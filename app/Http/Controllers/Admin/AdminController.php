<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pembayaran;
use App\Models\Santri;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalStudents' => Santri::count(),
            'totalMale' => Santri::where('jk', 'L')->count(),
            'totalFemale' => Santri::where('jk', 'P')->count(),
            'totalTeachers' => Guru::count(),
            'totalClasses' => Kelas::count(),
            'totalSubjects' => MataPelajaran::count(),
            'totalUsers' => User::count(),
            'activeStudents' => Santri::where('status', 'Aktif')->count(),
            'totalPayments' => Pembayaran::count(),
            'todayAbsensi' => Absensi::whereDate('created_at', today())->count(),
        ];

        $kelasList = Kelas::orderBy('nama_kelas')->pluck('nama_kelas')->toArray();
        $tahunAjaran = ['2025/2026', '2024/2025', '2023/2024'];

        $classDistribution = Santri::selectRaw('kelas, COUNT(*) as total')
            ->groupBy('kelas')->orderBy('kelas')->pluck('total', 'kelas');

        $monthlyLabels = [];
        $monthlyNew = [];
        $monthlyActive = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $m->isoFormat('MMM');
            $monthlyNew[] = Santri::whereMonth('created_at', $m->month)
                ->whereYear('created_at', $m->year)->count();
            $monthlyActive[] = Santri::where('status', 'Aktif')
                ->whereMonth('created_at', '<=', $m->month)
                ->whereYear('created_at', '<=', $m->year)->count();
        }

        $recentActivities = [];

        return view('admin.dashboard', compact(
            'stats', 'kelasList', 'tahunAjaran', 'recentActivities',
            'classDistribution', 'monthlyLabels', 'monthlyNew', 'monthlyActive'
        ));
    }

    public function santri()
    {
        $santri = Santri::latest()->get();

        $kelasList = Kelas::orderBy('nama_kelas')->pluck('nama_kelas')->toArray();
        $statusList = ['Aktif', 'Tidak Aktif'];

        return view('admin.santri', compact('santri', 'kelasList', 'statusList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:50',
            'ortu' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('santri', 'public');
        }

        do {
            $nis = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (Santri::where('no_registrasi', $nis)->exists());

        $data['no_registrasi'] = $nis;

        if (!in_array($data['kelas'], Kelas::pluck('nama_kelas')->toArray())) {
            return redirect()->route('admin.santri')->with('error', 'Kelas tidak valid');
        }

        Santri::create($data);

        return redirect()->route('admin.santri')->with('success', 'Santri berhasil ditambahkan');
    }

    public function edit(Santri $santri)
    {
        return response()->json($santri);
    }

    public function update(Request $request, Santri $santri)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:50',
            'ortu' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('santri', 'public');
        }

        if (!in_array($data['kelas'], Kelas::pluck('nama_kelas')->toArray())) {
            return redirect()->route('admin.santri')->with('error', 'Kelas tidak valid');
        }

        $santri->update($data);

        return redirect()->route('admin.santri')->with('success', 'Santri berhasil diupdate');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();

        return redirect()->route('admin.santri')->with('success', 'Santri berhasil dihapus');
    }

    public function export()
    {
        $santri = Santri::orderBy('kelas')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
        $headers = [
            'No', 'No Registrasi', 'Nama Lengkap', 'Kelas', 'Tempat Lahir',
            'Tanggal Lahir', 'Nama Ayah', 'Nama Ibu', 'No. HP',
            'Kampung', 'Desa', 'Kecamatan', 'Kabupaten', 'Status'
        ];

        // Merge & title
        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', 'DATA SANTRI TPA NURUL IMAN');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1a1a2e']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Headers
        foreach ($headers as $i => $h) {
            $col = $columns[$i];
            $sheet->setCellValue($col . '2', $h);
            $sheet->getStyle($col . '2')->applyFromArray([
                'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0d6efd']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'dee2e6']]],
            ]);
        }

        // Data
        foreach ($santri as $i => $s) {
            $row = $i + 3;
            $tgl = $s->tgl_lahir ? date('d-m-Y', strtotime($s->tgl_lahir)) : '-';
            $data = [
                $i + 1,
                $s->no_registrasi,
                $s->nama,
                $s->kelas,
                $s->tmp_lahir,
                $tgl,
                $s->ortu,
                $s->ibu,
                $s->no_hp ?? '-',
                $s->kampung ?? '-',
                $s->desa ?? '-',
                $s->kecamatan ?? '-',
                $s->kabupaten ?? '-',
                $s->status,
            ];
            foreach ($data as $j => $val) {
                $col = $columns[$j];
                $sheet->setCellValueExplicit($col . $row, $val, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $leftCols = [2, 6, 7, 9, 10, 11, 12];
                $align = in_array($j, $leftCols) ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_CENTER;
                $sheet->getStyle($col . $row)->applyFromArray([
                    'alignment' => ['horizontal' => $align, 'vertical' => Alignment::VERTICAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'dee2e6']]],
                ]);
                $sheet->getStyle($col . $row)->getNumberFormat()->setFormatCode('@');
            }
        }

        // Auto width
        foreach ($columns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xls($spreadsheet);
        $filename = 'data-santri-' . date('Y-m-d') . '.xls';

        $callback = function () use ($writer) {
            $writer->save('php://output');
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
        $headers = [
            'No', 'No Registrasi', 'Nama Lengkap', 'Kelas', 'Tempat Lahir',
            'Tanggal Lahir', 'Nama Ayah', 'Nama Ibu', 'No. HP',
            'Kampung', 'Desa', 'Kecamatan', 'Kabupaten', 'Status'
        ];

        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', 'DATA SANTRI TPA NURUL IMAN');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1a1a2e']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        foreach ($headers as $i => $h) {
            $col = $columns[$i];
            $sheet->setCellValue($col . '2', $h);
            $sheet->getStyle($col . '2')->applyFromArray([
                'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0d6efd']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'dee2e6']]],
            ]);
        }

        foreach ($columns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xls($spreadsheet);
        $filename = 'template-import-santri.xls';

        $callback = function () use ($writer) {
            $writer->save('php://output');
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv,xls|max:5120',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        $imported = 0;
        $skipped = [];
        $errors = [];
        $existingNames = Santri::pluck('nama')->map(fn($n) => strtolower(trim($n)))->toArray();

        foreach ($rows as $i => $row) {
            if ($i < 2) continue;

            $nama = trim($row[2] ?? '');
            if (empty($nama)) continue;

            if (in_array(strtolower($nama), $existingNames)) {
                $skipped[] = $nama;
                continue;
            }

            if (empty(trim($row[1] ?? ''))) {
                do {
                    $reg = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
                } while (Santri::where('no_registrasi', $reg)->exists());
            } else {
                $reg = trim($row[1]);
            }

            try {
                Santri::create([
                    'no_registrasi' => $reg,
                    'nama' => $nama,
                    'jk' => strtoupper(substr(trim($row[4] ?? 'L'), 0, 1)) == 'P' ? 'P' : 'L',
                    'kelas' => trim($row[3] ?? '1A'),
                    'tmp_lahir' => trim($row[5] ?? '-'),
                    'tgl_lahir' => $row[6] ?? '-',
                    'ortu' => trim($row[7] ?? '-'),
                    'ibu' => trim($row[8] ?? '-'),
                    'no_hp' => trim($row[9] ?? '-'),
                    'kampung' => trim($row[10] ?? '-'),
                    'desa' => trim($row[11] ?? '-'),
                    'kecamatan' => trim($row[12] ?? '-'),
                    'kabupaten' => trim($row[13] ?? '-'),
                    'status' => trim($row[14] ?? 'Aktif'),
                ]);
                $existingNames[] = strtolower($nama);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Baris " . ($i + 1) . ": " . $e->getMessage();
            }
        }

        $msg = "$imported data santri berhasil diimport.";
        if (count($skipped) > 0) $msg .= " " . count($skipped) . " data dilewati (sudah terdaftar): " . implode(', ', array_slice($skipped, 0, 5)) . (count($skipped) > 5 ? ', dan lainnya...' : '');
        if (!empty($errors)) {
            $msg .= " " . count($errors) . " error: " . implode(', ', array_slice($errors, 0, 3));
        }

        return redirect()->route('admin.santri')->with('success', $msg);
    }
}
