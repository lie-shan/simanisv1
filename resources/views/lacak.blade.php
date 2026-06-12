<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pendaftaran — TPA Nurul Iman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            background-color: #72a5ba;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 750px;
        }

        .header-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
        }

        .header-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #104c8f;
        }

        .header-text h1 {
            margin: 0;
            font-size: 65px;
            font-weight: 900;
            letter-spacing: -2px;
            line-height: 1;
        }

        .header-text p {
            margin: 2px 0 0 0;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        .search-card {
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 28px 32px;
            margin-bottom: 32px;
            backdrop-filter: blur(4px);
        }

        .search-card .form-group {
            margin-bottom: 0;
        }

        .search-card label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .search-card .input-group {
            display: flex;
            gap: 10px;
        }

        .search-card input {
            flex: 1;
            padding: 14px 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            outline: none;
            transition: border-color 0.3s;
            background: rgba(255,255,255,0.9);
        }

        .search-card input:focus {
            border-color: #104c8f;
            background: #fff;
        }

        .search-card button {
            padding: 14px 28px;
            background: #104c8f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .search-card button:hover {
            background: #0c3d73;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            width: 100%;
        }

        .info-section {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 16px;
            margin-bottom: 25px;
        }

        td {
            padding: 6px 0;
            vertical-align: top;
        }

        td:nth-child(1) { width: 140px; }
        td:nth-child(2) { width: 20px; }

        .bold-val {
            font-weight: bold;
            letter-spacing: 0.3px;
            word-break: break-word;
        }

        .btn-back {
            background-color: #2d9f3f;
            color: #ffffff;
            border: none;
            padding: 16px;
            font-size: 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-align: center;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #248133;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-error {
            background: rgba(255,0,0,0.2);
            border: 1px solid rgba(255,0,0,0.3);
            color: #fff;
        }

        @media (max-width: 768px) {
            body { padding: 30px 15px; }
            .header-text h1 { font-size: 50px; }
            .page-title { font-size: 20px; margin-bottom: 30px; }
            .search-card { padding: 20px; }
        }

        @media (max-width: 480px) {
            body { padding: 20px 12px; }
            .header-section { gap: 10px; margin-bottom: 25px; }
            .header-text h1 { font-size: 36px; letter-spacing: -1px; }
            .header-text p { font-size: 11px; }
            .page-title { font-size: 16px; margin-bottom: 25px; }
            .search-card { padding: 16px; }
            .search-card .input-group { flex-direction: column; }
            .search-card button { justify-content: center; }
            table { font-size: 14px; }
            td:nth-child(1) { width: 110px; }
            .btn-back { padding: 12px; font-size: 13.5px; }
        }
    </style>
</head>
<body>

<div class="container">
    @php
        $appDesc = \App\Models\Setting::getValue('app_description', 'Sistem Informasi Akademik TPA Nurul Iman');
    @endphp
    <div class="header-section">
        <div class="header-text">
            <h1>SIMANIS</h1>
            <p>{{ $appDesc }}</p>
        </div>
    </div>
    

    @php
        $filterLabel = $jenisFilter ?? $jenis ?? null;
    @endphp

    @if(!isset($data))
        <div class="page-title">LACAK PENDAFTARAN{{ $filterLabel ? ' ' . $filterLabel : '' }}</div>

        <div class="search-card">
            <form method="POST" action="{{ route('lacak.cek') }}">
                @csrf
                @if ($filterLabel)
                <input type="hidden" name="jenis_filter" value="{{ $filterLabel }}">
                @endif
                <div class="form-group">
                    <label for="no_pendaftaran"><i class="fa-solid fa-search"></i> Masukkan nomor pendaftaran{{ $filterLabel ? ' ' . $filterLabel : '' }}</label>
                    <div class="input-group">
                        <input type="text" name="no_pendaftaran" id="no_pendaftaran"
                            placeholder="{{ $filterLabel === 'PEKANI' ? 'Contoh: PPKNI-12062026001' : 'Contoh: PSBNI-12062026001' }}"
                            value="{{ old('no_pendaftaran', $no ?? '') }}" required>
                        <button type="submit"><i class="fa-solid fa-arrow-right"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        @if (request()->isMethod('post') && !$errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> Data dengan nomor pendaftaran <strong>{{ $no }}</strong> tidak ditemukan.
            </div>
        @endif

    @endif

    @if (isset($data))
        <div class="page-title">PENGUMUMAN HASIL {{ $jenis ?? 'PENDAFTARAN' }}</div>

        <div class="content-wrapper">
            <div class="info-section">
                <table>
                    <tr>
                        <td>No. Pendaftaran</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->nama }}</td>
                    </tr>
                    @if ($data->jk)
                    <tr>
                        <td>Jenis kelamin</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    @endif
                    @if ($data->tmp_lahir || $data->tgl_lahir)
                    <tr>
                        <td>Tempat, tgl lahir</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->tmp_lahir ? $data->tmp_lahir . ', ' : '' }}{{ $data->tgl_lahir ? \Carbon\Carbon::parse($data->tgl_lahir)->format('d - m - Y') : '-' }}</td>
                    </tr>
                    @endif
                    @if ($data->ortu)
                    <tr>
                        <td>Nama ayah</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->ortu }}</td>
                    </tr>
                    @endif
                    @if ($data->ibu)
                    <tr>
                        <td>Nama ibu</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->ibu }}</td>
                    </tr>
                    @endif
                    @if ($data->no_hp)
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->no_hp }}</td>
                    </tr>
                    @endif
                    @php
                        $alamatParts = [];
                        if ($data->kampung) $alamatParts[] = $data->kampung;
                        if (!empty($data->rt_rw)) $alamatParts[] = 'RT/RW: ' . $data->rt_rw;
                        if (!empty($data->desa)) $alamatParts[] = $data->desa;
                        if (!empty($data->kecamatan)) $alamatParts[] = 'Kec. ' . $data->kecamatan;
                        if (!empty($data->kabupaten)) $alamatParts[] = $data->kabupaten;
                        if (!empty($data->kode_pos)) $alamatParts[] = $data->kode_pos;
                        $alamatLengkap = implode(', ', $alamatParts);
                    @endphp
                    @if ($alamatLengkap)
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td class="bold-val">{{ $alamatLengkap }}</td>
                    </tr>
                    @endif
                    @if (isset($data->asal_sekolah) && $data->asal_sekolah)
                    <tr>
                        <td>Asal sekolah</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->asal_sekolah }}</td>
                    </tr>
                    @endif
                    @if (isset($data->kelas_sekolah) && $data->kelas_sekolah)
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->kelas_sekolah }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->status }}</td>
                    </tr>
                    @if ($data->keterangan)
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->keterangan }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Tanggal daftar</td>
                        <td>:</td>
                        <td class="bold-val">{{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') : '-' }}</td>
                    </tr>
                </table>

                <a href="{{ route('lacak', $jenisFilter ? ['jenis' => $jenisFilter] : []) }}" class="btn-back" style="margin-top:20px;"><i class="fa-solid fa-arrow-left"></i> Kembali ke pencarian</a>
            </div>
        </div>
    @endif
</div>

</body>
</html>
