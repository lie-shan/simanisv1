<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Mata Pelajaran</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 11px;
            padding: 20px;
            color: #1a1a2e;
        }
        body::before {
            content: '';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(90deg);
            width: 90%;
            height: 90%;
            background: url('{{ asset("assets/img/logo_simanis.png") }}') no-repeat center;
            background-size: contain;
            opacity: 0.08;
            pointer-events: none;
            z-index: -1;
        }
        .header {
            text-align: center;
            margin-bottom: 16px;
            padding: 0 0 12px 0;
            border-bottom: 2px solid #f97316;
        }
        .header h1 { font-size: 18px; margin: 0; line-height: 1.2; }
        .header p { font-size: 12px; color: #666; margin: 0; line-height: 1.4; }
        .header img { display: block; margin: 0 auto; height: 50px; }
        table.data {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th {
            background: #f97316;
            color: #fff;
            padding: 6px 4px;
            text-align: center;
            font-weight: 600;
            border: 1px solid #dee2e6;
        }
        td {
            padding: 4px;
            border: 1px solid #dee2e6;
            text-align: center;
        }
        td.left { text-align: left; }
        .footer {
            margin-top: 16px;
            text-align: right;
            font-size: 11px;
            color: #666;
        }
        .status-badge { font-weight: 600; }
        .status-badge.aktif { color: #16a34a; }
        .status-badge.tidak-aktif { color: #dc2626; }
        @media print {
            body { padding: 10px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom:12px;">
        <button onclick="window.print()" style="padding:8px 16px;background:#f97316;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:13px;">
            <i class="fa-solid fa-print"></i> Cetak / Print
        </button>
        <button onclick="window.close()" style="padding:8px 16px;background:#6c757d;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:13px;margin-left:8px;">
            Tutup
        </button>
    </div>

    <div class="header">
        <img src="{{ asset('assets/img/logo_simanis.png') }}" alt="Logo" style="height:60px;display:block;margin:0 auto;">
        <h1>LAPORAN DATA MATA PELAJARAN TAMAN PENDIDIKAN AL QUR'AN NURUL IMAN</h1>
        <p>Kampung Bebedahan RT 01 RW 03, Desa Wanamekar, Kecamatan Wanaraja, Kabupaten Garut 44183</p>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th>Kode Mapel</th>
                <th style="text-align:left;">Nama Mata Pelajaran</th>
                <th style="text-align:left;">Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapel as $i => $m)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td style="font-family:monospace;">{{ $m->kode_mapel }}</td>
                <td class="left">{{ $m->nama_mapel }}</td>
                <td class="left">{{ $m->deskripsi ?? '-' }}</td>
                <td class="status-badge {{ strtolower(str_replace(' ', '-', $m->status)) }}">{{ $m->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:20px;text-align:center;color:#999;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <span id="printTime"></span>
    </div>

    <script>
        var now = new Date();
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        var day = now.getDate();
        var month = months[now.getMonth()];
        var year = now.getFullYear();
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('printTime').textContent = day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes;
    </script>
</body>
</html>
