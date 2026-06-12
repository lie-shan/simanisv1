<x-admin-layout>
    <x-slot name="title">PESANIM - Penerimaan Santri Baru</x-slot>
    @section('header_title', 'PESANIM')
    @section('header_subtitle', 'Penerimaan Santri Baru Nurul Iman')

    <style>
        .pes-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin: 0 0 28px;
        }
        .pes-stat {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 14px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
            transition: all 0.2s;
        }
        .pes-stat:hover { border-color: var(--primary-blue); box-shadow: 0 4px 12px rgba(13,110,253,0.08); }
        .pes-stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .pes-stat-icon.blue { background: #e0f2fe; color: #0284c7; }
        .pes-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .pes-stat-icon.green { background: #f0fdf4; color: #16a34a; }
        .pes-stat-icon.red { background: #fef2f2; color: #dc2626; }
        .pes-stat-label { font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 2px; }
        .pes-stat-value { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.3px; }

        .pes-filter {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            padding: 14px 15px;
            margin-bottom: 20px;
        }
        .pes-filter-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .pes-filter-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .pes-filter-label {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; margin-right: 4px;
        }
        .pes-filter-select {
            padding: 8px 14px; border: 1px solid var(--border-color);
            border-radius: 8px; font-size: 13px; color: #444;
            background: #fafbfc; cursor: pointer; outline: none;
            min-width: 140px; transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .pes-filter-select:hover { border-color: #c0c8d0; }
        .pes-filter-select:focus { border-color: var(--primary-blue); background: #fff; box-shadow: 0 0 0 3px rgba(13,110,253,0.08); }
        .pes-filter-right { display: flex; align-items: center; gap: 8px; }

        .pes-table-wrap {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .pes-table-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 15px; border-bottom: 1px solid var(--border-color);
        }
        .pes-table-header-title {
            display: flex; align-items: center; gap: 10px;
            font-size: 15px; font-weight: 600; color: #333;
        }
        .pes-table-header-title i { color: var(--primary-blue); }

        .pes-table-scroll { overflow-x: auto; }
        table.pes-table {
            width: 100%; border-collapse: collapse; font-size: 13px;
        }
        table.pes-table thead { background: #fff; }
        table.pes-table th {
            text-align: center; font-size: 11px; font-weight: 700;
            color: var(--text-muted); text-transform: uppercase;
            letter-spacing: 0.4px; padding: 10px 12px;
            border-bottom: 1px solid var(--border-color); white-space: nowrap;
        }
        table.pes-table td {
            padding: 10px 12px; border-bottom: 1px solid var(--border-color);
            color: #444; vertical-align: middle; text-align: center;
        }
        table.pes-table td.pes-nama-cell { text-align: left; }
        table.pes-table tbody tr:hover { background: #f8faff; }
        table.pes-table tbody tr:last-child td { border-bottom: none; }

        .pes-nama-info { display: flex; align-items: center; gap: 12px; }
        .pes-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .pes-nama-text { font-weight: 600; color: #2c3e50; }
        .pes-nopen-text { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .pes-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .pes-badge.mendaftar { background: #f0f4ff; color: #2563eb; }
        .pes-badge.diterima { background: #f0fdf4; color: #16a34a; }
        .pes-badge.ditolak { background: #fef2f2; color: #dc2626; }
        .pes-badge .pes-dot { width: 6px; height: 6px; border-radius: 50%; }
        .pes-badge.mendaftar .pes-dot { background: #2563eb; }
        .pes-badge.lolos .pes-dot { background: #0284c7; }
        .pes-badge.diterima .pes-dot { background: #16a34a; }
        .pes-badge.ditolak .pes-dot { background: #dc2626; }

        .pes-jk-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 12px; border-radius: 6px; font-size: 11px; font-weight: 600;
        }
        .pes-jk-badge.lk { background: #e0f2fe; color: #0284c7; }
        .pes-jk-badge.pr { background: #fce7f3; color: #db2777; }

        .pes-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .pes-action-btn {
            width: 32px; height: 32px; border-radius: 6px;
            border: none; display: inline-flex; align-items: center;
            justify-content: center; cursor: pointer; font-size: 14px;
            transition: all 0.15s;
        }
        .pes-action-btn.view { background: #e8f0fe; color: var(--primary-blue); }
        .pes-action-btn.view:hover { background: #d4e4fc; }
        .pes-action-btn.edit { background: #fff3e0; color: #e67e22; }
        .pes-action-btn.edit:hover { background: #ffe4b3; }
        .pes-action-btn.delete { background: #ffeae9; color: #dc3545; }
        .pes-action-btn.delete:hover { background: #fcc; }

        .pes-kelas-tag {
            display: inline-block; padding: 4px 12px;
            border-radius: 6px; font-size: 12px; font-weight: 600;
            background: #f0f4ff; color: var(--primary-blue);
        }

        .pes-pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 15px; border-top: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px;
        }
        .pes-pagination-info { font-size: 12px; color: var(--text-muted); }
        .pes-pagination { display: flex; align-items: center; gap: 4px; }
        .pes-page-btn {
            width: 34px; height: 34px; border-radius: 6px;
            border: 1px solid var(--border-color); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 500; color: #555;
            cursor: pointer; transition: all 0.15s;
        }
        .pes-page-btn:hover { border-color: var(--primary-blue); color: var(--primary-blue); }
        .pes-page-btn.active { background: var(--primary-blue); color: #fff; border-color: var(--primary-blue); }
        .pes-page-btn.arrow { font-size: 10px; }
        .pes-page-btn:disabled { opacity: 0.4; cursor: not-allowed; }
        .pes-page-btn:disabled:hover { border-color: var(--border-color); color: #555; }

        @keyframes pesFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .pes-row-enter { animation: pesFadeIn 0.3s ease both; }
        .pes-row-enter:nth-child(1) { animation-delay: 0.02s; }
        .pes-row-enter:nth-child(2) { animation-delay: 0.04s; }
        .pes-row-enter:nth-child(3) { animation-delay: 0.06s; }
        .pes-row-enter:nth-child(4) { animation-delay: 0.08s; }
        .pes-row-enter:nth-child(5) { animation-delay: 0.10s; }
        .pes-row-enter:nth-child(6) { animation-delay: 0.12s; }
        .pes-row-enter:nth-child(7) { animation-delay: 0.14s; }
        .pes-row-enter:nth-child(8) { animation-delay: 0.16s; }
        .pes-row-enter:nth-child(9) { animation-delay: 0.18s; }
        .pes-row-enter:nth-child(10) { animation-delay: 0.20s; }

        .pes-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
            padding: 8px 0;
        }
        .pes-detail-item {}
        .pes-detail-label { font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 4px; }
        .pes-detail-value { font-size: 14px; font-weight: 500; color: #1a1a2e; }

        .detail-hero {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5986 50%, #1e3a5f 100%);
            padding: 40px 32px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .detail-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 60%);
            animation: detailHeroGlow 6s ease-in-out infinite;
        }
        @keyframes detailHeroGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10%, 10%); }
        }
        .detail-hero-avatar {
            width: 88px; height: 88px;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 34px; font-weight: 700; color: #fff;
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            position: relative; z-index: 1;
            margin-bottom: 16px;
            overflow: hidden;
        }
        .detail-hero-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .detail-hero-name { font-size: 20px; font-weight: 700; color: #fff; position: relative; z-index: 1; }
        .detail-hero-reg {
            font-size: 13px; color: rgba(255,255,255,0.7);
            margin-top: 4px; position: relative; z-index: 1;
        }
        .detail-hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 16px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
            margin-top: 12px; position: relative; z-index: 1;
        }
        .detail-hero-badge.mendaftar { background: rgba(255,255,255,0.2); color: #fff; }
        .detail-hero-badge.diterima { background: rgba(74,222,128,0.3); color: #4ade80; }
        .detail-hero-badge.ditolak { background: rgba(248,113,113,0.3); color: #f87171; }
        .detail-hero-close {
            position: absolute; top: 16px; right: 16px;
            width: 36px; height: 36px; border-radius: 50%;
            border: none; background: rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.7); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; transition: all 0.2s; z-index: 2;
        }
        .detail-hero-close:hover { background: rgba(255,255,255,0.25); color: #fff; }

        .detail-body { padding: 28px 32px; }
        .detail-section-title {
            font-size: 12px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.6px;
            margin-bottom: 16px; padding-bottom: 8px;
            border-bottom: 2px solid #eef2f6;
        }
        .detail-info-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 18px 32px;
            margin-bottom: 24px;
        }
        .detail-info-full { grid-column: 1 / -1; }
        .detail-info-label {
            font-size: 11px; font-weight: 600; color: #94a3b8;
            text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px;
        }
        .detail-info-value { font-size: 14px; font-weight: 500; color: #1a1a2e; line-height: 1.5; }

        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5); z-index: 1000;
            align-items: center; justify-content: center;
            backdrop-filter: blur(4px);
        }
        .modal-box {
            background: #fff; border-radius: 18px; width: 90%;
            max-height: 90vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            animation: pesSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes pesSlideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid var(--border-color);
        }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            background: #f1f5f9; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
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
            padding: 0 14px; min-width: 240px; transition: all 0.2s;
        }
        .search-box:focus-within { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(13,110,253,0.1); }
        .search-box i { color: var(--text-muted); font-size: 14px; margin-right: 10px; }
        .search-box input {
            border: none; background: none; padding: 10px 0;
            font-size: 13px; color: var(--text-main); outline: none;
            width: 100%; font-family: 'Inter', sans-serif;
        }
        .search-box input::placeholder { color: #aaa; }

        .pes-form-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px;
        }
        .pes-form-grid .full { grid-column: 1 / -1; }
        .pes-form-label {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            display: block; margin-bottom: 4px;
        }
        .pes-form-label .req { color: #dc3545; }
        .pes-form-input {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px;
            font-size: 13px; color: #444; background: #fff;
            outline: none; font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }
        .pes-form-input:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(13,110,253,0.08); }
        .pes-form-input::placeholder { color: #aaa; }
        .pes-form-textarea {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px;
            font-size: 13px; color: #444; background: #fff;
            outline: none; font-family: 'Inter', sans-serif;
            resize: vertical; min-height: 60px;
            transition: border-color 0.2s;
        }
        .pes-form-textarea:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(13,110,253,0.08); }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 20px; border-radius: 8px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif;
            text-decoration: none;
        }
        .btn.fill { background: var(--primary-blue); color: #fff; }
        .btn.fill:hover { background: #0b5ed7; }
        .btn.ghost { background: #e8f0fe; color: var(--primary-blue); }
        .btn.ghost:hover { background: #d4e4fc; }
        .btn.danger { background: #fee2e2; color: #dc2626; }
        .btn.danger:hover { background: #fecaca; }
        .btn.danger-solid { background: #dc2626; color: #fff; }
        .btn.danger-solid:hover { background: #b91c1c; }

        .pes-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px;
            padding: 16px 20px; border-radius: 12px;
            min-width: 320px; max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: pesToastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            border-left: 4px solid;
        }
        .pes-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .pes-toast.error { background: #fef2f2; border-color: #ef4444; }
        .pes-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }
        .pes-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .pes-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .pes-toast .toast-body { flex: 1; min-width: 0; }
        .pes-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .pes-toast .toast-msg { font-size: 12px; color: #555; line-height: 1.4; }
        .pes-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px;
            border: none; background: transparent; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: #999; flex-shrink: 0;
            transition: all 0.15s;
        }
        .pes-toast .toast-close:hover { background: rgba(0,0,0,0.05); color: #333; }

        @keyframes pesToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes pesToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }
    @media (max-width: 767px) { .pes-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; } }
    @media (max-width: 576px) { .pes-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; } }
    @media (max-width: 576px) {
        .pes-detail-hero { padding: 24px 16px 20px !important; }
        .pes-detail-hero-avatar { width: 64px; height: 64px; font-size: 24px; }
        .pes-detail-hero-name { font-size: 16px; }
        .pes-detail-body { padding: 16px !important; }
        .pes-detail-grid { grid-template-columns: 1fr !important; }
    }
    </style>

    {{-- Stats --}}
    <div class="pes-stats" x-data="{ visible: true }">
        <div class="pes-stat">
            <div class="pes-stat-icon blue"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="pes-stat-label">Total Pendaftar</div>
                <div class="pes-stat-value">{{ $totalPendaftar }}</div>
            </div>
        </div>
        <div class="pes-stat">
            <div class="pes-stat-icon green"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="pes-stat-label">Diterima</div>
                <div class="pes-stat-value">{{ $diterima }}</div>
            </div>
        </div>
        <div class="pes-stat">
            <div class="pes-stat-icon red"><i class="fa-solid fa-times-circle"></i></div>
            <div>
                <div class="pes-stat-label">Ditolak</div>
                <div class="pes-stat-value">{{ $ditolak }}</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="pes-filter">
        <div class="pes-filter-top">
            <div class="pes-filter-left">
                <span class="pes-filter-label"><i class="fa-solid fa-filter" style="margin-right:4px;"></i>Filter</span>
                <select class="pes-filter-select" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Mendaftar">Mendaftar</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
                <select class="pes-filter-select" id="filterTahun">
                    <option value="">Semua Tahun</option>
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                </select>
                <div class="search-box" style="min-width:200px;">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama / no pendaftaran...">
                </div>
            </div>
            <div class="pes-filter-right">
                <button class="btn fill" onclick="openTambahModal()"><i class="fa-solid fa-plus"></i> Tambah Pendaftar</button>
                <a href="{{ route('admin.pesanim.export') }}" target="_blank" class="btn ghost" style="text-decoration:none;"><i class="fa-solid fa-print"></i> Print</a>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="pes-table-wrap">
        <div class="pes-table-header">
            <div class="pes-table-header-title">
                <i class="fa-solid fa-user-plus"></i> Daftar Pendaftar
                <span style="font-size:12px;font-weight:500;color:var(--text-muted);">({{ count($pendaftar) }} data)</span>
            </div>
        </div>
        <div class="pes-table-scroll">
            <table class="pes-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Pendaftar</th>
                        <th style="width:60px;">JK</th>
                        <th style="width:120px;">Tempat Lahir</th>
                        <th style="width:110px;">Tgl Lahir</th>
                        <th style="width:120px;">Tgl Daftar</th>
                        <th style="width:110px;">No. HP</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pesTableBody">
                    @foreach($pendaftar as $index => $p)
                    <tr class="pes-row-enter" data-id="{{ $p->id }}" data-status="{{ $p->status }}" data-tahun="{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('Y') }}" data-name="{{ strtolower($p->nama) }}" data-nopen="{{ $p->no_pendaftaran }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="pes-nama-cell">
                            <div class="pes-nama-info">
                                <div class="pes-avatar" style="background: {{ $p->jk == 'L' ? '#2563eb' : '#db2777' }};">
                                    {{ substr($p->nama, 0, 1) }}
                                </div>
                                <div>
                                    <div class="pes-nama-text">{{ $p->nama }}</div>
                                    <div class="pes-nopen-text">{{ $p->no_pendaftaran }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="pes-jk-badge {{ $p->jk == 'L' ? 'lk' : 'pr' }}">
                                <i class="fa-solid {{ $p->jk == 'L' ? 'fa-mars' : 'fa-venus' }}"></i>
                                {{ $p->jk }}
                            </span>
                        </td>
                        <td><span style="font-size:12px;">{{ $p->tmp_lahir ?? '-' }}</span></td>
                        <td><span style="font-size:12px;">{{ $p->tgl_lahir ? \Carbon\Carbon::parse($p->tgl_lahir)->format('d/m/Y') : '-' }}</span></td>
                        <td><span style="font-size:12px;">{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d/m/Y') }}</span></td>
                        <td><span style="font-size:12px;">{{ $p->no_hp ?? '-' }}</span></td>
                        <td>
                            @php
                                $badgeCls = match($p->status) {
                                    'Mendaftar' => 'mendaftar',
                                    'Diterima' => 'diterima',
                                    'Ditolak' => 'ditolak',
                                    default => 'mendaftar',
                                };
                            @endphp
                            <span class="pes-badge {{ $badgeCls }}">
                                <span class="pes-dot"></span>
                                {{ $p->status }}
                            </span>
                        </td>
                        <td>
                            <div class="pes-action-btns">
                                <button class="pes-action-btn view" title="Detail" onclick="openDetail({{ $p->id }})"><i class="fa-solid fa-eye"></i></button>
                                <button class="pes-action-btn edit" title="Edit" onclick="openEdit({{ $p->id }})"><i class="fa-solid fa-pen"></i></button>
                                <button class="pes-action-btn delete" title="Hapus" onclick="openHapus({{ $p->id }})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pes-pagination-wrap">
            <div class="pes-pagination-info">Menampilkan <strong>{{ count($pendaftar) }}</strong> dari <strong>{{ count($pendaftar) }}</strong> data</div>
            <div class="pes-pagination">
                <button class="pes-page-btn arrow" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="pes-page-btn active">1</button>
                <button class="pes-page-btn arrow" disabled><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('detailModal').style.display='none'">
        <div class="modal-box" style="max-width:680px;">
            <div class="detail-hero">
                <button class="detail-hero-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
                <div class="detail-hero-avatar" id="detailAvatar">-</div>
                <div class="detail-hero-name" id="detailNama">-</div>
                <div class="detail-hero-reg" id="detailNoPendaftaran">-</div>
                <div class="detail-hero-badge" id="detailStatus">-</div>
            </div>
            <div class="detail-body">
                <div class="detail-section-title"><i class="fa-solid fa-address-card" style="margin-right:6px;"></i> Informasi Pribadi</div>
                <div class="detail-info-grid">
                    <div>
                        <div class="detail-info-label">Jenis Kelamin</div>
                        <div class="detail-info-value" id="detailJK">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Tempat, Tanggal Lahir</div>
                        <div class="detail-info-value" id="detailTtl">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Nama Ayah</div>
                        <div class="detail-info-value" id="detailOrtu">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Nama Ibu</div>
                        <div class="detail-info-value" id="detailIbu">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">No. HP</div>
                        <div class="detail-info-value" id="detailNoHp">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Tanggal Daftar</div>
                        <div class="detail-info-value" id="detailTglDaftar">-</div>
                    </div>
                </div>
                <div class="detail-section-title" style="margin-top:8px;"><i class="fa-solid fa-location-dot" style="margin-right:6px;"></i> Alamat</div>
                <div class="detail-info-grid">
                    <div class="detail-info-full">
                        <div class="detail-info-label">Alamat Lengkap</div>
                        <div class="detail-info-value" id="detailAlamat" style="line-height:1.7;background:#f8fafc;padding:12px 16px;border-radius:10px;border:1px solid #eef2f6;">-</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding:18px 32px;">
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
        <div class="modal-box" style="max-width:640px;">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:#e8f0fe;display:flex;align-items:center;justify-content:center;color:var(--primary-blue);">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;" id="formModalTitle">Tambah Pendaftar</div>
                        <div style="font-size:12px;color:var(--text-muted);">Form pendaftaran santri baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('formModal').style.display='none'">&times;</button>
            </div>
            <form id="pendaftarForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="pes-form-grid">
                        <div class="full">
                            <label class="pes-form-label">Nama Lengkap <span class="req">*</span></label>
                            <input type="text" id="formNama" class="pes-form-input" required>
                        </div>
                        <div>
                            <label class="pes-form-label">Jenis Kelamin <span class="req">*</span></label>
                            <select id="formJk" class="pes-form-input">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="pes-form-label">Tempat Lahir</label>
                            <input type="text" id="formTmpLahir" class="pes-form-input">
                        </div>
                        <div>
                            <label class="pes-form-label">Tanggal Lahir</label>
                            <input type="date" id="formTglLahir" class="pes-form-input">
                        </div>
                        <div>
                            <label class="pes-form-label">Nama Ayah</label>
                            <input type="text" id="formOrtu" class="pes-form-input">
                        </div>
                        <div>
                            <label class="pes-form-label">Nama Ibu</label>
                            <input type="text" id="formIbu" class="pes-form-input">
                        </div>
                        <div>
                            <label class="pes-form-label">No. HP</label>
                            <input type="text" id="formNoHp" class="pes-form-input">
                        </div>
                        <div class="full">
                            <label class="pes-form-label">Alamat</label>
                            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;">
                                <input type="text" id="formKampung" class="pes-form-input" placeholder="Kampung">
                                <input type="text" id="formRtRw" class="pes-form-input" placeholder="RT/RW">
                                <input type="text" id="formDesa" class="pes-form-input" placeholder="Desa">
                                <input type="text" id="formKecamatan" class="pes-form-input" placeholder="Kecamatan">
                                <input type="text" id="formKabupaten" class="pes-form-input" placeholder="Kabupaten">
                                <input type="text" id="formKodePos" class="pes-form-input" placeholder="Kode Pos">
                            </div>
                        </div>
                        <div>
                            <label class="pes-form-label">Kelas</label>
                            <select id="formKelas" class="pes-form-input">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach(\App\Models\Kelas::orderBy('nama_kelas')->get() as $kelas)
                                    <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="pes-form-label">Status</label>
                            <select id="formStatus" class="pes-form-input">
                                <option value="Mendaftar">Mendaftar</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="full">
                            <label class="pes-form-label">Dokumen Foto</label>
                            <input type="file" id="formFoto" class="pes-form-input" style="padding:8px 14px;" accept="image/*">
                            <div id="fotoPreview" style="margin-top:8px;display:none;"><img id="fotoPreviewImg" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:2px solid var(--border-color);"></div>
                        </div>
                        <div class="full">
                            <label class="pes-form-label">Keterangan</label>
                            <textarea id="formKeterangan" class="pes-form-textarea"></textarea>
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
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;">Hapus Pendaftar</div>
                        <div style="font-size:12px;color:var(--text-muted);">Data akan dihapus permanen</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('hapusModal').style.display='none'">&times;</button>
            </div>
            <div class="modal-body">
                <p style="font-size:14px;color:#444;line-height:1.6;">
                    Apakah Anda yakin ingin menghapus pendaftar <strong id="hapusNama">-</strong>?
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
        const pendaftarData = @json($pendaftar);

        function openDetail(id) {
            const p = pendaftarData.find(d => d.id === id);
            if (!p) return;
            const avatar = document.getElementById('detailAvatar');
            if (p.foto_url) {
                avatar.innerHTML = `<img src="${p.foto_url}" style="width:72px;height:72px;border-radius:50%;object-fit:cover;">`;
                avatar.style.background = 'none';
            } else {
                avatar.textContent = p.nama.charAt(0);
                avatar.style.background = p.jk === 'L' ? '#2563eb' : '#db2777';
            }
            document.getElementById('detailNama').textContent = p.nama;
            document.getElementById('detailNoPendaftaran').textContent = 'No. Pendaftaran: ' + p.no_pendaftaran;
            document.getElementById('detailJK').textContent = p.jk === 'L' ? 'Laki-laki' : 'Perempuan';
            document.getElementById('detailTtl').textContent = (p.tmp_lahir || '-') + ', ' + (p.tgl_lahir ? new Date(p.tgl_lahir).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-');
            document.getElementById('detailOrtu').textContent = p.ortu || '-';
            document.getElementById('detailIbu').textContent = p.ibu || '-';
            document.getElementById('detailNoHp').textContent = p.no_hp || '-';
            document.getElementById('detailTglDaftar').textContent = p.tanggal_daftar ? new Date(p.tanggal_daftar).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

            const statusBadge = document.getElementById('detailStatus');
            statusBadge.className = 'detail-hero-badge ' + p.status.toLowerCase();
            statusBadge.textContent = p.status;

            const parts = [];
            if (p.kampung) parts.push(p.kampung);
            if (p.rt_rw) parts.push('RT ' + p.rt_rw.replace('/', ' RW '));
            if (p.desa) parts.push('Des. ' + p.desa);
            if (p.kecamatan) parts.push('Kec. ' + p.kecamatan);
            if (p.kabupaten) parts.push('Kab. ' + p.kabupaten);
            if (p.kode_pos) parts.push('Kode Pos ' + p.kode_pos);
            document.getElementById('detailAlamat').textContent = parts.join(', ') || '-';

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

        function openTambahModal() {
            document.getElementById('formModalTitle').textContent = 'Tambah Pendaftar';
            document.getElementById('formId').value = '';
            document.getElementById('pendaftarForm').reset();
            document.getElementById('formStatus').value = 'Mendaftar';
            document.getElementById('formKelas').value = '';
            document.getElementById('fotoPreview').style.display = 'none';
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').style.display = 'flex';
        }

        function openEdit(id) {
            fetch('/admin/pesanim/' + id + '/edit')
                .then(res => res.json())
                .then(p => {
                    document.getElementById('formModalTitle').textContent = 'Edit Pendaftar';
                    document.getElementById('formId').value = p.id;
                    document.getElementById('formNama').value = p.nama;
                    document.getElementById('formJk').value = p.jk;
                    document.getElementById('formTmpLahir').value = p.tmp_lahir || '';
                    document.getElementById('formTglLahir').value = p.tgl_lahir || '';
                    document.getElementById('formOrtu').value = p.ortu || '';
                    document.getElementById('formIbu').value = p.ibu || '';
                    document.getElementById('formNoHp').value = p.no_hp || '';
                    document.getElementById('formKampung').value = p.kampung || '';
                    document.getElementById('formRtRw').value = p.rt_rw || '';
                    document.getElementById('formDesa').value = p.desa || '';
                    document.getElementById('formKecamatan').value = p.kecamatan || '';
                    document.getElementById('formKabupaten').value = p.kabupaten || '';
                    document.getElementById('formKodePos').value = p.kode_pos || '';
                    document.getElementById('formKeterangan').value = p.keterangan || '';
                    document.getElementById('formKelas').value = p.kelas || '';
                    document.getElementById('formStatus').value = p.status || 'Mendaftar';
                    document.getElementById('formFoto').value = '';
                    document.getElementById('fotoPreview').style.display = 'none';
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
                    document.getElementById('formModal').style.display = 'flex';
                });
        }

        function openHapus(id) {
            const p = pendaftarData.find(d => d.id === id);
            if (!p) return;
            document.getElementById('hapusId').value = p.id;
            document.getElementById('hapusNama').textContent = p.nama;
            document.getElementById('hapusModal').style.display = 'flex';
        }

        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('/admin/pesanim/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('hapusModal').style.display = 'none';
                    showToast('success', 'Berhasil!', 'Pendaftar berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            });
        }

        function renderRow(p, index) {
            const badgeCls = p.status.toLowerCase();
            const jkIcon = p.jk === 'L' ? 'fa-mars' : 'fa-venus';
            const jkBadge = p.jk === 'L' ? 'lk' : 'pr';
            const avatarColor = p.jk === 'L' ? '#2563eb' : '#db2777';
            const avatarHtml = p.foto_url ? `<img src="${p.foto_url}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">` : `<div class="pes-avatar" style="background:${avatarColor};">${p.nama.charAt(0)}</div>`;
            const tgl = p.tanggal_daftar ? new Date(p.tanggal_daftar).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) : '-';
            return `<tr data-id="${p.id}" data-status="${p.status}" data-tahun="${p.tanggal_daftar ? new Date(p.tanggal_daftar).getFullYear() : ''}" data-name="${p.nama.toLowerCase()}" data-nopen="${p.no_pendaftaran}">
                <td>${index + 1}</td>
                <td class="pes-nama-cell">
                    <div class="pes-nama-info">
                        ${avatarHtml}
                        <div><div class="pes-nama-text">${p.nama}</div><div class="pes-nopen-text">${p.no_pendaftaran}</div></div>
                    </div>
                </td>
                <td><span class="pes-jk-badge ${jkBadge}"><i class="fa-solid ${jkIcon}"></i> ${p.jk}</span></td>
                <td><span style="font-size:12px;">${p.tmp_lahir || '-'}</span></td>
                <td><span style="font-size:12px;">${p.tgl_lahir ? new Date(p.tgl_lahir).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }) : '-'}</span></td>
                <td><span style="font-size:12px;">${tgl}</span></td>
                <td><span style="font-size:12px;">${p.no_hp || '-'}</span></td>
                <td><span class="pes-badge ${badgeCls}"><span class="pes-dot"></span> ${p.status}</span></td>
                <td>
                    <div class="pes-action-btns">
                        <button class="pes-action-btn view" title="Detail" onclick="openDetail(${p.id})"><i class="fa-solid fa-eye"></i></button>
                        <button class="pes-action-btn edit" title="Edit" onclick="openEdit(${p.id})"><i class="fa-solid fa-pen"></i></button>
                        <button class="pes-action-btn delete" title="Hapus" onclick="openHapus(${p.id})"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            </tr>`;
        }

        function refreshTable() {
            const tbody = document.getElementById('pesTableBody');
            tbody.innerHTML = pendaftarData.map((p, i) => renderRow(p, i)).join('');
            filterTable();
        }

        document.getElementById('formFoto').addEventListener('change', function() {
            const file = this.files[0];
            const preview = document.getElementById('fotoPreview');
            const img = document.getElementById('fotoPreviewImg');
            if (file) {
                img.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
                img.src = '';
            }
        });

        document.getElementById('pendaftarForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('nama', document.getElementById('formNama').value);
            formData.append('jk', document.getElementById('formJk').value);
            formData.append('tmp_lahir', document.getElementById('formTmpLahir').value);
            formData.append('tgl_lahir', document.getElementById('formTglLahir').value);
            formData.append('ortu', document.getElementById('formOrtu').value);
            formData.append('ibu', document.getElementById('formIbu').value);
            formData.append('no_hp', document.getElementById('formNoHp').value);
            formData.append('kampung', document.getElementById('formKampung').value);
            formData.append('rt_rw', document.getElementById('formRtRw').value);
            formData.append('desa', document.getElementById('formDesa').value);
            formData.append('kecamatan', document.getElementById('formKecamatan').value);
            formData.append('kabupaten', document.getElementById('formKabupaten').value);
            formData.append('kode_pos', document.getElementById('formKodePos').value);
            formData.append('keterangan', document.getElementById('formKeterangan').value);
            formData.append('kelas', document.getElementById('formKelas').value);
            formData.append('status', document.getElementById('formStatus').value);
            const fotoFile = document.getElementById('formFoto').files[0];
            if (fotoFile) formData.append('foto', fotoFile);
            if (id) formData.append('_method', 'PUT');

            const url = id ? '/admin/pesanim/' + id : '/admin/pesanim';
            fetch(url, { method: 'POST', headers: { 'Accept': 'application/json' }, body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('formModal').style.display = 'none';
                        showToast('success', 'Berhasil!', 'Data pendaftar berhasil ' + (id ? 'diupdate' : 'disimpan') + '.');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showToast('error', 'Gagal!', data.message || 'Terjadi kesalahan.');
                    }
                })
                .catch(err => showToast('error', 'Gagal!', 'Terjadi kesalahan: ' + err.message));
        });

        // Toast
        function showToast(type, title, msg) {
            const existing = document.querySelector('.pes-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'pes-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + icons[type] + '"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { if (t.parentElement) { t.style.animation = 'pesToastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); } }, 4000);
        }

        // Filter
        document.getElementById('filterStatus').addEventListener('change', filterTable);
        document.getElementById('filterTahun').addEventListener('change', filterTable);
        document.getElementById('searchInput').addEventListener('input', filterTable);

        function filterTable() {
            const status = document.getElementById('filterStatus').value;
            const tahun = document.getElementById('filterTahun').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#pesTableBody tr');
            rows.forEach(row => {
                const rStatus = row.dataset.status;
                const rTahun = row.dataset.tahun;
                const rName = row.dataset.name;
                const rNopen = row.dataset.nopen;
                const matchStatus = !status || rStatus === status;
                const matchTahun = !tahun || rTahun === tahun;
                const matchSearch = !search || rName.includes(search) || rNopen.includes(search);
                row.style.display = matchStatus && matchTahun && matchSearch ? '' : 'none';
            });
        }
    </script>
</x-admin-layout>
