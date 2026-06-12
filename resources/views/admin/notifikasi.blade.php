<x-admin-layout>
    <x-slot name="title">Notifikasi</x-slot>
    @section('header_title', 'Notifikasi')
    @section('header_subtitle', 'Pusat notifikasi dan pemberitahuan')

    <style>
        :root { --nt-primary: #8b5cf6; }
        .nt-header {
            display: flex; align-items: center; justify-content: space-between;
            background: #fff; border-radius: 14px; border: 1px solid var(--border-color);
            padding: 16px 20px; margin: 0 0 18px; flex-wrap: wrap; gap: 10px;
        }
        .nt-header-left { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .nt-header-left h3 { font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; }
        .nt-header-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .nt-badge {
            display: inline-flex; align-items: center; justify-content: center;
            background: #f5f3ff; color: var(--nt-primary);
            font-size: 12px; font-weight: 700; padding: 2px 12px; border-radius: 20px;
        }
        .nt-list { list-style: none; padding: 0; margin: 0; }
        .nt-item {
            display: flex; align-items: flex-start; gap: 14px;
            padding: 16px 20px; background: #fff;
            border: 1px solid var(--border-color); border-radius: 12px;
            margin-bottom: 10px; transition: all 0.2s;
        }
        .nt-item:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.04); }
        .nt-item.belum { border-left: 3px solid var(--nt-primary); }
        .nt-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 16px;
        }
        .nt-body { flex: 1; min-width: 0; }
        .nt-judul { font-size: 14px; font-weight: 600; color: #1e293b; }
        .nt-pesan { font-size: 12px; color: #64748b; margin-top: 4px; line-height: 1.5; }
        .nt-waktu { font-size: 11px; color: #94a3b8; margin-top: 6px; }
        .nt-kosong {
            text-align: center; padding: 48px 20px; color: #94a3b8;
        }
        .nt-kosong i { font-size: 48px; margin-bottom: 12px; display: block; }
        .nt-actions { display: flex; align-items: center; gap: 4px; flex-shrink: 0; margin-left: auto; }
        .nt-action-btn {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 13px; transition: all 0.2s;
            background: transparent; color: #94a3b8; font-family: inherit;
        }
        .nt-action-btn:hover { background: #f1f5f9; color: #475569; }
        .nt-action-btn.danger:hover { background: #fef2f2; color: #ef4444; }
        .btn-mark-read {
            padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
            border: none; cursor: pointer; background: #f5f3ff; color: var(--nt-primary);
            transition: all 0.2s; font-family: inherit; white-space: nowrap;
        }
        .btn-mark-read:hover { background: #ede9fe; }
        .btn-primary {
            padding: 8px 18px; border-radius: 10px; font-size: 13px; font-weight: 600;
            border: none; cursor: pointer; background: var(--nt-primary); color: #fff;
            transition: all 0.2s; font-family: inherit; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-primary:hover { background: #7c3aed; }
        .nt-modal-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 9999;
            display: none; align-items: center; justify-content: center; padding: 20px;
        }
        .nt-modal-overlay.show { display: flex; }
        .nt-modal {
            background: #fff; border-radius: 16px; width: 100%; max-width: 480px;
            padding: 28px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .nt-modal h3 { font-size: 17px; font-weight: 700; color: #1e293b; margin: 0 0 20px; display: flex; align-items: center; gap: 8px; }
        .nt-form-group { margin-bottom: 16px; }
        .nt-form-group label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }
        .nt-form-group label span.req { color: #ef4444; }
        .nt-form-group input, .nt-form-group textarea, .nt-form-group select {
            width: 100%; padding: 10px 12px; border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 13px; font-family: inherit; outline: none; transition: border 0.2s; box-sizing: border-box;
        }
        .nt-form-group input:focus, .nt-form-group textarea:focus, .nt-form-group select:focus { border-color: var(--nt-primary); }
        .nt-form-group textarea { min-height: 80px; resize: vertical; }
        .nt-modal-actions { display: flex; gap: 10px; margin-top: 20px; justify-content: flex-end; }
        .nt-modal-actions .btn-cancel {
            padding: 8px 18px; border-radius: 10px; font-size: 13px; font-weight: 600;
            border: 1px solid #e2e8f0; cursor: pointer; background: #fff; color: #475569;
            font-family: inherit; transition: all 0.2s;
        }
        .nt-modal-actions .btn-cancel:hover { background: #f8fafc; }
        .nt-modal-actions .btn-submit {
            padding: 8px 18px; border-radius: 10px; font-size: 13px; font-weight: 600;
            border: none; cursor: pointer; background: var(--nt-primary); color: #fff;
            font-family: inherit; transition: all 0.2s;
        }
        .nt-modal-actions .btn-submit:hover { background: #7c3aed; }
        .color-option { display: inline-flex; align-items: center; gap: 6px; }
        .color-dot { width: 14px; height: 14px; border-radius: 4px; display: inline-block; }
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

    <div class="nt-header">
        <div class="nt-header-left">
            <i class="fa-solid fa-bell" style="color:var(--nt-primary);font-size:18px;"></i>
            <h3>Semua Notifikasi</h3>
            <span class="nt-badge">{{ $totalUnread }} belum dibaca</span>
        </div>
        <div class="nt-header-actions">
            @if($totalUnread > 0)
            <button class="btn-mark-read" onclick="readAll()"><i class="fa-solid fa-check-double"></i> Tandai Semua Dibaca</button>
            @endif
            <button class="btn-primary" onclick="openModal()"><i class="fa-solid fa-plus"></i> Buat Notifikasi</button>
        </div>
    </div>

    @if(count($notifikasi) > 0)
    <ul class="nt-list">
        @foreach($notifikasi as $n)
        <li class="nt-item {{ !$n->dibaca ? 'belum' : '' }}" data-id="{{ $n->id }}">
            <div class="nt-icon" style="background:{{ $n->warna }}20;color:{{ $n->warna }};">
                <i class="{{ $n->icon }}"></i>
            </div>
            <div class="nt-body" onclick="markRead({{ $n->id }}, this.closest('.nt-item'))">
                <div class="nt-judul">{{ $n->judul }}</div>
                @if($n->pesan)<div class="nt-pesan">{{ $n->pesan }}</div>@endif
                <div class="nt-waktu"><i class="fa-regular fa-clock"></i> {{ $n->created_at ? \Carbon\Carbon::parse($n->created_at)->locale('id')->isoFormat('D MMM YYYY, HH:mm') : '-' }}</div>
            </div>
            <div class="nt-actions">
                @if(!$n->dibaca)
                <button class="btn-mark-read" onclick="event.stopPropagation();markRead({{ $n->id }}, this.closest('.nt-item'))"><i class="fa-solid fa-check"></i></button>
                @endif
                <button class="nt-action-btn" onclick="event.stopPropagation();openModal({{ $n->id }})" title="Edit"><i class="fa-solid fa-pen"></i></button>
                <button class="nt-action-btn danger" onclick="event.stopPropagation();confirmDelete({{ $n->id }})" title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </li>
        @endforeach
    </ul>
    @else
    <div class="nt-kosong">
        <i class="fa-regular fa-bell-slash"></i>
        <p>Tidak ada notifikasi</p>
    </div>
    @endif

    <div class="nt-modal-overlay" id="ntModal">
        <div class="nt-modal">
            <h3><i class="fa-solid fa-bell"></i> <span id="modalTitle">Buat Notifikasi</span></h3>
            <form id="ntForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="ntMethod" value="POST">
                <input type="hidden" name="id" id="ntId">
                <div class="nt-form-group">
                    <label>Judul <span class="req">*</span></label>
                    <input type="text" name="judul" id="ntJudul" required maxlength="200" placeholder="Judul notifikasi">
                </div>
                <div class="nt-form-group">
                    <label>Pesan</label>
                    <textarea name="pesan" id="ntPesan" placeholder="Isi pesan notifikasi (opsional)"></textarea>
                </div>
                <div class="nt-form-group">
                    <label>Ikon <span class="req">*</span></label>
                    <select name="icon" id="ntIcon" required>
                        <option value="fa-solid fa-bell">Bell</option>
                        <option value="fa-solid fa-circle-info">Info</option>
                        <option value="fa-solid fa-check-circle">Check</option>
                        <option value="fa-solid fa-exclamation-triangle">Warning</option>
                        <option value="fa-solid fa-times-circle">Error</option>
                        <option value="fa-solid fa-user-plus">User Plus</option>
                        <option value="fa-solid fa-user-graduate">Santri</option>
                        <option value="fa-solid fa-chalkboard-user">Guru</option>
                        <option value="fa-solid fa-money-bill">Pembayaran</option>
                        <option value="fa-solid fa-calendar-check">Jadwal</option>
                        <option value="fa-solid fa-book-open">Pelajaran</option>
                        <option value="fa-solid fa-star">Star</option>
                        <option value="fa-solid fa-gift">Gift</option>
                        <option value="fa-solid fa-megaphone">Megaphone</option>
                    </select>
                </div>
                <div class="nt-form-group">
                    <label>Warna <span class="req">*</span></label>
                    <select name="warna" id="ntWarna" required>
                        <option value="#8b5cf6" data-color="#8b5cf6"><span class="color-dot" style="background:#8b5cf6"></span> Ungu</option>
                        <option value="#2563eb" data-color="#2563eb">Biru</option>
                        <option value="#059669" data-color="#059669">Hijau</option>
                        <option value="#d97706" data-color="#d97706">Kuning</option>
                        <option value="#dc2626" data-color="#dc2626">Merah</option>
                        <option value="#0891b2" data-color="#0891b2">Cyan</option>
                        <option value="#db2777" data-color="#db2777">Pink</option>
                        <option value="#7c3aed" data-color="#7c3aed">Violet</option>
                    </select>
                </div>
                <div class="nt-modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-submit" id="modalSubmit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    var notifData = @json($notifikasi);

    function openModal(id) {
        var modal = document.getElementById('ntModal');
        var form = document.getElementById('ntForm');
        var method = document.getElementById('ntMethod');
        var title = document.getElementById('modalTitle');
        var submitBtn = document.getElementById('modalSubmit');

        if (id) {
            var n = notifData.find(function(x) { return x.id === id; });
            if (!n) return;
            title.textContent = 'Edit Notifikasi';
            method.value = 'PUT';
            form.action = '/admin/notifikasi/' + id + '/update';
            submitBtn.textContent = 'Simpan';
            document.getElementById('ntId').value = n.id;
            document.getElementById('ntJudul').value = n.judul;
            document.getElementById('ntPesan').value = n.pesan || '';
            document.getElementById('ntIcon').value = n.icon;
            document.getElementById('ntWarna').value = n.warna;
        } else {
            title.textContent = 'Buat Notifikasi';
            method.value = 'POST';
            form.action = '/admin/notifikasi/store';
            submitBtn.textContent = 'Simpan';
            document.getElementById('ntId').value = '';
            document.getElementById('ntJudul').value = '';
            document.getElementById('ntPesan').value = '';
            document.getElementById('ntIcon').value = 'fa-solid fa-bell';
            document.getElementById('ntWarna').value = '#8b5cf6';
        }
        modal.classList.add('show');
    }

    function closeModal() {
        document.getElementById('ntModal').classList.remove('show');
    }

    document.getElementById('ntModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    function confirmDelete(id) {
        if (!confirm('Hapus notifikasi ini?')) return;
        fetch('/admin/notifikasi/' + id + '/delete', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: new URLSearchParams({ '_method': 'DELETE' }),
        })
        .then(function(res) { return res.json(); })
        .then(function(r) {
            if (r.success) {
                var el = document.querySelector('.nt-item[data-id="' + id + '"]');
                if (el) el.remove();
                var badge = document.querySelector('.nt-badge');
                if (badge) {
                    var cur = parseInt(badge.textContent);
                    badge.textContent = Math.max(0, cur - 1) + ' belum dibaca';
                }
                var remaining = document.querySelectorAll('.nt-item').length;
                if (remaining === 0) {
                    var list = document.querySelector('.nt-list');
                    if (list) {
                        list.outerHTML = '<div class="nt-kosong"><i class="fa-regular fa-bell-slash"></i><p>Tidak ada notifikasi</p></div>';
                    }
                }
                var toast = document.querySelector('.toast-notif');
                if (toast) toast.remove();
                var html = '<div class="toast-notif toast-success" id="notifAlert">' +
                    '<div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div>' +
                    '<div class="toast-body"><div class="toast-title">Berhasil</div><div class="toast-msg">Notifikasi berhasil dihapus</div></div>' +
                    '<button class="toast-close" onclick="this.parentElement.remove()">&times;</button></div>';
                document.querySelector('.nt-header').insertAdjacentHTML('beforebegin', html);
                setTimeout(function() { var t = document.getElementById('notifAlert'); if (t) t.remove(); }, 3000);
            }
        });
    }

    function markRead(id, el) {
        if (el.classList.contains('belum') === false) return;
        fetch('/admin/notifikasi/' + id + '/read', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
        })
        .then(function(res) { return res.json(); })
        .then(function(r) {
            if (r.success) {
                el.classList.remove('belum');
                var btn = el.querySelector('.btn-mark-read');
                if (btn) btn.remove();
                var badge = document.querySelector('.nt-badge');
                if (badge) {
                    var cur = parseInt(badge.textContent);
                    badge.textContent = Math.max(0, cur - 1) + ' belum dibaca';
                    if (cur - 1 <= 0) {
                        var raBtn = document.querySelector('.btn-mark-read[onclick="readAll()"]');
                        if (raBtn) raBtn.remove();
                    }
                }
            }
        });
    }

    function readAll() {
        fetch('/admin/notifikasi/read-all', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
        })
        .then(function(res) { return res.json(); })
        .then(function(r) {
            if (r.success) {
                document.querySelectorAll('.nt-item.belum').forEach(function(el) { el.classList.remove('belum'); });
                document.querySelectorAll('.nt-item .btn-mark-read').forEach(function(el) { el.remove(); });
                var badge = document.querySelector('.nt-badge');
                if (badge) badge.textContent = '0 belum dibaca';
                var raBtn = document.querySelector('.btn-mark-read[onclick="readAll()"]');
                if (raBtn) raBtn.remove();
            }
        });
    }

    setTimeout(function() { var t = document.getElementById('notifAlert'); if (t) t.remove(); }, 3000);
    </script>

</x-admin-layout>