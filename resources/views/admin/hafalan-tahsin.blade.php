<x-admin-layout>
    <x-slot name="title">Hafalan & Tahsin</x-slot>
    @section('header_title', 'Hafalan & Tahsin')
    @section('header_subtitle', 'Kelola hafalan dan tahsin santri TPA Nurul Iman')

    <style>
        :root {
            --ht-primary: #10b981;
            --ht-primary-dark: #059669;
            --ht-primary-light: #ecfdf5;
            --ht-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .ht-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px;
        }
        .ht-stat {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 14px 15px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03); transition: all 0.2s;
        }
        .ht-stat:hover { border-color: var(--ht-primary); box-shadow: 0 4px 12px rgba(16,185,129,0.08); }
        .ht-stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .ht-stat-icon.green { background: #ecfdf5; color: #059669; }
        .ht-stat-icon.emerald { background: #d1fae5; color: #10b981; }
        .ht-stat-icon.blue { background: #e0f2fe; color: #0284c7; }
        .ht-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .ht-stat-label { font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 2px; }
        .ht-stat-value { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.3px; }

        .ht-filter {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); padding: 14px 15px; margin-bottom: 20px;
        }
        .ht-filter-top {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        }
        .ht-filter-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .ht-filter-label {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; margin-right: 4px;
        }
        .ht-filter-select {
            padding: 8px 14px; border: 1px solid var(--border-color); border-radius: 8px;
            font-size: 13px; color: #444; background: #fafbfc; cursor: pointer; outline: none;
            min-width: 130px; transition: all 0.2s; font-family: 'Inter', sans-serif;
        }
        .ht-filter-select:hover { border-color: #c0c8d0; }
        .ht-filter-select:focus { border-color: var(--ht-primary); background: #fff; box-shadow: 0 0 0 3px rgba(16,185,129,0.08); }
        .ht-filter-right { display: flex; align-items: center; gap: 8px; }

        .ht-table-wrap {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); overflow: hidden;
        }
        .ht-table-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 15px; border-bottom: 1px solid var(--border-color);
        }
        .ht-table-header-title {
            display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #333;
        }
        .ht-table-header-title i { color: var(--ht-primary); }
        .ht-table-scroll { overflow-x: auto; }
        table.ht-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        table.ht-table thead { background: #fff; }
        table.ht-table th {
            text-align: center; font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; padding: 10px 12px;
            border-bottom: 1px solid var(--border-color); white-space: nowrap;
        }
        table.ht-table td {
            padding: 10px 12px; border-bottom: 1px solid var(--border-color);
            color: #444; vertical-align: middle; text-align: center;
        }
        table.ht-table td.ht-nama-cell { text-align: left; }
        table.ht-table tbody tr:hover { background: #ecfdf5; }
        table.ht-table tbody tr:last-child td { border-bottom: none; }

        .ht-santri-info { display: flex; align-items: center; gap: 12px; }
        .ht-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .ht-santri-text { font-weight: 600; color: #2c3e50; }
        .ht-kelas-text { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .ht-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .ht-badge.hafalan { background: #ecfdf5; color: #059669; }
        .ht-badge.tahsin { background: #dbeafe; color: #2563eb; }
        .ht-badge.lancar { background: #f0fdf4; color: #16a34a; }
        .ht-badge.kurang-lancar { background: #fef3c7; color: #d97706; }
        .ht-badge.belum-lancar { background: #fef2f2; color: #dc2626; }
        .ht-badge .ht-dot { width: 6px; height: 6px; border-radius: 50%; }
        .ht-badge.hafalan .ht-dot { background: #059669; }
        .ht-badge.tahsin .ht-dot { background: #2563eb; }
        .ht-badge.lancar .ht-dot { background: #16a34a; }
        .ht-badge.kurang-lancar .ht-dot { background: #d97706; }
        .ht-badge.belum-lancar .ht-dot { background: #dc2626; }

        .ht-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .ht-action-btn {
            width: 32px; height: 32px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; transition: all 0.15s;
        }
        .ht-action-btn.view { background: #ecfdf5; color: var(--ht-primary); }
        .ht-action-btn.view:hover { background: #d1fae5; }
        .ht-action-btn.edit { background: #fef3c7; color: #d97706; }
        .ht-action-btn.edit:hover { background: #fde68a; }
        .ht-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .ht-action-btn.delete:hover { background: #fee2e2; }

        .ht-pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 15px; border-top: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px;
        }
        .ht-pagination-info { font-size: 12px; color: var(--text-muted); }
        .ht-pagination { display: flex; align-items: center; gap: 4px; }
        .ht-page-btn {
            width: 34px; height: 34px; border-radius: 6px;
            border: 1px solid var(--border-color); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 500; color: #555;
            cursor: pointer; transition: all 0.15s;
        }
        .ht-page-btn:hover { border-color: var(--ht-primary); color: var(--ht-primary); }
        .ht-page-btn.active { background: var(--ht-primary); color: #fff; border-color: var(--ht-primary); }

        @keyframes htFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .ht-row-enter { animation: htFadeIn 0.3s ease both; }

        .detail-hero {
            background: var(--ht-gradient); padding: 40px 32px 32px; text-align: center; position: relative; overflow: hidden;
        }
        .detail-hero::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 60%);
            animation: htHeroGlow 6s ease-in-out infinite;
        }
        @keyframes htHeroGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10%, 10%); }
        }
        .detail-hero-avatar {
            width: 88px; height: 88px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 34px; font-weight: 700; color: #fff;
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            position: relative; z-index: 1; margin-bottom: 16px;
        }
        .detail-hero-name { font-size: 20px; font-weight: 700; color: #fff; position: relative; z-index: 1; }
        .detail-hero-sub {
            font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 4px; position: relative; z-index: 1;
        }
        .detail-hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 16px; border-radius: 20px; font-size: 12px; font-weight: 600;
            margin-top: 12px; position: relative; z-index: 1;
        }
        .detail-hero-badge.lancar { background: rgba(74,222,128,0.3); color: #4ade80; }
        .detail-hero-badge.kurang-lancar { background: rgba(251,191,36,0.3); color: #fbbf24; }
        .detail-hero-badge.belum-lancar { background: rgba(248,113,113,0.3); color: #f87171; }
        .detail-hero-close {
            position: absolute; top: 16px; right: 16px; width: 36px; height: 36px; border-radius: 50%;
            border: none; background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 18px; transition: all 0.2s; z-index: 2;
        }
        .detail-hero-close:hover { background: rgba(255,255,255,0.25); color: #fff; }
        .detail-body { padding: 28px 32px; }
        .detail-section-title {
            font-size: 12px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #eef2f6;
        }
        .detail-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px 32px; margin-bottom: 24px; }
        .detail-info-full { grid-column: 1 / -1; }
        .detail-info-label {
            font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px;
        }
        .detail-info-value { font-size: 14px; font-weight: 500; color: #1a1a2e; line-height: 1.5; }

        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);
        }
        .modal-box {
            background: #fff; border-radius: 18px; width: 90%; max-height: 90vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: htSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes htSlideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid var(--border-color);
        }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px; border: none; background: #f1f5f9;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #64748b; transition: all 0.15s;
        }
        .modal-close:hover { background: #e2e8f0; color: #1a1a2e; }
        .modal-body { padding: 24px; }
        .modal-footer {
            display: flex; align-items: center; justify-content: flex-end;
            gap: 10px; padding: 18px 24px; border-top: 1px solid var(--border-color);
        }

        .search-box {
            display: flex; align-items: center; background: #fff;
            border: 1px solid var(--border-color); border-radius: 8px;
            padding: 0 14px; min-width: 220px; transition: all 0.2s;
        }
        .search-box:focus-within { border-color: var(--ht-primary); box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }
        .search-box i { color: var(--text-muted); font-size: 14px; margin-right: 10px; }
        .search-box input {
            border: none; background: none; padding: 10px 0; font-size: 13px;
            color: var(--text-main); outline: none; width: 100%; font-family: 'Inter', sans-serif;
        }
        .search-box input::placeholder { color: #aaa; }

        .ht-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
        .ht-form-grid .full { grid-column: 1 / -1; }
        .ht-form-label { font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px; }
        .ht-form-label .req { color: #dc3545; }
        .ht-form-input {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif; transition: border-color 0.2s;
        }
        .ht-form-input:focus { border-color: var(--ht-primary); box-shadow: 0 0 0 3px rgba(16,185,129,0.08); }
        .ht-form-input::placeholder { color: #aaa; }
        .ht-form-textarea {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif;
            resize: vertical; min-height: 60px; transition: border-color 0.2s;
        }
        .ht-form-textarea:focus { border-color: var(--ht-primary); box-shadow: 0 0 0 3px rgba(16,185,129,0.08); }

        .btn {
            display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px;
            border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.fill { background: var(--ht-gradient); color: #fff; box-shadow: 0 4px 12px rgba(16,185,129,0.3); }
        .btn.fill:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }
        .btn.ghost { background: #ecfdf5; color: var(--ht-primary); }
        .btn.ghost:hover { background: #d1fae5; }
        .btn.danger { background: #fee2e2; color: #dc2626; }
        .btn.danger:hover { background: #fecaca; }
        .btn.danger-solid { background: #dc2626; color: #fff; }
        .btn.danger-solid:hover { background: #b91c1c; }

        .ht-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px; max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: htToastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .ht-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .ht-toast.error { background: #fef2f2; border-color: #ef4444; }
        .ht-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .ht-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .ht-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .ht-toast .toast-body { flex: 1; min-width: 0; }
        .ht-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .ht-toast .toast-msg { font-size: 12px; color: #555; line-height: 1.4; }
        .ht-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; display: flex; align-items: center;
            justify-content: center; font-size: 20px; color: #999; flex-shrink: 0; transition: all 0.15s;
        }
        .ht-toast .toast-close:hover { background: rgba(0,0,0,0.05); color: #333; }

        @keyframes htToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes htToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }
    @media (max-width: 767px) { .ht-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; } }
    @media (max-width: 576px) { .ht-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; } }
    </style>

    {{-- Stats --}}
    <div class="ht-stats">
        <div class="ht-stat">
            <div class="ht-stat-icon green"><i class="fa-solid fa-book-quran"></i></div>
            <div>
                <div class="ht-stat-label">Total Record</div>
                <div class="ht-stat-value">{{ $totalRecord }}</div>
            </div>
        </div>
        <div class="ht-stat">
            <div class="ht-stat-icon emerald"><i class="fa-solid fa-book"></i></div>
            <div>
                <div class="ht-stat-label">Hafalan</div>
                <div class="ht-stat-value">{{ $totalHafalan }}</div>
            </div>
        </div>
        <div class="ht-stat">
            <div class="ht-stat-icon blue"><i class="fa-solid fa-pen"></i></div>
            <div>
                <div class="ht-stat-label">Tahsin</div>
                <div class="ht-stat-value">{{ $totalTahsin }}</div>
            </div>
        </div>
        <div class="ht-stat">
            <div class="ht-stat-icon amber"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="ht-stat-label">Lancar</div>
                <div class="ht-stat-value">{{ $lancar }}</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="ht-filter">
        <div class="ht-filter-top">
            <div class="ht-filter-left">
                <span class="ht-filter-label"><i class="fa-solid fa-filter" style="margin-right:4px;"></i>Filter</span>
                <select class="ht-filter-select" id="filterJenis">
                    <option value="">Semua Jenis</option>
                    <option value="Hafalan">Hafalan</option>
                    <option value="Tahsin">Tahsin</option>
                </select>
                <select class="ht-filter-select" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Lancar">Lancar</option>
                    <option value="Kurang Lancar">Kurang Lancar</option>
                    <option value="Belum Lancar">Belum Lancar</option>
                </select>
                <div class="search-box" style="min-width:200px;">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari santri / surah...">
                </div>
            </div>
            <div class="ht-filter-right">
                <button class="btn fill" onclick="openTambahModal()"><i class="fa-solid fa-plus"></i> Tambah Record</button>
                <a href="{{ route('admin.hafalan-tahsin.export') }}" target="_blank" class="btn ghost" style="text-decoration:none;"><i class="fa-solid fa-print"></i> Print</a>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ht-table-wrap">
        <div class="ht-table-header">
            <div class="ht-table-header-title">
                <i class="fa-solid fa-book-quran"></i> Daftar Hafalan & Tahsin
                <span style="font-size:12px;font-weight:500;color:var(--text-muted);">({{ count($records) }} record)</span>
            </div>
        </div>
        <div class="ht-table-scroll">
            <table class="ht-table">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th style="width:150px;">Nama Santri</th>
                        <th style="width:140px;">Materi / Surah</th>
                        <th style="width:70px;">Ayat</th>
                        <th style="width:100px;">Tanggal</th>
                        <th style="width:110px;">Pengajar</th>
                        <th style="width:70px;">Jenis</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="htTableBody">
                    @foreach($records as $index => $r)
                    <tr class="ht-row-enter" data-id="{{ $r->id }}" data-jenis="{{ $r->jenis }}" data-status="{{ $r->status }}" data-santri="{{ strtolower($r->santri) }}" data-surah="{{ strtolower($r->surah) }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="ht-nama-cell">
                            <div class="ht-santri-info">
                                <div class="ht-avatar" style="background: {{ $r->jenis == 'Hafalan' ? '#059669' : '#2563eb' }};">
                                    {{ substr($r->santri, 0, 1) }}
                                </div>
                                <div>
                                    <div class="ht-santri-text">{{ $r->santri }}</div>
                                    <div class="ht-kelas-text">Kelas {{ $r->kelas ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="font-size:12px;font-weight:500;">{{ $r->surah }}</span></td>
                        <td><span style="font-size:12px;">{{ $r->ayat ?? '-' }}</span></td>
                        <td><span style="font-size:12px;">{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</span></td>
                        <td><span style="font-size:12px;">{{ $r->pengajar ?? '-' }}</span></td>
                        <td>
                            <span class="ht-badge {{ strtolower($r->jenis) }}">
                                <span class="ht-dot"></span>
                                {{ $r->jenis }}
                            </span>
                        </td>
                        <td>
                            <span class="ht-badge {{ strtolower(str_replace(' ', '-', $r->status)) }}">
                                <span class="ht-dot"></span>
                                {{ $r->status }}
                            </span>
                        </td>
                        <td>
                            <div class="ht-action-btns">
                                <button class="ht-action-btn view" title="Detail" onclick="openDetail({{ $r->id }})"><i class="fa-solid fa-eye"></i></button>
                                <button class="ht-action-btn edit" title="Edit" onclick="openEdit({{ $r->id }})"><i class="fa-solid fa-pen"></i></button>
                                <button class="ht-action-btn delete" title="Hapus" onclick="openHapus({{ $r->id }})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="ht-pagination-wrap">
            <div class="ht-pagination-info">Menampilkan <strong>{{ count($records) }}</strong> dari <strong>{{ count($records) }}</strong> record</div>
            <div class="ht-pagination">
                <button class="ht-page-btn active">1</button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('detailModal').style.display='none'">
        <div class="modal-box" style="max-width:560px;">
            <div class="detail-hero">
                <button class="detail-hero-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
                <div class="detail-hero-avatar" id="detailAvatar">-</div>
                <div class="detail-hero-name" id="detailNama">-</div>
                <div class="detail-hero-sub" id="detailJenisLabel">-</div>
                <div class="detail-hero-badge" id="detailStatus">-</div>
            </div>
            <div class="detail-body">
                <div class="detail-section-title"><i class="fa-solid fa-circle-info" style="margin-right:6px;"></i> Informasi Hafalan & Tahsin</div>
                <div class="detail-info-grid">
                    <div>
                        <div class="detail-info-label">Kelas</div>
                        <div class="detail-info-value" id="detailKelas">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Surah / Materi</div>
                        <div class="detail-info-value" id="detailSurah">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Ayat</div>
                        <div class="detail-info-value" id="detailAyat">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Pengajar</div>
                        <div class="detail-info-value" id="detailPengajar">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Tanggal</div>
                        <div class="detail-info-value" id="detailTanggal">-</div>
                    </div>
                    <div class="detail-info-full">
                        <div class="detail-info-label">Keterangan</div>
                        <div class="detail-info-value" id="detailKeterangan" style="line-height:1.7;background:#f8fafc;padding:12px 16px;border-radius:10px;border:1px solid #eef2f6;">-</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style="display:flex;gap:8px;">
                    <button class="btn fill" id="detailEditBtn"><i class="fa-solid fa-pen"></i> Edit</button>
                    <button class="btn danger" id="detailHapusBtn"><i class="fa-solid fa-trash"></i> Hapus</button>
                </div>
                <button class="btn ghost" onclick="document.getElementById('detailModal').style.display='none'">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Tambah / Edit Modal --}}
    <div id="formModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('formModal').style.display='none'">
        <div class="modal-box" style="max-width:600px;">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:#ecfdf5;display:flex;align-items:center;justify-content:center;color:var(--ht-primary);">
                        <i class="fa-solid fa-book-quran"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;" id="formModalTitle">Tambah Record</div>
                        <div style="font-size:12px;color:var(--text-muted);">Catat hafalan atau tahsin baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('formModal').style.display='none'">&times;</button>
            </div>
            <form id="recordForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="ht-form-grid">
                        <div class="full">
                            <label class="ht-form-label">Nama Santri <span class="req">*</span></label>
                            <select id="formSantri" class="ht-form-input" required>
                                <option value="">-- Pilih Santri --</option>
                                @foreach($santriList as $s)
                                    <option value="{{ $s->nama }}" data-kelas="{{ $s->kelas }}">{{ $s->nama }} ({{ $s->kelas }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="ht-form-label">Kelas</label>
                            <select id="formKelas" class="ht-form-input">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($santriList->pluck('kelas')->unique()->sort() as $k)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="ht-form-label">Jenis <span class="req">*</span></label>
                            <select id="formJenis" class="ht-form-input">
                                <option value="Hafalan">Hafalan</option>
                                <option value="Tahsin">Tahsin</option>
                            </select>
                        </div>
                        <div>
                            <label class="ht-form-label">Surah / Materi <span class="req">*</span></label>
                            <input type="text" id="formSurah" class="ht-form-input" placeholder="Nama surah / materi" required>
                        </div>
                        <div>
                            <label class="ht-form-label">Ayat (jika hafalan)</label>
                            <input type="text" id="formAyat" class="ht-form-input" placeholder="1-10">
                        </div>
                        <div>
                            <label class="ht-form-label">Tanggal <span class="req">*</span></label>
                            <input type="date" id="formTanggal" class="ht-form-input" required>
                        </div>
                        <div>
                            <label class="ht-form-label">Pengajar</label>
                            <select id="formPengajar" class="ht-form-input">
                                <option value="">-- Pilih Pengajar --</option>
                                @foreach($guruList as $g)
                                    <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="ht-form-label">Status</label>
                            <select id="formStatus" class="ht-form-input">
                                <option value="Belum Lancar">Belum Lancar</option>
                                <option value="Kurang Lancar">Kurang Lancar</option>
                                <option value="Lancar">Lancar</option>
                            </select>
                        </div>
                        <div class="full">
                            <label class="ht-form-label">Keterangan</label>
                            <textarea id="formKeterangan" class="ht-form-textarea" placeholder="Catatan tambahan..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="display:flex;gap:8px;">
                        <button type="submit" class="btn fill" id="formSubmitBtn"><i class="fa-solid fa-save"></i> Simpan</button>
                    </div>
                    <button type="button" class="btn ghost" onclick="document.getElementById('formModal').style.display='none'">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Hapus Modal --}}
    <div id="hapusModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('hapusModal').style.display='none'">
        <div class="modal-box" style="max-width:420px;">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;color:#dc3545;">
                        <i class="fa-solid fa-trash"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;">Hapus Record</div>
                        <div style="font-size:12px;color:var(--text-muted);">Data akan dihapus permanen</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('hapusModal').style.display='none'">&times;</button>
            </div>
            <div class="modal-body">
                <p style="font-size:14px;color:#444;line-height:1.6;">
                    Apakah Anda yakin ingin menghapus record <strong id="hapusNama">-</strong>?
                </p>
                <input type="hidden" id="hapusId">
            </div>
            <div class="modal-footer">
                <button class="btn danger-solid" onclick="confirmHapus()"><i class="fa-solid fa-trash"></i> Hapus</button>
                <button class="btn ghost" onclick="document.getElementById('hapusModal').style.display='none'">Batal</button>
            </div>
        </div>
    </div>

    <script>
        const recordsData = @json($records);

        function openDetail(id) {
            const r = recordsData.find(d => d.id === id);
            if (!r) return;
            const avatar = document.getElementById('detailAvatar');
            avatar.textContent = r.santri.charAt(0);
            avatar.style.background = r.jenis === 'Hafalan' ? '#059669' : '#2563eb';

            document.getElementById('detailNama').textContent = r.santri;
            document.getElementById('detailJenisLabel').textContent = r.jenis === 'Hafalan' ? 'Hafalan Surah ' + r.surah : 'Tahsin - ' + r.surah;
            document.getElementById('detailKelas').textContent = r.kelas || '-';
            document.getElementById('detailSurah').textContent = r.surah;
            document.getElementById('detailAyat').textContent = r.ayat || '-';
            document.getElementById('detailPengajar').textContent = r.pengajar || '-';
            document.getElementById('detailTanggal').textContent = r.tanggal ? new Date(r.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            document.getElementById('detailKeterangan').textContent = r.keterangan || '-';

            const badge = document.getElementById('detailStatus');
            badge.className = 'detail-hero-badge ' + r.status.toLowerCase().replace(' ', '-');
            badge.textContent = r.status;

            document.getElementById('detailEditBtn').onclick = function() {
                document.getElementById('detailModal').style.display = 'none';
                openEdit(id);
            };
            document.getElementById('detailHapusBtn').onclick = function() {
                document.getElementById('detailModal').style.display = 'none';
                openHapus(id);
            };

            document.getElementById('detailModal').style.display = 'flex';
        }

        document.getElementById('formSantri').addEventListener('change', function() {
            const opt = this.selectedOptions[0];
            if (opt && opt.dataset.kelas) {
                document.getElementById('formKelas').value = opt.dataset.kelas;
            }
        });

        function openTambahModal() {
            document.getElementById('formModalTitle').textContent = 'Tambah Record';
            document.getElementById('formId').value = '';
            document.getElementById('recordForm').reset();
            document.getElementById('formTanggal').value = new Date().toISOString().split('T')[0];
            document.getElementById('formStatus').value = 'Belum Lancar';
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').style.display = 'flex';
        }

        function openEdit(id) {
            fetch('{{ route("admin.hafalan-tahsin.edit", 0) }}'.replace('/0', '/' + id))
                .then(r => r.json())
                .then(function(r) {
                    document.getElementById('formModalTitle').textContent = 'Edit Record';
                    document.getElementById('formId').value = r.id;
                    document.getElementById('formSantri').value = r.santri;
                    document.getElementById('formKelas').value = r.kelas || '';
                    if (!document.getElementById('formKelas').value) {
                        const opt = document.getElementById('formSantri').selectedOptions[0];
                        if (opt) document.getElementById('formKelas').value = opt.dataset.kelas || '';
                    }
                    document.getElementById('formJenis').value = r.jenis;
                    document.getElementById('formSurah').value = r.surah;
                    document.getElementById('formAyat').value = r.ayat || '';
                    document.getElementById('formTanggal').value = r.tanggal;
                    document.getElementById('formPengajar').value = r.pengajar || '';
                    document.getElementById('formStatus').value = r.status;
                    document.getElementById('formKeterangan').value = r.keterangan || '';
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
                    document.getElementById('formModal').style.display = 'flex';
                });
        }

        function openHapus(id) {
            const r = recordsData.find(d => d.id === id);
            if (!r) return;
            document.getElementById('hapusId').value = r.id;
            document.getElementById('hapusNama').textContent = r.santri + ' - ' + r.surah;
            document.getElementById('hapusModal').style.display = 'flex';
        }

        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('{{ route("admin.hafalan-tahsin.destroy", 0) }}'.replace('/0', '/' + id), {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(r => r.json()).then(function(res) {
                if (res.success) location.reload();
            });
        }

        function renderRow(r, index) {
            const jenisCls = r.jenis.toLowerCase();
            const statusCls = r.status.toLowerCase().replace(' ', '-');
            const avatarColor = r.jenis === 'Hafalan' ? '#059669' : '#2563eb';
            return '<tr data-id="' + r.id + '" data-jenis="' + r.jenis + '" data-status="' + r.status + '" data-santri="' + r.santri.toLowerCase() + '" data-surah="' + r.surah.toLowerCase() + '">' +
                '<td>' + (index + 1) + '</td>' +
                '<td class="ht-nama-cell"><div class="ht-santri-info"><div class="ht-avatar" style="background:' + avatarColor + ';">' + r.santri.charAt(0) + '</div><div><div class="ht-santri-text">' + r.santri + '</div><div class="ht-kelas-text">Kelas ' + (r.kelas || '-') + '</div></div></div></td>' +
                '<td><span style="font-size:12px;font-weight:500;">' + r.surah + '</span></td>' +
                '<td><span style="font-size:12px;">' + (r.ayat || '-') + '</span></td>' +
                '<td><span style="font-size:12px;">' + new Date(r.tanggal).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) + '</span></td>' +
                '<td><span style="font-size:12px;">' + (r.pengajar || '-') + '</span></td>' +
                '<td><span class="ht-badge ' + jenisCls + '"><span class="ht-dot"></span> ' + r.jenis + '</span></td>' +
                '<td><span class="ht-badge ' + statusCls + '"><span class="ht-dot"></span> ' + r.status + '</span></td>' +
                '<td><div class="ht-action-btns">' +
                '<button class="ht-action-btn view" title="Detail" onclick="openDetail(' + r.id + ')"><i class="fa-solid fa-eye"></i></button>' +
                '<button class="ht-action-btn edit" title="Edit" onclick="openEdit(' + r.id + ')"><i class="fa-solid fa-pen"></i></button>' +
                '<button class="ht-action-btn delete" title="Hapus" onclick="openHapus(' + r.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                '</div></td></tr>';
        }

        function refreshTable() {
            const tbody = document.getElementById('htTableBody');
            tbody.innerHTML = recordsData.map((r, i) => renderRow(r, i)).join('');
            filterTable();
        }

        document.getElementById('recordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const data = {
                santri: document.getElementById('formSantri').value,
                kelas: document.getElementById('formKelas').value,
                jenis: document.getElementById('formJenis').value,
                surah: document.getElementById('formSurah').value,
                ayat: document.getElementById('formAyat').value,
                tanggal: document.getElementById('formTanggal').value,
                pengajar: document.getElementById('formPengajar').value,
                status: document.getElementById('formStatus').value,
                keterangan: document.getElementById('formKeterangan').value,
            };
            const url = id ? '{{ route("admin.hafalan-tahsin.update", 0) }}'.replace('/0', '/' + id) : '{{ route("admin.hafalan-tahsin.store") }}';
            const method = id ? 'PUT' : 'POST';
            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            }).then(r => r.json()).then(function(res) {
                if (res.success) location.reload();
            });
        });

        function showToast(type, title, msg) {
            const existing = document.querySelector('.ht-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'ht-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + icons[type] + '"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { if (t.parentElement) { t.style.animation = 'htToastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); } }, 4000);
        }

        document.getElementById('filterJenis').addEventListener('change', filterTable);
        document.getElementById('filterStatus').addEventListener('change', filterTable);
        document.getElementById('searchInput').addEventListener('input', filterTable);

        function filterTable() {
            const jenis = document.getElementById('filterJenis').value;
            const status = document.getElementById('filterStatus').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#htTableBody tr');
            rows.forEach(row => {
                const rJenis = row.dataset.jenis;
                const rStatus = row.dataset.status;
                const rSantri = row.dataset.santri;
                const rSurah = row.dataset.surah;
                const matchJenis = !jenis || rJenis === jenis;
                const matchStatus = !status || rStatus === status;
                const matchSearch = !search || rSantri.includes(search) || rSurah.includes(search);
                row.style.display = matchJenis && matchStatus && matchSearch ? '' : 'none';
            });
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
    </script>

</x-admin-layout>
