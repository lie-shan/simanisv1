<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Santri - TPA Nurul Iman</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }
        body { padding: 40px; color: #1e293b; }
        .kop {
            text-align: center; border-bottom: 3px solid #f59e0b; padding-bottom: 20px; margin-bottom: 24px;
        }
        .kop h1 { font-size: 22px; font-weight: 700; color: #d97706; margin-bottom: 4px; }
        .kop h2 { font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 4px; }
        .kop p { font-size: 12px; color: #64748b; }
        .kop .divider { width: 80px; height: 3px; background: #f59e0b; margin: 10px auto; border-radius: 2px; }
        .title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; margin-bottom: 24px; }
        th { background: #f59e0b; color: #fff; padding: 9px 8px; text-align: center; font-size: 10px; text-transform: uppercase; letter-spacing: 0.2px; }
        td { padding: 7px 8px; border-bottom: 1px solid #e2e8f0; color: #475569; text-align: center; }
        td.left { text-align: left; }
        tr:nth-child(even) { background: #f8fafc; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: 10px; font-weight: 600; }
        .badge.lulus { background: #ecfdf5; color: #059669; }
        .badge.cadangan { background: #fef3c7; color: #d97706; }
        .badge.tidak-lulus { background: #fef2f2; color: #ef4444; }
        .footer { font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px; border-top: 1px solid #e2e8f0; padding-top: 16px; }
        @media print { body { padding: 20px; } }
    </style>
</head>
<body>
    <div class="kop">
        <h1>TAMAN PENDIDIKAN AL QUR'AN NURUL IMAN</h1>
        <h2>LAPORAN NILAI SANTRI</h2>
        <p>Kampung Bebedahan RT 01 RW 03, Desa Wanamekar, Kecamatan Wanaraja, Kabupaten Garut 44183</p>
        <div class="divider"></div>
    </div>

    <div class="title">
        <i class="fa-solid fa-star" style="color:#f59e0b;"></i> Data Nilai Santri
        <span style="font-size:12px;font-weight:400;color:#94a3b8;margin-left:12px;">Periode: {{ now()->isoFormat('D MMMM Y') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th style="text-align:left;">Nama</th>
                <th>Kelas</th>
                @foreach($mapelList as $mapel)
                <th>{{ Str::of($mapel)->limit(6, '..') }}</th>
                @endforeach
                <th>Rata²</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="left">{{ $r->nama_santri }}</td>
                <td>{{ $r->kelas }}</td>
                @foreach($mapelList as $mapel)
                <td>{{ $r->nilai_mapel[$mapel] ?? 0 }}</td>
                @endforeach
                <td><strong>{{ $r->rata_rata }}</strong></td>
                <td><span class="badge {{ str_replace(' ', '-', strtolower($r->status)) }}">{{ $r->status }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->isoFormat('dddd, D MMMM Y') }} pukul {{ now()->format('H:i') }} &middot; Sistem Informasi Akademik TPA Nurul Iman (SIMANIS)
    </div>

    <script>window.print();</script>
</body>
</html>
