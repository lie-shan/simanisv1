<x-admin-layout>
    <x-slot name="title">Mata Pelajaran</x-slot>
    @section('header_title', 'Mata Pelajaran')
    @section('header_subtitle', 'Kelola mata pelajaran TPA Nurul Iman')

    <style>
        :root {
            --mp-primary: #f97316;
            --mp-primary-dark: #ea580c;
            --mp-primary-light: #fff7ed;
            --mp-gradient: linear-gradient(135deg, #f97316 0%, #d97706 100%);
        }
        .mp-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px;
        }
        .mp-stat {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 14px 15px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03); transition: all 0.2s;
        }
        .mp-stat:hover { border-color: var(--mp-primary); box-shadow: 0 4px 12px rgba(249,115,22,0.08); }
        .mp-stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .mp-stat-icon.orange { background: #fff7ed; color: #ea580c; }
        .mp-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .mp-stat-icon.blue { background: #e0f2fe; color: #0284c7; }
        .mp-stat-icon.green { background: #f0fdf4; color: #16a34a; }
        .mp-stat-label { font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 2px; }
        .mp-stat-value { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.3px; }

        .mp-filter {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); padding: 14px 15px; margin-bottom: 20px;
        }
        .mp-filter-top {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        }
        .mp-filter-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .mp-filter-label {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; margin-right: 4px;
        }
        .mp-filter-select {
            padding: 8px 14px; border: 1px solid var(--border-color); border-radius: 8px;
            font-size: 13px; color: #444; background: #fafbfc; cursor: pointer; outline: none;
            min-width: 140px; transition: all 0.2s; font-family: 'Inter', sans-serif;
        }
        .mp-filter-select:hover { border-color: #c0c8d0; }
        .mp-filter-select:focus { border-color: var(--mp-primary); background: #fff; box-shadow: 0 0 0 3px rgba(249,115,22,0.08); }
        .mp-filter-right { display: flex; align-items: center; gap: 8px; }

        .mp-table-wrap {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03); overflow: hidden;
        }
        .mp-table-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 15px; border-bottom: 1px solid var(--border-color);
        }
        .mp-table-header-title {
            display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 600; color: #333;
        }
        .mp-table-header-title i { color: var(--mp-primary); }
        .mp-table-scroll { overflow-x: auto; }
        table.mp-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        table.mp-table thead { background: #fff; }
        table.mp-table th {
            text-align: center; font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.4px; padding: 10px 12px;
            border-bottom: 1px solid var(--border-color); white-space: nowrap;
        }
        table.mp-table td {
            padding: 10px 12px; border-bottom: 1px solid var(--border-color);
            color: #444; vertical-align: middle; text-align: center;
        }
        table.mp-table td.mp-nama-cell { text-align: left; }
        table.mp-table tbody tr:hover { background: #fffbeb; }
        table.mp-table tbody tr:last-child td { border-bottom: none; }

        .mp-mapel-info { display: flex; align-items: center; gap: 12px; }
        .mp-icon-wrap {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff; flex-shrink: 0;
        }
        .mp-mapel-text { font-weight: 600; color: #2c3e50; }
        .mp-kode-text { font-size: 11px; color: var(--text-muted); margin-top: 1px; font-family: monospace; }

        .mp-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .mp-badge.aktif { background: #f0fdf4; color: #16a34a; }
        .mp-badge.tidak-aktif { background: #fef2f2; color: #dc2626; }
        .mp-badge .mp-dot { width: 6px; height: 6px; border-radius: 50%; }
        .mp-badge.aktif .mp-dot { background: #16a34a; }
        .mp-badge.tidak-aktif .mp-dot { background: #dc2626; }

        .mp-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .mp-action-btn {
            width: 32px; height: 32px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; transition: all 0.15s;
        }
        .mp-action-btn.view { background: #fff7ed; color: var(--mp-primary); }
        .mp-action-btn.view:hover { background: #ffedd5; }
        .mp-action-btn.edit { background: #f0fdf4; color: #16a34a; }
        .mp-action-btn.edit:hover { background: #dcfce7; }
        .mp-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .mp-action-btn.delete:hover { background: #fee2e2; }

        .mp-pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 15px; border-top: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px;
        }
        .mp-pagination-info { font-size: 12px; color: var(--text-muted); }
        .mp-pagination { display: flex; align-items: center; gap: 4px; }
        .mp-page-btn {
            width: 34px; height: 34px; border-radius: 6px;
            border: 1px solid var(--border-color); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 500; color: #555;
            cursor: pointer; transition: all 0.15s;
        }
        .mp-page-btn:hover { border-color: var(--mp-primary); color: var(--mp-primary); }
        .mp-page-btn.active { background: var(--mp-primary); color: #fff; border-color: var(--mp-primary); }

        @keyframes mpFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .mp-row-enter { animation: mpFadeIn 0.3s ease both; }

        .detail-hero {
            background: var(--mp-gradient); padding: 40px 32px 32px; text-align: center; position: relative; overflow: hidden;
        }
        .detail-hero::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 60%);
            animation: mpHeroGlow 6s ease-in-out infinite;
        }
        @keyframes mpHeroGlow {
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
        .detail-hero-name { font-size: 22px; font-weight: 700; color: #fff; position: relative; z-index: 1; }
        .detail-hero-code {
            font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 4px; position: relative; z-index: 1; font-family: monospace;
        }
        .detail-hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 16px; border-radius: 20px; font-size: 12px; font-weight: 600;
            margin-top: 12px; position: relative; z-index: 1;
        }
        .detail-hero-badge.aktif { background: rgba(74,222,128,0.3); color: #4ade80; }
        .detail-hero-badge.tidak-aktif { background: rgba(248,113,113,0.3); color: #f87171; }
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
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: mpSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes mpSlideIn {
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
            padding: 0 14px; min-width: 240px; transition: all 0.2s;
        }
        .search-box:focus-within { border-color: var(--mp-primary); box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
        .search-box i { color: var(--text-muted); font-size: 14px; margin-right: 10px; }
        .search-box input {
            border: none; background: none; padding: 10px 0; font-size: 13px;
            color: var(--text-main); outline: none; width: 100%; font-family: 'Inter', sans-serif;
        }
        .search-box input::placeholder { color: #aaa; }

        .mp-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
        .mp-form-grid .full { grid-column: 1 / -1; }
        .mp-form-label { font-size: 12px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px; }
        .mp-form-label .req { color: #dc3545; }
        .mp-form-input {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif; transition: border-color 0.2s;
        }
        .mp-form-input:focus { border-color: var(--mp-primary); box-shadow: 0 0 0 3px rgba(249,115,22,0.08); }
        .mp-form-input::placeholder { color: #aaa; }
        .mp-form-textarea {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1px solid var(--border-color); border-radius: 8px; font-size: 13px;
            color: #444; background: #fff; outline: none; font-family: 'Inter', sans-serif;
            resize: vertical; min-height: 60px; transition: border-color 0.2s;
        }
        .mp-form-textarea:focus { border-color: var(--mp-primary); box-shadow: 0 0 0 3px rgba(249,115,22,0.08); }

        .btn {
            display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px;
            border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.fill { background: var(--mp-gradient); color: #fff; box-shadow: 0 4px 12px rgba(249,115,22,0.3); }
        .btn.fill:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(249,115,22,0.4); }
        .btn.ghost { background: #fff7ed; color: var(--mp-primary); }
        .btn.ghost:hover { background: #ffedd5; }
        .btn.danger { background: #fee2e2; color: #dc2626; }
        .btn.danger:hover { background: #fecaca; }
        .btn.danger-solid { background: #dc2626; color: #fff; }
        .btn.danger-solid:hover { background: #b91c1c; }

        .mp-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px; max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: mpToastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .mp-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .mp-toast.error { background: #fef2f2; border-color: #ef4444; }
        .mp-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .mp-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .mp-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .mp-toast .toast-body { flex: 1; min-width: 0; }
        .mp-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .mp-toast .toast-msg { font-size: 12px; color: #555; line-height: 1.4; }
        .mp-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; display: flex; align-items: center;
            justify-content: center; font-size: 20px; color: #999; flex-shrink: 0; transition: all 0.15s;
        }
        .mp-toast .toast-close:hover { background: rgba(0,0,0,0.05); color: #333; }

        @keyframes mpToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes mpToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }
    @media (max-width: 767px) { .mp-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; } }
    @media (max-width: 576px) { .mp-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; } }
    </style>

    {{-- Stats --}}
    <div class="mp-stats">
        <div class="mp-stat">
            <div class="mp-stat-icon orange"><i class="fa-solid fa-book-open"></i></div>
            <div>
                <div class="mp-stat-label">Total Mapel</div>
                <div class="mp-stat-value">{{ $totalMapel }}</div>
            </div>
        </div>
        <div class="mp-stat">
            <div class="mp-stat-icon green"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="mp-stat-label">Aktif</div>
                <div class="mp-stat-value">{{ $aktif }}</div>
            </div>
        </div>
        <div class="mp-stat">
            <div class="mp-stat-icon amber"><i class="fa-solid fa-pause-circle"></i></div>
            <div>
                <div class="mp-stat-label">Tidak Aktif</div>
                <div class="mp-stat-value">{{ $nonaktif }}</div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="mp-filter">
        <div class="mp-filter-top">
            <div class="mp-filter-left">
                <span class="mp-filter-label"><i class="fa-solid fa-filter" style="margin-right:4px;"></i>Filter</span>
                <select class="mp-filter-select" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <div class="search-box" style="min-width:200px;">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama mapel / kode...">
                </div>
            </div>
            <div class="mp-filter-right">
                <button class="btn fill" onclick="openTambahModal()"><i class="fa-solid fa-plus"></i> Tambah Mapel</button>
                <a href="{{ route('admin.mata-pelajaran.export') }}" target="_blank" class="btn ghost" style="text-decoration:none;"><i class="fa-solid fa-print"></i> Print</a>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="mp-table-wrap">
        <div class="mp-table-header">
            <div class="mp-table-header-title">
                <i class="fa-solid fa-book"></i> Daftar Mata Pelajaran
                <span style="font-size:12px;font-weight:500;color:var(--text-muted);">({{ count($mapel) }} data)</span>
            </div>
        </div>
        <div class="mp-table-scroll">
            <table class="mp-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th style="width:100px;">Kode</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mpTableBody">
                    @foreach($mapel as $index => $m)
                    <tr class="mp-row-enter" data-id="{{ $m->id }}" data-status="{{ $m->status }}" data-name="{{ strtolower($m->nama_mapel) }}" data-kode="{{ strtolower($m->kode_mapel) }}">
                        <td>{{ $index + 1 }}</td>
                        <td><span style="font-family:monospace;font-weight:600;color:#333;">{{ $m->kode_mapel }}</span></td>
                        <td class="mp-nama-cell">
                            <div class="mp-mapel-info">
                                <div class="mp-icon-wrap" style="background: {{ \Illuminate\Support\Arr::random(['#f97316','#d97706','#ea580c','#db2777','#7c3aed','#2563eb','#16a34a','#0891b2']) }};">
                                    <i class="fa-solid {{ \Illuminate\Support\Arr::random(['fa-book','fa-book-open','fa-feather','fa-pen','fa-star','fa-mosque','fa-hands-praying','fa-moon']) }}"></i>
                                </div>
                                <div>
                                    <div class="mp-mapel-text">{{ $m->nama_mapel }}</div>
                                    <div class="mp-kode-text">{{ $m->kode_mapel }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="font-size:12px;color:#64748b;">{{ $m->kategori ?? '-' }}</span></td>
                        <td><span style="font-size:12px;color:#64748b;">{{ Str::limit($m->deskripsi ?? '-', 50) }}</span></td>
                        <td>
                            <span class="mp-badge {{ strtolower(str_replace(' ', '-', $m->status)) }}">
                                <span class="mp-dot"></span>
                                {{ $m->status }}
                            </span>
                        </td>
                        <td>
                            <div class="mp-action-btns">
                                <button class="mp-action-btn view" title="Detail" onclick="openDetail({{ $m->id }})"><i class="fa-solid fa-eye"></i></button>
                                <button class="mp-action-btn edit" title="Edit" onclick="openEdit({{ $m->id }})"><i class="fa-solid fa-pen"></i></button>
                                <button class="mp-action-btn delete" title="Hapus" onclick="openHapus({{ $m->id }})"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mp-pagination-wrap">
            <div class="mp-pagination-info">Menampilkan <strong>{{ count($mapel) }}</strong> dari <strong>{{ count($mapel) }}</strong> data</div>
            <div class="mp-pagination">
                <button class="mp-page-btn active">1</button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="modal-overlay" style="display:none;" @click.self="document.getElementById('detailModal').style.display='none'">
        <div class="modal-box" style="max-width:560px;">
            <div class="detail-hero">
                <button class="detail-hero-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
                <div class="detail-hero-icon" id="detailIcon"><i class="fa-solid fa-book"></i></div>
                <div class="detail-hero-name" id="detailNama">-</div>
                <div class="detail-hero-code" id="detailKode">-</div>
                <div class="detail-hero-badge" id="detailStatus">-</div>
            </div>
            <div class="detail-body">
                <div class="detail-section-title"><i class="fa-solid fa-info-circle" style="margin-right:6px;"></i> Informasi Mata Pelajaran</div>
                <div class="detail-info-grid">
                    <div>
                        <div class="detail-info-label">Kode Mapel</div>
                        <div class="detail-info-value" id="detailKode2">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Status</div>
                        <div class="detail-info-value" id="detailStatus2">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Kategori</div>
                        <div class="detail-info-value" id="detailKategori">-</div>
                    </div>
                    <div class="detail-info-full">
                        <div class="detail-info-label">Deskripsi</div>
                        <div class="detail-info-value" id="detailDeskripsi" style="line-height:1.7;background:#f8fafc;padding:12px 16px;border-radius:10px;border:1px solid #eef2f6;">-</div>
                    </div>
                    <div>
                        <div class="detail-info-label">Dibuat</div>
                        <div class="detail-info-value" id="detailCreated">-</div>
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
        <div class="modal-box" style="max-width:560px;">
            <div class="modal-header">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:#fff7ed;display:flex;align-items:center;justify-content:center;color:var(--mp-primary);">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;" id="formModalTitle">Tambah Mata Pelajaran</div>
                        <div style="font-size:12px;color:var(--text-muted);">Buat mata pelajaran baru</div>
                    </div>
                </div>
                <button class="modal-close" onclick="document.getElementById('formModal').style.display='none'">&times;</button>
            </div>
            <form id="mapelForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="mp-form-grid">
                        <div>
                            <label class="mp-form-label">Kode Mapel <span class="req">*</span></label>
                            <input type="text" id="formKode" class="mp-form-input" placeholder="MP-XXX" required>
                        </div>
                        <div>
                            <label class="mp-form-label">Status</label>
                            <select id="formStatus" class="mp-form-input">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="full">
                            <label class="mp-form-label">Nama Mata Pelajaran <span class="req">*</span></label>
                            <input type="text" id="formNama" class="mp-form-input" placeholder="Contoh: Tahsin Al-Qur'an" required>
                        </div>
                        <div class="full">
                            <label class="mp-form-label">Kategori</label>
                            <select id="formKategori" class="mp-form-input">
                                <option value="">Pilih kategori</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Muatan Lokal">Muatan Lokal</option>
                            </select>
                        </div>
                        <div class="full">
                            <label class="mp-form-label">Deskripsi</label>
                            <textarea id="formDeskripsi" class="mp-form-textarea" placeholder="Deskripsi mata pelajaran..."></textarea>
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
                        <div style="font-weight:700;font-size:16px;color:#1a1a2e;">Hapus Mata Pelajaran</div>
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
        const mapelData = @json($mapel);
        const mapelIcons = ['fa-book','fa-book-open','fa-feather','fa-pen','fa-star','fa-mosque','fa-hands-praying','fa-moon'];
        const mapelColors = ['#f97316','#d97706','#ea580c','#db2777','#7c3aed','#2563eb','#16a34a','#0891b2'];

        function openDetail(id) {
            const m = mapelData.find(d => d.id === id);
            if (!m) return;
            const iconIdx = (m.id - 1) % mapelIcons.length;
            const colorIdx = (m.id - 1) % mapelColors.length;
            document.getElementById('detailIcon').innerHTML = '<i class="fa-solid ' + mapelIcons[iconIdx] + '"></i>';
            document.getElementById('detailIcon').style.background = mapelColors[colorIdx];
            document.getElementById('detailNama').textContent = m.nama_mapel;
            document.getElementById('detailKode').textContent = 'Kode: ' + m.kode_mapel;
            document.getElementById('detailKode2').textContent = m.kode_mapel;

            const statusBadge = document.getElementById('detailStatus');
            statusBadge.className = 'detail-hero-badge ' + m.status.toLowerCase().replace(' ', '-');
            statusBadge.textContent = m.status;
            document.getElementById('detailStatus2').innerHTML = '<span class="mp-badge ' + m.status.toLowerCase().replace(' ', '-') + '"><span class="mp-dot"></span> ' + m.status + '</span>';

            document.getElementById('detailKategori').textContent = m.kategori || '-';
            document.getElementById('detailDeskripsi').textContent = m.deskripsi || '-';
            document.getElementById('detailCreated').textContent = m.created_at ? new Date(m.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';

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
            document.getElementById('formModalTitle').textContent = 'Tambah Mata Pelajaran';
            document.getElementById('formId').value = '';
            document.getElementById('mapelForm').reset();
            document.getElementById('formStatus').value = 'Aktif';
            document.getElementById('formKategori').value = '';
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').style.display = 'flex';
        }

        function openEdit(id) {
            fetch('{{ route("admin.mata-pelajaran.edit", 0) }}'.replace('/0', '/' + id))
                .then(r => r.json())
                .then(function(m) {
                    document.getElementById('formModalTitle').textContent = 'Edit Mata Pelajaran';
                    document.getElementById('formId').value = m.id;
                    document.getElementById('formKode').value = m.kode_mapel;
                    document.getElementById('formNama').value = m.nama_mapel;
                    document.getElementById('formKategori').value = m.kategori || '';
                    document.getElementById('formDeskripsi').value = m.deskripsi || '';
                    document.getElementById('formStatus').value = m.status;
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
                    document.getElementById('formModal').style.display = 'flex';
                });
        }

        function openHapus(id) {
            const m = mapelData.find(d => d.id === id);
            if (!m) return;
            document.getElementById('hapusId').value = m.id;
            document.getElementById('hapusNama').textContent = m.nama_mapel;
            document.getElementById('hapusModal').style.display = 'flex';
        }

        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('{{ route("admin.mata-pelajaran.destroy", 0) }}'.replace('/0', '/' + id), {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(r => r.json()).then(function(res) {
                if (res.success) location.reload();
            });
        }

        function renderRow(m, index) {
            const badgeCls = m.status.toLowerCase().replace(' ', '-');
            const iconIdx = (m.id - 1) % mapelIcons.length;
            const colorIdx = (m.id - 1) % mapelColors.length;
            const deskripsi = m.deskripsi ? (m.deskripsi.length > 50 ? m.deskripsi.substring(0, 50) + '...' : m.deskripsi) : '-';
            return '<tr data-id="' + m.id + '" data-status="' + m.status + '" data-name="' + m.nama_mapel.toLowerCase() + '" data-kode="' + m.kode_mapel.toLowerCase() + '">' +
                '<td>' + (index + 1) + '</td>' +
                '<td><span style="font-family:monospace;font-weight:600;color:#333;">' + m.kode_mapel + '</span></td>' +
                '<td class="mp-nama-cell"><div class="mp-mapel-info"><div class="mp-icon-wrap" style="background:' + mapelColors[colorIdx] + ';"><i class="fa-solid ' + mapelIcons[iconIdx] + '"></i></div><div><div class="mp-mapel-text">' + m.nama_mapel + '</div><div class="mp-kode-text">' + m.kode_mapel + '</div></div></div></td>' +
                '<td><span style="font-size:12px;color:#64748b;">' + (m.kategori || '-') + '</span></td>' +
                '<td><span style="font-size:12px;color:#64748b;">' + deskripsi + '</span></td>' +
                '<td><span class="mp-badge ' + badgeCls + '"><span class="mp-dot"></span> ' + m.status + '</span></td>' +
                '<td><div class="mp-action-btns">' +
                '<button class="mp-action-btn view" title="Detail" onclick="openDetail(' + m.id + ')"><i class="fa-solid fa-eye"></i></button>' +
                '<button class="mp-action-btn edit" title="Edit" onclick="openEdit(' + m.id + ')"><i class="fa-solid fa-pen"></i></button>' +
                '<button class="mp-action-btn delete" title="Hapus" onclick="openHapus(' + m.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                '</div></td></tr>';
        }

        function refreshTable() {
            const tbody = document.getElementById('mpTableBody');
            tbody.innerHTML = mapelData.map((m, i) => renderRow(m, i)).join('');
            filterTable();
        }

        document.getElementById('mapelForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const data = {
                kode_mapel: document.getElementById('formKode').value,
                nama_mapel: document.getElementById('formNama').value,
                kategori: document.getElementById('formKategori').value,
                deskripsi: document.getElementById('formDeskripsi').value,
                status: document.getElementById('formStatus').value,
            };
            const url = id ? '{{ route("admin.mata-pelajaran.update", 0) }}'.replace('/0', '/' + id) : '{{ route("admin.mata-pelajaran.store") }}';
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
            const existing = document.querySelector('.mp-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'mp-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + icons[type] + '"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { if (t.parentElement) { t.style.animation = 'mpToastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); } }, 4000);
        }

        document.getElementById('filterStatus').addEventListener('change', filterTable);
        document.getElementById('searchInput').addEventListener('input', filterTable);

        function filterTable() {
            const status = document.getElementById('filterStatus').value;
            const search = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#mpTableBody tr');
            rows.forEach(row => {
                const rStatus = row.dataset.status;
                const rName = row.dataset.name;
                const rKode = row.dataset.kode;
                const matchStatus = !status || rStatus === status;
                const matchSearch = !search || rName.includes(search) || rKode.includes(search);
                row.style.display = matchStatus && matchSearch ? '' : 'none';
            });
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
    </script>

</x-admin-layout>
