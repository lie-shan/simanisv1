<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — {{ $appShort ?? 'SIMANIS' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @php
        $appLogo = \App\Models\Setting::getValue('app_logo');
        $appShort = \App\Models\Setting::getValue('app_short_name', 'SIMANIS');
        $appName = \App\Models\Setting::getValue('app_name', 'Sistem Informasi Akademik TPA Nurul Iman');
        $appDesc = \App\Models\Setting::getValue('app_description', 'Taman Pendidikan Al Quran Nurul Iman');
        $pengumuman = \App\Models\Pengumuman::where('status', 'aktif')->latest()->first();
    @endphp
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #ffffff;
        }

        .left-panel {
            width: 50%;
            display: flex;
            flex-direction: column;
            padding: 40px 60px;
            background-color: #ffffff;
        }

        .logo-header {
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 15px;
            margin-bottom: auto;
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

        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            margin-bottom: auto;
            padding-top: 40px;
        }

        .login-container h2 {
            font-size: 28px;
            color: #1a56db;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
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

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            color: #333;
            background-color: transparent;
            transition: border-color 0.2s;
        }

        .input-group input::placeholder {
            color: #999;
        }

        .input-group input:focus {
            border-bottom: 2px solid #1a56db;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #1a56db;
            cursor: pointer;
            font-size: 16px;
            background: none;
            border: none;
            padding: 4px;
            line-height: 1;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-password a {
            color: #1a56db;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-login {
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
        }

        .btn-login:hover {
            background-color: #1545b3;
        }

        .right-panel {
            width: 50%;
            position: relative;
            background: linear-gradient(135deg, #e0e8f5 0%, #f4f7fb 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow: hidden;
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
                min-height: auto;
            }
            .right-panel {
                padding: 40px 30px;
                align-items: center;
                min-height: 300px;
            }
            .info-card {
                margin-top: 0;
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
            .login-container {
                padding-top: 30px;
                padding-bottom: 20px;
            }
            .login-container h2 {
                font-size: 24px;
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

        <div class="login-container">
            <h2>Portal Santri</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Masukkan No Registrasi atau Email" required autofocus>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePass()" tabindex="-1">
                        <i class="fa-solid fa-eye-slash" id="passIcon"></i>
                    </button>
                </div>
                <div class="forgot-password">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa Password ?</a>
                    @endif
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <div class="right-panel">
        <div class="bg-shape"></div>
        <div class="info-card">
            <div class="info-header">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Info Singkat</span>
            </div>
            <div class="info-body">
                <div class="info-date">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y | H:i') }}</span>
                </div>
                <div class="info-content">
                    @if($pengumuman)
                        <p>{{ $pengumuman->judul }}</p>
                        <p>{!! nl2br(e($pengumuman->isi)) !!}</p>
                    @else
                        <p>
                            SILAHKAN SANTRI LOGIN MENGGUNAKAN<br>
                            USERNAME : NO REGISTRASI / EMAIL<br>
                            PASS : PASSWORD
                        </p>
                        <p>
                            JIKA ADA KENDALA SILAHKAN HUBUNGI PENGURUS ATAU GUNAKAN FITUR RESET PASSWORD
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    function togglePass() {
        var p = document.getElementById('password');
        var icon = document.getElementById('passIcon');
        if (p.type === 'password') {
            p.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            p.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
    </script>

</body>
</html>