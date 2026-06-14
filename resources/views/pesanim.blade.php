<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PESANIM — Penerimaan Santri Nurul Iman</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @php
        $appLogo = \App\Models\Setting::getValue('app_logo');
        $appName = \App\Models\Setting::getValue('app_name', 'Sistem Informasi Akademik TPA Nurul Iman');
        $appDesc = \App\Models\Setting::getValue('app_description', 'Taman Pendidikan Al Quran Nurul Iman');
        $tahunAjaran = \App\Models\Setting::getValue('academic_year', '2025/2026');
    @endphp
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #ffffff;
        }

        .left-panel {
            width: 55%;
            display: flex;
            flex-direction: column;
            padding: 40px 60px;
            background-color: #ffffff;
            overflow-y: auto;
        }

        .logo-header {
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 15px;
            margin-bottom: 30px;
        }

        .logo-header img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 5px;
        }

        .logo-placeholder {
            min-width: 50px;
            height: 50px;
            background-color: #f0f0f0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
            border: 1px dashed #ccc;
        }

        .logo-text h1 {
            font-size: 20px;
            color: #333;
            font-weight: 700;
        }

        .logo-text p {
            font-size: 14px;
            color: #777;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .register-container h2 {
            font-size: 26px;
            color: #213555;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .register-container p.subtitle {
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .profile-upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            padding: 15px;
            border: 1px dashed #ccc;
            border-radius: 8px;
            background-color: #fafdff;
        }

        .profile-preview {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-color: #e0e8f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a56db;
            font-size: 32px;
            margin-bottom: 10px;
            border: 2px solid #1a56db;
            overflow: hidden;
            position: relative;
        }

        .profile-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-input-label {
            font-size: 13px;
            color: #1a56db;
            font-weight: 600;
            cursor: pointer;
            padding: 6px 12px;
            border: 1px solid #1a56db;
            border-radius: 20px;
            transition: all 0.3s;
        }

        .file-input-label:hover {
            background-color: #1a56db;
            color: #fff;
        }

        .profile-upload-container input[type="file"] {
            display: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group label .req {
            color: #e74c3c;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            color: #333;
            background-color: transparent;
            transition: border-color 0.3s;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #aaa;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-bottom: 2px solid #1a56db;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 60px;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background-color: #1a56db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #1545b3;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #1a56db;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .right-panel {
            width: 45%;
            position: relative;
            background: linear-gradient(135deg, #e0e8f5 0%, #f4f7fb 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow: hidden;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .bg-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 86, 219, 0.8);
            clip-path: polygon(0 0, 100% 0, 100% 40%, 0 80%);
            z-index: 1;
        }

        .info-card {
            position: relative;
            z-index: 2;
            background-color: #1a56db;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            margin: 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .info-header {
            padding: 15px 20px;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .info-body {
            background-color: #fff;
            margin: 0 5px 5px 5px;
            border-radius: 8px;
            padding: 25px;
        }

        .info-date {
            font-size: 12px;
            color: #888;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-date i {
            color: #1a56db;
        }

        .info-content {
            font-size: 13px;
            color: #111;
            line-height: 1.6;
        }

        .info-content ul {
            margin-left: 20px;
            margin-bottom: 15px;
            color: #444;
        }

        .info-content p {
            margin-bottom: 15px;
        }

        .info-content p:last-child {
            margin-bottom: 0;
        }

        @media screen and (max-width: 992px) {
            body {
                flex-direction: column;
            }
            .left-panel, .right-panel {
                width: 100%;
            }
            .left-panel {
                padding: 30px 40px;
                overflow-y: visible;
            }
            .right-panel {
                padding: 40px 30px;
                align-items: center;
                position: relative;
                height: auto;
            }
        }

        @media screen and (max-width: 576px) {
            .left-panel {
                padding: 20px;
            }
            .logo-header {
                flex-direction: row;
                align-items: center;
                gap: 10px;
            }
            .logo-text h1 {
                font-size: 15px;
            }
            .logo-text p {
                font-size: 11px;
            }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .form-group.full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

    <div class="left-panel">
        <div class="logo-header">
            @if($appLogo)
                <img src="{{ asset('storage/' . $appLogo) }}" alt="{{ $appName }}">
            @else
                <div class="logo-placeholder">Logo<br>TPQ</div>
            @endif
            <div class="logo-text">
                <h1>{{ $appName }}</h1>
                <p>{{ $appDesc }}</p>
            </div>
        </div>

        <div class="register-container">
            <h2>Formulir PESANIM</h2>
            <p class="subtitle">Penerimaan Santri Baru Nurul Iman</p>

            @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
                <a href="{{ route('lacak', ['jenis' => 'PESANIM']) }}" style="color:#166534;font-weight:700;text-decoration:underline;margin-left:4px;">Lacak</a>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('pesanim.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="profile-upload-container">
                    <div class="profile-preview" id="imagePreview">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <label for="profileInput" class="file-input-label">Pilih Foto Profil</label>
                    <input type="file" id="profileInput" name="foto" accept="image/*" onchange="previewImage(event)">
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nama Lengkap Santri <span class="req">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir <span class="req">*</span></label>
                        <input type="text" name="tmp_lahir" value="{{ old('tmp_lahir') }}" placeholder="Kota/Kabupaten" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir <span class="req">*</span></label>
                        <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Jenis Kelamin <span class="req">*</span></label>
                        <select name="jk" required>
                            <option value="" disabled {{ old('jk') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Ayah <span class="req">*</span></label>
                        <input type="text" name="ortu" value="{{ old('ortu') }}" placeholder="Masukkan nama ayah" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Ibu <span class="req">*</span></label>
                        <input type="text" name="ibu" value="{{ old('ibu') }}" placeholder="Masukkan nama ibu" required>
                    </div>

                    <div class="form-group full-width">
                        <label>No. HP <span class="req">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan no. HP yang bisa dihubungi" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Alamat Lengkap <span class="req">*</span></label>
                        <textarea name="kampung" placeholder="Jalan, RT/RW, Desa/Kelurahan..." required>{{ old('kampung') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>

                <div class="login-link">
                    <a href="{{ route('lacak', ['jenis' => 'PESANIM']) }}"><i class="fa-solid fa-search"></i> Lacak Pendaftaran</a>
                </div>
            </form>
        </div>
    </div>

    <div class="right-panel">
        <div class="bg-shape"></div>
        <div class="info-card">
            <div class="info-header">
                <i class="fa-solid fa-circle-info"></i>
                <span>Informasi Pendaftaran</span>
            </div>
            <div class="info-body">
                <div class="info-date">
                    <i class="fa-solid fa-clock"></i>
                    <span>Tahun Ajaran {{ $tahunAjaran }}</span>
                </div>
                <div class="info-content">
                    <p><strong>Syarat Pendaftaran:</strong></p>
                    <ul>
                        <li>Pas foto profil terbaru (unggah pada form).</li>
                        <li>Mengisi formulir pendaftaran online.</li>
                        <li>Data yang di isi harus sesuai dengan KK dan Akte.</li>
                    </ul>
                    <p>
                        Setelah mengisi formulir, silakan konfirmasi atau tunggu petunjuk selanjutnya dari pihak pengurus.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('imagePreview');
                output.innerHTML = '<img src="' + reader.result + '" alt="Preview">';
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

</body>
</html>