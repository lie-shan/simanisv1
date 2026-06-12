<x-admin-layout>
    <x-slot name="title">Data Santri</x-slot>
    @section('header_title', 'Data Santri')

    <style>
        .search-box {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0 14px;
            min-width: 240px;
            transition: all 0.2s;
        }

        .search-box:focus-within { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(13,110,253,0.1); }
        .search-box i { color: var(--text-muted); font-size: 14px; margin-right: 10px; }

        .search-box input {
            border: none; background: none; padding: 10px 0;
            font-size: 13px; color: var(--text-main); outline: none;
            width: 100%; font-family: 'Inter', sans-serif;
        }

        .search-box input::placeholder { color: #aaa; }

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

        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-top: 0;
            margin-bottom: 24px;
        }

        .stat-box {
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

        .stat-box:hover { border-color: var(--primary-blue); box-shadow: 0 4px 12px rgba(13,110,253,0.08); }

        .stat-box-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }

        .stat-box-icon.purple { background: #f3e8ff; color: #9333ea; }
        .stat-box-icon.blue { background: #e0f2fe; color: #0284c7; }
        .stat-box-icon.pink { background: #fce7f3; color: #db2777; }
        .stat-box-icon.teal { background: #f0fdf4; color: #16a34a; }

        .stat-box-label { font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 2px; }
        .stat-box-value { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -0.3px; }


        .filter-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            padding: 14px 15px;
            margin-bottom: 20px;
        }

        .filter-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .filter-left {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-right: 4px;
        }

        .filter-select {
            padding: 8px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 13px;
            color: #444;
            background: #fafbfc;
            cursor: pointer;
            outline: none;
            min-width: 140px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .filter-select:hover { border-color: #c0c8d0; }
        .filter-select:focus { border-color: var(--primary-blue); background: #fff; box-shadow: 0 0 0 3px rgba(13,110,253,0.08); }

        .filter-right { display: flex; align-items: center; gap: 8px; }

        .filter-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 8px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .filter-btn.primary { background: var(--primary-blue); color: #fff; }
        .filter-btn.primary:hover { background: #0b5ed7; }
        .filter-btn.ghost { background: #f0f4ff; color: var(--primary-blue); }
        .filter-btn.ghost:hover { background: #e0e8ff; }

        .table-wrap {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .table-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .table-header-title i { color: var(--primary-blue); }


        .table-scroll { overflow-x: auto; }

        table.santri-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table.santri-table thead { background: #fff; }

        table.santri-table th {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 10px 12px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        table.santri-table td {
            padding: 10px 12px;
            border-bottom: 1px solid var(--border-color);
            color: #444;
            vertical-align: middle;
            text-align: center;
        }

        table.santri-table td:nth-child(2) {
            text-align: left;
        }

        table.santri-table tbody tr:hover { background: #f8faff; }
        table.santri-table tbody tr:last-child td { border-bottom: none; }

        .santri-nama {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .santri-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }

        .santri-name-text { font-weight: 600; color: #2c3e50; }
        .santri-nis-text { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-status.aktif { background: #e6f9ee; color: #1a8a4a; }
        .badge-status.tidak-aktif { background: #ffeae9; color: #dc3545; }

        .badge-status .dot { width: 6px; height: 6px; border-radius: 50%; }
        .badge-status.aktif .dot { background: #1a8a4a; }
        .badge-status.tidak-aktif .dot { background: #dc3545; }

        .action-btns { display: flex; align-items: center; gap: 4px; }

        .action-btn {
            width: 32px; height: 32px; border-radius: 6px;
            border: none; display: flex; align-items: center;
            justify-content: center; cursor: pointer; font-size: 14px;
            transition: all 0.15s;
        }

        .action-btn.view { background: #e8f0fe; color: var(--primary-blue); }
        .action-btn.view:hover { background: #d4e4fc; }
        .action-btn.edit { background: #fff3e0; color: #e67e22; }
        .action-btn.edit:hover { background: #ffe4b3; }
        .action-btn.delete { background: #ffeae9; color: #dc3545; }
        .action-btn.delete:hover { background: #fcc; }

        .kelas-tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            background: #f0f4ff;
            color: var(--primary-blue);
        }

        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 15px;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-info { font-size: 12px; color: var(--text-muted); }

        .pagination { display: flex; align-items: center; gap: 4px; }

        .page-btn {
            width: 34px; height: 34px; border-radius: 6px;
            border: 1px solid var(--border-color); background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 500; color: #555;
            cursor: pointer; transition: all 0.15s;
        }

        .page-btn:hover { border-color: var(--primary-blue); color: var(--primary-blue); }
        .page-btn.active { background: var(--primary-blue); color: #fff; border-color: var(--primary-blue); }
        .page-btn.arrow { font-size: 10px; }

        .toast-notif {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            border-radius: 12px;
            min-width: 320px;
            max-width: 440px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: toastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            border-left: 4px solid;
        }

        .toast-success { background: #f0fdf4; border-color: #22c55e; }
        .toast-error { background: #fef2f2; border-color: #ef4444; }

        .toast-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .toast-success .toast-icon { background: #dcfce7; color: #16a34a; }
        .toast-error .toast-icon { background: #fee2e2; color: #dc2626; }

        .toast-body { flex: 1; min-width: 0; }
        .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
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

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }

        .modal-box {
            background: #fff;
            border-radius: 14px;
            width: 90%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .modal-close {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: #f0f0f0;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            color: #666;
            transition: all 0.15s;
        }
        .modal-close:hover { background: #e0e0e0; }

        .modal-body { padding: 20px; }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }

        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        .form-control:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(13,110,253,0.08); }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            padding: 16px 20px;
            border-top: 1px solid var(--border-color);
        }

        @media (max-width: 991px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); gap: 14px; }
            .filter-top { flex-direction: column; align-items: stretch; }
            .filter-left { flex-wrap: wrap; }
            .filter-select { min-width: 120px; flex: 1; }
            .search-box { min-width: 0; }
        }

        @media (max-width: 575px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .search-box { width: 100%; }
            .filter-left { flex-direction: column; }
            .filter-select { width: 100%; }
            .filter-right { width: 100%; }
            .filter-btn { flex: 1; justify-content: center; }
            .table-header { flex-direction: column; gap: 6px; align-items: flex-start; }
            .pagination-wrap { flex-direction: column; align-items: center; }
            table.santri-table th, table.santri-table td { padding: 11px 12px; font-size: 12px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>

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
        <div class="toast-notif toast-error" id="notifAlert">
            <div class="toast-icon"><i class="fa-solid fa-exclamation-circle"></i></div>
            <div class="toast-body">
                <div class="toast-title">Gagal</div>
                <div class="toast-msg">{{ session('error') }}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-box-icon purple"><i class="fa-solid fa-user-graduate"></i></div>
            <div class="stat-box-body">
                <div class="stat-box-label">Total Santri</div>
                <div class="stat-box-value">{{ $santri->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon blue"><i class="fa-solid fa-person"></i></div>
            <div class="stat-box-body">
                <div class="stat-box-label">Laki-laki</div>
                <div class="stat-box-value">{{ $santri->where('jk', 'L')->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon pink"><i class="fa-solid fa-person-dress"></i></div>
            <div class="stat-box-body">
                <div class="stat-box-label">Perempuan</div>
                <div class="stat-box-value">{{ $santri->where('jk', 'P')->count() }}</div>
            </div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon teal"><i class="fa-solid fa-layer-group"></i></div>
            <div class="stat-box-body">
                <div class="stat-box-label">Total Kelas</div>
                <div class="stat-box-value">{{ $kelasList ? count($kelasList) : 0 }}</div>
            </div>
        </div>
    </div>

    <div class="filter-card">
        <div class="filter-top">
            <div class="filter-left">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="filterSearch" placeholder="Cari santri..." oninput="filterTable()">
                </div>
                <select class="filter-select" id="filterKelas" onchange="filterTable()">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $k)
                    <option>{{ $k }}</option>
                    @endforeach
                </select>
                <select class="filter-select" id="filterJk" onchange="filterTable()">
                    <option value="">Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
                <select class="filter-select" id="filterStatus" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    @foreach($statusList as $s)
                    <option>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-right">
                <button class="filter-btn ghost" onclick="resetFilter()"><i class="fa-solid fa-rotate"></i> Reset</button>
                <button class="btn fill" style="padding:8px 18px;" onclick="openCreateModal()"><i class="fa-solid fa-plus"></i> Tambah Santri</button>
            </div>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-header">
            <div class="table-header-title">
                <i class="fa-solid fa-user-graduate"></i>
                Daftar Santri
            </div>
            <div style="display:flex;gap:8px;">
                <button class="filter-btn ghost" onclick="openImportModal()"><i class="fa-solid fa-upload"></i> Import</button>
                <a href="{{ route('admin.santri.export') }}" class="filter-btn ghost"><i class="fa-solid fa-download"></i> Export</a>
            </div>
            </div>

        <div class="table-scroll">
            <table class="santri-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>JK</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($santri as $i => $s)
                    <tr>
                        <td style="color:var(--text-muted);font-weight:500;">{{ $i + 1 }}</td>
                        <td>
                            <div class="santri-nama">
                                <div class="santri-avatar" style="background: {{ ['#0d6efd','#6f42c1','#d63384','#dc3545','#fd7e14','#ffc107','#198754','#0dcaf0','#6610f2','#e83e8c','#20c997','#17a2b8'][$i % 12] }}">
                                    @if($s['foto'])
                                        <img src="{{ asset('storage/'.$s['foto']) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ substr($s['nama'], 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="santri-name-text">{{ $s['nama'] }}</div>
                                    <div class="santri-nis-text">No. Reg: {{ $s['no_registrasi'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="kelas-tag">{{ $s['kelas'] }}</span></td>
                        <td>{{ $s['jk'] }}</td>
                        <td>{{ $s['tmp_lahir'] }}</td>
                        <td>@php try { echo \Carbon\Carbon::parse($s['tgl_lahir'])->locale('id')->isoFormat('D MMM YYYY'); } catch (\Exception $e) { echo $s['tgl_lahir']; } @endphp</td>
                        <td>{{ $s['no_hp'] ?? '-' }}</td>
                        <td>
                            <span class="badge-status {{ strtolower(str_replace(' ', '-', $s['status'])) }}">
                                <span class="dot"></span> {{ $s['status'] }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn view" title="Detail" onclick="openDetailModal({{ $s['id'] }})"><i class="fa-regular fa-eye"></i></button>
                                <button class="action-btn edit" title="Edit" onclick="openEditModal({{ $s['id'] }})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" title="Hapus" onclick="confirmDelete({{ $s['id'] }})"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <div class="pagination-info">Menampilkan 1-{{ $santri->count() }} dari {{ $santri->count() }} santri</div>
            <div class="pagination">
                <button class="page-btn arrow"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn arrow"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal-overlay" id="createModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Santri Baru</h3>
                <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            </div>
            <form action="{{ route('admin.santri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="text-align:center;">
                        <label>Foto Profil</label>
                        <div style="margin:8px 0;">
                            <div class="foto-preview" id="createFotoPreview" style="width:80px;height:80px;border-radius:50%;background:#f0f0f0;border:2px dashed var(--border-color);margin:0 auto;display:flex;align-items:center;justify-content:center;overflow:hidden;cursor:pointer;" onclick="document.getElementById('createFotoInput').click()">
                                <i class="fa-solid fa-camera" style="color:#aaa;font-size:22px;"></i>
                            </div>
                            <input type="file" name="foto" id="createFotoInput" class="form-control" accept="image/*" style="display:none;" onchange="previewFoto(this, 'createFotoPreview')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No. Registrasi</label>
                            <input type="text" class="form-control" value="Auto-generate" disabled style="color:#999;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" class="form-control" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control" required>
                                @foreach($kelasList as $k)
                                <option>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tmp_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="ortu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="ibu" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                @foreach($statusList as $st)
                                <option>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kampung</label>
                            <input type="text" name="kampung" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Desa</label>
                            <input type="text" name="desa" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="filter-btn ghost" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn fill">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Edit Santri</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group" style="text-align:center;">
                        <label>Foto Profil</label>
                        <div style="margin:8px 0;">
                            <div class="foto-preview" id="editFotoPreview" style="width:80px;height:80px;border-radius:50%;background:#f0f0f0;border:2px dashed var(--border-color);margin:0 auto;display:flex;align-items:center;justify-content:center;overflow:hidden;cursor:pointer;" onclick="document.getElementById('editFotoInput').click()">
                                <i class="fa-solid fa-camera" style="color:#aaa;font-size:22px;"></i>
                            </div>
                            <input type="file" name="foto" id="editFotoInput" class="form-control" accept="image/*" style="display:none;" onchange="previewFoto(this, 'editFotoPreview')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No. Registrasi</label>
                            <input type="text" id="edit_nis" class="form-control" disabled style="color:#999;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" id="edit_jk" class="form-control" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" id="edit_kelas" class="form-control" required>
                                @foreach($kelasList as $k)
                                <option>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tmp_lahir" id="edit_tmp_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="edit_tgl_lahir" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="ortu" id="edit_ortu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="ibu" id="edit_ibu" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" id="edit_no_hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                @foreach($statusList as $st)
                                <option>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kampung</label>
                            <input type="text" name="kampung" id="edit_kampung" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Desa</label>
                            <input type="text" name="desa" id="edit_desa" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" id="edit_kecamatan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" id="edit_kabupaten" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="filter-btn ghost" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn fill">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal-overlay" id="importModal">
        <div class="modal-box" style="max-width:440px;">
            <div class="modal-header">
                <h3>Import Data Santri</h3>
                <button class="modal-close" onclick="closeImportModal()">&times;</button>
            </div>
            <form action="{{ route('admin.santri.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="text-align:center;padding:24px;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#e8f0fe;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fa-solid fa-file-excel" style="font-size:24px;color:#0d6efd;"></i>
                    </div>
                    <p style="font-size:13px;color:#666;margin-bottom:16px;">Upload file Excel (.xlsx, .xls, .csv) dengan format yang sesuai dengan template export.</p>
                    <div style="border:2px dashed var(--border-color);border-radius:10px;padding:20px;background:#fafbfc;margin-bottom:14px;cursor:pointer;" onclick="document.getElementById('importFile').click()">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size:32px;color:#0d6efd;display:block;margin-bottom:8px;"></i>
                        <span id="importFileName" style="font-size:13px;color:#888;">Klik untuk pilih file</span>
                        <input type="file" name="file" id="importFile" accept=".xlsx,.xls,.csv" style="display:none;" onchange="document.getElementById('importFileName').textContent = this.files[0].name">
                    </div>
                    <a href="{{ route('admin.santri.template') }}" class="filter-btn ghost" style="font-size:12px;padding:6px 14px;"><i class="fa-solid fa-download"></i> Download Template</a>
                </div>
                <div class="modal-footer" style="justify-content:center;">
                    <button type="button" class="filter-btn ghost" onclick="closeImportModal()">Batal</button>
                    <button type="submit" class="btn fill">Import</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal-overlay" id="detailModal">
        <div class="modal-box" style="max-width:480px;">
            <div class="modal-header">
                <h3>Detail Santri</h3>
                <button class="modal-close" onclick="closeDetailModal()">&times;</button>
            </div>
            <div class="modal-body" id="detailContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="filter-btn ghost" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Delete Confirmation --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-body" style="text-align:center;padding:30px 24px 20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fee2e2;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="fa-solid fa-trash-can" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <h3 style="font-size:17px;font-weight:700;color:#1a1a2e;margin:0 0 6px;">Hapus Santri</h3>
                <p style="font-size:13px;color:#666;margin:0 0 20px;line-height:1.5;">Apakah Anda yakin ingin menghapus santri ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:10px;justify-content:center;">
                    <button type="button" class="filter-btn ghost" onclick="closeDeleteModal()" style="padding:10px 24px;">Batal</button>
                    <button type="button" class="btn fill" id="confirmDeleteBtn" style="padding:10px 24px;background:#dc2626;" onclick="submitDelete()"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Delete --}}
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.add('active');
        }
        function closeCreateModal() {
            document.getElementById('createModal').classList.remove('active');
        }

        function openEditModal(id) {
            fetch('/admin/santri/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit_nama').value = data.nama;
                    document.getElementById('edit_nis').value = data.no_registrasi;
                    var preview = document.getElementById('editFotoPreview');
                    if (data.foto) {
                        preview.innerHTML = '<img src="{{ asset('storage') }}/' + data.foto + '" style="width:100%;height:100%;object-fit:cover;">';
                        preview.style.border = '2px solid var(--primary-blue)';
                    } else {
                        preview.innerHTML = '<i class="fa-solid fa-camera" style="color:#aaa;font-size:22px;"></i>';
                        preview.style.border = '2px dashed var(--border-color)';
                    }
                    document.getElementById('edit_kelas').value = data.kelas;
                    document.getElementById('edit_jk').value = data.jk;
                    document.getElementById('edit_tmp_lahir').value = data.tmp_lahir;
                    document.getElementById('edit_tgl_lahir').value = data.tgl_lahir;
                    document.getElementById('edit_ortu').value = data.ortu;
                    document.getElementById('edit_ibu').value = data.ibu;
                    document.getElementById('edit_no_hp').value = data.no_hp || '';
                    document.getElementById('edit_kampung').value = data.kampung || '';
                    document.getElementById('edit_desa').value = data.desa || '';
                    document.getElementById('edit_kecamatan').value = data.kecamatan || '';
                    document.getElementById('edit_kabupaten').value = data.kabupaten || '';
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('editForm').action = '/admin/santri/' + id;
                    document.getElementById('editModal').classList.add('active');
                });
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        function openImportModal() {
            document.getElementById('importModal').classList.add('active');
        }
        function closeImportModal() {
            document.getElementById('importModal').classList.remove('active');
        }

        function openDetailModal(id) {
            fetch('/admin/santri/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    var fotoHtml = '';
                    if (data.foto) {
                        fotoHtml = '<img src="{{ asset('storage') }}/' + data.foto + '" style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:0 4px 15px rgba(13,110,253,0.2);display:block;margin:0 auto;">';
                    } else {
                        fotoHtml = '<div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#0d6efd,#6f42c1);color:#fff;display:flex;align-items:center;justify-content:center;font-size:32px;font-weight:700;margin:0 auto;box-shadow:0 4px 15px rgba(13,110,253,0.2);">' + data.nama.charAt(0) + '</div>';
                    }
                    var html = '<div style="text-align:center;padding:20px 0 10px;background:linear-gradient(135deg,#e8f0fe,#f0e8ff);border-radius:12px 12px 0 0;margin:-20px -20px 16px;">' + fotoHtml + '</div>';
                    html += '<div style="font-size:13px;">';

                    function dl(l, v) { return '<div style="flex:1;min-width:0;background:#f8f9fa;padding:10px 12px;border-radius:8px;"><div style="font-size:10px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:0.3px;margin-bottom:4px;">'+l+'</div><div style="color:#222;font-weight:600;">'+v+'</div></div>'; }

                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Nama Lengkap', data.nama)+dl('No. Registrasi', data.no_registrasi)+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Jenis Kelamin', data.jk == 'L' ? 'Laki-laki' : 'Perempuan')+dl('Kelas', data.kelas)+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Tempat Lahir', data.tmp_lahir)+dl('Tanggal Lahir', data.tgl_lahir ? new Date(data.tgl_lahir).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-')+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Nama Ayah', data.ortu)+dl('Nama Ibu', data.ibu)+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Nomor HP', data.no_hp || '-')+dl('Status', '<span style="display:inline-flex;align-items:center;gap:4px;padding:2px 10px;border-radius:12px;font-size:11px;font-weight:600;'+(data.status=='Aktif'?'background:#e6f9ee;color:#1a8a4a':'background:#ffeae9;color:#dc3545')+'">'+data.status+'</span>')+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Kampung', data.kampung || '-')+dl('Desa', data.desa || '-')+'</div>';
                    html += '<div style="display:flex;gap:10px;margin-bottom:10px;">'+dl('Kecamatan', data.kecamatan || '-')+dl('Kabupaten', data.kabupaten || '-')+'</div>';
                    html += '</div>';
                    document.getElementById('detailContent').innerHTML = html;
                    document.getElementById('detailModal').classList.add('active');
                });
        }
        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        var deleteId = null;
        function confirmDelete(id) {
            deleteId = id;
            document.getElementById('deleteModal').classList.add('active');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            deleteId = null;
        }
        function submitDelete() {
            if (deleteId) {
                var form = document.getElementById('deleteForm');
                form.action = '/admin/santri/' + deleteId;
                form.submit();
            }
        }

        function filterTable() {
            var search = document.getElementById('filterSearch').value.toLowerCase();
            var kelas = document.getElementById('filterKelas').value;
            var jk = document.getElementById('filterJk').value;
            var status = document.getElementById('filterStatus').value;
            var rows = document.querySelectorAll('.santri-table tbody tr');
            var visible = 0;
            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                var match = true;
                if (search && text.indexOf(search) === -1) match = false;
                if (kelas && row.querySelector('td:nth-child(3)').textContent.trim() !== kelas) match = false;
                if (jk) {
                    var jkVal = row.querySelector('td:nth-child(4)').textContent.trim();
                    if ((jk === 'Laki-laki' && jkVal !== 'L') || (jk === 'Perempuan' && jkVal !== 'P')) match = false;
                }
                    if (status) {
                        var statusVal = row.querySelector('td:nth-child(8) .badge-status').textContent.trim();
                if (statusVal !== status) match = false;
                }
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
        }

        function resetFilter() {
            document.getElementById('filterSearch').value = '';
            document.getElementById('filterKelas').value = '';
            document.getElementById('filterJk').value = '';
            document.getElementById('filterStatus').value = '';
            filterTable();
        }

        function previewFoto(input, previewId) {
            var preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">';
                    preview.style.border = '2px solid var(--primary-blue)';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        var notif = document.getElementById('notifAlert');
        if (notif) {
            setTimeout(function() {
                notif.style.animation = 'toastOut 0.35s cubic-bezier(0.22, 1, 0.36, 1) forwards';
                setTimeout(function() { if (notif.parentNode) notif.remove(); }, 350);
            }, 4500);
        }

        document.getElementById('createModal').addEventListener('click', function(e) {
            if (e.target === this) closeCreateModal();
        });
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
        document.getElementById('importModal').addEventListener('click', function(e) {
            if (e.target === this) closeImportModal();
        });
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>

</x-admin-layout>