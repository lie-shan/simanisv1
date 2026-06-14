<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ \App\Models\Setting::getValue('app_name', 'SIMANIS TPA Nurul Iman') }}</title>

    @php $appFavicon = \App\Models\Setting::getValue('app_favicon'); @endphp
    @if($appFavicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $appFavicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --bg-color: #f4f7fa;
            --sidebar-width: 260px;
            --header-height: 70px;
            --text-main: #333;
            --text-muted: #6c757d;
            --border-color: #e9ecef;
            --card-purple: #8c62c9;
            --card-blue: #4e9bdf;
            --card-red: #e66560;
            --card-pink: #a061a9;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            height: 100%;
            z-index: 10;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-logo {
            width: 110px;
            height: 110px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .sidebar-header h2 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.3;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 15px 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-item:hover { background-color: #f8f9fa; }

        .menu-item.active {
            background-color: var(--primary-blue);
            color: #ffffff;
        }

        .menu-item i {
            width: 20px;
            font-size: 16px;
            margin-right: 12px;
            text-align: center;
        }

        .menu-item .arrow { margin-left: auto; font-size: 12px; }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .top-header {
            height: var(--header-height);
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .header-left { display: flex; align-items: center; gap: 20px; }

        .hamburger {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f0f4ff;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            border: none;
        }

        .blue-logo {
            width: 24px;
            height: 24px;
            background-color: var(--primary-blue);
            border-radius: 4px;
            transform: skew(-10deg);
        }

        .header-right { display: flex; align-items: center; gap: 20px; }

        .header-icon {
            position: relative;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .header-icon.bell { background-color: #f0f4ff; color: var(--primary-blue); font-size: 16px; }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background-color: #ff9800;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 10px;
            border: 2px solid white;
        }

        .header-icon.bell { position: relative; }
        .notif-dropdown {
            position: absolute; top: 44px; right: -10px; width: 340px; max-height: 420px;
            background: #fff; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,.12);
            border: 1px solid #e9ecef; z-index: 999; display: none; overflow: hidden;
        }
        .notif-dropdown.show { display: block; }
        .notif-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 16px; border-bottom: 1px solid #f1f5f9;
            font-size: 13px; font-weight: 700; color: #1e293b;
        }
        .notif-read-all {
            background: none; border: none; font-size: 11px; color: var(--primary-blue);
            cursor: pointer; font-weight: 600; padding: 0;
        }
        .notif-read-all:hover { text-decoration: underline; }
        .notif-list { max-height: 340px; overflow-y: auto; }
        .notif-item {
            display: flex; align-items: flex-start; gap: 12px; padding: 12px 16px;
            border-bottom: 1px solid #f8f9fa; cursor: pointer; transition: background .15s;
        }
        .notif-item:hover { background: #f8f9fa; }
        .notif-item.belum { background: #f0f7ff; }
        .notif-item.belum:hover { background: #e8f0fe; }
        .notif-icon {
            width: 34px; height: 34px; border-radius: 10px; display: flex;
            align-items: center; justify-content: center; font-size: 14px; color: #fff; flex-shrink: 0;
        }
        .notif-body { flex: 1; min-width: 0; }
        .notif-judul { font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 2px; }
        .notif-pesan { font-size: 11px; color: #64748b; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .notif-waktu { font-size: 10px; color: #94a3b8; margin-top: 4px; }
        .notif-empty { padding: 30px; text-align: center; font-size: 13px; color: #94a3b8; }

        .user-profile { display: flex; align-items: center; gap: 12px; cursor: pointer; position: relative; }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 20px;
        }

        .user-info { display: flex; flex-direction: column; }

        .user-name { font-size: 14px; font-weight: 600; color: var(--text-main); }
        .user-id { font-size: 12px; color: var(--text-muted); }

        .user-profile i.fa-chevron-down {
            color: var(--text-muted);
            font-size: 12px;
            margin-left: 5px;
        }

        .dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            min-width: 210px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: all 0.2s ease;
            z-index: 200;
        }

        .dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 18px;
            font-size: 13px;
            color: var(--text-main);
            text-decoration: none;
            transition: background 0.15s;
        }

        .dropdown-item:hover { background: var(--bg-color); }
        .dropdown-item i { width: 18px; color: var(--text-muted); text-align: center; }
        .dropdown-item.danger { color: #dc3545; }
        .dropdown-item.danger i { color: #dc3545; }

        .dropdown-divider { height: 1px; background: var(--border-color); margin: 4px 0; }

        .content-area {
            flex: 1;
            padding: 20px 15px 24px;
            overflow-y: auto;
            min-height: 0;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 9;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 100;
            }

            .sidebar.open { transform: translateX(0); }

            .main-wrapper { margin-left: 0; }

            .hamburger { display: flex; }

            .header-search { display: none; }

            .content-area { padding: 0 14px 20px; }

            .header-date span { display: none; }

            .user-info { display: none; }
        }

        @media (max-width: 575px) {
            :root {
                --header-height: 60px;
            }

            .top-header { padding: 0 14px; }

            .header-right { gap: 10px; }

            .header-icon.bell { width: 32px; height: 32px; font-size: 14px; }

            .avatar { width: 34px; height: 34px; font-size: 16px; }

            .user-profile { gap: 8px; }

            .content-area { padding: 0 10px 16px; }

            .page-title { font-size: 20px; }

            .sidebar { width: 280px; }

            .header-left > div:last-child span:first-child { font-size: 15px !important; }
            .header-left > div:last-child span:last-child { font-size: 11px !important; }
            .header-left { gap: 12px; }

            .notif-dropdown { width: 290px; right: -70px; }

            .menu-item { padding: 14px 15px; font-size: 14px; }

            .sidebar-header { padding: 14px; }
            .sidebar-logo { width: 80px; height: 80px; }
            .sidebar-header h2 { font-size: 11px; }
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive table { min-width: 600px; }

        @media (max-width: 576px) {
            .modal-box { width: 95% !important; max-width: 95% !important; margin: 10px; }
            .modal-body { padding: 16px !important; }
            .pk-detail-body { padding: 16px !important; }
            .pk-detail-grid { grid-template-columns: 1fr !important; }
            .pes-form-grid { grid-template-columns: 1fr !important; }
            .pes-form-grid .full { grid-column: span 1 !important; }
            .pk-form-grid { grid-template-columns: 1fr !important; }
            .pk-form-grid .full { grid-column: span 1 !important; }
            .pk-detail-hero { padding: 24px 16px 20px !important; }
            .pk-detail-hero-avatar { width: 64px; height: 64px; font-size: 24px; }
            .pk-detail-hero-name { font-size: 16px; }
        }
    </style>
    @vite(['resources/css/app.css'])
</head>
<body>

    {{-- Sidebar --}}
    @php
        $appLogo = \App\Models\Setting::getValue('app_logo');
        $appShort = \App\Models\Setting::getValue('app_short_name', 'S');
        $appName = \App\Models\Setting::getValue('app_name', 'Sistem Informasi Akademik TPA Nurul Iman');
        $appNameBr = str_replace('TPA', '<br>TPA', $appName);
    @endphp
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo" style="{{ $appLogo ? 'overflow:hidden;' : 'background:var(--primary-blue);' }}">
                @if($appLogo)
                    <img src="{{ asset('storage/' . $appLogo) }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:12px;">
                @else
                    <span style="color:#fff;font-size:28px;font-weight:800;">{{ $appShort[0] ?? 'S' }}</span>
                @endif
            </div>
            <h2 style="font-size:12px;">{!! $appNameBr !!}</h2>
        </div>
        <div class="sidebar-menu">
            {{-- Menu Utama --}}
            <div style="font-size:11px;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.5px;padding:15px 15px 5px;">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i> Dashboard
            </a>
            <a href="{{ route('admin.santri') }}" class="menu-item {{ request()->routeIs('admin.santri') ? 'active' : '' }}">
                <i class="fa-solid fa-child-reaching"></i> Data Santri
            </a>
            <a href="{{ route('admin.guru') }}" class="menu-item {{ request()->routeIs('admin.guru') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i> Data Guru
            </a>
            <a href="{{ route('admin.kelas') }}" class="menu-item {{ request()->routeIs('admin.kelas') ? 'active' : '' }}">
                <i class="fa-solid fa-people-group"></i> Data Kelas
            </a>
            <a href="{{ route('admin.pengumuman') }}" class="menu-item {{ request()->routeIs('admin.pengumuman') ? 'active' : '' }}">
                <i class="fa-solid fa-bullhorn"></i> Pengumuman
            </a>

            {{-- Administrasi --}}
            <div style="font-size:11px;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.5px;padding:15px 15px 5px;">Administrasi</div>

            <a href="{{ route('admin.pembayaran') }}" class="menu-item {{ request()->routeIs('admin.pembayaran') ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill-wave"></i> Pembayaran
            </a>
            <a href="{{ route('admin.absensi') }}" class="menu-item {{ request()->routeIs('admin.absensi*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-check"></i> Absensi Harian
            </a>
            <a href="{{ route('admin.jadwal') }}" class="menu-item {{ request()->routeIs('admin.jadwal') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar-days"></i> Jadwal Pelajaran
            </a>
            <a href="{{ route('admin.mutasi-santri') }}" class="menu-item {{ request()->routeIs('admin.mutasi-santri') ? 'active' : '' }}">
                <i class="fa-solid fa-arrows-rotate"></i> Mutasi Santri
            </a>
            <a href="{{ route('admin.pesanim') }}" class="menu-item {{ request()->routeIs('admin.pesanim') ? 'active' : '' }}">
                <i class="fa-solid fa-user-plus"></i> PESANIM
            </a>
            <a href="{{ route('admin.pekani') }}" class="menu-item {{ request()->routeIs('admin.pekani') ? 'active' : '' }}">
                <i class="fa-solid fa-school"></i> PEKANI
            </a>

            {{-- Akademik --}}
            <div style="font-size:11px;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.5px;padding:15px 15px 5px;">Akademik</div>

            <a href="{{ route('admin.mata-pelajaran') }}" class="menu-item {{ request()->routeIs('admin.mata-pelajaran*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> Mata Pelajaran
            </a>
            <a href="{{ route('admin.hafalan-tahsin') }}" class="menu-item {{ request()->routeIs('admin.hafalan-tahsin*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-quran"></i> Hafalan & Tahsin
            </a>
            <a href="{{ route('admin.kuis-ujian') }}" class="menu-item {{ request()->routeIs('admin.kuis-ujian*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pen"></i> Kuis & Ujian
            </a>
            <a href="{{ route('admin.tugas') }}" class="menu-item {{ request()->routeIs('admin.tugas') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open"></i> Pengumpulan Tugas
            </a>
            <a href="{{ route('admin.nilai') }}" class="menu-item {{ request()->routeIs('admin.nilai') ? 'active' : '' }}">
                <i class="fa-regular fa-star"></i> Nilai & Rapor
            </a>



            {{-- Lainnya --}}
            <div style="font-size:11px;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.5px;padding:15px 15px 5px;">Lainnya</div>

            <a href="{{ route('admin.pengguna') }}" class="menu-item {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
                <i class="fa-solid fa-users-gear"></i> Data Pengguna
            </a>
            <a href="{{ route('admin.pengaturan') }}" class="menu-item {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Pengaturan
            </a>
        </div>
        <div style="padding:15px 10px;border-top:1px solid var(--border-color);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item" style="width:100%;border:none;background:none;cursor:pointer;color:#dc3545;">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Main Wrapper --}}
    <div class="main-wrapper">

        {{-- Top Header --}}
        <header class="top-header">
            <div class="header-left">
                <div class="hamburger" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
                <div>
                    <span style="font-size:17px;font-weight:700;color:#2c3e50;display:block;">@yield('header_title', 'Dashboard')</span>
                    <span style="font-size:12px;font-weight:400;color:#94a3b8;display:block;margin-top:1px;">@yield('header_subtitle')</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-icon bell" id="bellIcon" onclick="toggleNotif()">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge" id="notifBadge">0</span>
                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-head">
                            <span>Notifikasi</span>
                            <button class="notif-read-all" onclick="event.stopPropagation();readAllNotif()">Tandai dibaca</button>
                        </div>
                        <div class="notif-list" id="notifList">
                            <div class="notif-empty">Memuat...</div>
                        </div>
                    </div>
                </div>
                <div class="user-profile">
                    <div class="avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-id">Admin TPA</span>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="content-area">
            {{ $slot }}
        </main>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        (function() {
            if (window._scrollRestoreDone) return;
            window._scrollRestoreDone = true;

            var selectors = ['.content-area', '.sidebar-menu'];
            var stores = {};

            selectors.forEach(function(sel) {
                var el = document.querySelector(sel);
                if (!el) return;
                var key = 'scroll_' + sel + '_' + window.location.pathname;
                stores[sel] = { el: el, key: key };

                var saved = localStorage.getItem(key);
                if (saved) {
                    el.scrollTop = parseInt(saved, 10);
                }

                el.addEventListener('scroll', function() {
                    localStorage.setItem(key, el.scrollTop);
                });
            });

            window.addEventListener('beforeunload', function() {
                for (var s in stores) {
                    localStorage.setItem(stores[s].key, stores[s].el.scrollTop);
                }
            });
        })();
    </script>

    <script>
        function fetchNotif() {
            fetch('{{ route("admin.notifikasi.fetch") }}')
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    var badge = document.getElementById('notifBadge');
                    badge.textContent = d.totalUnread;
                    badge.style.display = d.totalUnread > 0 ? 'inline' : 'none';
                    var list = document.getElementById('notifList');
                    if (d.notifikasi.length === 0) {
                        list.innerHTML = '<div class="notif-empty">Tidak ada notifikasi</div>';
                        return;
                    }
                    var html = '';
                    d.notifikasi.forEach(function(n) {
                        var cls = n.dibaca ? '' : ' belum';
                        var waktu = n.created_at ? new Date(n.created_at + ' UTC').toLocaleDateString('id-ID', { day:'numeric', month:'short', hour:'2-digit', minute:'2-digit' }) : '';
                        html += '<div class="notif-item' + cls + '" data-id="' + n.id + '" onclick="clickNotif(' + n.id + ')">';
                        html += '<div class="notif-icon" style="background:' + (n.warna || 'var(--primary-blue)') + '"><i class="' + n.icon + '"></i></div>';
                        html += '<div class="notif-body"><div class="notif-judul">' + n.judul + '</div>';
                        if (n.pesan) html += '<div class="notif-pesan">' + n.pesan + '</div>';
                        html += '<div class="notif-waktu">' + waktu + '</div></div></div>';
                    });
                    list.innerHTML = html;
                });
        }

        function toggleNotif() {
            var dd = document.getElementById('notifDropdown');
            dd.classList.toggle('show');
            if (dd.classList.contains('show')) fetchNotif();
            event.stopPropagation();
        }

        function clickNotif(id) {
            fetch('{{ url("admin/notifikasi") }}/' + id + '/read', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function() {
                    fetchNotif();
                });
        }

        function readAllNotif() {
            fetch('{{ route("admin.notifikasi.read-all") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function() {
                    fetchNotif();
                });
        }

        document.addEventListener('click', function(e) {
            var dd = document.getElementById('notifDropdown');
            if (dd.classList.contains('show') && !dd.contains(e.target) && e.target.closest('.header-icon.bell') === null) {
                dd.classList.remove('show');
            }
        });

        fetchNotif();
        setInterval(fetchNotif, 30000);
    </script>

    @stack('scripts')
</body>
</html>
