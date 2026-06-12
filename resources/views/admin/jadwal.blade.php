<x-admin-layout>
    <x-slot name="title">Jadwal Pelajaran</x-slot>
    @section('header_title', 'Jadwal Pelajaran')

    <style>
        :root {
            --jadwal-primary: #6366f1;
            --jadwal-primary-light: #eef2ff;
            --jadwal-accent: #8b5cf6;
            --jadwal-teal: #0ea5e9;
            --jadwal-card-shadow: 0 4px 24px rgba(0,0,0,0.06);
            --jadwal-border: #f1f5f9;
            --jadwal-text: #1e293b;
            --jadwal-text-muted: #94a3b8;
        }

        .jadwal-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin: 0 0 28px;
        }

        .jadwal-stat {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--jadwal-border);
            box-shadow: var(--jadwal-card-shadow);
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            position: relative;
            overflow: hidden;
        }

        .jadwal-stat::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }

        .jadwal-stat:nth-child(1)::after { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
        .jadwal-stat:nth-child(2)::after { background: linear-gradient(90deg, #0ea5e9, #06b6d4); }
        .jadwal-stat:nth-child(3)::after { background: linear-gradient(90deg, #f59e0b, #f97316); }
        .jadwal-stat:nth-child(4)::after { background: linear-gradient(90deg, #10b981, #34d399); }

        .jadwal-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
        }

        .jadwal-stat-icon {
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

        .jadwal-stat:hover .jadwal-stat-icon {
            transform: scale(1.08) rotate(-4deg);
        }

        .jadwal-stat-icon.purple { background: linear-gradient(135deg, #eef2ff, #e0e7ff); color: #6366f1; }
        .jadwal-stat-icon.blue { background: linear-gradient(135deg, #e0f2fe, #bae6fd); color: #0ea5e9; }
        .jadwal-stat-icon.orange { background: linear-gradient(135deg, #fff7ed, #ffedd5); color: #f97316; }
        .jadwal-stat-icon.green { background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #10b981; }

        .jadwal-stat-body { flex: 1; min-width: 0; }
        .jadwal-stat-label { font-size: 11px; font-weight: 600; color: var(--jadwal-text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
        .jadwal-stat-value { font-size: 26px; font-weight: 800; color: var(--jadwal-text); letter-spacing: -0.5px; line-height: 1.2; }
        .jadwal-stat-sub { font-size: 11px; color: var(--jadwal-text-muted); margin-top: 1px; }

        .jadwal-filter {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 24px;
            background: #fff;
            padding: 12px 20px;
            border-radius: 16px;
            border: 1px solid var(--jadwal-border);
            box-shadow: var(--jadwal-card-shadow);
        }

        .jadwal-filter-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .jadwal-kelas-select {
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

        .jadwal-kelas-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .jadwal-add-btn {
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
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            text-decoration: none;
        }

        .jadwal-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.45);
        }

        .jadwal-add-btn:active {
            transform: translateY(0);
        }

        .jadwal-week-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: var(--jadwal-text-muted);
        }

        .jadwal-week-info i {
            color: var(--jadwal-primary);
        }

        .jadwal-week-nav {
            display: flex;
            gap: 6px;
        }

        .jadwal-week-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid var(--jadwal-border);
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
            font-size: 13px;
        }

        .jadwal-week-btn:hover {
            background: var(--jadwal-primary-light);
            border-color: var(--jadwal-primary);
            color: var(--jadwal-primary);
        }

        .jadwal-table-wrap {
            background: #fff;
            border-radius: 18px;
            border: 1px solid var(--jadwal-border);
            box-shadow: var(--jadwal-card-shadow);
            overflow: auto;
            margin-bottom: 24px;
        }

        .jadwal-table-wrap::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        .jadwal-table-wrap::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .jadwal-table-wrap::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .jadwal-table-wrap::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .jadwal-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            font-size: 13px;
        }

        .jadwal-table thead th {
            padding: 16px 14px;
            text-align: center;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .jadwal-table thead th:first-child {
            background: #f8fafc;
            text-align: center;
            min-width: 70px;
        }

        .jadwal-table thead th .day-num {
            display: block;
            font-size: 18px;
            font-weight: 800;
            color: var(--jadwal-text);
            margin-top: 2px;
        }

        .jadwal-table thead th.today {
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            color: var(--jadwal-primary);
        }

        .jadwal-table thead th.today .day-num { color: var(--jadwal-primary); }

        .jadwal-table thead th.weekend {
            background: linear-gradient(135deg, #fff8f0, #fffbeb);
            color: #b45309;
        }

        .jadwal-table thead th.weekend .day-num { color: #d97706; }

        .jadwal-table tbody td.weekend {
            background: #fffcf5;
        }

        .jadwal-table tbody td.weekend:hover {
            background: #fff7ed;
        }

        .jadwal-table tbody td {
            padding: 6px;
            border: 1px solid #f1f5f9;
            vertical-align: top;
            transition: background 0.2s;
            height: 82px;
        }

        .jadwal-table tbody td:hover {
            background: #fafbff;
        }

        .jadwal-table tbody td.time-cell {
            text-align: center;
            font-weight: 600;
            font-size: 12px;
            color: #64748b;
            background: #fafbfc;
            padding: 8px 6px;
            white-space: nowrap;
            min-width: 70px;
            width: 70px;
        }

        .jadwal-time-range {
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.3;
        }

        .jadwal-time-range .start { font-weight: 700; color: var(--jadwal-text); font-size: 13px; }
        .jadwal-time-range .end { font-size: 10px; color: var(--jadwal-text-muted); }
        .jadwal-time-range .jam-ke {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }

        .jadwal-cell {
            padding: 5px 10px;
            border-radius: 10px;
            height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            cursor: pointer;
            position: relative;
            gap: 2px;
        }

        .jadwal-cell:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.25);
        }

        .jadwal-cell-empty {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e2e8f0;
            font-size: 18px;
            border-radius: 10px;
            background: #fafbfc;
            border: 1.5px dashed #e2e8f0;
        }

        .jadwal-cell-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1px;
        }

        .jadwal-cell-kelas {
            font-size: 8px;
            font-weight: 700;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background: rgba(0,0,0,0.15);
            padding: 1px 6px;
            border-radius: 4px;
        }

        .jadwal-cell-mapel {
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        .jadwal-cell-guru {
            font-size: 10px;
            color: rgba(255,255,255,0.85);
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .jadwal-cell-guru i {
            font-size: 9px;
            flex-shrink: 0;
        }

        .jadwal-break-row td {
            background: #f8fafc !important;
            padding: 0 !important;
            text-align: center;
            border-bottom: 2px dashed #e2e8f0;
            height: 82px;
        }

        .jadwal-break-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70px;
        }

        .jadwal-break-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 600;
            color: var(--jadwal-text-muted);
        }

        .jadwal-break-label i {
            font-size: 16px;
            color: #f59e0b;
        }

        .jadwal-side-section {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            margin-bottom: 24px;
        }

        .jadwal-side-section > .jadwal-table-wrap {
            margin-bottom: 0;
        }

        .jadwal-agenda {
            background: #fff;
            border-radius: 18px;
            border: 1px solid var(--jadwal-border);
            box-shadow: var(--jadwal-card-shadow);
            padding: 20px;
        }

        .jadwal-agenda-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--jadwal-border);
        }

        .jadwal-agenda-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--jadwal-text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .jadwal-agenda-title i {
            color: var(--jadwal-primary);
        }

        .jadwal-agenda-badge {
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .jadwal-agenda-item {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
            cursor: pointer;
        }

        .jadwal-agenda-item:last-child { border-bottom: none; }

        .jadwal-agenda-item:hover {
            padding-left: 8px;
        }

        .jadwal-agenda-time {
            width: 52px;
            flex-shrink: 0;
            text-align: center;
        }

        .jadwal-agenda-time .time-badge {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            background: #f8fafc;
            padding: 6px 10px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            color: var(--jadwal-text);
            line-height: 1.3;
        }

        .jadwal-agenda-time .time-badge .end {
            font-size: 9px;
            color: var(--jadwal-text-muted);
            font-weight: 500;
        }

        .jadwal-agenda-dot {
            width: 4px;
            min-height: 100%;
            border-radius: 4px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .jadwal-agenda-info { flex: 1; min-width: 0; }

        .jadwal-agenda-mapel {
            font-size: 13px;
            font-weight: 700;
            color: var(--jadwal-text);
            margin-bottom: 2px;
        }

        .jadwal-agenda-guru {
            font-size: 11px;
            color: var(--jadwal-text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .jadwal-agenda-guru i { font-size: 10px; }

        .jadwal-agenda-kelas {
            font-size: 10px;
            font-weight: 600;
            color: var(--jadwal-primary);
            background: var(--jadwal-primary-light);
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
        }

        .jadwal-empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .jadwal-empty-state i {
            font-size: 40px;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .jadwal-empty-state h3 {
            font-size: 16px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }

        .jadwal-empty-state p {
            font-size: 13px;
            color: #94a3b8;
        }

        .jadwal-legend {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 14px 20px;
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--jadwal-border);
            box-shadow: var(--jadwal-card-shadow);
        }

        .jadwal-legend-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--jadwal-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .jadwal-legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #64748b;
        }

        .jadwal-legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 4px;
        }

        @keyframes jadwalPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
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

        .btn.ghost {
            background: #f1f5f9;
            color: #475569;
        }

        .btn.ghost:hover { background: #e2e8f0; }

        .btn.primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
        }

        .btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
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
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
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

        .jadwal-now-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #ef4444;
            margin-left: 12px;
        }

        .jadwal-now-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            animation: jadwalPulse 1.5s ease-in-out infinite;
        }

        @media (max-width: 1200px) {
            .jadwal-stats { grid-template-columns: repeat(2, 1fr); }
            .jadwal-side-section { grid-template-columns: 1fr; }
        }

        @media (max-width: 767px) {
            .jadwal-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .jadwal-stat { padding: 14px 16px; }
            .jadwal-stat-value { font-size: 22px; }
            .jadwal-filter { flex-direction: column; align-items: stretch; }
            .jadwal-kelas-tabs { justify-content: center; }
            .jadwal-week-info { justify-content: center; }
            .jadwal-table-wrap { border-radius: 12px; }
        }

        @media (max-width: 480px) {
            .jadwal-stats { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .jadwal-stat-icon { width: 42px; height: 42px; font-size: 16px; }
            .jadwal-stat-value { font-size: 20px; }
        }
    </style>

    <div class="jadwal-stats">
        <div class="jadwal-stat">
            <div class="jadwal-stat-icon purple"><i class="fa-solid fa-book-quran"></i></div>
            <div class="jadwal-stat-body">
                <div class="jadwal-stat-label">Mata Pelajaran</div>
                <div class="jadwal-stat-value">{{ $data['total_mapel'] }}</div>
                <div class="jadwal-stat-sub">Aktif semester ini</div>
            </div>
        </div>
        <div class="jadwal-stat">
            <div class="jadwal-stat-icon blue"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="jadwal-stat-body">
                <div class="jadwal-stat-label">Tenaga Pengajar</div>
                <div class="jadwal-stat-value">{{ $data['total_guru'] }}</div>
                <div class="jadwal-stat-sub">Guru aktif</div>
            </div>
        </div>
        <div class="jadwal-stat">
            <div class="jadwal-stat-icon orange"><i class="fa-solid fa-clock"></i></div>
            <div class="jadwal-stat-body">
                <div class="jadwal-stat-label">Total Jam/Minggu</div>
                <div class="jadwal-stat-value">{{ $data['total_jam'] }}</div>
                <div class="jadwal-stat-sub">Jam pelajaran</div>
            </div>
        </div>
        <div class="jadwal-stat">
            <div class="jadwal-stat-icon green"><i class="fa-solid fa-people-group"></i></div>
            <div class="jadwal-stat-body">
                <div class="jadwal-stat-label">Total Kelas</div>
                <div class="jadwal-stat-value">{{ $data['total_kelas'] }}</div>
                <div class="jadwal-stat-sub">Kelas aktif</div>
            </div>
        </div>
    </div>

    <div class="jadwal-filter">
        <div class="jadwal-week-info">
            <div class="jadwal-week-nav">
                <button class="jadwal-week-btn"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
            <i class="fa-regular fa-calendar"></i>
            <span>Minggu Ini — 2 - 7 Juni 2026</span>
            <div class="jadwal-week-nav">
                <button class="jadwal-week-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="jadwal-filter-left">
            <select class="jadwal-kelas-select" onchange="if(this.value) window.location.href='{{ route('admin.jadwal') }}?kelas='+this.value">
                @foreach($kelas as $k)
                    <option value="{{ $k->nama_kelas }}" {{ $kelasTerpilih == $k->nama_kelas ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
            <button class="jadwal-add-btn" onclick="openTambahModal()">
                <i class="fa-solid fa-plus"></i> Tambah Jadwal
            </button>
        </div>
    </div>

    <div class="jadwal-side-section">
        <div class="jadwal-table-wrap">
            <table class="jadwal-table">
                <thead>
                    <tr>
                        <th>
                            <div style="font-size:11px;font-weight:700;color:var(--jadwal-text);">Jam</div>
                        </th>
                        @php
                            $todayName = now()->locale('id')->dayName;
                            $todayIdx = array_search(ucfirst($todayName), ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
                        @endphp
                        @foreach($hari as $idx => $h)
                            <th class="{{ $idx === $todayIdx ? 'today' : '' }} {{ $idx >= 5 ? 'weekend' : '' }}">
                                {{ $h }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($allJamKe as $jj => $jamKe)
                        @php
                            $sample = null;
                            foreach ($hari as $h) { $sample = $jadwal[$h][$jamKe] ?? null; if ($sample) break; }
                        @endphp
                        <tr>
                            <td class="time-cell">
                                <div class="jadwal-time-range">
                                    <span class="jam-ke">Jam {{ $jamKe }}</span>
                                    @if($sample)
                                        <span class="start">{{ $sample['mulai'] }}</span>
                                        <span class="end">{{ $sample['selesai'] }}</span>
                                    @endif
                                </div>
                            </td>
                            @foreach($hari as $h)
                                @php
                                    $entry = $jadwal[$h][$jamKe] ?? null;
                                    $dayIdx = array_search($h, $hari);
                                @endphp
                                <td class="{{ $dayIdx >= 5 ? 'weekend' : '' }}">
                                    @if($entry)
                                        <div class="jadwal-cell" style="background: linear-gradient(135deg, {{ $entry['warna'] }}, {{ $entry['warna'] }}cc);box-shadow:0 2px 8px {{ $entry['warna'] }}33;" data-detail='@json($entry)' onclick="var d=JSON.parse(this.dataset.detail);showDetail(d.id,d.mapel,d.guru,d.mulai,d.selesai,d.kelas,'{{ $h }}',d.jam_ke,d.warna)">
                                            <div class="jadwal-cell-top">
                                                <span class="jadwal-cell-kelas">{{ $entry['kelas'] }}</span>
                                                <span class="jadwal-cell-kelas">Jam {{ $entry['jam_ke'] }}</span>
                                            </div>
                                            <div class="jadwal-cell-mapel">{{ $entry['mapel'] }}</div>
                                            <div class="jadwal-cell-guru"><i class="fa-solid fa-user"></i> {{ $entry['guru'] }}</div>
                                        </div>
                                    @else
                                        <div class="jadwal-cell-empty">
                                            <i class="fa-regular fa-minus"></i>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    @if(empty($allJamKe))
                        <tr>
                            <td colspan="8">
                                <div class="jadwal-empty-state" style="padding:60px 20px;">
                                    <i class="fa-regular fa-calendar-circle-exclamation"></i>
                                    <h3>Belum Ada Jadwal</h3>
                                    <p>Klik tombol <strong>Tambah Jadwal</strong> untuk membuat jadwal pertama.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="jadwal-agenda">
            <div class="jadwal-agenda-header">
                <div class="jadwal-agenda-title">
                    <i class="fa-regular fa-clock"></i> Agenda Hari Ini
                    <span class="jadwal-now-indicator">
                        <span class="jadwal-now-dot"></span> Live
                    </span>
                </div>
                <span class="jadwal-agenda-badge">{{ now()->isoFormat('dddd', 'id') }}</span>
            </div>
            <div id="jadwalAgendaList">
                @php
                    $today = ucfirst(now()->locale('id')->dayName);
                    $todayEntries = $jadwal[$today] ?? [];
                @endphp
                @forelse($todayEntries as $e)
                    <div class="jadwal-agenda-item">
                        <div class="jadwal-agenda-time">
                            <div class="time-badge">
                                {{ $e['mulai'] }}
                                <span class="end">{{ $e['selesai'] }}</span>
                            </div>
                        </div>
                        <div class="jadwal-agenda-dot" style="background: {{ $e['warna'] }};"></div>
                        <div class="jadwal-agenda-info">
                            <div class="jadwal-agenda-mapel">{{ $e['mapel'] }}</div>
                            <div class="jadwal-agenda-guru"><i class="fa-solid fa-user"></i> {{ $e['guru'] }}</div>
                            <span class="jadwal-agenda-kelas">{{ $e['kelas'] }}</span>
                        </div>
                    </div>
                @empty
                    <div class="jadwal-empty-state">
                        <i class="fa-regular fa-calendar-circle-exclamation"></i>
                        <h3>Belum Ada Jadwal</h3>
                        <p>Belum ada jadwal pelajaran untuk hari ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="jadwal-legend">
        <span class="jadwal-legend-label">Kategori Mapel</span>
        @foreach($kategoriMapel as $kat)
        <span class="jadwal-legend-item">
            <span class="jadwal-legend-dot" style="background: {{ $kategoriColors[$kat] }};"></span>
            {{ $kat }}
        </span>
        @endforeach
        <span class="jadwal-legend-item" style="margin-left:auto;">
            <i class="fa-regular fa-circle-check" style="color:#10b981;"></i>
            {{ $kelasTerpilih ? $kelasTerpilih : '-' }} &mdash; {{ count($hari) }} Hari &middot; {{ count($allJamKe) }} Jam
        </span>
    </div>

    <div class="modal-overlay" id="detailJadwalModal">
        <div class="modal-box" style="max-width: 420px;">
            <div class="modal-header">
                <h3><i class="fa-regular fa-calendar-circle-info" style="color:#6366f1;margin-right:8px;"></i> Detail Jadwal</h3>
                <button class="modal-close" onclick="closeDetailModal()">&times;</button>
            </div>
            <div class="modal-body" id="detailJadwalContent"></div>
            <div class="modal-footer">
                <button type="button" class="btn ghost" onclick="closeDetailModal()">Tutup</button>
                <button type="button" class="btn danger" id="detailHapusBtn" onclick=""><i class="fa-regular fa-trash-can"></i> Hapus</button>
                <button type="button" class="btn primary" id="detailEditBtn" onclick=""><i class="fa-regular fa-pen-to-square"></i> Edit</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="formJadwalModal">
        <div class="modal-box" style="max-width: 520px;">
            <div class="modal-header">
                <h3 id="formModalTitle"><i id="formModalIcon" class="fa-solid fa-plus-circle" style="color:#6366f1;margin-right:8px;"></i> <span id="formModalText">Tambah Jadwal</span></h3>
                <button class="modal-close" onclick="closeFormModal()">&times;</button>
            </div>
            <form action="#" method="POST" id="formJadwal">
                @csrf
                <input type="hidden" name="mode" id="formMode" value="tambah">
                <input type="hidden" name="id" id="formId" value="">
                <input type="hidden" name="jam_ke" id="formJamKe" value="">
                <div class="modal-body" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="form-group" style="margin:0;">
                        <label>Mata Pelajaran</label>
                        <select name="mapel" id="formMapel" class="form-control" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->nama_mapel }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Kelas</label>
                        <select name="kelas" id="formKelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->nama_kelas }}" {{ $kelasTerpilih == $k->nama_kelas ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Hari</label>
                        <select name="hari" id="formHari" class="form-control" required>
                            <option value="">-- Hari --</option>
                            @foreach($hari as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="formJamMulai" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Pengajar</label>
                        <select name="guru" id="formGuru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="formJamSelesai" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeFormModal()">Batal</button>
                    <button type="submit" class="btn primary" id="formSubmitBtn"><i class="fa-solid fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="hapusJadwalModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-body" style="text-align:center;padding:32px 24px 24px;">
                <div style="width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,#fee2e2,#fecaca);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fa-solid fa-trash-can" style="font-size:24px;color:#dc2626;"></i>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:#1a1a2e;margin:0 0 6px;">Hapus Jadwal</h3>
                <p style="font-size:13px;color:#64748b;margin:0 0 24px;line-height:1.6;" id="hapusJadwalText">Apakah Anda yakin ingin menghapus jadwal ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:12px;justify-content:center;">
                    <button type="button" class="btn ghost" onclick="closeHapusModal()" style="padding:10px 28px;">Batal</button>
                    <button type="button" class="btn danger" onclick="submitHapus()" style="padding:10px 28px;"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var detailData = null;
        var hapusData = null;

        function openHapusModal(id, mapel, hari) {
            hapusData = { id: id, mapel: mapel, hari: hari };
            document.getElementById('hapusJadwalText').innerHTML = 'Yakin ingin menghapus jadwal <strong>"' + mapel + '"</strong> hari ' + hari + '?<br>Tindakan ini tidak dapat dibatalkan.';
            document.getElementById('hapusJadwalModal').classList.add('active');
        }
        function closeHapusModal() {
            document.getElementById('hapusJadwalModal').classList.remove('active');
            hapusData = null;
        }
        function submitHapus() {
            fetch('/admin/jadwal/' + hapusData.id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    closeHapusModal();
                    closeDetailModal();
                    showToastJadwal('success', 'Berhasil!', 'Jadwal berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToastJadwal('error', 'Gagal!', 'Terjadi kesalahan.'));
        }
        document.getElementById('hapusJadwalModal')?.addEventListener('click', function(e) { if (e.target === this) closeHapusModal(); });

        function openTambahModal() {
            document.getElementById('formMode').value = 'tambah';
            document.getElementById('formModalIcon').className = 'fa-solid fa-plus-circle';
            document.getElementById('formModalText').textContent = 'Tambah Jadwal';
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-check"></i> Simpan';
            document.getElementById('formJadwal').reset();
            document.getElementById('formId').value = '';
            document.getElementById('formJamKe').value = '';
            document.getElementById('formJadwalModal').classList.add('active');
        }

        function openEditModal(id) {
            fetch('/admin/jadwal/' + id + '/edit')
                .then(res => res.json())
                .then(r => {
                    document.getElementById('formMode').value = 'edit';
                    document.getElementById('formModalIcon').className = 'fa-regular fa-pen-to-square';
                    document.getElementById('formModalText').textContent = 'Edit Jadwal';
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-check"></i> Update';
                    document.getElementById('formId').value = r.id;
                    document.getElementById('formMapel').value = r.mapel;
                    document.getElementById('formKelas').value = r.kelas;
                    document.getElementById('formHari').value = r.hari;
                    document.getElementById('formJamMulai').value = r.jam_mulai;
                    document.getElementById('formJamSelesai').value = r.jam_selesai;
                    document.getElementById('formGuru').value = r.guru;
                    document.getElementById('formJamKe').value = r.jam_ke;
                    document.getElementById('formJadwalModal').classList.add('active');
                });
        }

        function closeFormModal() { document.getElementById('formJadwalModal').classList.remove('active'); }
        document.getElementById('formJadwalModal')?.addEventListener('click', function(e) { if (e.target === this) closeFormModal(); });
        document.getElementById('formJadwal')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const isEdit = document.getElementById('formMode').value === 'edit';
            const id = document.getElementById('formId').value;
            const data = {
                mapel: document.getElementById('formMapel').value,
                kelas: document.getElementById('formKelas').value,
                hari: document.getElementById('formHari').value,
                jam_mulai: document.getElementById('formJamMulai').value,
                jam_selesai: document.getElementById('formJamSelesai').value,
                guru: document.getElementById('formGuru').value,
                jam_ke: document.getElementById('formJamKe').value,
            };
            const url = isEdit ? '/admin/jadwal/' + id : '/admin/jadwal';
            const method = isEdit ? 'PUT' : 'POST';
            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify(data),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    closeFormModal();
                    showToastJadwal('success', 'Berhasil!', 'Jadwal berhasil ' + (isEdit ? 'diupdate' : 'disimpan'));
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToastJadwal('error', 'Gagal!', 'Terjadi kesalahan.'));
        });

        function showDetail(id, mapel, guru, mulai, selesai, kelas, hari, jamKe, warna) {
            var initial = guru.charAt(0);
            var html = '<div style="background:linear-gradient(135deg,' + warna + ',' + warna + 'dd);margin:-24px -24px 20px;padding:28px 24px;text-align:center;color:#fff;border-radius:18px 18px 0 0;">';
            html += '<div style="font-size:14px;font-weight:600;opacity:0.85;margin-bottom:4px;">' + hari + ' &middot; Jam Ke-' + jamKe + '</div>';
            html += '<div style="font-size:22px;font-weight:800;letter-spacing:-0.3px;">' + mapel + '</div>';
            html += '<div style="font-size:13px;opacity:0.8;margin-top:4px;"><i class="fa-regular fa-clock"></i> ' + mulai + ' – ' + selesai + '</div>';
            html += '</div>';
            html += '<div class="detail-grid">';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-solid fa-calendar-day" style="margin-right:4px;"></i>Hari</div><div class="dvalue" style="font-size:15px;">' + hari + '</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-regular fa-clock" style="margin-right:4px;"></i>Jam Ke</div><div class="dvalue" style="font-size:15px;">' + jamKe + '</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-solid fa-play" style="margin-right:4px;"></i>Mulai</div><div class="dvalue" style="font-size:15px;">' + mulai + ' WIB</div></div>';
            html += '<div class="detail-item"><div class="dlabel"><i class="fa-solid fa-stop" style="margin-right:4px;"></i>Selesai</div><div class="dvalue" style="font-size:15px;">' + selesai + ' WIB</div></div>';
            html += '<div class="detail-item full"><div class="dlabel"><i class="fa-solid fa-chalkboard-user" style="margin-right:4px;"></i>Pengajar</div><div class="dvalue" style="display:flex;align-items:center;gap:10px;"><div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,' + warna + ',' + warna + 'cc);color:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;flex-shrink:0;">' + initial + '</div><div><div style="font-weight:600;color:#1a1a2e;">' + guru + '</div><div style="font-size:11px;color:#94a3b8;">Tenaga Pengajar TPA</div></div></div></div>';
            html += '<div class="detail-item full"><div class="dlabel"><i class="fa-solid fa-people-group" style="margin-right:4px;"></i>Kelas</div><div class="dvalue" style="display:flex;gap:8px;flex-wrap:wrap;"><span style="background:linear-gradient(135deg,' + warna + '22,' + warna + '11);color:' + warna + ';padding:5px 14px;border-radius:8px;font-size:14px;font-weight:700;">' + kelas + '</span></div></div>';
            html += '</div>';
            document.getElementById('detailJadwalContent').innerHTML = html;

            detailData = { id: id, mapel: mapel, guru: guru, mulai: mulai, selesai: selesai, kelas: kelas, hari: hari, jamKe: jamKe };
            document.getElementById('detailEditBtn').onclick = function() {
                closeDetailModal();
                openEditModal(detailData.id);
            };
            document.getElementById('detailHapusBtn').onclick = function() {
                closeDetailModal();
                openHapusModal(detailData.id, detailData.mapel, detailData.hari);
            };

            document.getElementById('detailJadwalModal').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('detailJadwalModal').classList.remove('active');
        }

        document.getElementById('detailJadwalModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        document.querySelectorAll('.jadwal-week-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.9)';
                setTimeout(function() { btn.style.transform = ''; }, 150);
            });
        });

        document.getElementById('formJamMulai')?.addEventListener('change', function() {
            document.getElementById('formJamKe').value = '';
        });

        function showToastJadwal(type, title, msg) {
            const existing = document.querySelector('.jadwal-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'jadwal-toast';
            t.style.cssText = 'position:fixed;top:24px;right:24px;z-index:9999;display:flex;align-items:center;gap:14px;padding:16px 20px;border-radius:12px;min-width:320px;box-shadow:0 8px 32px rgba(0,0,0,0.12);animation:korIn 0.4s cubic-bezier(0.22,1,0.36,1);border-left:4px solid;' + (type === 'success' ? 'background:#f0fdf4;border-color:#22c55e;' : 'background:#fef2f2;border-color:#ef4444;');
            t.innerHTML = '<div class="toast-icon" style="width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;' + (type === 'success' ? 'background:#dcfce7;color:#16a34a;' : 'background:#fee2e2;color:#dc2626;') + '"><i class="fa-solid ' + (icons[type] || 'fa-check-circle') + '"></i></div><div class="toast-body" style="flex:1;"><div class="toast-title" style="font-size:14px;font-weight:700;color:#1a1a2e;margin-bottom:2px;">' + title + '</div><div class="toast-msg" style="font-size:12px;color:#555;">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()" style="width:28px;height:28px;border-radius:8px;border:none;background:transparent;cursor:pointer;font-size:20px;color:#999;">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { if (t.parentElement) { t.style.animation = 'korOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); } }, 4000);
        }
    </script>

</x-admin-layout>
