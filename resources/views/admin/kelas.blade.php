<x-admin-layout>
    <x-slot name="title">Data Kelas</x-slot>
    @section('header_title', 'Data Kelas')

    <style>
        :root {
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-5: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --gradient-6: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
            --gradient-7: linear-gradient(135deg, #fccb90 0%, #d57eeb 100%);
            --gradient-8: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
        }

        .kelas-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-top: 0;
            margin-bottom: 28px;
        }

        .kelas-stat {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            position: relative;
            overflow: hidden;
        }

        .kelas-stat::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .kelas-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .kelas-stat:hover .kelas-stat-icon-wrap {
            transform: scale(1.1) rotate(-5deg);
        }

        .kelas-stat-icon-wrap {
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

        .kelas-stat-icon-wrap.purple { background: linear-gradient(135deg, #f3e8ff, #e9d5ff); color: #7c3aed; }
        .kelas-stat-icon-wrap.blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb; }
        .kelas-stat-icon-wrap.pink { background: linear-gradient(135deg, #fce7f3, #fbcfe8); color: #db2777; }
        .kelas-stat-icon-wrap.green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669; }

        .kelas-stat-body { flex: 1; }
        .kelas-stat-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px; }
        .kelas-stat-value { font-size: 24px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; line-height: 1.2; }
        .kelas-stat-sub { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        .kelas-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 24px;
        }

        .kelas-search-wrap {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0 16px;
            min-width: 280px;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .kelas-search-wrap:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .kelas-search-wrap i { color: #94a3b8; font-size: 15px; margin-right: 12px; }

        .kelas-search-wrap input {
            border: none;
            background: none;
            padding: 12px 0;
            font-size: 13px;
            color: #1a1a2e;
            outline: none;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .kelas-search-wrap input::placeholder { color: #b0b8c4; }

        .kelas-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            background: var(--gradient-1);
            color: #fff;
            box-shadow: 0 4px 14px rgba(102, 126, 234, 0.35);
        }

        .kelas-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.45);
        }

        .kelas-add-btn:active {
            transform: translateY(0);
        }

        .kelas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .kelas-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            animation: cardFadeIn 0.5s ease forwards;
            opacity: 0;
        }

        .kelas-card:nth-child(1) { animation-delay: 0.02s; }
        .kelas-card:nth-child(2) { animation-delay: 0.06s; }
        .kelas-card:nth-child(3) { animation-delay: 0.10s; }
        .kelas-card:nth-child(4) { animation-delay: 0.14s; }
        .kelas-card:nth-child(5) { animation-delay: 0.18s; }
        .kelas-card:nth-child(6) { animation-delay: 0.22s; }
        .kelas-card:nth-child(7) { animation-delay: 0.26s; }
        .kelas-card:nth-child(8) { animation-delay: 0.30s; }
        .kelas-card:nth-child(9) { animation-delay: 0.34s; }
        .kelas-card:nth-child(10) { animation-delay: 0.38s; }

        @keyframes cardFadeIn {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .kelas-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .kelas-card-top {
            padding: 24px 24px 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .kelas-card-top::after {
            content: '';
            position: absolute;
            top: -60%;
            right: -30%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .kelas-card-top::before {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -20%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .kelas-card-name {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }

        .kelas-card-sub {
            font-size: 12px;
            opacity: 0.85;
            margin-top: 4px;
            position: relative;
            z-index: 1;
        }

        .kelas-card-body {
            padding: 18px 24px 20px;
        }

        .kelas-card-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }

        .kelas-card-info-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 10px 12px;
            text-align: center;
        }

        .kelas-card-info-item .label {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .kelas-card-info-item .value {
            font-size: 18px;
            font-weight: 800;
            color: #1a1a2e;
            margin-top: 2px;
        }

        .kelas-card-info-item .value.l { color: #2563eb; }
        .kelas-card-info-item .value.p { color: #db2777; }
        .kelas-card-info-item .value.total { color: #7c3aed; }

        .kelas-card-walas {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .kelas-card-walas i {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .kelas-card-walas .walas-label {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .kelas-card-walas .walas-name {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .kelas-card-bar {
            height: 4px;
            border-radius: 4px;
            background: #eef2f6;
            overflow: hidden;
            margin-bottom: 16px;
            display: flex;
        }

        .kelas-card-bar .bar-l {
            height: 100%;
            border-radius: 4px 0 0 4px;
            background: linear-gradient(90deg, #4facfe, #00f2fe);
            transition: width 0.8s ease;
        }

        .kelas-card-bar .bar-p {
            height: 100%;
            border-radius: 0 4px 4px 0;
            background: linear-gradient(90deg, #f093fb, #f5576c);
            transition: width 0.8s ease;
        }

        .kelas-card-actions {
            display: flex;
            gap: 6px;
        }

        .kelas-card-actions .act-btn {
            flex: 1;
            padding: 9px 0;
            border-radius: 10px;
            border: none;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .kelas-card-actions .act-btn.view {
            background: #eef2ff;
            color: #4f46e5;
        }

        .kelas-card-actions .act-btn.view:hover {
            background: #e0e7ff;
        }

        .kelas-card-actions .act-btn.edit {
            background: #fff7ed;
            color: #ea580c;
        }

        .kelas-card-actions .act-btn.edit:hover {
            background: #ffedd5;
        }

        .kelas-card-actions .act-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .kelas-card-actions .act-btn.delete:hover {
            background: #fee2e2;
        }

        .kelas-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 18px;
            border: 2px dashed var(--border-color);
        }

        .kelas-empty i {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .kelas-empty h3 {
            font-size: 18px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 6px;
        }

        .kelas-empty p {
            font-size: 13px;
            color: #94a3b8;
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
            max-width: 520px;
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
            color: #1a1a2e;
        }

        .form-control:focus {
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder { color: #94a3b8; }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
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
            background: var(--gradient-1);
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
            color: #1a1a2e;
        }

        .detail-santri-list {
            margin-top: 14px;
        }

        .detail-santri-list h4 {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 10px;
        }

        .detail-santri-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .detail-santri-item .initial {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .detail-santri-item .sname {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a2e;
            flex: 1;
        }

        .detail-santri-item .sreg {
            font-size: 11px;
            color: #94a3b8;
        }

        @media (max-width: 1200px) {
            .kelas-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 767px) {
            .kelas-stats-row { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .kelas-grid { grid-template-columns: 1fr; }
            .kelas-search-wrap { min-width: 100%; }
            .kelas-toolbar { flex-direction: column; align-items: stretch; }
            .kelas-add-btn { justify-content: center; }
            .detail-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .kelas-stats-row { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .kelas-stat { padding: 14px 16px; }
            .kelas-card-top { padding: 20px 18px 16px; }
            .kelas-card-body { padding: 14px 18px 16px; }
            .kelas-card-info { grid-template-columns: 1fr 1fr; gap: 8px; }
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

    <div class="kelas-stats-row">
        <div class="kelas-stat">
            <div class="kelas-stat-icon-wrap purple"><i class="fa-solid fa-people-group"></i></div>
            <div class="kelas-stat-body">
                <div class="kelas-stat-label">Total Kelas</div>
                <div class="kelas-stat-value">{{ $kelas->count() }}</div>
                <div class="kelas-stat-sub">Kelas aktif</div>
            </div>
        </div>
        <div class="kelas-stat">
            <div class="kelas-stat-icon-wrap blue"><i class="fa-solid fa-user-graduate"></i></div>
            <div class="kelas-stat-body">
                <div class="kelas-stat-label">Total Santri</div>
                <div class="kelas-stat-value">{{ $totalSantri }}</div>
                <div class="kelas-stat-sub">Tersebar di {{ $kelas->count() }} kelas</div>
            </div>
        </div>
        <div class="kelas-stat">
            <div class="kelas-stat-icon-wrap pink"><i class="fa-solid fa-person"></i></div>
            <div class="kelas-stat-body">
                <div class="kelas-stat-label">Laki-laki</div>
                <div class="kelas-stat-value">{{ $totalL }}</div>
                <div class="kelas-stat-sub">{{ $totalSantri > 0 ? round(($totalL / $totalSantri) * 100) : 0 }}% dari total</div>
            </div>
        </div>
        <div class="kelas-stat">
            <div class="kelas-stat-icon-wrap green"><i class="fa-solid fa-person-dress"></i></div>
            <div class="kelas-stat-body">
                <div class="kelas-stat-label">Perempuan</div>
                <div class="kelas-stat-value">{{ $totalP }}</div>
                <div class="kelas-stat-sub">{{ $totalSantri > 0 ? round(($totalP / $totalSantri) * 100) : 0 }}% dari total</div>
            </div>
        </div>
    </div>

    <div class="kelas-toolbar">
        <div class="kelas-search-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="kelasSearch" placeholder="Cari kelas..." oninput="filterKelas()">
        </div>
        <button class="kelas-add-btn" onclick="openCreateModal()">
            <i class="fa-solid fa-plus"></i> Tambah Kelas
        </button>
    </div>

    <div class="kelas-grid" id="kelasGrid">
        @forelse($kelas as $i => $k)
            @php
                $gradients = ['var(--gradient-1)', 'var(--gradient-2)', 'var(--gradient-3)', 'var(--gradient-4)', 'var(--gradient-5)', 'var(--gradient-6)', 'var(--gradient-7)', 'var(--gradient-8)'];
                $g = $gradients[$i % count($gradients)];
                $iconColors = ['#667eea', '#f5576c', '#4facfe', '#43e97b', '#fa709a', '#a18cd1', '#d57eeb', '#8ec5fc'];
                $ic = $iconColors[$i % count($iconColors)];
                $stat = $kelasStats[$k->id] ?? ['total' => 0, 'l' => 0, 'p' => 0];
                $total = $stat['total'];
                $lCount = $stat['l'];
                $pCount = $stat['p'];
                $lPct = $total > 0 ? round(($lCount / $total) * 100) : 0;
                $pPct = $total > 0 ? round(($pCount / $total) * 100) : 0;
                $walasGuru = $k->wali_kelas ? \App\Models\Guru::where('nama', $k->wali_kelas)->first() : null;
            @endphp
            <div class="kelas-card" data-name="{{ strtolower($k->nama_kelas) }} {{ strtolower($k->wali_kelas ?? '') }}" data-search="{{ strtolower($k->nama_kelas) }}">
                <div class="kelas-card-top" style="background: {{ $g }};">
                    <div class="kelas-card-name">{{ $k->nama_kelas }}</div>
                    <div class="kelas-card-sub">{{ $k->deskripsi ?? 'Kelas TPA Nurul Iman' }}</div>
                </div>
                <div class="kelas-card-body">
                    <div class="kelas-card-info">
                        <div class="kelas-card-info-item">
                            <div class="label">Total Santri</div>
                            <div class="value total">{{ $total }}</div>
                        </div>
                        <div class="kelas-card-info-item">
                            <div class="label">Rata-rata/kelas</div>
                            <div class="value" style="color:#64748b;">{{ $kelas->count() > 0 ? round($totalSantri / $kelas->count()) : 0 }}</div>
                        </div>
                        <div class="kelas-card-info-item">
                            <div class="label">Laki-laki</div>
                            <div class="value l">{{ $lCount }}</div>
                        </div>
                        <div class="kelas-card-info-item">
                            <div class="label">Perempuan</div>
                            <div class="value p">{{ $pCount }}</div>
                        </div>
                    </div>

                    @if($total > 0)
                        <div class="kelas-card-bar">
                            <div class="bar-l" style="width: {{ $lPct }}%;"></div>
                            <div class="bar-p" style="width: {{ $pPct }}%;"></div>
                        </div>
                    @endif

                    <div class="kelas-card-walas">
                        @if($walasGuru)
                            <i style="background:{{ $ic }};font-weight:700;font-size:13px;">{{ substr($walasGuru->nama, 0, 1) }}</i>
                        @else
                            <i style="background: {{ $ic }};"><i class="fa-solid fa-chalkboard-user" style="font-size:14px;"></i></i>
                        @endif
                        <div>
                            <div class="walas-label">Wali Kelas</div>
                            <div class="walas-name">{{ $k->wali_kelas ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="kelas-card-actions">
                        <button class="act-btn view" onclick="openDetailModal({{ $k->id }})">
                            <i class="fa-regular fa-eye"></i> Detail
                        </button>
                        <button class="act-btn edit" onclick="openEditModal({{ $k->id }})">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </button>
                        <button class="act-btn delete" onclick="confirmDelete({{ $k->id }})">
                            <i class="fa-regular fa-trash-can"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="kelas-empty">
                <i class="fa-solid fa-people-group"></i>
                <h3>Belum Ada Kelas</h3>
                <p>Klik tombol "Tambah Kelas" untuk menambahkan kelas baru.</p>
            </div>
        @endforelse
    </div>

    {{-- Modal Create --}}
    <div class="modal-overlay" id="createModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-plus-circle" style="color:#667eea;margin-right:8px;"></i>Tambah Kelas Baru</h3>
                <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            </div>
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: 1A, 2B, 3A" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <select name="wali_kelas" id="create_wali_kelas" class="form-control" style="flex:1;">
                                <option value="">-- Pilih Guru --</option>
                                @foreach(\App\Models\Guru::orderBy('nama')->get() as $g)
                                <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                                @endforeach
                            </select>
                            <span style="font-size:11px;color:#94a3b8;white-space:nowrap;">atau <a href="{{ route('admin.guru') }}" style="color:#667eea;text-decoration:none;font-weight:600;">tambah guru</a></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi singkat (opsional)">
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
                <h3><i class="fa-solid fa-pen-to-square" style="color:#ea580c;margin-right:8px;"></i>Edit Kelas</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="edit_nama_kelas" class="form-control" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <select name="wali_kelas" id="edit_wali_kelas" class="form-control">
                            <option value="">-- Pilih Guru --</option>
                            @foreach(\App\Models\Guru::orderBy('nama')->get() as $g)
                            <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" id="edit_deskripsi" class="form-control" placeholder="Deskripsi singkat (opsional)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn primary"><i class="fa-solid fa-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal-overlay" id="detailModal">
        <div class="modal-box" style="max-width:560px;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-info-circle" style="color:#4f46e5;margin-right:8px;"></i>Detail Kelas</h3>
                <button class="modal-close" onclick="closeDetailModal()">&times;</button>
            </div>
            <div class="modal-body" id="detailContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn ghost" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-body" style="text-align:center;padding:32px 24px 24px;">
                <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#fee2e2,#fecaca);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-trash-can" style="font-size:24px;color:#dc2626;"></i>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:#1a1a2e;margin:0 0 6px;">Hapus Kelas</h3>
                <p style="font-size:13px;color:#64748b;margin:0 0 24px;line-height:1.6;">Apakah Anda yakin ingin menghapus kelas ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
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
        var gradients = [
            'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
            'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
            'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
            'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
            'linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%)',
            'linear-gradient(135deg, #fccb90 0%, #d57eeb 100%)',
            'linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%)',
        ];

        var iconColors = ['#667eea', '#f5576c', '#4facfe', '#43e97b', '#fa709a', '#a18cd1', '#d57eeb', '#8ec5fc'];

        function filterKelas() {
            var q = document.getElementById('kelasSearch').value.toLowerCase();
            var cards = document.querySelectorAll('.kelas-card');
            cards.forEach(function(c) {
                var name = c.getAttribute('data-search') || '';
                c.style.display = name.indexOf(q) > -1 ? '' : 'none';
            });
        }

        function openCreateModal() { document.getElementById('createModal').classList.add('active'); }
        function closeCreateModal() { document.getElementById('createModal').classList.remove('active'); }

        function openEditModal(id) {
            fetch('/admin/kelas/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit_nama_kelas').value = data.nama_kelas;
                    var walasSelect = document.getElementById('edit_wali_kelas');
                    for (var i = 0; i < walasSelect.options.length; i++) {
                        if (walasSelect.options[i].value === data.wali_kelas) {
                            walasSelect.selectedIndex = i;
                            break;
                        }
                    }
                    document.getElementById('edit_deskripsi').value = data.deskripsi || '';
                    document.getElementById('editForm').action = '/admin/kelas/' + id;
                    document.getElementById('editModal').classList.add('active');
                });
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function openDetailModal(id) {
            fetch('/admin/kelas/' + id + '/detail')
                .then(r => r.json())
                .then(data => {
                    var kls = data.kelas;
                    var total = data.total;
                    var lCount = data.l;
                    var pCount = data.p;
                    var lPct = total > 0 ? Math.round((lCount / total) * 100) : 0;
                    var pPct = total > 0 ? Math.round((pCount / total) * 100) : 0;

                    var html = '<div style="text-align:center;padding:16px 0 20px;background:' + gradients[id % gradients.length] + ';border-radius:14px;margin:-24px -24px 20px;color:#fff;">';
                    html += '<div style="font-size:36px;font-weight:800;letter-spacing:-0.5px;">' + kls.nama_kelas + '</div>';
                    html += '<div style="font-size:13px;opacity:0.85;margin-top:4px;">' + (kls.deskripsi || 'Kelas TPA Nurul Iman') + '</div>';
                    html += '</div>';

                    var walasHtml = kls.wali_kelas ? kls.wali_kelas : '-';
                    if (data.guru) {
                        walasHtml = '<div style="display:flex;align-items:center;gap:8px;"><div style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;">' + data.guru.nama.charAt(0) + '</div><div><div style="font-weight:600;color:#1a1a2e;font-size:13px;">' + kls.wali_kelas + '</div><div style="font-size:10px;color:#94a3b8;">No. Reg: ' + data.guru.no_registrasi + '</div></div></div>';
                    }
                    html += '<div class="detail-grid">';
                    html += '<div class="detail-item"><div class="dlabel">Total Santri</div><div class="dvalue" style="color:#7c3aed;">' + total + ' santri</div></div>';
                    html += '<div class="detail-item"><div class="dlabel">Wali Kelas</div><div class="dvalue">' + walasHtml + '</div></div>';
                    html += '<div class="detail-item"><div class="dlabel">Laki-laki</div><div class="dvalue" style="color:#2563eb;">' + lCount + ' (' + lPct + '%)</div></div>';
                    html += '<div class="detail-item"><div class="dlabel">Perempuan</div><div class="dvalue" style="color:#db2777;">' + pCount + ' (' + pPct + '%)</div></div>';

                    if (total > 0) {
                        html += '<div class="detail-item full" style="padding:6px 14px 10px;"><div class="dlabel" style="margin-bottom:6px;">Komposisi</div><div style="height:6px;border-radius:6px;background:#eef2f6;overflow:hidden;display:flex;"><div style="height:100%;background:linear-gradient(90deg,#4facfe,#00f2fe);width:' + lPct + '%;border-radius:6px 0 0 6px;"></div><div style="height:100%;background:linear-gradient(90deg,#f093fb,#f5576c);width:' + pPct + '%;border-radius:0 6px 6px 0;"></div></div></div>';
                    }

                    html += '<div class="detail-item full"><div class="dlabel">Dibuat</div><div class="dvalue" style="font-weight:400;font-size:13px;color:#64748b;">' + new Date(kls.created_at).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) + '</div></div>';
                    html += '</div>';

                    if (data.santri && data.santri.length > 0) {
                        html += '<div class="detail-santri-list">';
                        html += '<h4><i class="fa-solid fa-user-graduate" style="color:#667eea;margin-right:6px;"></i>Daftar Santri (' + total + ')</h4>';
                        data.santri.forEach(function(s, idx) {
                            var colors = ['#667eea','#f5576c','#4facfe','#43e97b','#fa709a','#a18cd1','#d57eeb','#8ec5fc'];
                            html += '<div class="detail-santri-item">';
                            html += '<div class="initial" style="background:' + colors[idx % colors.length] + ';">' + s.nama.charAt(0) + '</div>';
                            html += '<div class="sname">' + s.nama + '</div>';
                            html += '<div class="sreg">' + s.no_registrasi + '</div>';
                            html += '</div>';
                        });
                        html += '</div>';
                    }

                    document.getElementById('detailContent').innerHTML = html;
                    document.getElementById('detailModal').classList.add('active');
                });
        }
        function closeDetailModal() { document.getElementById('detailModal').classList.remove('active'); }

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
                document.getElementById('deleteForm').action = '/admin/kelas/' + deleteId;
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
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) closeDetailModal(); });
        document.getElementById('deleteModal').addEventListener('click', function(e) { if (e.target === this) closeDeleteModal(); });
    </script>

</x-admin-layout>
