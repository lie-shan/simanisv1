<x-admin-layout>
    <x-slot name="title">Absensi Harian</x-slot>
    @section('header_title', 'Absensi Harian')
    @section('header_subtitle', 'Kelola kehadiran santri setiap hari')

<style>
:root {
    --a-primary: #0ea5e9;
    --a-primary-dark: #0284c7;
    --a-primary-light: #38bdf8;
    --a-bg: #f8fafc;
    --a-card: #ffffff;
    --a-border: #e2e8f0;
    --a-text: #1e293b;
    --a-text-secondary: #64748b;
    --a-shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --a-shadow-lg: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -2px rgba(0,0,0,.04);
    --a-radius: 12px;
}

/* Stats */
.a-stats { display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px; }
.a-stat { background:var(--a-card);border-radius:var(--a-radius);padding:18px 20px;box-shadow:var(--a-shadow);display:flex;align-items:center;gap:14px;transition:all .25s;border:1px solid var(--a-border);position:relative;overflow:hidden; }
.a-stat:hover { transform:translateY(-2px);box-shadow:var(--a-shadow-lg); }
.a-stat-icon { width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0; }
.a-stat-icon.i1 { background:linear-gradient(135deg,#0ea5e9,#38bdf8);color:#fff; }
.a-stat-icon.i2 { background:linear-gradient(135deg,#10b981,#34d399);color:#fff; }
.a-stat-icon.i3 { background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff; }
.a-stat-icon.i4 { background:linear-gradient(135deg,#ef4444,#f87171);color:#fff; }
.a-stat-icon.i5 { background:linear-gradient(135deg,#64748b,#94a3b8);color:#fff; }
.a-stat-icon.i6 { background:linear-gradient(135deg,#8b5cf6,#a78bfa);color:#fff; }
.a-stat-body { flex:1;min-width:0; }
.a-stat-label { font-size:12px;color:var(--a-text-secondary);margin-bottom:1px;font-weight:500; }
.a-stat-value { font-size:24px;font-weight:700;color:var(--a-text);line-height:1.2; }
.a-stat:after { content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:50%;background:currentColor;opacity:.03;transform:translate(30%,-30%); }

/* Tabs */
.a-tabs { display:flex;gap:0;margin-bottom:24px;background:var(--a-card);border-radius:var(--a-radius);box-shadow:var(--a-shadow);border:1px solid var(--a-border);overflow:hidden; }
.a-tab { flex:1;padding:12px 20px;border:none;background:transparent;cursor:pointer;font-size:13px;font-weight:600;color:var(--a-text-secondary);transition:all .2s;white-space:nowrap;display:flex;align-items:center;justify-content:center;gap:8px;font-family:inherit;position:relative;border-bottom:2px solid transparent;text-decoration:none; }
.a-tab:not(:last-child) { border-right:1px solid var(--a-border); }
.a-tab:hover { color:var(--a-text);background:#fafafa; }
.a-tab.active { color:var(--a-primary);border-bottom-color:var(--a-primary);background:#f0f9ff; }
.a-tab i { font-size:15px; }

/* Filter */
.a-filter { background:var(--a-card);border-radius:var(--a-radius);padding:16px 20px;box-shadow:var(--a-shadow);border:1px solid var(--a-border);margin-bottom:20px; }
.a-filter-inner { display:flex;align-items:center;flex-wrap:wrap;gap:12px; }
.a-filter-group { display:flex;align-items:center;gap:8px; }
.a-filter-label { font-size:12px;font-weight:600;color:var(--a-text-secondary);text-transform:uppercase;letter-spacing:.4px; }
.a-filter-input { padding:8px 12px;border:1px solid var(--a-border);border-radius:8px;font-size:13px;outline:none;background:#f8fafc;transition:all .2s;font-family:inherit;min-width:150px; }
.a-filter-input:focus { border-color:var(--a-primary);background:#fff;box-shadow:0 0 0 3px rgba(14,165,233,.12); }
.a-filter-select { padding:8px 32px 8px 12px;border:1px solid var(--a-border);border-radius:8px;font-size:13px;outline:none;background:#f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 10px center;cursor:pointer;transition:all .2s;font-family:inherit;appearance:none;min-width:140px; }
.a-filter-select:focus { border-color:var(--a-primary);background-color:#fff;box-shadow:0 0 0 3px rgba(14,165,233,.12); }
.a-filter-actions { display:flex;align-items:center;gap:8px;margin-left:auto; }

/* Buttons */
.a-btn { display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;border:none;font-family:inherit;text-decoration:none;white-space:nowrap; }
.a-btn-primary { background:linear-gradient(135deg,var(--a-primary),var(--a-primary-dark));color:#fff;box-shadow:0 4px 6px rgba(14,165,233,.25); }
.a-btn-primary:hover { transform:translateY(-1px);box-shadow:0 6px 12px rgba(14,165,233,.35); }
.a-btn-success { background:linear-gradient(135deg,#10b981,#059669);color:#fff;box-shadow:0 4px 6px rgba(16,185,129,.25); }
.a-btn-success:hover { transform:translateY(-1px);box-shadow:0 6px 12px rgba(16,185,129,.35); }
.a-btn-ghost { background:#f1f5f9;color:var(--a-text); }
.a-btn-ghost:hover { background:#e2e8f0; }
.a-btn-green { background:#25D366;color:#fff; }
.a-btn-green:hover { background:#1da851; }
.a-btn-sm { padding:6px 12px;font-size:12px; }

/* Table */
.a-card { background:var(--a-card);border-radius:var(--a-radius);box-shadow:var(--a-shadow);border:1px solid var(--a-border);overflow:hidden;margin-bottom:20px; }
.a-card-header { padding:14px 20px;border-bottom:1px solid var(--a-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px; }
.a-card-header h3 { margin:0;font-size:14px;font-weight:700;color:var(--a-text);display:flex;align-items:center;gap:8px; }
.a-card-header h3 i { color:var(--a-primary); }
.a-table-scroll { overflow-x:auto; }
.a-table { width:100%;border-collapse:collapse;font-size:13px; }
.a-table thead { background:#f8fafc; }
.a-table th { padding:10px 14px;text-align:center;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;color:var(--a-text-secondary);border-bottom:2px solid var(--a-border);white-space:nowrap; }
.a-table td { padding:10px 14px;border-bottom:1px solid var(--a-border);color:var(--a-text);vertical-align:middle; }
.a-table tbody tr { transition:background .15s; }
.a-table tbody tr:hover { background:#f8fafc; }
.a-table tbody tr:last-child td { border-bottom:none; }

/* Santri cell */
.a-santri { display:flex;align-items:center;gap:10px; }
.a-avatar { width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:#fff;flex-shrink:0; }
.a-santri-info { }
.a-santri-name { font-weight:600;color:var(--a-text);font-size:13px; }
.a-santri-reg { font-size:11px;color:var(--a-text-secondary);margin-top:1px; }

/* Status badges */
.a-badge { display:inline-block;padding:3px 12px;border-radius:20px;font-size:11px;font-weight:600; }
.a-badge.h { background:#f0fdf4;color:#15803d; }
.a-badge.i { background:#fef3c7;color:#b45309; }
.a-badge.s { background:#fee2e2;color:#b91c1c; }
.a-badge.a { background:#f1f5f9;color:#475569; }

/* Radio attendance */
.a-srad { display:inline-flex;align-items:center;gap:4px;flex-wrap:wrap; }
.a-srad label { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600;cursor:pointer;border:1px solid var(--a-border);background:#fafbfc;color:#64748b;transition:all .15s;user-select:none;font-family:inherit; }
.a-srad label:hover { border-color:var(--a-primary);color:var(--a-primary); }
.a-srad input[type="radio"] { display:none; }
.a-srad label.active { color:#fff;border-color:transparent; }
.a-srad label.h.active { background:#10b981; }
.a-srad label.i.active { background:#f59e0b; }
.a-srad label.s.active { background:#ef4444; }
.a-srad label.a.active { background:#64748b; }

/* Keterangan input */
.a-ket { padding:5px 10px;border:1px solid var(--a-border);border-radius:6px;font-size:12px;outline:none;width:130px;font-family:inherit;transition:all .2s; }
.a-ket:focus { border-color:var(--a-primary);box-shadow:0 0 0 3px rgba(14,165,233,.12); }

/* QR */
.a-qr-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:12px;padding:16px; }
.a-qr-card { background:var(--a-card);border:1px solid var(--a-border);border-radius:10px;padding:14px 10px;text-align:center;transition:all .2s; }
.a-qr-card:hover { border-color:var(--a-primary);box-shadow:var(--a-shadow-lg); }
.a-qr-card img { width:100px;height:100px;margin:0 auto 8px;border-radius:6px;display:block; }
.a-qr-name { font-size:12px;font-weight:600;color:var(--a-text); }
.a-qr-reg { font-size:10px;color:var(--a-text-secondary); }

/* Empty state */
.a-empty { text-align:center;padding:60px 20px;color:var(--a-text-secondary); }
.a-empty i { font-size:40px;margin-bottom:12px;color:#d1d5db;display:block; }
.a-empty p { font-size:14px; }

/* Toast */
.a-toast { position:fixed;top:20px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:8px; }
.a-toast-item { display:flex;align-items:center;gap:12px;padding:12px 18px;border-radius:10px;box-shadow:0 10px 25px -5px rgba(0,0,0,.1);animation:aslideIn .3s;min-width:300px;max-width:420px;border:1px solid; }
.a-toast-item.success { background:#f0fdf4;border-color:#bbf7d0;color:#166534; }
.a-toast-item.error { background:#fef2f2;border-color:#fecaca;color:#991b1b; }
.a-toast-icon { font-size:17px; }
.a-toast-body { flex:1; }
.a-toast-title { font-weight:700;font-size:13px; }
.a-toast-msg { font-size:12px;opacity:.9;margin-top:1px; }
.a-toast-close { width:22px;height:22px;border-radius:6px;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;opacity:.5;transition:all .2s; }
.a-toast-close:hover { opacity:1;background:rgba(0,0,0,.05); }

/* Scanner */
#scannerContainer { max-width:480px;margin:0 auto 20px;border-radius:var(--a-radius);overflow:hidden; }

/* Tab content */
.a-tc { display:none; }
.a-tc.active { display:block;animation:afadeUp .35s ease; }

@keyframes afadeUp { from { opacity:0;transform:translateY(10px); } to { opacity:1;transform:translateY(0); } }
@keyframes aslideIn { from { opacity:0;transform:translateX(50px); } to { opacity:1;transform:translateX(0); } }

@media(max-width:768px){
    .a-stats { grid-template-columns:repeat(3,1fr); }
    .a-filter-inner { flex-direction:column;align-items:stretch; }
    .a-filter-group { flex-direction:column;align-items:stretch; }
    .a-filter-input,.a-filter-select { min-width:0; }
    .a-filter-actions { margin-left:0; }
    .a-table { font-size:12px; }
    .a-table th,.a-table td { padding:8px 10px; }
    .a-qr-grid { grid-template-columns:repeat(3,1fr); }
    .a-srad { gap:3px; }
    .a-srad label { padding:3px 8px;font-size:10px; }
    .a-ket { width:100px; }
}

@media(max-width:480px){
    .a-stats { grid-template-columns:repeat(2,1fr); }
    .a-qr-grid { grid-template-columns:repeat(2,1fr); }
}
</style>

{{-- Toast from session --}}
@if(session('success'))
<div class="a-toast" id="toastContainer">
    <div class="a-toast-item success">
        <i class="a-toast-icon fa-regular fa-circle-check"></i>
        <div class="a-toast-body">
            <div class="a-toast-title">Berhasil</div>
            <div class="a-toast-msg">{{ session('success') }}</div>
        </div>
        @if(session('wa_terkirim'))
        <div style="display:flex;align-items:center;gap:6px;color:#059669;font-size:13px;font-weight:600;white-space:nowrap;margin-right:4px;"><i class="fa-brands fa-whatsapp"></i> Terkirim</div>
        @elseif(session('wa_url'))
        <a href="{{ session('wa_url') }}" target="_blank" class="a-btn a-btn-green a-btn-sm" style="text-decoration:none;white-space:nowrap;margin-right:4px;"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        @endif
        <button class="a-toast-close" onclick="this.parentElement.remove()">&times;</button>
    </div>
</div>
@endif

{{-- STATS --}}
<div class="a-stats">
    <div class="a-stat">
        <div class="a-stat-icon i1"><i class="fa-solid fa-users"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Total Santri</div>
            <div class="a-stat-value">{{ $stats['total'] }}</div>
        </div>
    </div>
    <div class="a-stat">
        <div class="a-stat-icon i2"><i class="fa-solid fa-check"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Hadir</div>
            <div class="a-stat-value">{{ $stats['hadir'] }}</div>
        </div>
    </div>
    <div class="a-stat">
        <div class="a-stat-icon i3"><i class="fa-solid fa-pen"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Izin</div>
            <div class="a-stat-value">{{ $stats['izin'] }}</div>
        </div>
    </div>
    <div class="a-stat">
        <div class="a-stat-icon i4"><i class="fa-solid fa-bed"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Sakit</div>
            <div class="a-stat-value">{{ $stats['sakit'] }}</div>
        </div>
    </div>
    <div class="a-stat">
        <div class="a-stat-icon i5"><i class="fa-solid fa-xmark"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Alpha</div>
            <div class="a-stat-value">{{ $stats['alpha'] }}</div>
        </div>
    </div>
    <div class="a-stat">
        <div class="a-stat-icon i6"><i class="fa-solid fa-clock"></i></div>
        <div class="a-stat-body">
            <div class="a-stat-label">Belum Absen</div>
            <div class="a-stat-value">{{ $stats['belum_absen'] }}</div>
        </div>
    </div>
</div>

{{-- TABS --}}
@php $tab = $tab ?? 'manual'; @endphp
<div class="a-tabs">
    <a href="{{ route('admin.absensi') }}" class="a-tab {{ $tab === 'manual' ? 'active' : '' }}"><i class="fa-solid fa-hand"></i> Manual</a>
    <a href="{{ route('admin.absensi', ['tab' => 'qr']) }}" class="a-tab {{ $tab === 'qr' ? 'active' : '' }}"><i class="fa-solid fa-qrcode"></i> QR Code</a>
    <a href="{{ route('admin.absensi.recap') }}" class="a-tab {{ $tab === 'recap' ? 'active' : '' }}"><i class="fa-solid fa-chart-simple"></i> Rekap</a>
</div>

{{-- ============= MANUAL ============= --}}
<div class="a-tc {{ $tab === 'manual' ? 'active' : '' }}">
    <form action="{{ route('admin.absensi.filter') }}" method="GET">
        <div class="a-filter">
            <div class="a-filter-inner">
                <div class="a-filter-group">
                    <span class="a-filter-label"><i class="fa-regular fa-calendar"></i> Tanggal</span>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" required class="a-filter-input">
                </div>
                <div class="a-filter-group">
                    <span class="a-filter-label"><i class="fa-solid fa-layer-group"></i> Kelas</span>
                    <select name="kelas" class="a-filter-select" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelasList as $k)
                        <option value="{{ $k->nama_kelas }}" {{ ($kelasDipilih ?? '') == $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="a-filter-actions">
                    <button type="submit" class="a-btn a-btn-primary"><i class="fa-solid fa-search"></i> Tampilkan</button>
                </div>
            </div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid var(--a-border);display:flex;gap:12px;flex-wrap:wrap;font-size:13px;">
                <a href="{{ route('admin.santri') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-child-reaching"></i> Data Santri</a>
                <a href="{{ route('admin.kelas') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-people-group"></i> Data Kelas</a>
                <a href="{{ route('admin.jadwal') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-regular fa-calendar-days"></i> Jadwal</a>
            </div>
        </div>
    </form>

    @if(isset($kelasDipilih) && $kelasDipilih && isset($santri) && $santri->count() > 0)
    <form action="{{ route('admin.absensi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        <input type="hidden" name="kelas" value="{{ $kelasDipilih }}">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:8px;">
                <label style="font-size:12px;font-weight:600;color:var(--a-text-secondary);text-transform:uppercase;letter-spacing:.4px;"><i class="fa-solid fa-book"></i> Mapel</label>
                <select name="mapel" class="a-filter-select" style="min-width:160px;">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($mapelList as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div style="font-size:11px;color:var(--a-text-secondary);"><i class="fa-solid fa-info-circle"></i> Mapel opsional untuk laporan WhatsApp</div>
        </div>
        <div class="a-card">
            <div class="a-card-header">
                <h3><i class="fa-solid fa-clipboard-check"></i> Daftar Santri — {{ $kelasDipilih }}</h3>
                <button type="submit" class="a-btn a-btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
            <div class="a-table-scroll">
                <table class="a-table">
                    <thead>
                        <tr><th>No</th><th>Nama Santri</th><th style="text-align:center;">Status</th><th>Keterangan</th></tr>
                    </thead>
                    <tbody>
                        @php $colors = ['#0ea5e9','#10b981','#f59e0b','#ef4444','#8b5cf6','#ec4899','#14b8a6','#f97316']; @endphp
                        @foreach($santri as $i => $s)
                        @php
                            $absen = $absensiHarian->get($s->id);
                            $st = $absen->status ?? 'hadir';
                            $k = $absen->keterangan ?? '';
                            $c = $colors[$i % count($colors)];
                        @endphp
                        <tr>
                            <td style="text-align:center;color:var(--a-text-secondary);">{{ $i + 1 }}</td>
                            <td>
                                <div class="a-santri">
                                    <div class="a-avatar" style="background:{{ $c }};">{{ strtoupper(substr($s->nama, 0, 1)) }}</div>
                                    <div class="a-santri-info">
                                        <div class="a-santri-name">{{ $s->nama }}</div>
                                        <div class="a-santri-reg">{{ $s->no_registrasi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:center;">
                                <div class="a-srad" style="justify-content:center;">
                                    @foreach(['hadir','izin','sakit','alpha'] as $stt)
                                    <label class="{{ substr($stt,0,1) }} {{ $st === $stt ? 'active' : '' }}">
                                        <input type="radio" name="absensi[{{ $s->id }}][status]" value="{{ $stt }}" {{ $st === $stt ? 'checked' : '' }}
                                            onchange="this.closest('.a-srad').querySelectorAll('label').forEach(function(l){l.classList.remove('active')});this.parentElement.classList.add('active')">
                                        {{ $stt === 'hadir' ? 'H' : ($stt === 'izin' ? 'I' : ($stt === 'sakit' ? 'S' : 'A')) }}
                                    </label>
                                    @endforeach
                                </div>
                            </td>
                            <td style="text-align:center;"><input type="text" name="absensi[{{ $s->id }}][keterangan]" class="a-ket" placeholder="Catatan" value="{{ $k }}" maxlength="255"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    @elseif(isset($kelasDipilih) && $kelasDipilih)
    <div class="a-empty"><i class="fa-solid fa-users-slash"></i><p>Tidak ada santri aktif di kelas <strong>{{ $kelasDipilih }}</strong></p></div>
    @else
    <div class="a-empty"><i class="fa-solid fa-hand-pointer"></i><p>Pilih tanggal dan kelas, lalu klik <strong>Tampilkan</strong></p></div>
    @endif
</div>

{{-- ============= QR CODE ============= --}}
<div class="a-tc {{ $tab === 'qr' ? 'active' : '' }}">
    <div class="a-filter">
        <div class="a-filter-inner">
            <div class="a-filter-group">
                <span class="a-filter-label"><i class="fa-solid fa-layer-group"></i> Kelas</span>
                <form method="GET" action="{{ route('admin.absensi') }}" id="qrForm">
                    <input type="hidden" name="tab" value="qr">
                    <select name="kelas" class="a-filter-select" onchange="this.form.submit()">
                        @foreach($qrKelasList as $k)
                        <option value="{{ $k->nama_kelas }}" {{ $qrKelas === $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="a-filter-actions">
                <button type="button" class="a-btn a-btn-primary" id="startScanner"><i class="fa-solid fa-camera"></i> Mulai Scan</button>
                <button type="button" class="a-btn a-btn-ghost" id="stopScanner" style="display:none;"><i class="fa-solid fa-stop"></i> Stop</button>
            </div>
        </div>
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid var(--a-border);display:flex;gap:12px;flex-wrap:wrap;font-size:13px;">
            <a href="{{ route('admin.santri') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-child-reaching"></i> Data Santri</a>
            <a href="{{ route('admin.kelas') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-people-group"></i> Data Kelas</a>
        </div>
    </div>

    <div id="scannerContainer" style="display:none;"></div>

    <div id="scanResult" style="display:none;">
        <div class="a-card">
            <div class="a-card-header">
                <h3><i class="fa-solid fa-clock"></i> Hasil Scan Hari Ini</h3>
                <span id="scanCount" style="font-size:13px;color:var(--a-text-secondary);">0 santri</span>
            </div>
            <div class="a-table-scroll">
                <table class="a-table" id="scanTable">
                    <thead><tr><th style="text-align:center;">No</th><th>Nama Santri</th><th style="text-align:center;">Status</th><th>Waktu</th></tr></thead>
                    <tbody id="scanBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    @if($qrSantri->count() > 0)
    <div class="a-card">
        <div class="a-card-header">
            <h3><i class="fa-solid fa-qrcode"></i> QR Code Santri — {{ $qrKelas }}</h3>
            <button class="a-btn a-btn-ghost a-btn-sm" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
        <div class="a-qr-grid">
            @foreach($qrSantri as $s)
            @php
                $qrUrl = route('admin.absensi.qr', $s->id);
                $qrImg = 'https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' . urlencode($qrUrl);
            @endphp
            <div class="a-qr-card">
                <img src="{{ $qrImg }}" alt="QR {{ $s->nama }}" loading="lazy">
                <div class="a-qr-name">{{ $s->nama }}</div>
                <div class="a-qr-reg">{{ $s->no_registrasi }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="a-empty"><i class="fa-solid fa-qrcode"></i><p>Tidak ada santri di kelas ini</p></div>
    @endif
</div>

{{-- ============= REKAP ============= --}}
<div class="a-tc {{ $tab === 'recap' ? 'active' : '' }}">
    <form action="{{ route('admin.absensi.recap') }}" method="GET">
        <div class="a-filter">
            <div class="a-filter-inner">
                <div class="a-filter-group">
                    <span class="a-filter-label"><i class="fa-regular fa-calendar"></i> Dari</span>
                    <input type="date" name="tanggal_awal" value="{{ $tanggalAwal ?? now()->startOfMonth()->toDateString() }}" required class="a-filter-input">
                </div>
                <div class="a-filter-group">
                    <span class="a-filter-label"><i class="fa-regular fa-calendar"></i> Sampai</span>
                    <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir ?? now()->toDateString() }}" required class="a-filter-input">
                </div>
                <div class="a-filter-group">
                    <span class="a-filter-label"><i class="fa-solid fa-layer-group"></i> Kelas</span>
                    <select name="kelas" class="a-filter-select">
                        <option value="">Semua</option>
                        @foreach($kelasList as $k)
                        <option value="{{ $k->nama_kelas }}" {{ (request('kelas') ?? '') === $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="a-filter-actions">
                    <button type="submit" class="a-btn a-btn-primary"><i class="fa-solid fa-search"></i> Tampilkan</button>
                </div>
            </div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid var(--a-border);display:flex;gap:12px;flex-wrap:wrap;font-size:13px;">
                <a href="{{ route('admin.santri') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-child-reaching"></i> Data Santri</a>
                <a href="{{ route('admin.kelas') }}" class="a-btn a-btn-ghost a-btn-sm" style="text-decoration:none;"><i class="fa-solid fa-people-group"></i> Data Kelas</a>
            </div>
        </div>
    </form>

    @if(isset($absensi) && $absensi->count() > 0)
    @php
        $msg = "Rekap Absensi%0APeriode: $tanggalAwal s/d $tanggalAkhir%0A%0A";
        $grouped = $absensi->groupBy('tanggal');
        foreach ($grouped as $tgl => $list) {
            $msg .= date('d/m/Y', strtotime($tgl)) . ":%0A";
            foreach ($list as $a) { $msg .= '  - ' . ($a->santri->nama ?? '-') . ': ' . ucfirst($a->status) . "%0A"; }
        }
    @endphp
    <div class="a-card">
        <div class="a-card-header">
            <h3><i class="fa-solid fa-chart-simple"></i> Rekap Absensi</h3>
            <div style="display:flex;align-items:center;gap:10px;">
                <span style="font-size:13px;color:var(--a-text-secondary);">{{ $absensi->count() }} data</span>
                <a href="https://wa.me/?text={{ $msg }}" target="_blank" class="a-btn a-btn-green a-btn-sm"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
            </div>
        </div>
        <div class="a-table-scroll">
            <table class="a-table">
                <thead>
                    <tr><th style="text-align:center;">No</th><th>Nama Santri</th><th>Kelas</th><th>Tanggal</th><th style="text-align:center;">Status</th><th>Ket.</th></tr>
                </thead>
                <tbody>
                    @foreach($absensi as $i => $a)
                    <tr>
                        <td style="text-align:center;color:var(--a-text-secondary);">{{ $i + 1 }}</td>
                        <td>
                            <div class="a-santri">
                                <div class="a-avatar" style="background:#0ea5e9;">{{ strtoupper(substr($a->santri->nama ?? '?', 0, 1)) }}</div>
                                <div class="a-santri-info">
                                    <div class="a-santri-name">{{ $a->santri->nama ?? '-' }}</div>
                                    <div class="a-santri-reg">{{ $a->santri->no_registrasi ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center;">{{ $a->santri->kelas ?? '-' }}</td>
                        <td style="text-align:center;">{{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('D MMM YYYY') }}</td>
                        <td style="text-align:center;"><span class="a-badge {{ substr($a->status,0,1) }}">{{ ucfirst($a->status) }}</span></td>
                        <td style="color:var(--a-text-secondary);text-align:center;">{{ $a->keterangan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @elseif(isset($absensi))
    <div class="a-empty"><i class="fa-solid fa-chart-simple"></i><p>Tidak ada data untuk periode tersebut</p></div>
    @else
    <div class="a-empty"><i class="fa-solid fa-chart-simple"></i><p>Pilih periode lalu klik <strong>Tampilkan</strong></p></div>
    @endif
</div>

<script src="{{ asset('assets/html5-qrcode.min.js') }}" type="text/javascript"></script>
<script>
// Auto-hide toast
var toastContainer = document.getElementById('toastContainer');
if (toastContainer) {
    setTimeout(function() {
        toastContainer.style.opacity = '0';
        toastContainer.style.transform = 'translateX(50px)';
        toastContainer.style.transition = 'all .3s';
        setTimeout(function() { if (toastContainer.parentNode) toastContainer.remove(); }, 300);
    }, 4000);
}

// QR Scanner
(function() {
    var scanner = null;
    var scannedIds = {};
    var santriMap = {
        @foreach($qrSantri as $s)
        "{{ $s->id }}": {"nama": "{{ $s->nama }}", "reg": "{{ $s->no_registrasi }}"},
        @endforeach
    };

    function loadScanned() {
        var saved = localStorage.getItem('absensi_scanned_' + '{{ $tanggal }}');
        if (saved) {
            try { scannedIds = JSON.parse(saved); } catch(e) { scannedIds = {}; }
        }
        renderScanned();
    }

    function saveScanned() {
        localStorage.setItem('absensi_scanned_' + '{{ $tanggal }}', JSON.stringify(scannedIds));
    }

    function renderScanned() {
        var tbody = document.getElementById('scanBody');
        var ids = Object.keys(scannedIds);
        if (ids.length === 0) {
            document.getElementById('scanResult').style.display = 'none';
            return;
        }
        document.getElementById('scanResult').style.display = '';
        document.getElementById('scanCount').textContent = ids.length + ' santri';

        var html = '';
        var colors = ['#0ea5e9','#10b981','#f59e0b','#ef4444','#8b5cf6','#ec4899','#14b8a6','#f97316'];
        ids.forEach(function(id, i) {
            var d = scannedIds[id];
            var initial = (d.nama || '?').substring(0, 1);
            var c = colors[i % colors.length];
            html += '<tr>' +
                '<td style="text-align:center;color:var(--a-text-secondary);">' + (i + 1) + '</td>' +
                '<td><div class="a-santri"><div class="a-avatar" style="background:' + c + ';">' + initial + '</div><div class="a-santri-info"><div class="a-santri-name">' + d.nama + '</div><div class="a-santri-reg">' + (d.reg || '') + '</div></div></div></td>' +
                '<td style="text-align:center;"><span class="a-badge h">Hadir</span></td>' +
                '<td style="color:var(--a-text-secondary);text-align:center;">' + (d.waktu || '') + '</td>' +
            '</tr>';
        });
        tbody.innerHTML = html;
    }

    function onScanSuccess(qrData) {
        try {
            var parts = qrData.split('/');
            var santriId = parts[parts.length - 1];
            if (!santriId || santriId === '' || scannedIds[santriId]) return;

            fetch('/admin/absensi/qr/' + santriId)
                .then(function(r) { return r.text(); })
                .then(function() {
                    var now = new Date();
                    var jam = String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');
                    var data = santriMap[santriId] || { nama: 'Santri #' + santriId, reg: '' };

                    scannedIds[santriId] = { nama: data.nama, reg: data.reg, waktu: jam };
                    saveScanned();
                    renderScanned();
                });
        } catch(e) {}
    }

    document.getElementById('startScanner').addEventListener('click', function() {
        var container = document.getElementById('scannerContainer');
        container.style.display = '';

        if (!scanner) {
            scanner = new Html5Qrcode('scannerContainer');
        }

        this.style.display = 'none';
        document.getElementById('stopScanner').style.display = '';
        loadScanned();

        scanner.start(
            { facingMode: 'environment' },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            onScanSuccess
        ).catch(function(err) {
            container.innerHTML = '<div class="a-empty"><i class="fa-solid fa-camera-slash"></i><p>Tidak dapat mengakses kamera: ' + err + '</p></div>';
            document.getElementById('startScanner').style.display = '';
            document.getElementById('stopScanner').style.display = 'none';
        });
    });

    document.getElementById('stopScanner').addEventListener('click', function() {
        if (scanner) {
            scanner.stop().then(function() {
                document.getElementById('scannerContainer').style.display = 'none';
                document.getElementById('startScanner').style.display = '';
                this.style.display = 'none';
            }.bind(this)).catch(function() {});
        }
        this.style.display = 'none';
        document.getElementById('startScanner').style.display = '';
    });

    loadScanned();
})();

// Close toast
document.querySelectorAll('.a-toast-close').forEach(function(el) {
    el.addEventListener('click', function() { this.parentElement.remove(); });
});
</script>

</x-admin-layout>
