<x-admin-layout>
    <x-slot name="title">Kuis & Ujian</x-slot>
    @section('header_title', 'Kuis & Ujian')
    @section('header_subtitle', 'Kelola kuis dan ujian TPA Nurul Iman')

    <style>
        :root {
            --ku-primary: #8b5cf6;
            --ku-primary-dark: #7c3aed;
            --ku-primary-light: #f5f3ff;
            --ku-gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .ku-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px;
        }
        .ku-stat {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 14px 15px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03); transition: all 0.2s;
        }
        .ku-stat:hover { border-color: var(--ku-primary); box-shadow: 0 4px 12px rgba(139,92,246,0.08); }
        .ku-stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .ku-stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
        .ku-stat-icon.violet { background: #ede9fe; color: #8b5cf6; }
        .ku-stat-icon.blue { background: #e0f2fe; color: #0284c7; }
        .ku-stat-icon.green { background: #ecfdf5; color: #059669; }
        .ku-stat-label { font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 2px; }
        .ku-stat-value { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.3px; }

        .ku-filter {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); padding: 14px 15px; margin-bottom: 20px;
        }
        .ku-filter-top {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        }
        .ku-filter-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .ku-filter-label {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; margin-right: 4px;
        }
        .ku-filter-select {
            padding: 8px 14px; border: 1px solid var(--border-color); border-radius: 8px;
            font-size: 13px; color: #444; background: #fafbfc; cursor: pointer; outline: none;
            min-width: 130px; transition: all 0.2s; font-family: 'Inter', sans-serif;
        }
        .ku-filter-select:hover { border-color: #c0c8d0; }
        .ku-filter-select:focus { border-color: var(--ku-primary); background: #fff; box-shadow: 0 0 0 3px rgba(139,92,246,0.08); }
        .ku-filter-right { display: flex; align-items: center; gap: 8px; }

        .ku-table-wrap {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); overflow: hidden;
        }
        .ku-table-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 15px; border-bottom: 1px solid var(--border-color);
        }
        .ku-table-header-title {
            display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #333;
        }
        .ku-table-header-title i { color: var(--ku-primary); }
        .ku-table-scroll { overflow-x: auto; }
        table.ku-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        table.ku-table thead { background: #fff; }
        table.ku-table th {
            text-align: center; font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; padding: 10px 12px;
            border-bottom: 1px solid var(--border-color); white-space: nowrap;
        }
        table.ku-table td {
            padding: 10px 12px; border-bottom: 1px solid var(--border-color);
            color: #444; vertical-align: middle; text-align: center;
        }
        table.ku-table td.ku-judul-cell { text-align: left; }
        table.ku-table tbody tr:hover { background: #f5f3ff; }
        table.ku-table tbody tr:last-child td { border-bottom: none; }

        .ku-info { display: flex; align-items: center; gap: 12px; }
        .ku-icon-wrap {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff; flex-shrink: 0;
        }
        .ku-judul-text { font-weight: 600; color: #2c3e50; }
        .ku-mapel-text { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .ku-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .ku-badge.kuis { background: #f5f3ff; color: #7c3aed; }
        .ku-badge.ujian { background: #fef3c7; color: #d97706; }
        .ku-badge.akan-datang { background: #dbeafe; color: #2563eb; }
        .ku-badge.sedang-berlangsung { background: #ecfdf5; color: #059669; }
        .ku-badge.selesai { background: #f1f5f9; color: #64748b; }
        .ku-badge .ku-dot { width: 6px; height: 6px; border-radius: 50%; }
        .ku-badge.kuis .ku-dot { background: #7c3aed; }
        .ku-badge.ujian .ku-dot { background: #d97706; }
        .ku-badge.akan-datang .ku-dot { background: #2563eb; }
        .ku-badge.sedang-berlangsung .ku-dot { background: #059669; }
        .ku-badge.selesai .ku-dot { background: #64748b; }

        .ku-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .ku-action-btn {
            width: 32px; height: 32px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; transition: all 0.15s;
        }
        .ku-action-btn.view { background: #f5f3ff; color: var(--ku-primary); }
        .ku-action-btn.view:hover { background: #ede9fe; }
        .ku-action-btn.edit { background: #fef3c7; color: #d97706; }
        .ku-action-btn.edit:hover { background: #fde68a; }
        .ku-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .ku-action-btn.delete:hover { background: #fee2e2; }

        .ku-pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 15px; border-top: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px;
        }
        .ku-pagination-info { font-size: 12px; color: var(--text-muted); }
        .ku-pagination { display: flex; align-items: center; gap: 4px; }
        .ku-page-btn {
            width: 34px; height: 34px; border-radius: 6px;
            border: 1px solid var(--border-color); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 500; color: #555;
            cursor: pointer; transition: all 0.15s;
        }
        .ku-page-btn:hover { border-color: var(--ku-primary); color: var(--ku-primary); }
        .ku-page-btn.active { background: var(--ku-primary); color: #fff; border-color: var(--ku-primary); }

        @keyframes kuFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .ku-row-enter { animation: kuFadeIn 0.3s ease both; }

        .detail-hero {
            background: var(--ku-gradient); padding: 40px 32px 32px; text-align: center; position: relative; overflow: hidden;
        }
        .detail-hero::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 60%);
            animation: kuHeroGlow 6s ease-in-out infinite;
        }
        @keyframes kuHeroGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10%, 10%); }
        }
        .detail-hero-icon {
            width: 88px; height: 88px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 36px; color: #fff;
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            position: relative; z-index: 1; margin-bottom: 16px;
            background: rgba(255,255,255,0.15);
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
        .detail-hero-badge.akan-datang { background: rgba(96,165,250,0.3); color: #93c5fd; }
        .detail-hero-badge.sedang-berlangsung { background: rgba(74,222,128,0.3); color: #4ade80; }
        .detail-hero-badge.selesai { background: rgba(148,163,184,0.3); color: #cbd5e1; }
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
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: kuSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes kuSlideIn {
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
        .search-box:focus-within { border-color: var(--ku-primary); box-shadow: 0 0 0 3px rgba(139,92,246,0.1); }
        .search-box i { color: var(--text-muted); font-size: 14px; margin-right: 10px; }
        .search-box input {
            border: none; background: none; padding: 10px 0; font-size: 13px;
            color: var(--text-main); outline: none; width: 100%; font-family: 'Inter', sans-serif;
        }
        .search-box input::placeholder { color: #aaa; }

        .ku-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
        .ku-form-grid .full { grid-column: 1 / -1; }
        .ku-form-label { font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px; }
        .ku-form-label .req { color: #dc3545; }
        .ku-form-input {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif; transition: border-color 0.2s;
        }
        .ku-form-input:focus { border-color: var(--ku-primary); box-shadow: 0 0 0 3px rgba(139,92,246,0.08); }
        .ku-form-input::placeholder { color: #aaa; }
        .ku-form-textarea {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif;
            resize: vertical; min-height: 60px; transition: border-color 0.2s;
        }
        .ku-form-textarea:focus { border-color: var(--ku-primary); box-shadow: 0 0 0 3px rgba(139,92,246,0.08); }

        .btn {
            display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px;
            border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.fill { background: var(--ku-gradient); color: #fff; box-shadow: 0 4px 12px rgba(139,92,246,0.3); }
        .btn.fill:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,92,246,0.4); }
        .btn.ghost { background: #f5f3ff; color: var(--ku-primary); }
        .btn.ghost:hover { background: #ede9fe; }
        .btn.danger { background: #fee2e2; color: #dc2626; }
        .btn.danger:hover { background: #fecaca; }
        .btn.danger-solid { background: #dc2626; color: #fff; }
        .btn.danger-solid:hover { background: #b91c1c; }

        .ku-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px; max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: kuToastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .ku-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .ku-toast.error { background: #fef2f2; border-color: #ef4444; }
        .ku-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .ku-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .ku-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .ku-toast .toast-body { flex: 1; min-width: 0; }
        .ku-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .ku-toast .toast-msg { font-size: 12px; color: #555; line-height: 1.4; }
        .ku-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; display: flex; align-items: center;
            justify-content: center; font-size: 20px; color: #999; flex-shrink: 0; transition: all 0.15s;
        }
        .ku-toast .toast-close:hover { background: rgba(0,0,0,0.05); color: #333; }

        @keyframes kuToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes kuToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }
    @media (max-width: 767px) { .ku-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; } }
    @media (max-width: 576px) { .ku-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; } }
    </style>

    {{-- Stats --}}
    <div class="ku-stats">
        <div class="ku-stat">
            <div class="ku-stat-icon purple"><i class="fa-solid fa-file-pen"></i></div>
            <div>
                <div class="ku-stat-label">Total Record</div>
                <div class="ku-stat-value">{{ $totalRecord }}</div>
            </div>
        </div>
        <div class="ku-stat">
            <div class="ku-stat-icon violet"><i class="fa-solid fa-pen-to-square"></i></div>
            <div>
                <div class="ku-stat-label">Kuis</div>
                <div class="ku-stat-value">{{ $totalKuis }}</div>
            </div>
        </div>
        <div class="ku-stat">
            <div class="ku-stat-icon blue"><i class="fa-solid fa-file-lines"></i></div>
            <div>
                <div class="ku-stat-label">Ujian</div>
                <div class="ku-stat-value">{{ $totalUjian }}</div>
            </div>
        </div>
        <div class="ku-stat">
            <div class="ku-stat-icon green"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="ku-stat-label">Selesai</div>
                <div class="ku-stat-value">{{ $selesai }}</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="ku-filter">
        <div class="ku-filter-top">
            <div class="ku-filter-left">
                <span class="ku-filter-label"><i class="fa-solid fa-filter" style="margin-right:4px;"></i>Filter</span>
                <select class="ku-filter-select" id="filterJenis">
                    <option value="">Semua Jenis</option>
                    <option value="Kuis">Kuis</option>
                    <option value="Ujian">Ujian</option>
                </select>
                <select class="ku-filter-select" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Akan Datang">Akan Datang</option>
                    <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                    <option value="Selesai">Selesai</option>
                </select>
                <div class="search-box" style="min-width:200px;">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari judul / mapel...">
                </div>
            </div>
            <div class="ku-filter-right">
                <button class="btn fill" onclick="openTambahModal()"><i class="fa-solid fa-plus"></i> Tambah</button>
                <a href="{{ route('admin.kuis-ujian.export') }}" target="_blank" class="btn ghost" style="text-decoration:none;"><i class="fa-solid fa-print"></i> Print</a>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ku-table-wrap">
        <div class="ku-table-header">
            <div class="ku-table-header-title">
                <i class="fa-solid fa-file-pen"></i> Daftar Kuis & Ujian
                <span style="font-size:12px;font-weight:500;color:var(--text-muted);">({{ count($records) }} record)</span>
            </div>
        </div>
        <div class="ku-table-scroll">
            <table class="ku-table">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th style="width:160px;">Judul</th>
                        <th style="width:65px;">Jenis</th>
                        <th style="width:70px;">Kelas</th>
                        <th style="width:120px;">Mata Pelajaran</th>
                        <th style="width:90px;">Tanggal</th>
                        <th style="width:65px;">Durasi</th>
                        <th style="width:95px;">Status</th>
                        <th style="width:90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kuTableBody">
                    @foreach($records as $index => $r)
                    <tr class="ku-row-enter" data-id="{{ $r->id }}" data-jenis="{{ $r->jenis }}" data-status="{{ $r->status }}" data-judul="{{ strtolower($r->judul) }}" data-mapel="{{ strtolower($r->mapel) }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="ku-judul-cell">
                            <div class="ku-info">
                                <div class="ku-icon-wrap" style="background: {{ $r->jenis == 'Kuis' ? '#8b5cf6' : '#d97706' }};">
                                    <i class="fa-solid {{ $r->jenis == 'Kuis' ? 'fa-pen-to-square' : 'fa-file-lines' }}"></i>
                                </div>
                                <div>
                                    <div class="ku-judul-text">{{ $r->judul }}</div>
                                    <div class="ku-mapel-text">{{ $r->mapel }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="ku-badge {{ strtolower($r->jenis) }}">
                                <span class="ku-dot"></span>
                                {{ $r->jenis }}
                            </span>
                        </td>
                        <td><span style="font-size:12px;">{{ $r->kelas ?? '-' }}</span></td>
                        <td><span style="font-size:12px;">{{ $r->mapel }}</span></td>
                        <td><span style="font-size:12px;">{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</span></td>
                        <td><span style="font-size:12px;">{{ $r->durasi ? $r->durasi . ' mnt' : '-' }}</span></td>
                        <td>
                            <span class="ku-badge {{ strtolower(str_replace(' ', '-', $r->status)) }}">
                                <span class="ku-dot"></span>
                                {{ $r->status }}
                            </span>
                        </td>
                        <td>
                            <div class="ku-action-btns">
                                <button class="ku-action-btn view" title="Detail" onclick="openDetail({{ $r->id }})"><i class="fa-solid fa-eye"></i></button>
                                <a href="{{ route('admin.kuis-ujian.kerjakan', $r->id) }}" class="ku-action-btn edit" title="Kerjakan" style="background:#ecfdf5;color:#10b981;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:14px;"><i class="fa-solid fa-play"></i></a>
                                <a href="{{ route('admin.kuis-ujian.soal', $r->id) }}" class="ku-action-btn edit" title="Soal" style="background:#ddd6fe;color:#7c3aed;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:13px;font-weight:600;"><i class="fa-solid fa-list-check"></i></a>
                                <a href="{{ route('admin.kuis-ujian.koreksi', $r->id) }}" class="ku-action-btn view" title="Koreksi" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:13px;"><i class="fa-solid fa-check-double"></i></a>
                                <button class="ku-action-btn delete" title="Hapus" onclick="openHapus({{ $r->id }})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="ku-pagination-wrap">
            <div class="ku-pagination-info">Menampilkan <strong>{{ count($records) }}</strong> dari <strong>{{ count($records) }}</strong> record</div>
            <div class="ku-pagination">
                <button class="ku-page-btn active">1</button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('detailModal').style.display='none'">
        <div class="modal-box" style="max-width:560px;">
            <div class="detail-hero">
                <button class="detail-hero-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
                <div class="detail-hero-icon" id="detailIcon"><i class="fa-solid fa-file-pen"></i></div>
                <div class="detail-hero-name" id="detailJudul">-</div>
                <div class="detail-hero-sub" id="detailJenisLabel">-</div>
                <div class="detail-hero-badge" id="detailStatus">-</div>
            </div>
            <div class="detail-body">
                <div class="detail-section-title"><i class="fa-solid fa-circle-info" style="margin-right:6px;"></i> Informasi Kuis & Ujian</div>
                <div class="detail-info-grid">
                    <div>
                        <div class="detail-info-label">Kelas</div>
                        <div class="detail-info-value" id="detailKelas">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Mata Pelajaran</div>
                        <div class="detail-info-value" id="detailMapel">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Tanggal</div>
                        <div class="detail-info-value" id="detailTanggal">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Durasi</div>
                        <div class="detail-info-value" id="detailDurasi">-</div>
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

    {{-- Form Modal --}}
    <div id="formModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('formModal').style.display='none'">
        <div class="modal-box" style="max-width:600px;">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;color:var(--ku-primary);">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;" id="formModalTitle">Tambah Record</div>
                        <div style="font-size:12px;color:var(--text-muted);">Buat kuis atau ujian baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('formModal').style.display='none'">&times;</button>
            </div>
            <form id="recordForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="ku-form-grid">
                        <div class="full">
                            <label class="ku-form-label">Judul <span class="req">*</span></label>
                            <input type="text" id="formJudul" class="ku-form-input" placeholder="Contoh: UTS Semester Ganjil" required>
                        </div>
                        <div>
                            <label class="ku-form-label">Jenis <span class="req">*</span></label>
                            <select id="formJenis" class="ku-form-input">
                                <option value="Kuis">Kuis</option>
                                <option value="Ujian">Ujian</option>
                            </select>
                        </div>
                        <div>
                            <label class="ku-form-label">Kelas</label>
                            <select id="formKelas" class="ku-form-input">
                                <option value="">-- Pilih Kelas --</option>
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                                <option value="2A">2A</option>
                                <option value="2B">2B</option>
                                <option value="3A">3A</option>
                                <option value="3B">3B</option>
                            </select>
                        </div>
                        <div>
                            <label class="ku-form-label">Mata Pelajaran <span class="req">*</span></label>
                            <select id="formMapel" class="ku-form-input" required>
                                <option value="">-- Pilih Mapel --</option>
                                @foreach($mapelList as $m)
                                    <option value="{{ $m->nama_mapel }}">{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="ku-form-label">Tanggal <span class="req">*</span></label>
                            <input type="date" id="formTanggal" class="ku-form-input" required>
                        </div>
                        <div>
                            <label class="ku-form-label">Durasi (menit)</label>
                            <input type="number" id="formDurasi" class="ku-form-input" placeholder="60">
                        </div>
                        <div class="full">
                            <label class="ku-form-label">Status</label>
                            <select id="formStatus" class="ku-form-input">
                                <option value="Akan Datang">Akan Datang</option>
                                <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="full">
                            <label class="ku-form-label">Keterangan</label>
                            <textarea id="formKeterangan" class="ku-form-textarea" placeholder="Catatan tambahan..."></textarea>
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
                    Apakah Anda yakin ingin menghapus <strong id="hapusNama">-</strong>?
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
            const icon = r.jenis === 'Kuis' ? 'fa-pen-to-square' : 'fa-file-lines';
            const iconBg = r.jenis === 'Kuis' ? '#8b5cf6' : '#d97706';
            document.getElementById('detailIcon').innerHTML = '<i class="fa-solid ' + icon + '"></i>';
            document.getElementById('detailIcon').style.background = iconBg;
            document.getElementById('detailJudul').textContent = r.judul;
            document.getElementById('detailJenisLabel').textContent = r.jenis + ' - ' + r.mapel;
            document.getElementById('detailKelas').textContent = r.kelas || '-';
            document.getElementById('detailMapel').textContent = r.mapel;
            document.getElementById('detailTanggal').textContent = r.tanggal ? new Date(r.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            document.getElementById('detailDurasi').textContent = r.durasi ? r.durasi + ' menit' : '-';
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

        function openTambahModal() {
            document.getElementById('formModalTitle').textContent = 'Tambah Record';
            document.getElementById('formId').value = '';
            document.getElementById('recordForm').reset();
            document.getElementById('formTanggal').value = new Date().toISOString().split('T')[0];
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').style.display = 'flex';
        }

        function openEdit(id) {
            fetch('/admin/kuis-ujian/' + id + '/edit')
                .then(res => res.json())
                .then(r => {
                    document.getElementById('formModalTitle').textContent = 'Edit Record';
                    document.getElementById('formId').value = r.id;
                    document.getElementById('formJudul').value = r.judul;
                    document.getElementById('formJenis').value = r.jenis;
                    document.getElementById('formKelas').value = r.kelas || '';
                    document.getElementById('formMapel').value = r.mapel;
                    document.getElementById('formTanggal').value = r.tanggal;
                    document.getElementById('formDurasi').value = r.durasi || '';
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
            document.getElementById('hapusNama').textContent = r.judul;
            document.getElementById('hapusModal').style.display = 'flex';
        }

        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('/admin/kuis-ujian/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    document.getElementById('hapusModal').style.display = 'none';
                    showToast('success', 'Berhasil!', 'Record berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        }

        function renderRow(r, index) {
            const jenisCls = r.jenis.toLowerCase();
            const statusCls = r.status.toLowerCase().replace(' ', '-');
            const icon = r.jenis === 'Kuis' ? 'fa-pen-to-square' : 'fa-file-lines';
            const iconBg = r.jenis === 'Kuis' ? '#8b5cf6' : '#d97706';
            const tgl = new Date(r.tanggal).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
            return '<tr data-id="' + r.id + '" data-jenis="' + r.jenis + '" data-status="' + r.status + '" data-judul="' + r.judul.toLowerCase() + '" data-mapel="' + r.mapel.toLowerCase() + '">' +
                '<td>' + (index + 1) + '</td>' +
                '<td class="ku-judul-cell"><div class="ku-info"><div class="ku-icon-wrap" style="background:' + iconBg + ';"><i class="fa-solid ' + icon + '"></i></div><div><div class="ku-judul-text">' + r.judul + '</div><div class="ku-mapel-text">' + r.mapel + '</div></div></div></td>' +
                '<td><span class="ku-badge ' + jenisCls + '"><span class="ku-dot"></span> ' + r.jenis + '</span></td>' +
                '<td><span style="font-size:12px;">' + (r.kelas || '-') + '</span></td>' +
                '<td><span style="font-size:12px;">' + r.mapel + '</span></td>' +
                '<td><span style="font-size:12px;">' + tgl + '</span></td>' +
                '<td><span style="font-size:12px;">' + (r.durasi ? r.durasi + ' mnt' : '-') + '</span></td>' +
                '<td><span class="ku-badge ' + statusCls + '"><span class="ku-dot"></span> ' + r.status + '</span></td>' +
                '<td><div class="ku-action-btns">' +
                '<button class="ku-action-btn view" title="Detail" onclick="openDetail(' + r.id + ')"><i class="fa-solid fa-eye"></i></button>' +
                '<a href="/admin/kuis-ujian/' + r.id + '/kerjakan" class="ku-action-btn edit" title="Kerjakan" style="background:#ecfdf5;color:#10b981;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:14px;"><i class="fa-solid fa-play"></i></a>' +
                '<a href="/admin/kuis-ujian/' + r.id + '/soal" class="ku-action-btn edit" title="Soal" style="background:#ddd6fe;color:#7c3aed;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:13px;font-weight:600;"><i class="fa-solid fa-list-check"></i></a>' +
                '<a href="/admin/kuis-ujian/' + r.id + '/koreksi" class="ku-action-btn view" title="Koreksi" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:13px;"><i class="fa-solid fa-check-double"></i></a>' +
                '<button class="ku-action-btn delete" title="Hapus" onclick="openHapus(' + r.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                '</div></td></tr>';
        }

        function refreshTable() {
            const tbody = document.getElementById('kuTableBody');
            tbody.innerHTML = recordsData.map((r, i) => renderRow(r, i)).join('');
            filterTable();
        }

        document.getElementById('recordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const data = {
                judul: document.getElementById('formJudul').value,
                jenis: document.getElementById('formJenis').value,
                kelas: document.getElementById('formKelas').value,
                mapel: document.getElementById('formMapel').value,
                tanggal: document.getElementById('formTanggal').value,
                durasi: document.getElementById('formDurasi').value,
                status: document.getElementById('formStatus').value,
                keterangan: document.getElementById('formKeterangan').value,
            };
            const url = id ? '/admin/kuis-ujian/' + id : '/admin/kuis-ujian';
            const method = id ? 'PUT' : 'POST';
            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify(data),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    document.getElementById('formModal').style.display = 'none';
                    showToast('success', 'Berhasil!', 'Record berhasil ' + (id ? 'diupdate' : 'disimpan') + '.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        });

        function showToast(type, title, msg) {
            const existing = document.querySelector('.ku-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'ku-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + icons[type] + '"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { if (t.parentElement) { t.style.animation = 'kuToastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); } }, 4000);
        }

        document.getElementById('filterJenis').addEventListener('change', filterTable);
        document.getElementById('filterStatus').addEventListener('change', filterTable);
        document.getElementById('searchInput').addEventListener('input', filterTable);

        function filterTable() {
            const jenis = document.getElementById('filterJenis').value;
            const status = document.getElementById('filterStatus').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#kuTableBody tr');
            rows.forEach(row => {
                const rJenis = row.dataset.jenis;
                const rStatus = row.dataset.status;
                const rJudul = row.dataset.judul;
                const rMapel = row.dataset.mapel;
                const matchJenis = !jenis || rJenis === jenis;
                const matchStatus = !status || rStatus === status;
                const matchSearch = !search || rJudul.includes(search) || rMapel.includes(search);
                row.style.display = matchJenis && matchStatus && matchSearch ? '' : 'none';
            });
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
    </script>

</x-admin-layout>
