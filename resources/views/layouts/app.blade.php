<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <!-- Scripts (Vite) -->
    @vite(['resources/js/app.js'])
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="https://upload.wikimedia.org/wikipedia/id/3/30/Logo_Institut_Kesehatan_Karsa_Husada_Garut.png" alt="Logo Karsa Husada" onerror="this.src='https://via.placeholder.com/60?text=Logo'">
            <h2>Institut Kesehatan Karsa<br>Husada Garut</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large"></i> Dashboard
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-address-card"></i> Biodata
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-folder-open"></i> KRS <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-file-invoice-dollar"></i> Biaya Kuliah
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-book-bookmark"></i> Bahan & Tugas
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-calendar-days"></i> Jadwal & Presensi
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-user-doctor"></i> PA Online
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-rectangle-list"></i> Kuesioner
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-star"></i> Nilai
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-users-rectangle"></i> Kegiatan <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <a href="#" class="menu-item">
                <i class="fa-regular fa-file-lines"></i> Pengajuan <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            
            <!-- Log Out Button -->
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                @csrf
                <a href="{{ route('logout') }}" class="menu-item"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </a>
            </form>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Header -->
        <header class="top-header">
            <div class="header-left">
                <div class="hamburger">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
                <div class="blue-logo"></div>
            </div>
            
            <div class="header-right">
                <div class="header-icon bell">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge">28</span>
                </div>
                <div class="header-icon info">
                    <i class="fa-solid fa-info"></i>
                </div>
                
                <a href="{{ route('profile.edit') }}" style="text-decoration: none;">
                    <div class="user-profile">
                        <div class="avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ strtoupper(Auth::user()->name ?? 'AHMAD RAMADHAN') }}</span>
                            <span class="user-id">KHGC24034</span>
                        </div>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
