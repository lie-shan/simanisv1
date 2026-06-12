<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::latest()->get();
        $statusList = ['Aktif', 'Tidak Aktif'];
        $kelasData = Kelas::orderBy('nama_kelas')->get();

        return view('admin.guru', compact('guru', 'statusList', 'kelasData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        do {
            $no_registrasi = str_pad(mt_rand(0, 999999999999999999), 18, '0', STR_PAD_LEFT);
        } while (Guru::where('no_registrasi', $no_registrasi)->exists());

        $data['no_registrasi'] = $no_registrasi;
        Guru::create($data);

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return response()->json($guru);
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil diupdate');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('admin.guru')->with('success', 'Guru berhasil dihapus');
    }

    public function export()
    {
        $guru = Guru::orderBy('nama')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['A','B','C','D','E','F','G','H','I','J','K','L'];
        $headers = [
            'No', 'No Registrasi', 'Nama Lengkap', 'JK', 'Tempat Lahir',
            'Tanggal Lahir', 'No. HP',
            'Kampung', 'Desa', 'Kecamatan', 'Kabupaten', 'Status'
        ];

        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A1', 'DATA GURU TPA NURUL IMAN');
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

        foreach ($guru as $i => $g) {
            $row = $i + 3;
            $tgl = $g->tgl_lahir ? date('d-m-Y', strtotime($g->tgl_lahir)) : '-';
            $data = [
                $i + 1,
                $g->no_registrasi,
                $g->nama,
                $g->jk == 'L' ? 'Laki-laki' : 'Perempuan',
                $g->tmp_lahir,
                $tgl,
                $g->no_hp ?? '-',
                $g->kampung ?? '-',
                $g->desa ?? '-',
                $g->kecamatan ?? '-',
                $g->kabupaten ?? '-',
                $g->status,
            ];
            foreach ($data as $j => $val) {
                $col = $columns[$j];
                $sheet->setCellValueExplicit($col . $row, $val, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $leftCols = [2, 7, 8, 9, 10];
                $align = in_array($j, $leftCols) ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_CENTER;
                $sheet->getStyle($col . $row)->applyFromArray([
                    'alignment' => ['horizontal' => $align, 'vertical' => Alignment::VERTICAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'dee2e6']]],
                ]);
                $sheet->getStyle($col . $row)->getNumberFormat()->setFormatCode('@');
            }
        }

        foreach ($columns as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xls($spreadsheet);
        $filename = 'data-guru-' . date('Y-m-d') . '.xls';

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

        $columns = ['A','B','C','D','E','F','G','H','I','J','K','L'];
        $headers = [
            'No', 'No Registrasi', 'Nama Lengkap', 'JK', 'Tempat Lahir',
            'Tanggal Lahir', 'No. HP',
            'Kampung', 'Desa', 'Kecamatan', 'Kabupaten', 'Status'
        ];

        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A1', 'DATA GURU TPA NURUL IMAN');
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
        $filename = 'template-import-guru.xls';

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
        $existingNames = Guru::pluck('nama')->map(fn($n) => strtolower(trim($n)))->toArray();

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
                    $reg = str_pad(mt_rand(0, 999999999999999999), 18, '0', STR_PAD_LEFT);
                } while (Guru::where('no_registrasi', $reg)->exists());
            } else {
                $reg = trim($row[1]);
            }

            try {
                Guru::create([
                    'no_registrasi' => $reg,
                    'nama' => $nama,
                    'jk' => strtoupper(substr(trim($row[3] ?? 'L'), 0, 1)) == 'P' ? 'P' : 'L',
                    'tmp_lahir' => trim($row[4] ?? '-'),
                    'tgl_lahir' => $row[5] ?? '-',
                    'no_hp' => trim($row[6] ?? '-'),
                    'kampung' => trim($row[7] ?? '-'),
                    'desa' => trim($row[8] ?? '-'),
                    'kecamatan' => trim($row[9] ?? '-'),
                    'kabupaten' => trim($row[10] ?? '-'),
                    'status' => trim($row[11] ?? 'Aktif'),
                ]);
                $existingNames[] = strtolower($nama);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Baris " . ($i + 1) . ": " . $e->getMessage();
            }
        }

        $msg = "$imported data guru berhasil diimport.";
        if (count($skipped) > 0) $msg .= " " . count($skipped) . " data dilewati (sudah terdaftar): " . implode(', ', array_slice($skipped, 0, 5)) . (count($skipped) > 5 ? ', dan lainnya...' : '');
        if (!empty($errors)) {
            $msg .= " " . count($errors) . " error: " . implode(', ', array_slice($errors, 0, 3));
        }

        return redirect()->route('admin.guru')->with('success', $msg);
    }
}
