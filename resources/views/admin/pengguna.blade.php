<x-admin-layout>
    <x-slot name="title">Data Pengguna</x-slot>
    @section('header_title', 'Data Pengguna')
    @section('header_subtitle', 'Kelola pengguna dan hak akses sistem')

<style>
:root {
    --p-primary: #6366f1;
    --p-primary-light: #818cf8;
    --p-primary-dark: #4f46e5;
    --p-bg: #f8fafc;
    --p-card: #ffffff;
    --p-border: #e2e8f0;
    --p-text: #1e293b;
    --p-text-secondary: #64748b;
    --p-shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --p-shadow-lg: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -2px rgba(0,0,0,.04);
    --p-radius: 12px;
}

/* Stats */
.p-stats { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px; }
.p-stat { background:var(--p-card);border-radius:var(--p-radius);padding:20px 24px;box-shadow:var(--p-shadow);display:flex;align-items:center;gap:16px;transition:all .25s;border:1px solid var(--p-border);position:relative;overflow:hidden; }
.p-stat:hover { transform:translateY(-2px);box-shadow:var(--p-shadow-lg); }
.p-stat-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0; }
.p-stat-icon.i1 { background:linear-gradient(135deg,#6366f1,#818cf8);color:#fff; }
.p-stat-icon.i2 { background:linear-gradient(135deg,#0ea5e9,#38bdf8);color:#fff; }
.p-stat-icon.i3 { background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff; }
.p-stat-icon.i4 { background:linear-gradient(135deg,#10b981,#34d399);color:#fff; }
.p-stat-body { flex:1;min-width:0; }
.p-stat-label { font-size:13px;color:var(--p-text-secondary);margin-bottom:2px;font-weight:500; }
.p-stat-value { font-size:26px;font-weight:700;color:var(--p-text);line-height:1.2; }
.p-stat-sub { font-size:12px;color:var(--p-text-secondary);margin-top:2px; }
.p-stat:after { content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:50%;background:currentColor;opacity:.03;transform:translate(30%,-30%); }

/* Toolbar */
.p-toolbar { background:var(--p-card);border-radius:var(--p-radius);padding:16px 20px;box-shadow:var(--p-shadow);border:1px solid var(--p-border);margin-bottom:20px;display:flex;flex-wrap:wrap;align-items:center;gap:12px; }
.p-search-wrap { position:relative;flex:1;min-width:200px; }
.p-search-wrap i { position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px; }
.p-search { width:100%;padding:9px 12px 9px 34px;border:1px solid var(--p-border);border-radius:8px;font-size:14px;outline:none;background:#f8fafc;transition:all .2s;font-family:inherit; }
.p-search:focus { border-color:var(--p-primary);background:#fff;box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.p-filter-select { padding:9px 32px 9px 12px;border:1px solid var(--p-border);border-radius:8px;font-size:14px;outline:none;background:#f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 10px center;cursor:pointer;transition:all .2s;font-family:inherit;appearance:none;min-width:130px; }
.p-filter-select:focus { border-color:var(--p-primary);background-color:#fff;box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.p-btn { display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;border:none;font-family:inherit;text-decoration:none;white-space:nowrap; }
.p-btn-primary { background:linear-gradient(135deg,var(--p-primary),var(--p-primary-dark));color:#fff;box-shadow:0 4px 6px rgba(99,102,241,.25); }
.p-btn-primary:hover { transform:translateY(-1px);box-shadow:0 6px 12px rgba(99,102,241,.35); }
.p-btn-secondary { background:#f1f5f9;color:var(--p-text); }
.p-btn-secondary:hover { background:#e2e8f0; }
.p-btn-sm { padding:6px 12px;font-size:13px; }

/* Table */
.p-card { background:var(--p-card);border-radius:var(--p-radius);box-shadow:var(--p-shadow);border:1px solid var(--p-border);overflow:hidden; }
.p-card-header { padding:16px 20px;border-bottom:1px solid var(--p-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px; }
.p-card-header h3 { margin:0;font-size:15px;font-weight:700;color:var(--p-text);display:flex;align-items:center;gap:8px; }
.p-card-header h3 i { color:var(--p-primary); }
.p-table-scroll { overflow-x:auto; }
.p-table { width:100%;border-collapse:collapse;font-size:14px; }
.p-table thead { background:#f8fafc; }
.p-table th { padding:12px 16px;text-align:center;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;color:var(--p-text-secondary);border-bottom:2px solid var(--p-border);white-space:nowrap; }
.p-table td { padding:12px 16px;border-bottom:1px solid var(--p-border);color:var(--p-text);vertical-align:middle; }
.p-table tbody tr { transition:background .15s; }
.p-table tbody tr:hover { background:#f8fafc; }
.p-table tbody tr:last-child td { border-bottom:none; }

/* User avatar */
.p-user { display:flex;align-items:center;gap:12px; }
.p-avatar { width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;color:#fff;flex-shrink:0;overflow:hidden;background:linear-gradient(135deg,var(--a1, #6366f1),var(--a2, #818cf8)); }
.p-avatar img { width:100%;height:100%;object-fit:cover; }
.p-user-info { }
.p-user-name { font-weight:600;color:var(--p-text); }
.p-user-email { font-size:12px;color:var(--p-text-secondary);margin-top:1px; }

/* Role badges */
.p-role { display:inline-flex;align-items:center;gap:4px;padding:3px 12px;border-radius:20px;font-size:12px;font-weight:600;letter-spacing:.3px; }
.p-role.admin { background:#eef2ff;color:#4f46e5; }
.p-role.operator { background:#fef3c7;color:#d97706; }
.p-role.user { background:#f0fdf4;color:#16a34a; }

/* Status dots */
.p-status { display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:500; }
.p-dot { width:8px;height:8px;border-radius:50%;display:inline-block; }
.p-dot.aktif { background:#10b981;box-shadow:0 0 0 3px rgba(16,185,129,.15); }
.p-dot.tidak-aktif { background:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.15); }

/* Action buttons */
.p-actions { display:flex;gap:4px; }
.p-action { width:32px;height:32px;border-radius:8px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:13px;transition:all .2s;background:transparent;color:#94a3b8; }
.p-action:hover { background:#f1f5f9; }
.p-action.view:hover { color:#6366f1;background:#eef2ff; }
.p-action.edit:hover { color:#0ea5e9;background:#e0f2fe; }
.p-action.delete:hover { color:#ef4444;background:#fef2f2; }

/* Pagination info */
.p-footer { padding:14px 20px;border-top:1px solid var(--p-border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;font-size:13px;color:var(--p-text-secondary); }

/* Modal */
.p-overlay { position:fixed;inset:0;background:rgba(15,23,42,.5);backdrop-filter:blur(4px);z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;animation:fadeIn .2s; }
.p-overlay.show { display:flex; }
.p-modal { background:#fff;border-radius:16px;width:100%;max-width:520px;max-height:90vh;overflow-y:auto;box-shadow:0 25px 50px -12px rgba(0,0,0,.25);animation:slideUp .3s; }
.p-modal-lg { max-width:600px; }
.p-modal-header { padding:20px 24px 0;display:flex;align-items:center;justify-content:space-between; }
.p-modal-header h3 { margin:0;font-size:18px;font-weight:700;color:var(--p-text);display:flex;align-items:center;gap:8px; }
.p-modal-close { width:32px;height:32px;border-radius:8px;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;color:#64748b;transition:all .2s; }
.p-modal-close:hover { background:#e2e8f0;color:var(--p-text); }
.p-modal-body { padding:20px 24px; }
.p-modal-footer { padding:0 24px 20px;display:flex;justify-content:flex-end;gap:8px; }

/* Form */
.p-form { }
.p-form-row { display:grid;grid-template-columns:1fr 1fr;gap:16px; }
.p-form-group { margin-bottom:16px; }
.p-form-group.full { grid-column:1/-1; }
.p-form-label { display:block;font-size:13px;font-weight:600;color:var(--p-text);margin-bottom:6px; }
.p-form-label span { color:#ef4444; }
.p-form-control { width:100%;padding:10px 12px;border:1px solid var(--p-border);border-radius:8px;font-size:14px;outline:none;transition:all .2s;font-family:inherit;background:#fff;box-sizing:border-box; }
.p-form-control:focus { border-color:var(--p-primary);box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.p-form-control.error { border-color:#ef4444; }
.p-form-select { padding:10px 32px 10px 12px;border:1px solid var(--p-border);border-radius:8px;font-size:14px;outline:none;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 10px center;cursor:pointer;transition:all .2s;font-family:inherit;appearance:none;width:100%;box-sizing:border-box; }
.p-form-select:focus { border-color:var(--p-primary);box-shadow:0 0 0 3px rgba(99,102,241,.12); }

/* Detail */
.p-detail { display:grid;grid-template-columns:1fr 1fr;gap:16px;font-size:14px; }
.p-detail-item { }
.p-detail-label { font-size:12px;font-weight:600;color:var(--p-text-secondary);margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px; }
.p-detail-value { color:var(--p-text);word-break:break-word; }

/* Delete */
.p-delete-icon { width:56px;height:56px;border-radius:16px;background:#fef2f2;display:flex;align-items:center;justify-content:center;font-size:24px;color:#ef4444;margin:0 auto 16px; }
.p-delete-text { text-align:center;font-size:15px;color:var(--p-text-secondary);margin-bottom:4px; }
.p-delete-name { text-align:center;font-size:16px;font-weight:700;color:var(--p-text); }

/* Toast */
.p-toast { position:fixed;top:20px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:8px; }
.p-toast-item { display:flex;align-items:center;gap:12px;padding:14px 18px;border-radius:12px;box-shadow:0 10px 25px -5px rgba(0,0,0,.1);animation:slideIn .3s;min-width:320px;max-width:420px;border:1px solid; }
.p-toast-item.success { background:#f0fdf4;border-color:#bbf7d0;color:#166534; }
.p-toast-item.error { background:#fef2f2;border-color:#fecaca;color:#991b1b; }
.p-toast-icon { font-size:18px; }
.p-toast-body { flex:1; }
.p-toast-title { font-weight:700;font-size:14px; }
.p-toast-msg { font-size:13px;opacity:.9;margin-top:1px; }
.p-toast-close { width:24px;height:24px;border-radius:6px;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;opacity:.5;transition:all .2s; }
.p-toast-close:hover { opacity:1;background:rgba(0,0,0,.05); }

@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes slideUp { from { opacity:0;transform:translateY(20px) scale(.97); } to { opacity:1;transform:translateY(0) scale(1); } }
@keyframes slideIn { from { opacity:0;transform:translateX(50px); } to { opacity:1;transform:translateX(0); } }

/* Responsive */
@media(max-width:768px){
    .p-stats { grid-template-columns:repeat(2,1fr); }
    .p-toolbar { flex-direction:column; }
    .p-search-wrap { width:100%; }
    .p-form-row { grid-template-columns:1fr; }
    .p-modal { max-width:100%;margin:10px; }
    .p-table { font-size:13px; }
    .p-table th,.p-table td { padding:10px 12px; }
}
</style>

<div class="p-stats">
    <div class="p-stat">
        <div class="p-stat-icon i1"><i class="fa-solid fa-users"></i></div>
        <div class="p-stat-body">
            <div class="p-stat-label">Total Pengguna</div>
            <div class="p-stat-value">{{ $totalUsers }}</div>
            <div class="p-stat-sub">Semua akun terdaftar</div>
        </div>
    </div>
    <div class="p-stat">
        <div class="p-stat-icon i2"><i class="fa-solid fa-shield-halved"></i></div>
        <div class="p-stat-body">
            <div class="p-stat-label">Administrator</div>
            <div class="p-stat-value">{{ $totalAdmin }}</div>
            <div class="p-stat-sub">Akses penuh sistem</div>
        </div>
    </div>
    <div class="p-stat">
        <div class="p-stat-icon i3"><i class="fa-solid fa-user-gear"></i></div>
        <div class="p-stat-body">
            <div class="p-stat-label">Operator</div>
            <div class="p-stat-value">{{ $totalOperator }}</div>
            <div class="p-stat-sub">Akses terbatas</div>
        </div>
    </div>
    <div class="p-stat">
        <div class="p-stat-icon i4"><i class="fa-solid fa-circle-check"></i></div>
        <div class="p-stat-body">
            <div class="p-stat-label">Aktif</div>
            <div class="p-stat-value">{{ $totalAktif }}</div>
            <div class="p-stat-sub">Pengguna aktif</div>
        </div>
    </div>
</div>

<div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap;">
    <a href="{{ route('admin.pengaturan') }}" style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;background:#f1f5f9;color:var(--p-text);text-decoration:none;transition:all .2s;"><i class="fa-solid fa-gear"></i> Pengaturan</a>
</div>

<div class="p-toolbar">
    <div class="p-search-wrap">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" class="p-search" id="searchInput" placeholder="Cari nama atau email..." oninput="filterTable()">
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <select class="p-filter-select" id="filterRole" onchange="filterTable()">
            <option value="">Semua Role</option>
            <option value="admin">Administrator</option>
            <option value="operator">Operator</option>
            <option value="user">User</option>
        </select>
        <select class="p-filter-select" id="filterStatus" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="tidak-aktif">Tidak Aktif</option>
        </select>
        <button class="p-btn p-btn-secondary p-btn-sm" onclick="resetFilter()"><i class="fa-solid fa-rotate-left"></i> Reset</button>
        <button class="p-btn p-btn-primary" onclick="openCreateModal()"><i class="fa-solid fa-plus"></i> Tambah</button>
    </div>
</div>

<div class="p-card">
    <div class="p-card-header">
        <h3><i class="fa-solid fa-users-gear"></i> Daftar Pengguna</h3>
        <span style="font-size:13px;color:var(--p-text-secondary);">{{ $totalUsers }} pengguna ditemukan</span>
    </div>
    <div class="p-table-scroll">
        <table class="p-table" id="userTable">
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>No. HP</th>
                    <th>Terdaftar</th>
                    <th style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td style="text-align:center;color:var(--p-text-secondary);">{{ $i + 1 }}</td>
                    <td>
                        <div class="p-user">
                            <div class="p-avatar" style="--a1: {{ ['#6366f1','#0ea5e9','#f59e0b','#10b981','#ef4444','#8b5cf6','#ec4899','#14b8a6'][$i % 8] }}; --a2: {{ ['#818cf8','#38bdf8','#fbbf24','#34d399','#f87171','#a78bfa','#f472b6','#2dd4bf'][$i % 8] }};">
                                @if($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <div class="p-user-info">
                                <div class="p-user-name">{{ $user->name }}</div>
                                <div class="p-user-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="text-align:center;"><span class="p-role {{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td style="text-align:center;">
                        <span class="p-status">
                            <span class="p-dot {{ $user->status }}"></span>
                            {{ $user->status === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td style="color:var(--p-text-secondary);text-align:center;">{{ $user->no_hp ?? '-' }}</td>
                    <td style="color:var(--p-text-secondary);font-size:13px;text-align:center;">{{ $user->created_at->isoFormat('D MMM Y') }}</td>
                    <td>
                        <div class="p-actions">
                            <button class="p-action view" onclick="openDetailModal({{ $user->id }})" title="Detail"><i class="fa-regular fa-eye"></i></button>
                            <button class="p-action edit" onclick="openEditModal({{ $user->id }})" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                            <button class="p-action delete" onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')" title="Hapus"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--p-text-secondary);">
                        <i class="fa-solid fa-users-slash" style="font-size:32px;margin-bottom:12px;display:block;opacity:.4;"></i>
                        Belum ada pengguna
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-footer">
        <span>Menampilkan {{ $users->count() }} pengguna</span>
    </div>
</div>

{{-- Create Modal --}}
<div class="p-overlay" id="createModal">
    <div class="p-modal">
        <div class="p-modal-header">
            <h3><i class="fa-solid fa-user-plus"></i> Tambah Pengguna</h3>
            <button class="p-modal-close" onclick="closeCreateModal()">&times;</button>
        </div>
        <form action="{{ route('admin.pengguna.store') }}" method="POST" class="p-form">
            @csrf
            <div class="p-modal-body">
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Nama Lengkap <span>*</span></label>
                        <input type="text" name="name" class="p-form-control" required placeholder="Masukkan nama">
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">Email <span>*</span></label>
                        <input type="email" name="email" class="p-form-control" required placeholder="contoh@email.com">
                    </div>
                </div>
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Password <span>*</span></label>
                        <input type="password" name="password" class="p-form-control" required placeholder="Min. 6 karakter">
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">No. HP</label>
                        <input type="text" name="no_hp" class="p-form-control" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Role <span>*</span></label>
                        <select name="role" class="p-form-select" required>
                            <option value="operator">Operator</option>
                            <option value="admin">Administrator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">Status <span>*</span></label>
                        <select name="status" class="p-form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak-aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-modal-footer">
                <button type="button" class="p-btn p-btn-secondary" onclick="closeCreateModal()">Batal</button>
                <button type="submit" class="p-btn p-btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div class="p-overlay" id="editModal">
    <div class="p-modal">
        <div class="p-modal-header">
            <h3><i class="fa-solid fa-user-pen"></i> Edit Pengguna</h3>
            <button class="p-modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <form action="#" method="POST" class="p-form" id="editForm">
            @csrf
            @method('PUT')
            <div class="p-modal-body">
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Nama Lengkap <span>*</span></label>
                        <input type="text" name="name" id="edit_name" class="p-form-control" required>
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">Email <span>*</span></label>
                        <input type="email" name="email" id="edit_email" class="p-form-control" required>
                    </div>
                </div>
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Password <span style="font-weight:400;color:#94a3b8;font-size:12px;">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" class="p-form-control" placeholder="Min. 6 karakter">
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">No. HP</label>
                        <input type="text" name="no_hp" id="edit_no_hp" class="p-form-control" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <div class="p-form-row">
                    <div class="p-form-group">
                        <label class="p-form-label">Role <span>*</span></label>
                        <select name="role" id="edit_role" class="p-form-select" required>
                            <option value="admin">Administrator</option>
                            <option value="operator">Operator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">Status <span>*</span></label>
                        <select name="status" id="edit_status" class="p-form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak-aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-modal-footer">
                <button type="button" class="p-btn p-btn-secondary" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="p-btn p-btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Detail Modal --}}
<div class="p-overlay" id="detailModal">
    <div class="p-modal p-modal-lg">
        <div class="p-modal-header">
            <h3><i class="fa-regular fa-circle-user"></i> Detail Pengguna</h3>
            <button class="p-modal-close" onclick="closeDetailModal()">&times;</button>
        </div>
        <div class="p-modal-body" id="detailBody">
            <div style="text-align:center;padding:30px;color:#94a3b8;"><i class="fa-solid fa-spinner fa-spin" style="font-size:24px;"></i></div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="p-overlay" id="deleteModal">
    <div class="p-modal" style="max-width:400px;">
        <div class="p-modal-body" style="padding:30px 24px;">
            <div class="p-delete-icon"><i class="fa-regular fa-trash-can"></i></div>
            <div class="p-delete-text">Apakah Anda yakin ingin menghapus</div>
            <div class="p-delete-name" id="deleteName"></div>
            <div style="text-align:center;font-size:13px;color:#94a3b8;margin-top:8px;">Tindakan ini tidak dapat dibatalkan</div>
        </div>
        <div class="p-modal-footer" style="padding:0 24px 24px;justify-content:center;gap:12px;">
            <button type="button" class="p-btn p-btn-secondary" onclick="closeDeleteModal()">Batal</button>
            <button type="button" class="p-btn p-btn-primary" id="deleteBtn" style="background:linear-gradient(135deg,#ef4444,#dc2626);box-shadow:0 4px 6px rgba(239,68,68,.25);" onclick="submitDelete()"><i class="fa-regular fa-trash-can"></i> Hapus</button>
        </div>
    </div>
</div>

{{-- Hidden delete form --}}
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

{{-- Toast notifications --}}
<div class="p-toast" id="toastContainer"></div>

<script>
const avatarColors = [
    { a1: '#6366f1', a2: '#818cf8' },
    { a1: '#0ea5e9', a2: '#38bdf8' },
    { a1: '#f59e0b', a2: '#fbbf24' },
    { a1: '#10b981', a2: '#34d399' },
    { a1: '#ef4444', a2: '#f87171' },
    { a1: '#8b5cf6', a2: '#a78bfa' },
    { a1: '#ec4899', a2: '#f472b6' },
    { a1: '#14b8a6', a2: '#2dd4bf' },
];

function filterTable() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const role = document.getElementById('filterRole').value;
    const status = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#userTable tbody tr');
    rows.forEach(row => {
        const name = (row.querySelector('.p-user-name')?.textContent || '').toLowerCase();
        const email = (row.querySelector('.p-user-email')?.textContent || '').toLowerCase();
        const rowRole = (row.querySelector('.p-role')?.textContent || '').trim().toLowerCase();
        const rowStatus = row.querySelector('.p-dot')?.className.includes('tidak') ? 'tidak-aktif' : 'aktif';
        const matchSearch = !q || name.includes(q) || email.includes(q);
        const matchRole = !role || rowRole === role;
        const matchStatus = !status || rowStatus === status;
        row.style.display = matchSearch && matchRole && matchStatus ? '' : 'none';
    });
}

function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterRole').value = '';
    document.getElementById('filterStatus').value = '';
    filterTable();
}

function openCreateModal() {
    document.getElementById('createModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.remove('show');
    document.body.style.overflow = '';
}

function openEditModal(id) {
    const modal = document.getElementById('editModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    document.getElementById('editForm').action = '/admin/pengguna/' + id;
    fetch('/admin/pengguna/' + id + '/edit')
        .then(r => r.json())
        .then(u => {
            document.getElementById('edit_name').value = u.name;
            document.getElementById('edit_email').value = u.email;
            document.getElementById('edit_no_hp').value = u.no_hp || '';
            document.getElementById('edit_role').value = u.role;
            document.getElementById('edit_status').value = u.status;
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('show');
    document.body.style.overflow = '';
}

function openDetailModal(id) {
    const modal = document.getElementById('detailModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    const body = document.getElementById('detailBody');
    fetch('/admin/pengguna/' + id + '/edit')
        .then(r => r.json())
        .then(u => {
            const c = avatarColors[id % avatarColors.length];
            const initial = u.name.charAt(0).toUpperCase();
            body.innerHTML = `
                <div style="display:flex;align-items:center;gap:20px;margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid var(--p-border);">
                    <div style="width:60px;height:60px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:22px;color:#fff;background:linear-gradient(135deg,${c.a1},${c.a2});flex-shrink:0;">${initial}</div>
                    <div>
                        <div style="font-size:18px;font-weight:700;color:var(--p-text);">${u.name}</div>
                        <div style="font-size:14px;color:var(--p-text-secondary);">${u.email}</div>
                    </div>
                </div>
                <div class="p-detail">
                    <div class="p-detail-item"><div class="p-detail-label">Nama</div><div class="p-detail-value">${u.name}</div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Email</div><div class="p-detail-value">${u.email}</div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Role</div><div class="p-detail-value"><span class="p-role ${u.role}">${u.role.charAt(0).toUpperCase() + u.role.slice(1)}</span></div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Status</div><div class="p-detail-value"><span class="p-status"><span class="p-dot ${u.status}"></span> ${u.status === 'aktif' ? 'Aktif' : 'Tidak Aktif'}</span></div></div>
                    <div class="p-detail-item"><div class="p-detail-label">No. HP</div><div class="p-detail-value">${u.no_hp || '-'}</div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Terdaftar</div><div class="p-detail-value">${new Date(u.created_at).toLocaleDateString('id-ID', {year:'numeric',month:'long',day:'numeric'})}</div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Terakhir Login</div><div class="p-detail-value">${u.last_login_at ? new Date(u.last_login_at).toLocaleDateString('id-ID', {year:'numeric',month:'long',day:'numeric',hour:'2-digit',minute:'2-digit'}) : 'Belum pernah'}</div></div>
                    <div class="p-detail-item"><div class="p-detail-label">Email Verifikasi</div><div class="p-detail-value">${u.email_verified_at ? new Date(u.email_verified_at).toLocaleDateString('id-ID', {year:'numeric',month:'long',day:'numeric'}) : '<span style="color:#ef4444;">Belum terverifikasi</span>'}</div></div>
                </div>
            `;
        });
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.remove('show');
    document.body.style.overflow = '';
}

let deleteId = null;
function confirmDelete(id, name) {
    deleteId = id;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    deleteId = null;
    document.getElementById('deleteModal').classList.remove('show');
    document.body.style.overflow = '';
}

function submitDelete() {
    if (!deleteId) return;
    const form = document.getElementById('deleteForm');
    form.action = '/admin/pengguna/' + deleteId;
    form.submit();
}

// Close modals on overlay click
document.querySelectorAll('.p-overlay').forEach(el => {
    el.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});

// Toast from session
@if(session('success'))
showToast('success', 'Berhasil', '{{ session('success') }}');
@endif
@if(session('error'))
showToast('error', 'Gagal', '{{ session('error') }}');
@endif

function showToast(type, title, msg) {
    const container = document.getElementById('toastContainer');
    const icon = type === 'success' ? 'fa-regular fa-circle-check' : 'fa-regular fa-circle-xmark';
    const item = document.createElement('div');
    item.className = 'p-toast-item ' + type;
    item.innerHTML = `
        <i class="p-toast-icon ${icon}"></i>
        <div class="p-toast-body">
            <div class="p-toast-title">${title}</div>
            <div class="p-toast-msg">${msg}</div>
        </div>
        <button class="p-toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    container.appendChild(item);
    setTimeout(() => { item.style.opacity = '0'; item.style.transform = 'translateX(50px)'; item.style.transition = 'all .3s'; setTimeout(() => item.remove(), 300); }, 4500);
}
</script>

</x-admin-layout>
