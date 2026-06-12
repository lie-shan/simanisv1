<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengumpulan Tugas - TPA Nurul Iman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { padding: 40px; color: #1e293b; }
        .kop {
            text-align: center; border-bottom: 3px solid #e11d48; padding-bottom: 20px; margin-bottom: 24px;
        }
        .kop h1 { font-size: 22px; font-weight: 700; color: #be123c; margin-bottom: 4px; }
        .kop h2 { font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 4px; }
        .kop p { font-size: 12px; color: #64748b; }
        .kop .divider { width: 80px; height: 3px; background: #e11d48; margin: 10px auto; border-radius: 2px; }
        .title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 24px; }
        th { background: #e11d48; color: #fff; padding: 10px 12px; text-align: center; font-size: 11px; text-transform: uppercase; letter-spacing: 0.3px; }
        td { padding: 8px 12px; border-bottom: 1px solid #e2e8f0; color: #475569; text-align: center; }
        td.left { text-align: left; }
        tr:nth-child(even) { background: #f8fafc; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: 10px; font-weight: 600; }
        .badge.aktif { background: #fef3c7; color: #d97706; }
        .badge.selesai { background: #ecfdf5; color: #059669; }
        .footer { font-size: 11px; color: #94a3b8; text-align: center; margin-top: 24px; border-top: 1px solid #e2e8f0; padding-top: 16px; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="kop">
        <h1>TAMAN PENDIDIKAN AL QUR'AN NURUL IMAN</h1>
        <h2>LAPORAN PENGUMPULAN TUGAS</h2>
        <p>Kampung Bebedahan RT 01 RW 03, Desa Wanamekar, Kecamatan Wanaraja, Kabupaten Garut 44183</p>
        <div class="divider"></div>
    </div>

    <div class="title">
        <i class="fa-solid fa-folder-open" style="color:#e11d48;"></i> Data Pengumpulan Tugas
        <span style="font-size:12px;font-weight:400;color:#94a3b8;margin-left:12px;">Periode: {{ now()->isoFormat('D MMMM Y') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th style="text-align:left;">Judul Tugas</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Deadline</th>
                <th>Pengumpul</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="left">{{ $r->judul }}</td>
                <td>{{ $r->kelas }}</td>
                <td>{{ $r->mapel }}</td>
                <td>{{ \Carbon\Carbon::parse($r->tanggal_deadline)->isoFormat('D MMM Y') }}</td>
                <td>{{ $r->pengumpul ?? 0 }}/{{ $r->total_santri ?? 0 }}</td>
                <td><span class="badge {{ strtolower($r->status) }}">{{ $r->status }}</span></td>
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
