<x-admin-layout>
    <x-slot name="title">Pembayaran</x-slot>
    @section('header_title', 'Pembayaran')

    <style>
        .bayar-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin: 0 0 28px;
        }

        .bayar-stat {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            overflow: hidden;
            position: relative;
        }

        .bayar-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .bayar-stat:hover .bayar-stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .bayar-stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .bayar-stat-icon.green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669; }
        .bayar-stat-icon.red { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626; }
        .bayar-stat-icon.blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb; }

        .bayar-stat-body { flex: 1; }
        .bayar-stat-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px; }
        .bayar-stat-value { font-size: 24px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; line-height: 1.2; }
        .bayar-stat-sub { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        .bayar-filter {
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            padding: 16px 18px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .bayar-filter-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .bayar-filter-select {
            padding: 9px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            color: #475569;
            background: #f8fafc;
            cursor: pointer;
            outline: none;
            min-width: 130px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .bayar-filter-select:hover { border-color: #c0c8d0; }
        .bayar-filter-select:focus { border-color: #667eea; background: #fff; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }

        .bayar-filter-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bayar-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .bayar-btn.primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
        }

        .bayar-btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .bayar-btn.ghost {
            background: #f1f5f9;
            color: #475569;
        }

        .bayar-btn.ghost:hover {
            background: #e2e8f0;
        }

        .bayar-table-wrap {
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .bayar-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 10px;
        }

        .bayar-table-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .bayar-table-title i { color: #667eea; }

        .bayar-table-scroll { overflow-x: auto; }

        table.bayar-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table.bayar-table thead { background: #f8fafc; }

        table.bayar-table th {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 11px 14px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        table.bayar-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            vertical-align: middle;
            text-align: center;
        }

        table.bayar-table tbody tr:hover { background: #f8faff; }
        table.bayar-table tbody tr:last-child td { border-bottom: none; }

        .bayar-santri {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bayar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .bayar-santri-name { font-weight: 600; color: #1a1a2e; }
        .bayar-santri-reg { font-size: 11px; color: #94a3b8; margin-top: 1px; }

        .bayar-jenis {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .bayar-tipe {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .bayar-tipe.masuk { background: #d1fae5; color: #059669; }
        .bayar-tipe.keluar { background: #fee2e2; color: #dc2626; }

        .bayar-jumlah.masuk { color: #059669; }
        .bayar-jumlah.keluar { color: #dc2626; }

        .bayar-jenis.pendaftaran { background: #d1fae5; color: #059669; }
        .bayar-jenis.paskil { background: #dbeafe; color: #2563eb; }
        .bayar-jenis.infaq { background: #fef3c7; color: #d97706; }
        .bayar-jenis.lainnya { background: #f1f5f9; color: #64748b; }

        .bayar-jumlah {
            font-weight: 700;
            color: #059669;
        }

        .bayar-status.lunas .dot { background: #059669; }
        .bayar-status.hutang { background: #fef3c7; color: #d97706; }
        .bayar-status.hutang .dot { background: #d97706; }
        .bayar-status.angsuran { background: #dbeafe; color: #2563eb; }
        .bayar-status.angsuran .dot { background: #2563eb; }

        .bayar-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .bayar-status.lunas { background: #d1fae5; color: #059669; }
        .bayar-status .dot { width: 5px; height: 5px; border-radius: 50%; }
        .bayar-status.lunas .dot { background: #059669; }
        .bayar-status.belum-lunas { background: #fef3c7; color: #d97706; }
        .bayar-status.belum-lunas .dot { background: #d97706; }

        .action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }

        .action-btn {
            width: 32px; height: 32px; border-radius: 8px;
            border: none; display: flex; align-items: center;
            justify-content: center; cursor: pointer; font-size: 14px;
            transition: all 0.15s;
        }

        .action-btn.view { background: #eef2ff; color: #4f46e5; }
        .action-btn.view:hover { background: #e0e7ff; }
        .action-btn.edit { background: #fff7ed; color: #ea580c; }
        .action-btn.edit:hover { background: #ffedd5; }
        .action-btn.delete { background: #fef2f2; color: #dc2626; }
        .action-btn.delete:hover { background: #fee2e2; }

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
            animation: toastIn 0.5s cubic-bezier(0.22, 1, 0.36, 1);
            border-left: 4px solid;
            backdrop-filter: blur(12px);
        }

        .toast-success { background: rgba(240, 253, 244, 0.95); border-color: #22c55e; }
        .toast-error { background: rgba(254, 242, 242, 0.95); border-color: #ef4444; }

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
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.active { display: flex; animation: modalFadeIn 0.2s ease; }

        @keyframes modalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-box {
            background: #fff;
            border-radius: 18px;
            width: 90%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            animation: modalSlideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
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

        .modal-close:hover { background: #e2e8f0; color: #1a1a2e; }

        .modal-body { padding: 24px; }

        .form-group { margin-bottom: 16px; }

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
            color: #1a1a2e;
        }

        .form-control:focus {
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 18px 24px;
            border-top: 1px solid var(--border-color);
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

        .btn.primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            box-shadow: 0 4px 14px rgba(102, 126, 234, 0.3);
        }

        .btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn.ghost {
            background: #f1f5f9;
            color: #475569;
        }

        .btn.ghost:hover {
            background: #e2e8f0;
        }

        .btn.danger {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #fff;
            box-shadow: 0 4px 14px rgba(244, 63, 94, 0.3);
        }

        .btn.danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(244, 63, 94, 0.4);
        }

        @media (max-width: 991px) {
            .bayar-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; }
            .bayar-filter { flex-direction: column; align-items: stretch; }
            .bayar-filter-left { flex-wrap: wrap; }
            .bayar-filter-select { min-width: 100px; flex: 1; }
            .form-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 575px) {
            .bayar-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .bayar-table-header { flex-direction: column; align-items: flex-start; }
            table.bayar-table th, table.bayar-table td { padding: 10px 10px; font-size: 12px; }
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

    <div class="bayar-stats">
        <div class="bayar-stat">
            <div class="bayar-stat-icon green"><i class="fa-solid fa-arrow-down"></i></div>
            <div class="bayar-stat-body">
                <div class="bayar-stat-label">Total Pemasukan</div>
                <div class="bayar-stat-value" id="statPemasukan">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                <div class="bayar-stat-sub" id="statPemasukanCount">{{ $pembayaran->where('tipe', 'masuk')->count() }} transaksi</div>
            </div>
        </div>
        <div class="bayar-stat">
            <div class="bayar-stat-icon red"><i class="fa-solid fa-arrow-up"></i></div>
            <div class="bayar-stat-body">
                <div class="bayar-stat-label">Total Pengeluaran</div>
                <div class="bayar-stat-value" id="statPengeluaran">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="bayar-stat-sub" id="statPengeluaranCount">{{ $pembayaran->where('tipe', 'keluar')->count() }} transaksi</div>
            </div>
        </div>
        <div class="bayar-stat">
            <div class="bayar-stat-icon blue"><i class="fa-solid fa-wallet"></i></div>
            <div class="bayar-stat-body">
                <div class="bayar-stat-label">Sisa Saldo</div>
                <div class="bayar-stat-value" id="statSisa">Rp {{ number_format($sisa, 0, ',', '.') }}</div>
                <div class="bayar-stat-sub">Pemasukan - Pengeluaran</div>
            </div>
        </div>
    </div>

    <div class="bayar-filter">
        <div class="bayar-filter-left">
            <select class="bayar-filter-select" id="filterTipe" onchange="filterTable()">
                <option value="">Semua Tipe</option>
                <option value="masuk">Pemasukan</option>
                <option value="keluar">Pengeluaran</option>
            </select>
            <select class="bayar-filter-select" id="filterJenis" onchange="filterTable()">
                <option value="">Semua Jenis</option>
                @foreach($jenisList as $j)
                <option value="{{ $j }}">{{ $j }}</option>
                @endforeach
                @foreach($jenisPengeluaran as $j)
                <option value="{{ $j }}">{{ $j }}</option>
                @endforeach
            </select>
            <select class="bayar-filter-select" id="filterSantri" onchange="filterTable()">
                <option value="">Semua Santri</option>
                @foreach($santriList as $s)
                <option value="{{ $s->nama }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="bayar-filter-right">
            <button class="bayar-btn ghost" onclick="resetFilter()"><i class="fa-solid fa-rotate"></i> Reset</button>
            <a href="{{ route('admin.pembayaran.export') }}" target="_blank" class="bayar-btn ghost" style="text-decoration:none;"><i class="fa-solid fa-print"></i> Print</a>
            <button class="bayar-btn primary" onclick="openCreateModal()"><i class="fa-solid fa-plus"></i> Catat Pembayaran</button>
        </div>
    </div>

    <div class="bayar-table-wrap">
        <div class="bayar-table-header">
            <div class="bayar-table-title">
                <i class="fa-solid fa-receipt"></i>
                Riwayat Pembayaran
            </div>
            <span style="font-size:12px;color:#94a3b8;">{{ $pembayaran->count() }} transaksi</span>
        </div>
        <div class="bayar-table-scroll">
            <table class="bayar-table">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th style="text-align:left;">Nama Santri</th>
                        <th>No. Transaksi</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Tgl Bayar</th>
                        <th>Metode</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $i => $p)
                    @php
                        $colors = ['#667eea','#f5576c','#4facfe','#43e97b','#fa709a','#a18cd1','#d57eeb','#8ec5fc'];
                        $c = $colors[$i % count($colors)];
                        $jenisSlug = strtolower(str_replace(' ', '-', $p->jenis_pembayaran ?? 'lainnya'));
                        $jenisColors = ['pendaftaran','paskil','infaq','lainnya'];
                        $jenisClass = in_array($jenisSlug, $jenisColors) ? $jenisSlug : 'lainnya';
                    @endphp
                    <tr>
                        <td style="color:#94a3b8;font-weight:500;">{{ $i + 1 }}</td>
                        <td style="text-align:left;">
                            <div class="bayar-santri">
                                @if($p->santri)
                                <div class="bayar-avatar" style="background:{{ $c }};">
                                    {{ substr($p->santri->nama, 0, 1) }}
                                </div>
                                <div>
                                    <div class="bayar-santri-name">{{ $p->santri->nama }}</div>
                                    <div class="bayar-santri-reg">{{ $p->santri->no_registrasi ?? '-' }}</div>
                                </div>
                                @else
                                <div class="bayar-avatar" style="background:#94a3b8;">
                                    <i class="fa-solid fa-receipt" style="font-size:12px;color:#fff;"></i>
                                </div>
                                <div>
                                    <div class="bayar-santri-name" style="color:#64748b;">{{ $p->jenis_pembayaran }}</div>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td style="font-weight:600;color:#1a1a2e;font-size:12px;font-family:monospace;">{{ $p->no_transaksi ?? '-' }}</td>
                        <td>
                            <span class="bayar-jenis {{ $jenisClass }}">{{ $p->jenis_pembayaran ?? 'Pendaftaran' }}</span>
                        </td>
                        <td class="bayar-jumlah {{ $p->tipe === 'keluar' ? 'keluar' : 'masuk' }}">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_bayar)->locale('id')->isoFormat('D MMM YYYY') }}</td>
                        <td>{{ $p->metode }}</td>
                        <td>
                            <span class="bayar-tipe {{ $p->tipe ?? 'masuk' }}">{{ $p->tipe === 'keluar' ? 'Keluar' : 'Masuk' }}</span>
                        </td>
                        <td>
                            <span class="bayar-status {{ strtolower($p->status) }}">
                                <span class="dot"></span> {{ $p->status }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" title="Edit" onclick="openEditModal({{ $p->id }})"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="action-btn delete" title="Hapus" onclick="confirmDelete({{ $p->id }})"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" style="padding:40px 20px;text-align:center;color:#94a3b8;">
                            <i class="fa-solid fa-receipt" style="font-size:36px;display:block;margin-bottom:12px;color:#cbd5e1;"></i>
                            Belum ada data pembayaran<br>
                            <span style="font-size:12px;">Klik "Catat Pembayaran" untuk mencatat pembayaran pertama</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal-overlay" id="createModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="createModalTitle"><i class="fa-solid fa-plus-circle" style="color:#667eea;margin-right:8px;"></i>Catat Pembayaran Baru</h3>
                <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            </div>
            <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" id="create_santri_group">
                        <label>Santri</label>
                        <select name="santri_id" class="form-control">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santriList as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->no_registrasi }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" id="create_tipe" class="form-control" required onchange="toggleCreateForm()">
                                <option value="masuk">Pemasukan</option>
                                <option value="keluar">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pembayaran</label>
                            <select name="jenis_pembayaran" id="create_jenis" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                @foreach($jenisList as $j)
                                <option value="{{ $j }}" class="jenis-masuk">{{ $j }}</option>
                                @endforeach
                                @foreach($jenisPengeluaran as $j)
                                <option value="{{ $j }}" class="jenis-keluar" style="display:none;">{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jumlah (Rp)</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="0" required min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="metode" class="form-control" required>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="create_status" class="form-control" required>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas" class="status-masuk">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Catatan tambahan..." maxlength="255">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn primary"><i class="fa-solid fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="editModalTitle"><i class="fa-solid fa-pen-to-square" style="color:#ea580c;margin-right:8px;"></i>Edit Pembayaran</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group" id="edit_santri_group">
                        <label>Santri</label>
                        <select name="santri_id" id="edit_santri_id" class="form-control">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santriList as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->no_registrasi }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" id="edit_tipe" class="form-control" required onchange="toggleEditForm()">
                                <option value="masuk">Pemasukan</option>
                                <option value="keluar">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pembayaran</label>
                            <select name="jenis_pembayaran" id="edit_jenis_pembayaran" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                @foreach($jenisList as $j)
                                <option value="{{ $j }}" class="jenis-masuk">{{ $j }}</option>
                                @endforeach
                                @foreach($jenisPengeluaran as $j)
                                <option value="{{ $j }}" class="jenis-keluar" style="display:none;">{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jumlah (Rp)</label>
                            <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" id="edit_tanggal_bayar" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="metode" id="edit_metode" class="form-control" required>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas" class="status-masuk">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan (opsional)</label>
                        <input type="text" name="keterangan" id="edit_keterangan" class="form-control" placeholder="Catatan tambahan..." maxlength="255">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn primary"><i class="fa-solid fa-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-body" style="text-align:center;padding:32px 24px 24px;">
                <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#fee2e2,#fecaca);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-trash-can" style="font-size:24px;color:#dc2626;"></i>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:#1a1a2e;margin:0 0 6px;">Hapus Pembayaran</h3>
                <p style="font-size:13px;color:#64748b;margin:0 0 24px;line-height:1.6;">Apakah Anda yakin ingin menghapus data pembayaran ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:12px;justify-content:center;">
                    <button type="button" class="btn ghost" onclick="closeDeleteModal()" style="padding:10px 28px;">Batal</button>
                    <button type="button" class="btn danger" id="confirmDeleteBtn" onclick="submitDelete()" style="padding:10px 28px;"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function formatRp(n) {
            return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function filterTable() {
            var tipe = document.getElementById('filterTipe').value;
            var jenis = document.getElementById('filterJenis').value;
            var santri = document.getElementById('filterSantri').value;
            var rows = document.querySelectorAll('.bayar-table tbody tr');
            if (rows.length === 1 && rows[0].querySelector('td[colspan]')) return;

            var totalMasuk = 0, totalKeluar = 0, countMasuk = 0, countKeluar = 0;

            rows.forEach(function(row) {
                var match = true;
                if (tipe && row.querySelector('td:nth-child(8) .bayar-tipe').textContent.trim().toLowerCase() !== tipe) match = false;
                if (jenis && row.querySelector('td:nth-child(4) .bayar-jenis').textContent.trim() !== jenis) match = false;
                if (santri && row.querySelector('td:nth-child(2) .bayar-santri-name').textContent.trim() !== santri) match = false;
                row.style.display = match ? '' : 'none';

                if (match) {
                    var jumlahText = row.querySelector('td:nth-child(5)').textContent.trim().replace(/[^\d]/g, '');
                    var jumlah = parseInt(jumlahText) || 0;
                    var tipeRow = row.querySelector('td:nth-child(8) .bayar-tipe').textContent.trim().toLowerCase();
                    if (tipeRow === 'masuk') {
                        totalMasuk += jumlah;
                        countMasuk++;
                    } else {
                        totalKeluar += jumlah;
                        countKeluar++;
                    }
                }
            });

            document.getElementById('statPemasukan').textContent = formatRp(totalMasuk);
            document.getElementById('statPemasukanCount').textContent = countMasuk + ' transaksi';
            document.getElementById('statPengeluaran').textContent = formatRp(totalKeluar);
            document.getElementById('statPengeluaranCount').textContent = countKeluar + ' transaksi';
            document.getElementById('statSisa').textContent = formatRp(totalMasuk - totalKeluar);
        }

        function resetFilter() {
            document.getElementById('filterTipe').value = '';
            document.getElementById('filterJenis').value = '';
            document.getElementById('filterSantri').value = '';
            filterTable();
        }

        function toggleCreateForm() {
            var tipe = document.getElementById('create_tipe').value;
            var title = document.getElementById('createModalTitle');
            var santriGroup = document.getElementById('create_santri_group');
            var santriSelect = santriGroup.querySelector('select');
            var jenisSelect = document.getElementById('create_jenis');

            if (tipe === 'keluar') {
                title.innerHTML = '<i class="fa-solid fa-plus-circle" style="color:#ef4444;margin-right:8px;"></i>Catat Pengeluaran Baru';
                santriGroup.style.display = 'none';
                santriSelect.required = false;
                santriSelect.value = '';
                document.querySelectorAll('.jenis-masuk').forEach(function(o) { o.style.display = 'none'; });
                document.querySelectorAll('.jenis-keluar').forEach(function(o) { o.style.display = ''; });
                document.querySelectorAll('.status-masuk').forEach(function(o) { o.style.display = 'none'; });
            } else {
                title.innerHTML = '<i class="fa-solid fa-plus-circle" style="color:#667eea;margin-right:8px;"></i>Catat Pemasukan Baru';
                santriGroup.style.display = '';
                santriSelect.required = true;
                document.querySelectorAll('.jenis-masuk').forEach(function(o) { o.style.display = ''; });
                document.querySelectorAll('.jenis-keluar').forEach(function(o) { o.style.display = 'none'; });
                document.querySelectorAll('.status-masuk').forEach(function(o) { o.style.display = ''; });
            }
            jenisSelect.value = '';
            document.getElementById('create_status').value = 'Lunas';
        }

        function openCreateModal() {
            document.getElementById('createModal').classList.add('active');
            toggleCreateForm();
        }
        function closeCreateModal() { document.getElementById('createModal').classList.remove('active'); }

        function toggleEditForm() {
            var tipe = document.getElementById('edit_tipe').value;
            var title = document.getElementById('editModalTitle');
            var santriGroup = document.getElementById('edit_santri_group');
            var santriSelect = santriGroup.querySelector('select');
            var jenisSelect = document.getElementById('edit_jenis_pembayaran');

            if (tipe === 'keluar') {
                title.innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:#ef4444;margin-right:8px;"></i>Edit Pengeluaran';
                santriGroup.style.display = 'none';
                santriSelect.required = false;
                santriSelect.value = '';
                document.querySelectorAll('#edit_jenis_pembayaran .jenis-masuk').forEach(function(o) { o.style.display = 'none'; });
                document.querySelectorAll('#edit_jenis_pembayaran .jenis-keluar').forEach(function(o) { o.style.display = ''; });
                document.querySelectorAll('#edit_status .status-masuk').forEach(function(o) { o.style.display = 'none'; });
            } else {
                title.innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:#ea580c;margin-right:8px;"></i>Edit Pemasukan';
                santriGroup.style.display = '';
                santriSelect.required = true;
                document.querySelectorAll('#edit_jenis_pembayaran .jenis-masuk').forEach(function(o) { o.style.display = ''; });
                document.querySelectorAll('#edit_jenis_pembayaran .jenis-keluar').forEach(function(o) { o.style.display = 'none'; });
                document.querySelectorAll('#edit_status .status-masuk').forEach(function(o) { o.style.display = ''; });
            }
            jenisSelect.value = '';
        }

        function openEditModal(id) {
            fetch('/admin/pembayaran/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit_santri_id').value = data.santri_id;
                    document.getElementById('edit_tipe').value = data.tipe || 'masuk';
                    document.getElementById('edit_jenis_pembayaran').value = data.jenis_pembayaran || 'Pendaftaran';
                    document.getElementById('edit_jumlah').value = data.jumlah;
                    document.getElementById('edit_tanggal_bayar').value = data.tanggal_bayar;
                    document.getElementById('edit_metode').value = data.metode;
                    document.getElementById('edit_keterangan').value = data.keterangan || '';
                    document.getElementById('edit_status').value = data.status || 'Lunas';
                    document.getElementById('editForm').action = '/admin/pembayaran/' + id;
                    toggleEditForm();
                    document.getElementById('edit_jenis_pembayaran').value = data.jenis_pembayaran || '';
                    document.getElementById('editModal').classList.add('active');
                });
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        var deleteId = null;
        function confirmDelete(id) { deleteId = id; document.getElementById('deleteModal').classList.add('active'); }
        function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }
        function submitDelete() {
            if (deleteId) {
                document.getElementById('deleteForm').action = '/admin/pembayaran/' + deleteId;
                document.getElementById('deleteForm').submit();
            }
        }

        var notif = document.getElementById('notifAlert');
        if (notif) {
            setTimeout(function() {
                notif.style.animation = 'toastOut 0.4s cubic-bezier(0.22, 1, 0.36, 1) forwards';
                setTimeout(function() { if (notif.parentNode) notif.remove(); }, 400);
            }, 4500);
        }

        document.getElementById('createModal').addEventListener('click', function(e) { if (e.target === this) closeCreateModal(); });
        document.getElementById('editModal').addEventListener('click', function(e) { if (e.target === this) closeEditModal(); });
        document.getElementById('deleteModal').addEventListener('click', function(e) { if (e.target === this) closeDeleteModal(); });
    </script>

</x-admin-layout>
