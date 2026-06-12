<x-admin-layout>
    <x-slot name="title">Pengumuman</x-slot>
    @section('header_title', 'Pengumuman')

    <style>
        :root {
            --peng-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --peng-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --peng-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --peng-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .peng-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 0;
            margin-bottom: 28px;
        }

        .peng-stat {
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

        .peng-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .peng-stat-icon {
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

        .peng-stat:hover .peng-stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .peng-stat-icon.purple { background: linear-gradient(135deg, #f3e8ff, #e9d5ff); color: #7c3aed; }
        .peng-stat-icon.green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669; }
        .peng-stat-icon.orange { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706; }

        .peng-stat-body { flex: 1; }
        .peng-stat-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 3px; }
        .peng-stat-value { font-size: 24px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; line-height: 1.2; }
        .peng-stat-sub { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        .peng-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 24px;
        }

        .peng-search-wrap {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0 16px;
            min-width: 300px;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .peng-search-wrap:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .peng-search-wrap i { color: #94a3b8; font-size: 15px; margin-right: 12px; }

        .peng-search-wrap input {
            border: none;
            background: none;
            padding: 12px 0;
            font-size: 13px;
            color: #1a1a2e;
            outline: none;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .peng-search-wrap input::placeholder { color: #b0b8c4; }

        .peng-add-btn {
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
            background: var(--peng-1);
            color: #fff;
            box-shadow: 0 4px 14px rgba(102, 126, 234, 0.35);
        }

        .peng-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.45);
        }

        .peng-add-btn:active {
            transform: translateY(0);
        }

        .peng-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .peng-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            animation: cardFadeIn 0.5s ease forwards;
            opacity: 0;
        }

        .peng-card:nth-child(1) { animation-delay: 0.02s; }
        .peng-card:nth-child(2) { animation-delay: 0.06s; }
        .peng-card:nth-child(3) { animation-delay: 0.10s; }
        .peng-card:nth-child(4) { animation-delay: 0.14s; }
        .peng-card:nth-child(5) { animation-delay: 0.18s; }
        .peng-card:nth-child(6) { animation-delay: 0.22s; }
        .peng-card:nth-child(7) { animation-delay: 0.26s; }
        .peng-card:nth-child(8) { animation-delay: 0.30s; }
        .peng-card:nth-child(9) { animation-delay: 0.34s; }
        .peng-card:nth-child(10) { animation-delay: 0.38s; }

        @keyframes cardFadeIn {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .peng-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .peng-card-top {
            padding: 24px 24px 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .peng-card-top::after {
            content: '';
            position: absolute;
            top: -60%;
            right: -30%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .peng-card-top::before {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -20%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .peng-card-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background: rgba(255,255,255,0.2);
            position: relative;
            z-index: 1;
            margin-bottom: 10px;
        }

        .peng-card-status .dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        .peng-card-title {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.3px;
            line-height: 1.4;
            position: relative;
            z-index: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .peng-card-sub {
            font-size: 12px;
            opacity: 0.85;
            margin-top: 6px;
            position: relative;
            z-index: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .peng-card-body {
            padding: 18px 24px 20px;
        }

        .peng-card-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .peng-card-info-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 10px 12px;
            text-align: center;
        }

        .peng-card-info-item .label {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .peng-card-info-item .value {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a2e;
            margin-top: 2px;
        }

        .peng-card-content {
            font-size: 13px;
            color: #475569;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 14px;
            padding: 12px 14px;
            background: #fafbfc;
            border-radius: 10px;
            border-left: 3px solid;
        }

        .peng-card-author {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .peng-card-author .author-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .peng-card-author .author-label {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .peng-card-author .author-name {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .peng-card-actions {
            display: flex;
            gap: 6px;
        }

        .peng-card-actions .act-btn {
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

        .peng-card-actions .act-btn.view {
            background: #eef2ff;
            color: #4f46e5;
        }

        .peng-card-actions .act-btn.view:hover {
            background: #e0e7ff;
        }

        .peng-card-actions .act-btn.edit {
            background: #fff7ed;
            color: #ea580c;
        }

        .peng-card-actions .act-btn.edit:hover {
            background: #ffedd5;
        }

        .peng-card-actions .act-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .peng-card-actions .act-btn.delete:hover {
            background: #fee2e2;
        }

        .peng-empty {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 16px;
            border: 2px dashed var(--border-color);
        }

        .peng-empty i {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .peng-empty h3 {
            font-size: 18px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 6px;
        }

        .peng-empty p {
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
            max-width: 600px;
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

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

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
            background: var(--peng-1);
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

        .detail-content {
            font-size: 14px;
            color: #334155;
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .detail-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 14px 18px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .detail-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #64748b;
        }

        .detail-meta-item i {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
        }

        @media (max-width: 1200px) {
            .peng-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 991px) {
            .peng-stats { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        }
        @media (max-width: 767px) {
            .peng-grid { grid-template-columns: 1fr; }
            .peng-toolbar { flex-direction: column; align-items: stretch; }
            .peng-search-wrap { min-width: 0; }
            .peng-add-btn { justify-content: center; }
        }
        @media (max-width: 575px) {
            .peng-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .peng-card-top { padding: 20px 18px 16px; }
            .peng-card-body { padding: 14px 18px 16px; }
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

    <div class="peng-stats">
        <div class="peng-stat">
            <div class="peng-stat-icon purple"><i class="fa-solid fa-bullhorn"></i></div>
            <div class="peng-stat-body">
                <div class="peng-stat-label">Total Pengumuman</div>
                <div class="peng-stat-value">{{ $pengumuman->count() }}</div>
                <div class="peng-stat-sub">Semua pengumuman</div>
            </div>
        </div>
        <div class="peng-stat">
            <div class="peng-stat-icon green"><i class="fa-solid fa-globe"></i></div>
            <div class="peng-stat-body">
                <div class="peng-stat-label">Dipublikasikan</div>
                <div class="peng-stat-value">{{ $totalPublished }}</div>
                <div class="peng-stat-sub">Sedang tayang</div>
            </div>
        </div>
        <div class="peng-stat">
            <div class="peng-stat-icon orange"><i class="fa-solid fa-pen-to-square"></i></div>
            <div class="peng-stat-body">
                <div class="peng-stat-label">Draft</div>
                <div class="peng-stat-value">{{ $totalDraft }}</div>
                <div class="peng-stat-sub">Belum dipublikasi</div>
            </div>
        </div>
    </div>

    <div class="peng-toolbar">
        <div class="peng-search-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="pengSearch" placeholder="Cari pengumuman..." oninput="filterPengumuman()">
        </div>
        <button class="peng-add-btn" onclick="openCreateModal()">
            <i class="fa-solid fa-plus"></i> Buat Pengumuman
        </button>
    </div>

    <div class="peng-grid" id="pengGrid">
        @forelse($pengumuman as $i => $p)
            @php
                $gradients = ['var(--peng-1)', 'var(--peng-2)', 'var(--peng-3)', 'var(--peng-4)'];
                $g = $gradients[$i % count($gradients)];
                $iconColors = ['#667eea', '#f5576c', '#4facfe', '#43e97b'];
                $ic = $iconColors[$i % count($iconColors)];
                $contentPreview = strip_tags($p->isi);
            @endphp
            <div class="peng-card" data-search="{{ strtolower($p->judul) }} {{ strtolower($p->penulis ?? '') }} {{ strtolower($p->status) }}">
                <div class="peng-card-top" style="background: {{ $g }};">
                    <div class="peng-card-status {{ strtolower($p->status) }}">
                        <span class="dot"></span> {{ $p->status }}
                    </div>
                    <div class="peng-card-title">{{ $p->judul }}</div>
                    <div class="peng-card-sub">{{ \Carbon\Carbon::parse($p->created_at)->locale('id')->isoFormat('D MMM YYYY') }}</div>
                </div>
                <div class="peng-card-body">
                    <div class="peng-card-info">
                        <div class="peng-card-info-item">
                            <div class="label">Status</div>
                            <div class="value" style="color:{{ $p->status == 'Publikasikan' ? '#059669' : '#d97706' }};">{{ $p->status }}</div>
                        </div>
                        <div class="peng-card-info-item">
                            <div class="label">Penulis</div>
                            <div class="value" style="color:#64748b;font-size:13px;">{{ $p->penulis ?? auth()->user()->name }}</div>
                        </div>
                    </div>
                    <div class="peng-card-content" style="border-left-color: {{ $ic }};">{{ $contentPreview }}</div>
                    <div class="peng-card-author">
                        <div class="author-avatar" style="background:{{ $ic }};">{{ substr($p->penulis ?? auth()->user()->name, 0, 1) }}</div>
                        <div>
                            <div class="author-label">Penulis</div>
                            <div class="author-name">{{ $p->penulis ?? auth()->user()->name }}</div>
                        </div>
                    </div>
                    <div class="peng-card-actions">
                        <button class="act-btn view" onclick="openDetailModal({{ $p->id }}, {{ $i }})"><i class="fa-regular fa-eye"></i> Detail</button>
                        <button class="act-btn edit" onclick="openEditModal({{ $p->id }})"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                        <button class="act-btn delete" onclick="confirmDelete({{ $p->id }})"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="peng-empty">
                <i class="fa-solid fa-bullhorn"></i>
                <h3>Belum Ada Pengumuman</h3>
                <p>Klik tombol "Buat Pengumuman" untuk membuat pengumuman pertama.</p>
            </div>
        @endforelse
    </div>

    {{-- Modal Create --}}
    <div class="modal-overlay" id="createModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-plus-circle" style="color:#667eea;margin-right:8px;"></i>Buat Pengumuman Baru</h3>
                <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            </div>
            <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul pengumuman" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" placeholder="Tulis isi pengumuman di sini..." required></textarea>
                    </div>
                    <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="penulis" class="form-control" value="{{ auth()->user()->name }}" disabled style="background:#eef2ff;color:#4f46e5;font-weight:600;border-color:#c7d2fe;">
                            <input type="hidden" name="penulis" value="{{ auth()->user()->name }}">
                            <div style="font-size:11px;color:#94a3b8;margin-top:4px;"><i class="fa-solid fa-circle-check" style="color:#22c55e;"></i> Terdeteksi otomatis</div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Publikasikan">Publikasikan</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>
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
                <h3><i class="fa-solid fa-pen-to-square" style="color:#ea580c;margin-right:8px;"></i>Edit Pengumuman</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Pengumuman</label>
                        <input type="text" name="judul" id="edit_judul" class="form-control" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" id="edit_isi" class="form-control" required></textarea>
                    </div>
                    <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="penulis" id="edit_penulis" class="form-control" placeholder="Nama penulis (opsional)">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                <option value="Publikasikan">Publikasikan</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>
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
        <div class="modal-box" style="max-width:640px;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-eye" style="color:#4f46e5;margin-right:8px;"></i>Detail Pengumuman</h3>
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
                <h3 style="font-size:18px;font-weight:700;color:#1a1a2e;margin:0 0 6px;">Hapus Pengumuman</h3>
                <p style="font-size:13px;color:#64748b;margin:0 0 24px;line-height:1.6;">Apakah Anda yakin ingin menghapus pengumuman ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
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
        ];

        var iconColors = ['#667eea', '#f5576c', '#4facfe', '#43e97b'];

        function filterPengumuman() {
            var q = document.getElementById('pengSearch').value.toLowerCase();
            var cards = document.querySelectorAll('.peng-card');
            cards.forEach(function(c) {
                var search = c.getAttribute('data-search') || '';
                c.style.display = search.indexOf(q) > -1 ? '' : 'none';
            });
        }

        function openCreateModal() { document.getElementById('createModal').classList.add('active'); }
        function closeCreateModal() { document.getElementById('createModal').classList.remove('active'); }

        function openEditModal(id) {
            fetch('/admin/pengumuman/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('edit_judul').value = data.judul;
                    document.getElementById('edit_isi').value = data.isi;
                    document.getElementById('edit_penulis').value = data.penulis || '';
                    document.getElementById('edit_status').value = data.status;
                    document.getElementById('editForm').action = '/admin/pengumuman/' + id;
                    document.getElementById('editModal').classList.add('active');
                });
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function openDetailModal(id, idx) {
            fetch('/admin/pengumuman/' + id + '/edit')
                .then(r => r.json())
                .then(data => {
                    var g = gradients[idx % gradients.length];
                    var ic = iconColors[idx % iconColors.length];
                    var statusClass = data.status === 'Publikasikan' ? 'background:#d1fae5;color:#059669;' : 'background:#fef3c7;color:#d97706;';
                    var statusDot = data.status === 'Publikasikan' ? '#059669' : '#d97706';

                    var html = '<div style="text-align:center;padding:20px 0 16px;background:' + g + ';border-radius:14px;margin:-24px -24px 20px;color:#fff;">';
                    html += '<div style="font-size:20px;font-weight:800;letter-spacing:-0.3px;padding:0 20px;">' + data.judul + '</div>';
                    html += '<div style="margin-top:12px;display:flex;align-items:center;justify-content:center;gap:8px;"><span style="display:inline-flex;align-items:center;gap:4px;padding:3px 12px;border-radius:20px;font-size:11px;font-weight:600;background:rgba(255,255,255,0.2);"><span style="width:5px;height:5px;border-radius:50%;background:' + statusDot + ';display:inline-block;"></span> ' + data.status + '</span></div>';
                    html += '</div>';

                    html += '<div class="detail-meta">';
                    html += '<div class="detail-meta-item"><i style="background:' + ic + ';"><i class="fa-regular fa-user"></i></i> ' + (data.penulis || '-') + '</div>';
                    html += '<div class="detail-meta-item"><i style="background:' + ic + ';"><i class="fa-regular fa-clock"></i></i> ' + new Date(data.created_at).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) + '</div>';
                    html += '</div>';

                    html += '<div class="detail-content">' + data.isi + '</div>';

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
                document.getElementById('deleteForm').action = '/admin/pengumuman/' + deleteId;
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
