<x-admin-layout>
    <x-slot name="title">Kerjakan Tugas</x-slot>
    @section('header_title', 'Kerjakan Tugas')
    @section('header_subtitle', $record->judul . ' — ' . $record->mapel)

    <style>
        .kj-container {
            max-width: 820px; margin: 0 auto;
        }

        .kj-back {
            display: inline-flex; align-items: center; gap: 8px; margin: 10px 0 22px;
            padding: 10px 22px; border-radius: 10px; font-size: 13px; font-weight: 600;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #fff; text-decoration: none;
            transition: all 0.25s; font-family: 'Inter', sans-serif;
        }
        .kj-back:hover { transform: translateY(-1px); opacity: 0.9; }

        .kj-card {
            background: #fff; border-radius: 18px; border: 1px solid #e2e8f0;
            overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }
        .kj-card-top {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            padding: 28px 32px; color: #fff; position: relative; overflow: hidden;
        }
        .kj-card-top::after {
            content: ''; position: absolute; top: -60%; right: -30%;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .kj-card-top h1 {
            font-size: 20px; font-weight: 700; margin: 0 0 4px; position: relative; z-index: 1;
        }
        .kj-card-top p {
            font-size: 13px; opacity: 0.85; margin: 0; position: relative; z-index: 1;
        }

        .kj-card-body { padding: 24px 32px; }

        .kj-meta {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 20px;
        }
        .kj-meta-item {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 16px; border-radius: 12px; background: #f8fafc;
            border: 1px solid #f1f5f9;
        }
        .kj-meta-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
        }
        .kj-meta-icon.rose { background: #fff1f2; color: #e11d48; }
        .kj-meta-icon.green { background: #ecfdf5; color: #059669; }
        .kj-meta-icon.amber { background: #fef3c7; color: #d97706; }
        .kj-meta-label { font-size: 10px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; }
        .kj-meta-value { font-size: 13px; font-weight: 600; color: #1e293b; }

        .kj-deskripsi-box {
            background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 12px;
            padding: 16px 20px; margin-bottom: 20px; border-left: 3px solid #e11d48;
        }
        .kj-deskripsi-box .label {
            font-size: 10px; font-weight: 700; color: #e11d48; text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 6px;
        }
        .kj-deskripsi-box .text {
            font-size: 14px; color: #475569; line-height: 1.7;
        }

        .kj-file-box {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 20px; border: 1px solid #e2e8f0; border-radius: 12px;
            background: #fff; margin-bottom: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .kj-file-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: #fef2f2; color: #e11d48;
            display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
        }
        .kj-file-info { flex: 1; min-width: 0; }
        .kj-file-name { font-size: 13px; font-weight: 600; color: #1e293b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .kj-file-size { font-size: 11px; color: #94a3b8; }
        .kj-file-btn {
            padding: 8px 18px; border-radius: 8px; font-size: 12px; font-weight: 600;
            border: none; cursor: pointer; transition: all 0.15s;
            background: #f1f5f9; color: #475569; display: inline-flex; align-items: center; gap: 6px;
            flex-shrink: 0;
        }
        .kj-file-btn:hover { background: #e2e8f0; }

        .kj-section-title {
            font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }
        .kj-section-title i { color: #e11d48; }

        .kj-tabs {
            display: flex; gap: 8px; margin-bottom: 18px;
        }
        .kj-tab {
            padding: 9px 20px; border-radius: 9px; font-size: 12px; font-weight: 600;
            border: 1.5px solid #e2e8f0; background: #fff; color: #64748b;
            cursor: pointer; transition: all 0.15s; display: flex; align-items: center; gap: 6px;
        }
        .kj-tab.active {
            border-color: #e11d48; background: #fff1f2; color: #e11d48;
            box-shadow: 0 2px 8px rgba(225,29,72,0.15);
        }
        .kj-tab:hover { border-color: #cbd5e1; }

        .form-control {
            width: 100%; padding: 14px 16px; box-sizing: border-box;
            border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 14px;
            outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif;
            background: #f8fafc; color: #1a1a2e; resize: vertical;
            line-height: 1.6;
        }
        .form-control:focus { border-color: #e11d48; box-shadow: 0 0 0 4px rgba(225,29,72,0.08); background: #fff; }
        .form-control.char-count { padding-bottom: 36px; }

        .kj-char-count {
            text-align: right; font-size: 11px; color: #94a3b8; margin-top: -30px;
            padding-right: 4px; pointer-events: none;
        }

        .kj-upload-area {
            display: flex; flex-direction: column; align-items: center; gap: 14px;
            padding: 40px 32px; border: 2px dashed #e2e8f0; border-radius: 14px;
            cursor: pointer; transition: all 0.25s; text-align: center;
            background: #fafafa;
        }
        .kj-upload-area:hover {
            border-color: #e11d48; background: #fff1f2;
            transform: translateY(-1px);
        }
        .kj-upload-area.dragover {
            border-color: #e11d48; background: #fff1f2;
            transform: scale(1.01);
        }
        .kj-upload-area .icon-wrap {
            width: 64px; height: 64px; border-radius: 16px;
            background: #fff1f2; color: #e11d48;
            display: flex; align-items: center; justify-content: center; font-size: 28px;
            transition: all 0.25s;
        }
        .kj-upload-area:hover .icon-wrap { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(225,29,72,0.15); }
        .kj-upload-area p { font-size: 15px; font-weight: 600; color: #1e293b; margin: 0; }
        .kj-upload-area .sub { font-size: 12px; color: #94a3b8; }
        .kj-upload-area .sub i { color: #e11d48; }

        .kj-upload-preview {
            display: none; align-items: center; gap: 14px;
            padding: 16px 20px; border: 1px solid #e2e8f0; border-radius: 12px;
            background: #f8fafc;
            animation: previewIn 0.3s ease;
        }
        @keyframes previewIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .kj-upload-preview .file-pdf-icon {
            width: 44px; height: 44px; border-radius: 10px;
            background: #fef2f2; color: #e11d48;
            display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;
        }
        .kj-upload-preview .file-info { flex: 1; min-width: 0; }
        .kj-upload-preview .file-name { font-size: 13px; font-weight: 600; color: #1e293b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .kj-upload-preview .file-size { font-size: 11px; color: #94a3b8; }
        .kj-upload-preview .file-actions { display: flex; gap: 6px; flex-shrink: 0; }
        .kj-upload-preview .file-btn {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            display: flex; align-items: center; justify-content: center; cursor: pointer;
            transition: all 0.15s; font-size: 14px;
        }
        .kj-upload-preview .file-btn.danger { background: #fef2f2; color: #dc2626; }
        .kj-upload-preview .file-btn.danger:hover { background: #fee2e2; }

        .kj-divider { height: 1px; background: #e2e8f0; margin: 20px 0; }

        .kj-actions {
            display: flex; align-items: center; justify-content: flex-end; gap: 10px;
        }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 11px 24px; border-radius: 10px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.ghost { background: #f1f5f9; color: #475569; }
        .btn.ghost:hover { background: #e2e8f0; }
        .btn.primary {
            background: linear-gradient(135deg, #e11d48, #be123c);
            color: #fff; box-shadow: 0 4px 14px rgba(225,29,72,0.3);
        }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(225,29,72,0.4); }
        .btn.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff; box-shadow: 0 4px 14px rgba(16,185,129,0.3);
        }
        .btn.success:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }

        .kj-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 340px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: kjIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .kj-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .kj-toast.error { background: #fef2f2; border-color: #ef4444; }
        .kj-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .kj-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .kj-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .kj-toast .toast-body { flex: 1; }
        .kj-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .kj-toast .toast-msg { font-size: 12px; color: #555; }
        .kj-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; font-size: 20px; color: #999;
            display: flex; align-items: center; justify-content: center;
        }
        .kj-toast .toast-close:hover { background: #f1f5f9; }
        @keyframes kjIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes kjOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        @media (max-width: 767px) {
            .kj-meta { grid-template-columns: 1fr; }
            .kj-card-top { padding: 20px 24px; }
            .kj-card-body { padding: 20px 20px; }
            .kj-upload-area { padding: 28px 20px; }
            .kj-actions { flex-direction: column; }
            .kj-actions .btn { width: 100%; justify-content: center; }
        }
    </style>

    <div class="kj-container">
        <a href="{{ route('admin.tugas') }}" class="kj-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="kj-card">
            <div class="kj-card-top">
                <h1><i class="fa-solid fa-file-pen" style="margin-right:8px;"></i> {{ $record->judul }}</h1>
                <p>{{ $record->mapel }} — Kelas {{ $record->kelas ?? '-' }}</p>
            </div>

            <div class="kj-card-body">
                <div class="kj-meta">
                    <div class="kj-meta-item">
                        <div class="kj-meta-icon rose"><i class="fa-solid fa-book-open"></i></div>
                        <div>
                            <div class="kj-meta-label">Mata Pelajaran</div>
                            <div class="kj-meta-value">{{ $record->mapel }}</div>
                        </div>
                    </div>
                    <div class="kj-meta-item">
                        <div class="kj-meta-icon green"><i class="fa-solid fa-users"></i></div>
                        <div>
                            <div class="kj-meta-label">Kelas</div>
                            <div class="kj-meta-value">{{ $record->kelas ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="kj-meta-item">
                        <div class="kj-meta-icon amber"><i class="fa-regular fa-calendar"></i></div>
                        <div>
                            <div class="kj-meta-label">Deadline</div>
                            <div class="kj-meta-value">{{ \Carbon\Carbon::parse($record->tanggal_deadline)->isoFormat('D MMMM Y') }}</div>
                        </div>
                    </div>
                </div>

                @if($record->deskripsi)
                <div class="kj-deskripsi-box">
                    <div class="label"><i class="fa-solid fa-bars"></i> Deskripsi Tugas</div>
                    <div class="text">{{ $record->deskripsi }}</div>
                </div>
                @endif

                @if($record->lampiran ?? false)
                <div class="kj-file-box">
                    <div class="kj-file-icon"><i class="fa-solid fa-file-pdf"></i></div>
                    <div class="kj-file-info">
                        <div class="kj-file-name">{{ $record->lampiran }}</div>
                        <div class="kj-file-size">Lampiran Soal &bull; PDF</div>
                    </div>
                    <button class="kj-file-btn" onclick="showToast('success','Info','Fitur lihat PDF tersedia setelah integrasi penyimpanan.')"><i class="fa-solid fa-eye"></i> Lihat</button>
                </div>
                @endif

                <div class="kj-divider"></div>

                <div class="kj-section-title"><i class="fa-solid fa-pen"></i> Jawaban Tugas</div>

                <div class="kj-tabs">
                    <button class="kj-tab active" id="tabTulis" onclick="pilihTipe('tulis')"><i class="fa-solid fa-pen"></i> Tulis Jawaban</button>
                    <button class="kj-tab" id="tabUpload" onclick="pilihTipe('upload')"><i class="fa-solid fa-upload"></i> Upload PDF</button>
                </div>

                <div id="jawabanTulis">
                    <textarea class="form-control char-count" id="jawabanText" style="min-height:180px;" placeholder="Tulis jawaban tugas di sini..." oninput="hitungChar()"></textarea>
                    <div class="kj-char-count"><span id="charCount">0</span> karakter</div>
                </div>

                <div id="jawabanUpload" style="display:none;">
                    <div class="kj-upload-area" id="uploadArea">
                        <div class="icon-wrap"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <div>
                            <p>Klik untuk upload atau tarik file ke sini</p>
                            <div class="sub"><i class="fa-solid fa-file"></i> PDF &bull; Maksimal 5MB</div>
                        </div>
                        <input type="file" id="uploadFile" accept=".pdf" style="display:none;" onchange="handleUpload(this)">
                    </div>
                    <div class="kj-upload-preview" id="uploadPreview">
                        <div class="file-pdf-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="file-info">
                            <div class="file-name" id="uploadFileName">-</div>
                            <div class="file-size" id="uploadFileSize">-</div>
                        </div>
                        <div class="file-actions">
                            <button class="file-btn danger" title="Hapus" onclick="hapusUpload()"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                </div>

                <div class="kj-divider"></div>

                <div class="kj-actions">
                    <button class="btn ghost" onclick="window.location.href='{{ route('admin.tugas') }}'"><i class="fa-solid fa-xmark"></i> Batal</button>
                    <button class="btn success" onclick="submitJawaban()"><i class="fa-solid fa-check-circle"></i> Kumpulkan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tipeJawaban = 'tulis';
        let uploadFileData = null;

        function hitungChar() {
            document.getElementById('charCount').textContent = document.getElementById('jawabanText').value.length;
        }

        function pilihTipe(tipe) {
            tipeJawaban = tipe;
            document.getElementById('tabTulis').classList.toggle('active', tipe === 'tulis');
            document.getElementById('tabUpload').classList.toggle('active', tipe === 'upload');
            document.getElementById('jawabanTulis').style.display = tipe === 'tulis' ? 'block' : 'none';
            document.getElementById('jawabanUpload').style.display = tipe === 'upload' ? 'block' : 'none';
        }

        function handleUpload(input) {
            const f = input.files[0];
            if (!f) return;
            if (f.type !== 'application/pdf') {
                showToast('error', 'Format tidak didukung', 'Hanya file PDF yang diperbolehkan.');
                input.value = '';
                return;
            }
            if (f.size > 5 * 1024 * 1024) {
                showToast('error', 'File terlalu besar', 'Maksimal ukuran file adalah 5MB.');
                input.value = '';
                return;
            }
            uploadFileData = f;
            document.getElementById('uploadArea').style.display = 'none';
            document.getElementById('uploadPreview').style.display = 'flex';
            document.getElementById('uploadFileName').textContent = f.name;
            const sizeKB = (f.size / 1024).toFixed(1);
            document.getElementById('uploadFileSize').textContent = sizeKB + ' KB';
        }

        function hapusUpload() {
            uploadFileData = null;
            document.getElementById('uploadFile').value = '';
            document.getElementById('uploadArea').style.display = 'flex';
            document.getElementById('uploadPreview').style.display = 'none';
        }

        function submitJawaban() {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');

            if (tipeJawaban === 'tulis') {
                const text = document.getElementById('jawabanText').value.trim();
                if (!text) {
                    showToast('error', 'Jawaban masih kosong', 'Silakan tulis jawaban terlebih dahulu.');
                    return;
                }
                formData.append('jawaban', text);
            } else {
                if (!uploadFileData) {
                    showToast('error', 'Belum upload file', 'Silakan upload file PDF terlebih dahulu.');
                    return;
                }
                formData.append('file', uploadFileData);
            }

            fetch('{{ route('admin.tugas.submit', $record->id) }}', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('success', 'Berhasil dikumpulkan!', 'Jawaban tugas berhasil dikirim.');
                    setTimeout(() => { window.location.href = '{{ route('admin.tugas') }}'; }, 1200);
                } else {
                    showToast('error', 'Gagal!', data.message || 'Terjadi kesalahan.');
                }
            })
            .catch(err => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        }

        function showToast(type, title, msg) {
            const existing = document.querySelector('.kj-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.className = 'kj-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { t.style.animation = 'kjOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); }, 4000);
        }

        (function() {
            const area = document.getElementById('uploadArea');
            area.addEventListener('click', function() { document.getElementById('uploadFile').click(); });
            area.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('dragover'); });
            area.addEventListener('dragleave', function() { this.classList.remove('dragover'); });
            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                const f = e.dataTransfer.files[0];
                if (f && f.type === 'application/pdf' && f.size <= 5 * 1024 * 1024) {
                    document.getElementById('uploadFile').files = e.dataTransfer.files;
                    handleUpload(document.getElementById('uploadFile'));
                } else if (f && f.type !== 'application/pdf') {
                    showToast('error', 'Format tidak didukung', 'Hanya file PDF yang diperbolehkan.');
                } else if (f && f.size > 5 * 1024 * 1024) {
                    showToast('error', 'File terlalu besar', 'Maksimal ukuran file adalah 5MB.');
                }
            });
        })();
    </script>

</x-admin-layout>
