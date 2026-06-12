<x-admin-layout>
    <x-slot name="title">Pengaturan</x-slot>
    @section('header_title', 'Pengaturan')
    @section('header_subtitle', 'Kelola konfigurasi dan preferensi sistem')

<style>
:root {
    --s-primary: #6366f1;
    --s-primary-light: #818cf8;
    --s-primary-dark: #4f46e5;
    --s-bg: #f8fafc;
    --s-card: #ffffff;
    --s-border: #e2e8f0;
    --s-text: #1e293b;
    --s-text-secondary: #64748b;
    --s-shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --s-shadow-lg: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -2px rgba(0,0,0,.04);
    --s-radius: 12px;
}

/* Tabs */
.s-tabs { display:flex;gap:0;margin-bottom:28px;background:var(--s-card);border-radius:var(--s-radius);box-shadow:var(--s-shadow);border:1px solid var(--s-border);overflow:hidden; }
.s-tab { flex:1;padding:14px 20px;border:none;background:transparent;cursor:pointer;font-size:13px;font-weight:600;color:var(--s-text-secondary);transition:all .2s;white-space:nowrap;display:flex;align-items:center;justify-content:center;gap:8px;font-family:inherit;position:relative;border-bottom:2px solid transparent; }
.s-tab:not(:last-child) { border-right:1px solid var(--s-border); }
.s-tab:hover { color:var(--s-text);background:#fafafa; }
.s-tab.active { color:var(--s-primary);border-bottom-color:var(--s-primary);background:#f8f7ff; }
.s-tab i { font-size:15px; }

/* Card */
.s-card { background:var(--s-card);border-radius:var(--s-radius);box-shadow:var(--s-shadow);border:1px solid var(--s-border);overflow:hidden;display:none; }
.s-card.active { display:block;animation:fadeUp .35s ease; }
.s-card-header { padding:18px 24px;border-bottom:1px solid var(--s-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;background:#fafbfc; }
.s-card-header h3 { margin:0;font-size:15px;font-weight:700;color:var(--s-text);display:flex;align-items:center;gap:8px; }
.s-card-header h3 i { color:var(--s-primary); }
.s-card-body { padding:24px; }
.s-card-footer { padding:16px 24px;border-top:1px solid var(--s-border);display:flex;justify-content:flex-end;gap:8px;background:#fafbfc; }

/* Form grid */
.s-form { display:grid;grid-template-columns:1fr 1fr;gap:20px; }
.s-group { }
.s-group.full { grid-column:1/-1; }
.s-label { display:block;font-size:13px;font-weight:600;color:var(--s-text);margin-bottom:6px; }
.s-label span { color:#ef4444; }
.s-desc { font-size:12px;color:var(--s-text-secondary);margin-bottom:8px;margin-top:-4px;line-height:1.4; }
.s-control { width:100%;padding:10px 12px;border:1px solid var(--s-border);border-radius:8px;font-size:14px;outline:none;transition:all .2s;font-family:inherit;background:#fff;box-sizing:border-box; }
.s-control:focus { border-color:var(--s-primary);box-shadow:0 0 0 3px rgba(99,102,241,.12); }
.s-control:disabled { background:#f8fafc;cursor:not-allowed;opacity:.6; }
textarea.s-control { min-height:80px;resize:vertical; }
.s-select { padding:10px 32px 10px 12px;border:1px solid var(--s-border);border-radius:8px;font-size:14px;outline:none;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 10px center;cursor:pointer;transition:all .2s;font-family:inherit;appearance:none;width:100%;box-sizing:border-box; }
.s-select:focus { border-color:var(--s-primary);box-shadow:0 0 0 3px rgba(99,102,241,.12); }

/* Toggle switch */
.s-toggle { position:relative;display:inline-flex;align-items:center;gap:10px;cursor:pointer;padding:4px 0; }
.s-toggle input { position:absolute;opacity:0;width:0;height:0; }
.s-toggle-slider { width:44px;height:24px;background:#cbd5e1;border-radius:12px;transition:all .25s;position:relative;flex-shrink:0; }
.s-toggle-slider:before { content:'';position:absolute;top:3px;left:3px;width:18px;height:18px;border-radius:50%;background:#fff;transition:all .25s;box-shadow:0 1px 3px rgba(0,0,0,.15); }
.s-toggle input:checked + .s-toggle-slider { background:var(--s-primary); }
.s-toggle input:checked + .s-toggle-slider:before { transform:translateX(20px); }
.s-toggle-text { font-size:13px;font-weight:500;color:var(--s-text-secondary);min-width:60px; }

/* File upload */
.s-upload { display:flex;align-items:center;gap:16px; }
.s-upload-preview { width:72px;height:72px;border-radius:12px;border:2px dashed var(--s-border);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;background:#f8fafc;transition:all .2s; }
.s-upload-preview img { width:100%;height:100%;object-fit:cover; }
.s-upload-preview i { font-size:28px;color:#94a3b8; }
.s-upload-btn { position:relative; }
.s-upload-btn input { position:absolute;opacity:0;width:100%;height:100%;top:0;left:0;cursor:pointer; }
.s-upload-label { display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;color:var(--s-text);background:#f1f5f9;cursor:pointer;transition:all .2s; }
.s-upload-label:hover { background:#e2e8f0; }
.s-upload-name { font-size:12px;color:var(--s-text-secondary);margin-top:4px; }

/* Toast */
.s-toast { position:fixed;top:20px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:8px; }
.s-toast-item { display:flex;align-items:center;gap:12px;padding:14px 18px;border-radius:12px;box-shadow:0 10px 25px -5px rgba(0,0,0,.1);animation:slideIn .3s;min-width:320px;max-width:420px;border:1px solid; }
.s-toast-item.success { background:#f0fdf4;border-color:#bbf7d0;color:#166534; }
.s-toast-item.error { background:#fef2f2;border-color:#fecaca;color:#991b1b; }
.s-toast-icon { font-size:18px; }
.s-toast-body { flex:1; }
.s-toast-title { font-weight:700;font-size:14px; }
.s-toast-msg { font-size:13px;opacity:.9;margin-top:1px; }
.s-toast-close { width:24px;height:24px;border-radius:6px;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;opacity:.5;transition:all .2s; }
.s-toast-close:hover { opacity:1;background:rgba(0,0,0,.05); }

/* Count badge */
.s-badge { display:inline-flex;align-items:center;justify-content:center;background:#eef2ff;color:var(--s-primary);font-size:12px;font-weight:700;padding:2px 10px;border-radius:20px;min-width:28px; }

@keyframes fadeUp { from { opacity:0;transform:translateY(12px); } to { opacity:1;transform:translateY(0); } }
@keyframes slideIn { from { opacity:0;transform:translateX(50px); } to { opacity:1;transform:translateX(0); } }

/* Submit button - reuse p-btn style */
.s-btn { display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;border:none;font-family:inherit;text-decoration:none;white-space:nowrap; }
.s-btn-primary { background:linear-gradient(135deg,var(--s-primary),var(--s-primary-dark));color:#fff;box-shadow:0 4px 6px rgba(99,102,241,.25); }
.s-btn-primary:hover { transform:translateY(-1px);box-shadow:0 6px 12px rgba(99,102,241,.35); }

@media(max-width:768px){
    .s-form { grid-template-columns:1fr; }
    .s-tabs { flex-wrap:wrap; }
    .s-tab { flex:1 1 auto;padding:12px 14px;font-size:12px;border-bottom:2px solid transparent; }
    .s-tab:not(:last-child) { border-right:none; }
    .s-card-body { padding:16px; }
}
</style>

{{-- Tabs --}}
<div class="s-tabs">
    <button class="s-tab active" onclick="switchTab('general', this)"><i class="fa-solid fa-sliders"></i> Umum</button>
    <button class="s-tab" onclick="switchTab('contact', this)"><i class="fa-solid fa-address-book"></i> Kontak</button>
    <button class="s-tab" onclick="switchTab('academic', this)"><i class="fa-solid fa-graduation-cap"></i> Akademik</button>
</div>

<div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap;">
    <a href="{{ route('admin.pengguna') }}" style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;background:#f1f5f9;color:var(--s-text);text-decoration:none;transition:all .2s;"><i class="fa-solid fa-users-gear"></i> Data Pengguna</a>
</div>

@foreach($settings as $group => $items)
@if($group !== 'payment')
<form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="s-card {{ $group === 'general' ? 'active' : '' }}" id="card-{{ $group }}">
    @csrf
    <div class="s-card-header">
        <h3>
            @switch($group)
                @case('general') <i class="fa-solid fa-sliders"></i> @break
                @case('contact') <i class="fa-solid fa-address-book"></i> @break
                @case('academic') <i class="fa-solid fa-graduation-cap"></i> @break
                @case('payment') <i class="fa-solid fa-money-bill-wave"></i> @break
                @default <i class="fa-solid fa-gear"></i>
            @endswitch
            @switch($group)
                @case('general') Pengaturan Umum @break
                @case('contact') Informasi Kontak @break
                @case('academic') Pengaturan Akademik @break
                @case('payment') Pengaturan Pembayaran @break
                @default {{ ucfirst($group) }}
            @endswitch
        </h3>
        <span class="s-badge">{{ $items->count() }} pengaturan</span>
    </div>
    <div class="s-card-body">
        <div class="s-form">
            @foreach($items as $item)
            @php
                $field = 'setting_' . $item->id;
                $val = old($field, $item->value);
                $isSelect = $item->type === 'select';
                $isBool = $item->type === 'boolean';
                $isFile = in_array($item->type, ['file', 'image']);
                $isTextarea = $item->type === 'textarea';
                $isLong = in_array($item->type, ['textarea', 'email', 'url']);
            @endphp
            <div class="s-group {{ $isLong ? 'full' : '' }}">
                <label class="s-label" for="{{ $field }}">{{ $item->label }}</label>
                @if($item->description)
                <div class="s-desc">{{ $item->description }}</div>
                @endif

                @if($isBool)
                    <label class="s-toggle">
                        <input type="hidden" name="{{ $field }}" value="0">
                        <input type="checkbox" name="{{ $field }}" id="{{ $field }}" value="1" {{ $val == '1' ? 'checked' : '' }}>
                        <span class="s-toggle-slider"></span>
                        <span class="s-toggle-text">{{ $val == '1' ? 'Aktif' : 'Nonaktif' }}</span>
                    </label>

                @elseif($isSelect)
                    @php $options = []; @endphp
                    @if($item->key === 'academic_semester')
                        @php $options = ['Ganjil', 'Genap']; @endphp
                    @endif
                    <select name="{{ $field }}" id="{{ $field }}" class="s-select">
                        @foreach($options as $opt)
                        <option value="{{ $opt }}" {{ $val === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>

                @elseif($isFile)
                    <div class="s-upload">
                        <div class="s-upload-preview">
                            @if($val)
                                <img src="{{ asset('storage/' . $val) }}" alt="{{ $item->label }}" id="{{ $field }}_preview">
                            @else
                                <i class="fa-solid fa-image" id="{{ $field }}_placeholder"></i>
                            @endif
                        </div>
                        <div>
                            <div class="s-upload-btn">
                                <input type="file" name="{{ $field }}" id="{{ $field }}" accept="image/*" onchange="previewFile(this, '{{ $field }}_preview', '{{ $field }}_placeholder')">
                                <span class="s-upload-label"><i class="fa-solid fa-upload"></i> Pilih File</span>
                            </div>
                            <div class="s-upload-name" id="{{ $field }}_name">@if($val) {{ basename($val) }} @else Tidak ada file @endif</div>
                        </div>
                    </div>

                @elseif($isTextarea)
                    <textarea name="{{ $field }}" id="{{ $field }}" class="s-control" rows="3" placeholder="Masukkan {{ strtolower($item->label) }}">{{ $val }}</textarea>

                @else
                    <input type="{{ $item->type === 'email' ? 'email' : ($item->type === 'number' ? 'number' : 'text') }}"
                           name="{{ $field }}" id="{{ $field }}" class="s-control"
                           value="{{ $val }}" {{ $item->type === 'number' ? 'min="0"' : '' }}
                           placeholder="Masukkan {{ strtolower($item->label) }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="s-card-footer">
        <button type="submit" class="s-btn s-btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan</button>
    </div>
</form>
@endif
@endforeach

{{-- Toast --}}
<div class="s-toast" id="toastContainer"></div>

<script>
function switchTab(group, btn) {
    document.querySelectorAll('.s-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.s-card').forEach(c => c.classList.remove('active'));
    const card = document.getElementById('card-' + group);
    if (card) card.classList.add('active');
}

function previewFile(input, previewId, placeholderId) {
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);
    const nameEl = document.getElementById(input.id + '_name');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
        if (nameEl) nameEl.textContent = input.files[0].name;
    }
}

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
    item.className = 's-toast-item ' + type;
    item.innerHTML = `
        <i class="s-toast-icon ${icon}"></i>
        <div class="s-toast-body">
            <div class="s-toast-title">${title}</div>
            <div class="s-toast-msg">${msg}</div>
        </div>
        <button class="s-toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;
    container.appendChild(item);
    setTimeout(() => { item.style.opacity = '0'; item.style.transform = 'translateX(50px)'; item.style.transition = 'all .3s'; setTimeout(() => item.remove(), 300); }, 4500);
}
</script>

</x-admin-layout>
