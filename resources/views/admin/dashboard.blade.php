<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>
    @section('header_title', 'Dashboard')
    @section('header_subtitle', 'Overview TPA Nurul Iman')

    <style>
        :root {
            --d-purple: #7c3aed;
            --d-blue: #2563eb;
            --d-emerald: #059669;
            --d-rose: #e11d48;
            --d-amber: #d97706;
            --d-cyan: #0891b2;
        }

        .d-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px; }

        .d-card { position: relative; border-radius: 16px; padding: 20px 22px; background: #fff; border: 1px solid var(--border-color); box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; transition: all 0.3s cubic-bezier(0.22,1,0.36,1); }
        .d-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.08); }
        .d-card::before { content: ''; position: absolute; inset: 0; border-radius: 16px; opacity: 0; transition: opacity 0.3s; }
        .d-card:hover::before { opacity: 1; }

        .d-card-top { display: flex; align-items: flex-start; justify-content: space-between; position: relative; z-index: 1; }
        .d-card-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
        .d-card-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .d-card-icon.purple { background: #f3e8ff; color: #7c3aed; }
        .d-card-icon.blue { background: #dbeafe; color: #2563eb; }
        .d-card-icon.emerald { background: #d1fae5; color: #059669; }
        .d-card-icon.rose { background: #ffe4e6; color: #e11d48; }
        .d-card-icon.amber { background: #fef3c7; color: #d97706; }
        .d-card-icon.cyan { background: #cffafe; color: #0891b2; }
        .d-card-icon.indigo { background: #e0e7ff; color: #4f46e5; }

        .d-card-value { font-size: 28px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; margin-top: 12px; line-height: 1; position: relative; z-index: 1; }
        .d-card-footer { font-size: 11px; color: var(--text-muted); margin-top: 8px; display: flex; align-items: center; gap: 6px; position: relative; z-index: 1; }

        .d-card-accent { position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; border-radius: 50%; opacity: 0.06; z-index: 0; }
        .d-card-accent.purple { background: #7c3aed; }
        .d-card-accent.blue { background: #2563eb; }
        .d-card-accent.emerald { background: #059669; }
        .d-card-accent.rose { background: #e11d48; }

        .d-row { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 24px; }

        .d-chart-box { background: #fff; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
        .d-chart-head { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px 0; }
        .d-chart-title { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 700; color: #1a1a2e; }
        .d-chart-title i { color: var(--d-blue); }
        .d-chart-body { padding: 16px 20px 20px; }

        .d-side-box { background: #fff; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
        .d-side-head { padding: 16px 18px 0; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 700; color: #1a1a2e; }
        .d-side-head i { color: var(--d-rose); }
        .d-side-body { padding: 14px 18px 18px; }

        .d-timeline { list-style: none; padding: 0; margin: 0; }
        .d-timeline li { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .d-timeline li:last-child { border-bottom: none; }
        .d-tl-dot { width: 32px; height: 32px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; margin-top: 2px; }
        .d-tl-dot.success { background: #d1fae5; color: #059669; }
        .d-tl-dot.info { background: #dbeafe; color: #2563eb; }
        .d-tl-dot.warning { background: #fef3c7; color: #d97706; }
        .d-tl-dot.danger { background: #ffe4e6; color: #e11d48; }
        .d-tl-body { flex: 1; min-width: 0; }
        .d-tl-user { font-size: 13px; font-weight: 700; color: #1a1a2e; }
        .d-tl-action { font-size: 12px; color: #555; margin-top: 1px; }
        .d-tl-time { font-size: 11px; color: var(--text-muted); margin-top: 3px; display: flex; align-items: center; gap: 4px; }

        .d-bottom-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }

        .d-event-list { list-style: none; padding: 0; margin: 0; }
        .d-event-list li { display: flex; align-items: center; gap: 14px; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
        .d-event-list li:last-child { border-bottom: none; }
        .d-event-date { width: 48px; height: 52px; border-radius: 10px; background: #f8fafc; border: 1px solid var(--border-color); display: flex; flex-direction: column; align-items: center; justify-content: center; flex-shrink: 0; }
        .d-event-day { font-size: 18px; font-weight: 800; color: #1a1a2e; line-height: 1; }
        .d-event-month { font-size: 9px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.3px; margin-top: 1px; }
        .d-event-info { flex: 1; min-width: 0; }
        .d-event-title { font-size: 13px; font-weight: 700; color: #1a1a2e; }
        .d-event-desc { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
        .d-event-badge { padding: 4px 12px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; flex-shrink: 0; }
        .d-event-badge.primary { background: #dbeafe; color: #2563eb; }
        .d-event-badge.warning { background: #fef3c7; color: #d97706; }
        .d-event-badge.success { background: #d1fae5; color: #059669; }

        .d-chart-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }

        .d-qa-btn { display:flex;align-items:center;gap:8px;padding:13px 14px;border-radius:10px;font-size:12px;font-weight:700;border:none;cursor:pointer;text-decoration:none;transition:all 0.2s; }
        .d-qa-btn:hover { transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.08); }

        @media (max-width: 991px) {
            .d-stats { grid-template-columns: repeat(2, 1fr); }
            .d-row { grid-template-columns: 1fr; }
            .d-bottom-row { grid-template-columns: 1fr; }
            .d-chart-row-2 { grid-template-columns: 1fr; }
        }

        @media (max-width: 575px) {
            .d-stats { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .d-card { padding: 16px 18px; }
            .d-card-value { font-size: 24px; }
            .d-chart-body { padding: 12px 14px 16px; }
        }
    </style>

    {{-- Stats Cards --}}
    <div class="d-stats">
        <div class="d-card">
            <div class="d-card-accent purple"></div>
            <div class="d-card-top">
                Total Santri
                <div class="d-card-icon purple"><i class="fa-solid fa-user-graduate"></i></div>
            </div>
            <div class="d-card-value">{{ $stats['totalStudents'] }}</div>
        </div>
        <div class="d-card">
            <div class="d-card-accent blue"></div>
            <div class="d-card-top">
                Ustadz
                <div class="d-card-icon blue"><i class="fa-solid fa-chalkboard-user"></i></div>
            </div>
            <div class="d-card-value">{{ $stats['totalTeachers'] }}</div>
        </div>
        <div class="d-card">
            <div class="d-card-accent emerald"></div>
            <div class="d-card-top">
                Mata Pelajaran
                <div class="d-card-icon emerald"><i class="fa-solid fa-book-open"></i></div>
            </div>
            <div class="d-card-value">{{ $stats['totalSubjects'] }}</div>
        </div>
        <div class="d-card">
            <div class="d-card-accent rose"></div>
            <div class="d-card-top">
                Absensi Hari Ini
                <div class="d-card-icon rose"><i class="fa-solid fa-clipboard-check"></i></div>
            </div>
            <div class="d-card-value">{{ $stats['todayAbsensi'] }}</div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="d-row">
        <div class="d-chart-box">
            <div class="d-chart-head">
                <div class="d-chart-title">
                    <i class="fa-solid fa-chart-line"></i> Perkembangan Santri
                </div>
            </div>
            <div class="d-chart-body">
                <div style="height:260px;"><canvas id="lineChart"></canvas></div>
            </div>
        </div>
        <div class="d-side-box">
            <div class="d-side-head">
                <i class="fa-solid fa-venus-mars"></i> Komposisi Santri
            </div>
            <div class="d-side-body">
                <div style="height:200px;"><canvas id="genderChart"></canvas></div>
                <div style="display:flex;gap:16px;justify-content:center;margin-top:12px;">
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:10px;height:10px;border-radius:3px;background:#2563eb;"></div>
                        Laki-laki <strong>{{ $stats['totalMale'] }}</strong>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:10px;height:10px;border-radius:3px;background:#e11d48;"></div>
                        Perempuan <strong>{{ $stats['totalFemale'] }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row: Bar Chart + Quick Actions --}}
    <div class="d-bottom-row">
        <div class="d-chart-box">
            <div class="d-chart-head">
                <div class="d-chart-title">
                    <i class="fa-solid fa-chart-bar" style="color:var(--d-emerald);"></i> Sebaran Santri per Kelas
                </div>
            </div>
            <div class="d-chart-body">
                <div style="height:220px;"><canvas id="classChart"></canvas></div>
            </div>
        </div>
        <div class="d-side-box">
            <div class="d-side-head">
                <i class="fa-solid fa-bolt" style="color:var(--d-amber);"></i> Tindakan Cepat
            </div>
            <div class="d-side-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <a href="{{ route('admin.absensi') }}" class="d-qa-btn" style="background:#dbeafe;color:#2563eb;">
                        <i class="fa-solid fa-clipboard-check"></i> Absen Sekarang
                    </a>
                    <a href="{{ route('admin.santri') }}" class="d-qa-btn" style="background:#d1fae5;color:#059669;">
                        <i class="fa-solid fa-user-plus"></i> Tambah Santri
                    </a>
                    <a href="{{ route('admin.nilai') }}" class="d-qa-btn" style="background:#fef3c7;color:#d97706;">
                        <i class="fa-solid fa-star"></i> Input Nilai
                    </a>
                    <a href="{{ route('admin.hafalan-tahsin') }}" class="d-qa-btn" style="background:#e0e7ff;color:#4f46e5;">
                        <i class="fa-solid fa-book-quran"></i> Hafalan
                    </a>
                    <a href="{{ route('admin.pembayaran') }}" class="d-qa-btn" style="background:#fce7f3;color:#db2777;">
                        <i class="fa-solid fa-money-bill-wave"></i> Pembayaran
                    </a>
                    <a href="{{ route('admin.jadwal') }}" class="d-qa-btn" style="background:#ccfbf1;color:#0d9488;">
                        <i class="fa-regular fa-calendar"></i> Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/chart.js') }}"></script>
    <script>
        const isDark = false;
        const textColor = '#6b7280';
        const gridColor = 'rgba(0,0,0,0.05)';

        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Santri Aktif',
                    data: @json($monthlyActive),
                    borderColor: '#2563eb',
                    backgroundColor: (ctx) => {
                        const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
                        g.addColorStop(0, 'rgba(37,99,235,0.18)');
                        g.addColorStop(1, 'rgba(37,99,235,0.01)');
                        return g;
                    },
                    fill: true, tension: 0.4, borderWidth: 3,
                    pointBackgroundColor: '#fff', pointBorderColor: '#2563eb',
                    pointBorderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6,
                }, {
                    label: 'Santri Baru',
                    data: @json($monthlyNew),
                    borderColor: '#059669',
                    backgroundColor: (ctx) => {
                        const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
                        g.addColorStop(0, 'rgba(5,150,105,0.12)');
                        g.addColorStop(1, 'rgba(5,150,105,0.01)');
                        return g;
                    },
                    fill: true, tension: 0.4, borderWidth: 2.5, borderDash: [6, 4],
                    pointBackgroundColor: '#fff', pointBorderColor: '#059669',
                    pointBorderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: {
                        display: true, position: 'top', labels: {
                            boxWidth: 14, boxHeight: 14, padding: 14,
                            font: { size: 12, weight: '600' }, color: '#4b5563',
                            usePointStyle: true, pointStyle: 'circle',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#fff', titleColor: '#1a1a2e', bodyColor: '#555',
                        padding: 14, borderRadius: 10, borderColor: '#e5e7eb', borderWidth: 1,
                        boxPadding: 4, usePointStyle: true,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { font: { size: 11 }, color: textColor, padding: 8 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 }, color: textColor, padding: 8 }
                    }
                }
            }
        });

        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $stats['totalMale'] }}, {{ $stats['totalFemale'] }}],
                    backgroundColor: ['#2563eb', '#e11d48'],
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff', titleColor: '#1a1a2e', bodyColor: '#555',
                        padding: 12, borderRadius: 8, borderColor: '#e5e7eb', borderWidth: 1,
                        callbacks: {
                            label: (ctx) => `${ctx.label}: ${ctx.parsed} santri (${Math.round(ctx.parsed / {{ $stats['totalStudents'] ?: 1 }} * 100)}%)`
                        }
                    }
                }
            }
        });

        const classCtx = document.getElementById('classChart').getContext('2d');
        new Chart(classCtx, {
            type: 'bar',
            data: {
                labels: @json($classDistribution->keys()),
                datasets: [{
                    label: 'Jumlah Santri',
                    data: @json($classDistribution->values()),
                    backgroundColor: [
                        '#7c3aed', '#2563eb', '#059669', '#e11d48',
                        '#d97706', '#0891b2', '#4f46e5', '#db2777',
                        '#65a30d', '#0d9488'
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    barPercentage: 0.55,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff', titleColor: '#1a1a2e', bodyColor: '#555',
                        padding: 12, borderRadius: 8, borderColor: '#e5e7eb', borderWidth: 1,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: { font: { size: 11 }, color: textColor, padding: 8, stepSize: 1 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' }, color: '#4b5563', padding: 8 }
                    }
                }
            }
        });
    </script>
    @endpush
</x-admin-layout>
