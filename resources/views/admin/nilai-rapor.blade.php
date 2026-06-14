<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor - {{ $santri->nama_santri }}</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }
        body { padding: 40px; color: #1e293b; }
        .kop {
            text-align: center; border-bottom: 3px solid #f59e0b; padding-bottom: 20px; margin-bottom: 24px;
        }
        .kop h1 { font-size: 20px; font-weight: 700; color: #d97706; margin-bottom: 4px; }
        .kop h2 { font-size: 15px; font-weight: 600; color: #1e293b; margin-bottom: 4px; }
        .kop p { font-size: 12px; color: #64748b; }
        .kop .divider { width: 80px; height: 3px; background: #f59e0b; margin: 10px auto; border-radius: 2px; }
        .title { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
        .info-grid { width: 100%; margin-bottom: 20px; font-size: 12px; }
        .info-grid .row { display: flex; align-items: center; margin-bottom: 4px; }
        .info-grid .label { min-width: 120px; font-weight: 600; color: #475569; display: inline-block; }
        .info-grid .value { min-width: 120px; display: inline-block; }
        .info-grid .r-label { min-width: 120px; font-weight: 600; color: #475569; display: inline-block; margin-left: auto; }
        .info-grid .rvalue { min-width: 90px; display: inline-block; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 24px; }
        th { background: #f59e0b; color: #fff; padding: 9px 8px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.2px; }
        th:first-child { text-align: left; border-radius: 6px 0 0 0; }
        th:last-child { border-radius: 0 6px 0 0; }
        td { padding: 7px 8px; border-bottom: 1px solid #e2e8f0; color: #475569; }
        td:first-child { text-align: left; }
        td:last-child { text-align: center; font-weight: 600; }
        td.center { text-align: center; }
        tr:nth-child(even) { background: #f8fafc; }
        tr.total td { background: #fef3c7; font-weight: 700; color: #1e293b; border-bottom: none; }
        .badge { display: inline-block; padding: 3px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge.lulus { background: #ecfdf5; color: #059669; }
        .badge.cadangan { background: #fef3c7; color: #d97706; }
        .badge.tidak-lulus { background: #fef2f2; color: #ef4444; }
        .footer { font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px; border-top: 1px solid #e2e8f0; padding-top: 16px; }
        .signatures { display: flex; justify-content: space-between; margin-top: 40px; padding: 0 20px; }
        .signatures .sig-item { text-align: center; min-width: 180px; }
        .signatures .sig-item .name { margin-top: 60px; font-weight: 600; font-size: 12px; border-top: 1px solid #1e293b; padding-top: 4px; }
        .signatures .sig-item .role { font-size: 11px; color: #64748b; margin-bottom: 4px; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none !important; }
            @page { margin: 15mm; }
        }
    </style>
</head>
<body>
    <div class="kop">
        <h1>LAPORAN HASIL BELAJAR SANTRI</h1>
        <h2>TAMAN PENDIDIKAN AL QUR'AN NURUL IMAN</h2>
        <p>Kampung Bebedahan RT 01 RW 03, Desa Wanamekar, Kecamatan Wanaraja, Kabupaten Garut 44183</p>
        <div class="divider"></div>
    </div>

    <div class="info-grid">
        <div class="row">
            <span class="label">Nama Santri</span>
            <span class="value">: {{ $santri->nama_santri }}</span>
            <span class="r-label">Kelas</span>
            <span class="rvalue">: {{ $santri->kelas }}</span>
        </div>
        <div class="row">
            <span class="label">No Registrasi</span>
            <span class="value">: {{ $santri->nis }}</span>
            <span class="r-label">Tahun Ajaran</span>
            <span class="rvalue">: {{ $santri->tahun_ajaran }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:40px;text-align:center;">No</th>
                <th>Mata Pelajaran</th>
                <th style="width:80px;">Nilai</th>
                <th style="width:100px;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mapelList as $i => $mapel)
            @php
                $score = $santri->nilai_mapel[$mapel] ?? 0;
                $ket = $score >= 80 ? 'Sangat Baik' : ($score >= 60 ? 'Baik' : ($score >= 40 ? 'Cukup' : 'Kurang'));
            @endphp
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $mapel }}</td>
                <td class="center">{{ $score }}</td>
                <td class="center">{{ $ket }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" style="text-align:right;padding-right:20px;">Rata-rata Nilai</td>
                <td class="center">{{ $santri->rata_rata }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signatures">
        <div class="sig-item">
            <div class="role">Wali Kelas</div>
            <div class="name">_________________</div>
        </div>
        <div class="sig-item">
            <div class="role">Orang Tua / Wali</div>
            <div class="name">_________________</div>
        </div>
    </div>

    <div class="footer">
        Dicetak pada <span id="printTime"></span> &middot; Sistem Informasi Akademik TPA Nurul Iman (SIMANIS)
    </div>

    <div class="no-print" style="text-align:center;margin-top:20px;">
        <button onclick="window.print()" style="padding:10px 24px;background:#f59e0b;color:#fff;border:none;border-radius:6px;font-size:14px;cursor:pointer;">
            <i class="fa-solid fa-print"></i> Cetak Rapor
        </button>
    </div>
    <script>
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const d = new Date();
        document.getElementById('printTime').textContent =
            days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear() +
            ' pukul ' + d.getHours().toString().padStart(2,'0') + ':' + d.getMinutes().toString().padStart(2,'0');
    </script>
</body>
</html>
