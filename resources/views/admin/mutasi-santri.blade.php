<x-admin-layout>
    <x-slot name="title">Mutasi Santri</x-slot>
    @section('header_title', 'Mutasi Santri')

    <style>
        :root {
            --ms-primary: #0ea5e9;
            --ms-primary-light: #e0f2fe;
            --ms-accent: #06b6d4;
            --ms-teal: #14b8a6;
            --ms-card-shadow: 0 4px 24px rgba(0,0,0,0.06);
            --ms-border: #f1f5f9;
            --ms-text: #1e293b;
            --ms-text-muted: #94a3b8;
            --ms-green: #10b981;
            --ms-red: #ef4444;
            --ms-orange: #f59e0b;
        }

        .ms-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin: 0 0 28px;
        }

        .ms-stat {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--ms-border);
            box-shadow: var(--ms-card-shadow);
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            position: relative;
            overflow: hidden;
        }

        .ms-stat::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .ms-stat:nth-child(1)::after { background: linear-gradient(90deg, #0ea5e9, #06b6d4); }
        .ms-stat:nth-child(2)::after { background: linear-gradient(90deg, #f59e0b, #f97316); }
        .ms-stat:nth-child(3)::after { background: linear-gradient(90deg, #10b981, #34d399); }
        .ms-stat:nth-child(4)::after { background: linear-gradient(90deg, #ef4444, #f43f5e); }

        .ms-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
        }

        .ms-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .ms-stat:hover .ms-stat-icon { transform: scale(1.08) rotate(-4deg); }

        .ms-stat-icon.blue { background: linear-gradient(135deg, #e0f2fe, #bae6fd); color: #0ea5e9; }
        .ms-stat-icon.orange { background: linear-gradient(135deg, #fff7ed, #ffedd5); color: #f97316; }
        .ms-stat-icon.green { background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #10b981; }
        .ms-stat-icon.red { background: linear-gradient(135deg, #fef2f2, #fecaca); color: #ef4444; }

        .ms-stat-body { flex: 1; min-width: 0; }
        .ms-stat-label { font-size: 11px; font-weight: 600; color: var(--ms-text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
        .ms-stat-value { font-size: 26px; font-weight: 800; color: var(--ms-text); letter-spacing: -0.5px; line-height: 1.2; }
        .ms-stat-sub { font-size: 11px; color: var(--ms-text-muted); margin-top: 1px; }

        .ms-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 24px;
            background: #fff;
            padding: 12px 20px;
            border-radius: 16px;
            border: 1px solid var(--ms-border);
            box-shadow: var(--ms-card-shadow);
        }

        .ms-toolbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ms-search-wrap {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0 14px;
            min-width: 240px;
            transition: all 0.2s;
        }

        .ms-search-wrap:focus-within {
            border-color: var(--ms-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        .ms-search-wrap i { color: #94a3b8; font-size: 14px; margin-right: 10px; }

        .ms-search-wrap input {
            border: none;
            background: none;
            padding: 10px 0;
            font-size: 13px;
            color: var(--ms-text);
            outline: none;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .ms-search-wrap input::placeholder { color: #b0b8c4; }

        .ms-filter-select {
            padding: 9px 36px 9px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: 1.5px solid #e2e8f0;
            font-family: 'Inter', sans-serif;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 12px center;
            color: #1e293b;
            cursor: pointer;
            appearance: none;
            transition: all 0.2s;
            min-width: 140px;
        }

        .ms-filter-select:focus {
            border-color: var(--ms-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .ms-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: #fff;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.35);
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            text-decoration: none;
        }

        .ms-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.45);
        }

        .ms-table-wrap {
            background: #fff;
            border-radius: 18px;
            border: 1px solid var(--ms-border);
            box-shadow: var(--ms-card-shadow);
            overflow: auto;
        }

        .ms-table-wrap::-webkit-scrollbar { height: 8px; width: 8px; }
        .ms-table-wrap::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
        .ms-table-wrap::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .ms-table-wrap::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .ms-table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
            font-size: 13px;
        }

        .ms-table thead th {
            padding: 14px 16px;
            text-align: center;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 5;
            white-space: nowrap;
        }

        .ms-table thead th:first-child { border-radius: 18px 0 0 0; }
        .ms-table thead th:last-child { border-radius: 0 18px 0 0; }

        .ms-table tbody tr {
            transition: background 0.2s;
        }

        .ms-table tbody tr:hover {
            background: #f8fafc;
        }

        .ms-table tbody tr:last-child td:first-child { border-radius: 0 0 0 18px; }
        .ms-table tbody tr:last-child td:last-child { border-radius: 0 0 18px 0; }

        .ms-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .ms-table tbody tr:last-child td {
            border-bottom: none;
        }

        .ms-santri-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ms-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .ms-santri-name {
            font-weight: 600;
            color: var(--ms-text);
        }

        .ms-class-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .ms-class-badge.from {
            background: #fef3c7;
            color: #d97706;
        }

        .ms-class-badge.to {
            background: #dbeafe;
            color: #2563eb;
        }

        .ms-arrow {
            color: #94a3b8;
            font-size: 14px;
            margin: 0 4px;
        }

        .ms-date {
            color: #64748b;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ms-date i { font-size: 13px; color: #94a3b8; }

        .ms-alasan {
            font-size: 12px;
            color: #64748b;
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ms-actions {
            display: flex;
            gap: 4px;
        }

        .ms-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all 0.2s;
        }

        .ms-action-btn.view {
            background: #eef2ff;
            color: #4f46e5;
        }

        .ms-action-btn.view:hover { background: #e0e7ff; }

        .ms-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .ms-action-btn.delete:hover { background: #fee2e2; }

        .ms-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .ms-empty i {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .ms-empty h3 {
            font-size: 18px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }

        .ms-empty p {
            font-size: 13px;
            color: #94a3b8;
        }

        .ms-footer-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            background: #f8fafc;
            border-top: 1px solid var(--ms-border);
            border-radius: 0 0 18px 18px;
            font-size: 12px;
            color: var(--ms-text-muted);
        }

        .ms-footer-info .total {
            font-weight: 700;
            color: var(--ms-text);
        }

        .ms-pagination {
            display: flex;
            gap: 4px;
        }

        .ms-page-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s;
        }

        .ms-page-btn:hover {
            border-color: var(--ms-primary);
            color: var(--ms-primary);
        }

        .ms-page-btn.active {
            background: var(--ms-primary);
            border-color: var(--ms-primary);
            color: #fff;
        }

        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.active { display: flex; animation: msFadeIn 0.2s ease; }

        @keyframes msFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-box {
            background: #fff;
            border-radius: 18px;
            width: 90%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            animation: msSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes msSlideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--ms-border);
        }

        .modal-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--ms-text);
            margin: 0;
        }

        .modal-close {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            color: #64748b;
            transition: all 0.15s;
        }

        .modal-close:hover { background: #e2e8f0; color: var(--ms-text); }

        .modal-body { padding: 24px; }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 18px 24px;
            border-top: 1px solid var(--ms-border);
        }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            background: #f8fafc;
            color: var(--ms-text);
        }

        .form-control:focus {
            border-color: var(--ms-primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .btn.ghost { background: #f1f5f9; color: #475569; }
        .btn.ghost:hover { background: #e2e8f0; }

        .btn.primary {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: #fff;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
        }

        .btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .btn.danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3);
        }

        .btn.danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 12px 14px;
            border-radius: 10px;
        }

        .detail-item.full { grid-column: 1 / -1; }

        .detail-item .dlabel {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
        }

        .detail-item .dvalue {
            font-size: 14px;
            font-weight: 600;
            color: var(--ms-text);
        }

        .toast-notif {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            border-radius: 14px;
            min-width: 320px;
            max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: msToastIn 0.5s cubic-bezier(0.22, 1, 0.36, 1);
            border-left: 4px solid;
            backdrop-filter: blur(12px);
        }

        .toast-success { background: rgba(240, 253, 244, 0.95); border-color: #22c55e; }

        .toast-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .toast-success .toast-icon { background: #dcfce7; color: #16a34a; }

        .toast-body { flex: 1; min-width: 0; }
        .toast-title { font-size: 14px; font-weight: 700; color: var(--ms-text); margin-bottom: 2px; }
        .toast-msg { font-size: 12px; color: #555; line-height: 1.4; }

        .toast-close {
            width: 28px; height: 28px;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            color: #999;
            flex-shrink: 0;
            transition: all 0.15s;
        }

        .toast-close:hover { background: rgba(0,0,0,0.05); color: #333; }

        @keyframes msToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }

        @keyframes msToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        @media (max-width: 1200px) {
            .ms-stats { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 767px) {
            .ms-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .ms-stat-value { font-size: 22px; }
            .ms-toolbar { flex-direction: column; align-items: stretch; }
            .ms-toolbar-left { flex-direction: column; }
            .ms-search-wrap { min-width: 100%; }
            .ms-add-btn { justify-content: center; }
        }

        @media (max-width: 480px) {
            .ms-stats { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        }
    </style>

    <div class="ms-stats">
        <div class="ms-stat">
            <div class="ms-stat-icon blue"><i class="fa-solid fa-arrows-rotate"></i></div>
            <div class="ms-stat-body">
                <div class="ms-stat-label">Total Mutasi</div>
                <div class="ms-stat-value">{{ $totalMutasi }}</div>
                <div class="ms-stat-sub">Seluruh riwayat mutasi</div>
            </div>
        </div>
        <div class="ms-stat">
            <div class="ms-stat-icon orange"><i class="fa-regular fa-calendar"></i></div>
            <div class="ms-stat-body">
                <div class="ms-stat-label">Bulan Ini</div>
                <div class="ms-stat-value">{{ $mutasiBulanIni }}</div>
                <div class="ms-stat-sub">Mutasi bulan {{ now()->format('F') }}</div>
            </div>
        </div>
        <div class="ms-stat">
            <div class="ms-stat-icon green"><i class="fa-solid fa-right-to-bracket"></i></div>
            <div class="ms-stat-body">
                <div class="ms-stat-label">Mutasi Masuk</div>
                <div class="ms-stat-value">{{ $mutasiMasuk }}</div>
                <div class="ms-stat-sub">Santri pindah ke kelas ini</div>
            </div>
        </div>
        <div class="ms-stat">
            <div class="ms-stat-icon red"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="ms-stat-body">
                <div class="ms-stat-label">Mutasi Keluar</div>
                <div class="ms-stat-value">{{ $mutasiKeluar }}</div>
                <div class="ms-stat-sub">Santri pindah dari kelas ini</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="toast-notif toast-success" id="notifAlert">
            <div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div>
            <div class="toast-body">
                <div class="toast-title">Berhasil</div>
                <div class="toast-msg">{{ session('success') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-notif" style="background:rgba(254,242,242,0.95);border-color:#ef4444;" id="notifAlert">
            <div class="toast-icon" style="background:#fee2e2;color:#dc2626;"><i class="fa-solid fa-exclamation-circle"></i></div>
            <div class="toast-body">
                <div class="toast-title">Gagal</div>
                <div class="toast-msg">{{ session('error') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    <div class="ms-toolbar">
        <div class="ms-toolbar-left">
            <div class="ms-search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="msSearch" placeholder="Cari santri..." oninput="filterMutasi()">
            </div>
            <select class="ms-filter-select" id="msFilterKelas" onchange="filterMutasi()">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <button class="ms-add-btn" onclick="openTambahMutasi()">
            <i class="fa-solid fa-plus"></i> Tambah Mutasi
        </button>
    </div>

    <div class="ms-table-wrap">
        <table class="ms-table">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama Santri</th>
                    <th>Kelas Asal</th>
                    <th>Kelas Tujuan</th>
                    <th>Tanggal</th>
                    <th>Alasan</th>
                    <th style="width:80px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="msTableBody">
                @forelse($mutasi as $m)
                    @php
                        $colors = ['#0ea5e9','#8b5cf6','#f59e0b','#10b981','#ef4444','#ec4899','#14b8a6','#f97316'];
                        $c = $colors[$loop->index % count($colors)];
                    @endphp
                    <tr class="ms-row" data-name="{{ strtolower($m->santri_nama) }}" data-kelas="{{ $m->kelas_asal }} {{ $m->kelas_tujuan }}">
                        <td style="text-align:center;font-weight:700;color:#64748b;">{{ $loop->iteration }}</td>
                        <td>
                            <div class="ms-santri-cell">
                                <div class="ms-avatar" style="background:{{ $c }};">
                                    {{ strtoupper(substr($m->santri_nama, 0, 1)) }}
                                </div>
                                <span class="ms-santri-name">{{ $m->santri_nama }}</span>
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <span class="ms-class-badge from"><i class="fa-solid fa-building"></i> {{ $m->kelas_asal }}</span>
                        </td>
                        <td style="text-align:center;">
                            <span class="ms-class-badge to"><i class="fa-solid fa-flag"></i> {{ $m->kelas_tujuan }}</span>
                        </td>
                        <td style="text-align:center;">
                            <div class="ms-date" style="justify-content:center;">
                                <i class="fa-regular fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($m->tgl_mutasi)->isoFormat('D MMM YYYY') }}
                            </div>
                        </td>
                        <td>
                            <span class="ms-alasan" title="{{ $m->alasan }}">
                                <i class="fa-regular fa-note-sticky" style="margin-right:4px;color:#94a3b8;"></i>
                                {{ $m->alasan }}
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <div class="ms-actions" style="justify-content:center;">
                                <button class="ms-action-btn view" onclick="detailMutasi('{{ $m->santri_nama }}', '{{ $m->kelas_asal }}', '{{ $m->kelas_tujuan }}', '{{ $m->tgl_mutasi }}', '{{ $m->alasan }}', '{{ $m->keterangan }}')" title="Detail">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <button class="ms-action-btn delete" onclick="confirmHapus({{ $m->id }})" title="Hapus">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="ms-empty">
                                <i class="fa-solid fa-arrows-rotate"></i>
                                <h3>Belum Ada Mutasi</h3>
                                <p>Klik tombol "Tambah Mutasi" untuk mencatat mutasi santri.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="ms-footer-info">
            <span>Menampilkan <span class="total">{{ count($mutasi) }}</span> data mutasi</span>
            <div class="ms-pagination">
                <button class="ms-page-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="ms-page-btn active">1</button>
                <button class="ms-page-btn">2</button>
                <button class="ms-page-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Mutasi --}}
    <div class="modal-overlay" id="tambahMutasiModal">
        <div class="modal-box" style="max-width:520px;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-arrows-rotate" style="color:#0ea5e9;margin-right:8px;"></i> Tambah Mutasi Santri</h3>
                <button class="modal-close" onclick="closeTambahMutasi()">&times;</button>
            </div>
            <form action="{{ route('admin.mutasi-santri.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Santri</label>
                        <select name="santri" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santri as $s)
                                <option value="{{ $s->id }}" data-kelas="{{ $s->kelas }}">{{ $s->nama }} ({{ $s->kelas }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group" style="margin:0;">
                            <label>Kelas Asal</label>
                            <input type="text" id="kelasAsalInput" class="form-control" readonly style="background:#f1f5f9;color:#94a3b8;">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Kelas Tujuan</label>
                            <select name="kelas_tujuan" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group" style="margin:0;">
                            <label>Tanggal Mutasi</label>
                            <input type="date" name="tgl_mutasi" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Alasan</label>
                            <select name="alasan" class="form-control" required>
                                <option value="">-- Alasan --</option>
                                <option>Pindah Kelas</option>
                                <option>Penyesuaian Tingkat</option>
                                <option>Permintaan Orang Tua</option>
                                <option>Pindah Wilayah</option>
                                <option>Akselerasi</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <textarea name="keterangan" class="form-control" placeholder="Tambahkan catatan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeTambahMutasi()">Batal</button>
                    <button type="submit" class="btn primary"><i class="fa-solid fa-check"></i> Simpan Mutasi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal-overlay" id="detailMutasiModal">
        <div class="modal-box" style="max-width:420px;">
            <div class="modal-header">
                <h3><i class="fa-regular fa-circle-info" style="color:#0ea5e9;margin-right:8px;"></i> Detail Mutasi</h3>
                <button class="modal-close" onclick="closeDetailMutasi()">&times;</button>
            </div>
            <div class="modal-body" id="detailMutasiContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn ghost" onclick="closeDetailMutasi()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal-overlay" id="hapusMutasiModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-body" style="text-align:center;padding:32px 24px 24px;">
                <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#fee2e2,#fecaca);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-trash-can" style="font-size:24px;color:#dc2626;"></i>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:var(--ms-text);margin:0 0 6px;">Hapus Mutasi</h3>
                <p style="font-size:13px;color:#64748b;margin:0 0 24px;line-height:1.6;">Apakah Anda yakin ingin menghapus riwayat mutasi ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:12px;justify-content:center;">
                    <button type="button" class="btn ghost" onclick="closeHapusMutasi()" style="padding:10px 28px;">Batal</button>
                    <button type="button" class="btn danger" onclick="submitHapusMutasi()" style="padding:10px 28px;"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var hapusId = null;

        function openTambahMutasi() {
            document.getElementById('tambahMutasiModal').classList.add('active');
        }
        function closeTambahMutasi() {
            document.getElementById('tambahMutasiModal').classList.remove('active');
        }
        document.getElementById('tambahMutasiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeTambahMutasi();
        });

        document.querySelector('#tambahMutasiModal form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            var data = {
                santri_id: document.querySelector('select[name="santri"]').value,
                kelas_asal: document.getElementById('kelasAsalInput').value,
                kelas_tujuan: document.querySelector('select[name="kelas_tujuan"]').value,
                tgl_mutasi: document.querySelector('input[name="tgl_mutasi"]').value,
                alasan: document.querySelector('select[name="alasan"]').value,
                keterangan: document.querySelector('textarea[name="keterangan"]').value,
            };
            fetch('{{ route("admin.mutasi-santri.store") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            }).then(r => r.json()).then(function(res) {
                if (res.success) location.reload();
            });
        });

        document.querySelector('select[name="santri"]')?.addEventListener('change', function() {
            var opt = this.options[this.selectedIndex];
            var kelas = opt.getAttribute('data-kelas') || '';
            document.getElementById('kelasAsalInput').value = kelas;
        });

        function detailMutasi(nama, asal, tujuan, tgl, alasan, keterangan) {
            var colors = ['#0ea5e9','#8b5cf6','#f59e0b','#10b981','#ef4444','#ec4899'];
            var c = colors[nama.length % colors.length];
            var initial = nama.charAt(0).toUpperCase();
            var html = '<div style="background:linear-gradient(135deg,' + c + ',' + c + 'dd);margin:-24px -24px 20px;padding:24px;text-align:center;color:#fff;border-radius:18px 18px 0 0;">';
            html += '<div style="width:48px;height:48px;border-radius:14px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:22px;font-weight:800;">' + initial + '</div>';
            html += '<div style="font-size:18px;font-weight:800;">' + nama + '</div>';
            html += '<div style="font-size:12px;opacity:0.8;margin-top:4px;">' + alasan + '</div>';
            html += '</div>';
            html += '<div class="detail-grid">';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-solid fa-building"></i> Kelas Asal</div><div class="dvalue" style="color:#d97706;">' + asal + '</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-solid fa-flag"></i> Kelas Tujuan</div><div class="dvalue" style="color:#2563eb;">' + tujuan + '</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-regular fa-calendar"></i> Tanggal</div><div class="dvalue">' + new Date(tgl).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) + '</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-regular fa-note-sticky"></i> Alasan</div><div class="dvalue">' + alasan + '</div></div>';
            if (keterangan) {
                html += '<div class="detail-item full"><div class="dlabel"><i class="fa-regular fa-comment"></i> Keterangan</div><div class="dvalue" style="font-weight:400;">' + keterangan + '</div></div>';
            }
            html += '</div>';
            document.getElementById('detailMutasiContent').innerHTML = html;
            document.getElementById('detailMutasiModal').classList.add('active');
        }
        function closeDetailMutasi() {
            document.getElementById('detailMutasiModal').classList.remove('active');
        }
        document.getElementById('detailMutasiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailMutasi();
        });

        function confirmHapus(id) {
            hapusId = id;
            document.getElementById('hapusMutasiModal').classList.add('active');
        }
        function closeHapusMutasi() {
            document.getElementById('hapusMutasiModal').classList.remove('active');
            hapusId = null;
        }
        function submitHapusMutasi() {
            fetch('{{ route("admin.mutasi-santri.destroy", 0) }}'.replace('/0', '/' + hapusId), {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(r => r.json()).then(res => {
                if (res.success) location.reload();
            });
        }
        document.getElementById('hapusMutasiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeHapusMutasi();
        });

        function filterMutasi() {
            var q = document.getElementById('msSearch').value.toLowerCase();
            var kelas = document.getElementById('msFilterKelas').value;
            var rows = document.querySelectorAll('.ms-row');
            rows.forEach(function(r) {
                var name = r.getAttribute('data-name') || '';
                var kls = r.getAttribute('data-kelas') || '';
                var matchName = name.indexOf(q) > -1;
                var matchKelas = kelas === '' || kls.indexOf(kelas) > -1;
                r.style.display = matchName && matchKelas ? '' : 'none';
            });
        }

        var notif = document.getElementById('notifAlert');
        if (notif) {
            setTimeout(function() {
                notif.style.animation = 'msToastOut 0.4s cubic-bezier(0.22, 1, 0.36, 1) forwards';
                setTimeout(function() { if (notif.parentNode) notif.remove(); }, 400);
            }, 4500);
        }
    </script>
</x-admin-layout>
