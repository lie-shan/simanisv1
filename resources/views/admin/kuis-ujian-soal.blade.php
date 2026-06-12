<x-admin-layout>
    <x-slot name="title">Kelola Soal {{ $record->jenis }}</x-slot>
    @section('header_title', 'Kelola Soal')
    @section('header_subtitle', $record->judul . ' — ' . $record->mapel)

    <style>
        .soal-back {
            display: inline-flex; align-items: center; gap: 7px; margin-bottom: 20px;
            padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 600;
            background: #f1f5f9; color: #475569; text-decoration: none;
            transition: all 0.2s; font-family: 'Inter', sans-serif;
        }
        .soal-back:hover { background: #e2e8f0; color: #1e293b; }

        .soal-stats {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;
        }
        .soal-stat {
            background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
            padding: 16px 18px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .soal-stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .soal-stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
        .soal-stat-icon.green { background: #ecfdf5; color: #059669; }
        .soal-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .soal-stat-label { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; }
        .soal-stat-value { font-size: 20px; font-weight: 700; color: #1e293b; letter-spacing: -0.3px; }

        .soal-toolbar {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
            background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
            padding: 12px 18px; margin-bottom: 20px;
        }
        .soal-info {
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap; font-size: 13px; color: #475569;
        }
        .soal-info i { color: #8b5cf6; }

        .soal-card {
            background: #fff; border: 1px solid #e2e8f0; border-radius: 14px;
            margin-bottom: 14px; overflow: hidden; transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .soal-card:hover { border-color: #cbd5e1; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .soal-card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; cursor: pointer; gap: 12px;
        }
        .soal-num {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; flex-shrink: 0;
        }
        .soal-text { flex: 1; font-size: 14px; font-weight: 600; color: #1e293b; }
        .soal-actions { display: flex; gap: 6px; flex-shrink: 0; }

        .soal-action-btn {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 13px; transition: all 0.15s;
        }
        .soal-action-btn.edit { background: #fef3c7; color: #d97706; }
        .soal-action-btn.edit:hover { background: #fde68a; }
        .soal-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .soal-action-btn.delete:hover { background: #fee2e2; }

        .soal-card-body {
            padding: 0 20px 16px; display: none;
        }
        .soal-card.open .soal-card-body { display: block; }
        .soal-card.open .soal-chevron i { transform: rotate(180deg); }
        .soal-chevron {
            width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;
            color: #94a3b8; transition: all 0.2s; flex-shrink: 0;
        }
        .soal-chevron i { transition: transform 0.2s; }

        .soal-tipe-badge {
            font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 20px;
            text-transform: uppercase; letter-spacing: 0.3px; flex-shrink: 0;
        }
        .soal-tipe-badge.pg { background: #f5f3ff; color: #7c3aed; }
        .soal-tipe-badge.essay { background: #fef3c7; color: #d97706; }

        .soal-options-preview { display: grid; gap: 6px; }
        .soal-opt-item {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 12px; border-radius: 8px; font-size: 13px; color: #475569;
        }
        .soal-opt-item.benar { background: #ecfdf5; color: #059669; font-weight: 600; }
        .soal-opt-item .opt-letter {
            width: 24px; height: 24px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; flex-shrink: 0;
        }
        .soal-opt-item .opt-letter.purple { background: #f5f3ff; color: #7c3aed; }
        .soal-opt-item.benar .opt-letter { background: #059669; color: #fff; }
        .soal-opt-item i { color: #10b981; margin-left: auto; }

        .soal-essay-answer {
            background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px;
            padding: 10px 14px; font-size: 13px; color: #92400e; line-height: 1.5;
        }
        .soal-essay-answer i { color: #d97706; margin-right: 6px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }

        .soal-essay-field { display: none; }
        .soal-pg-field { display: block; }

        .soal-empty {
            text-align: center; padding: 60px 20px; background: #fff;
            border-radius: 14px; border: 2px dashed #e2e8f0;
        }
        .soal-empty i { font-size: 48px; color: #cbd5e1; margin-bottom: 12px; }
        .soal-empty h3 { font-size: 16px; font-weight: 700; color: #64748b; margin-bottom: 4px; }
        .soal-empty p { font-size: 13px; color: #94a3b8; }

        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #fff; border-radius: 18px; width: 90%; max-width: 560px;
            max-height: 90vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: slideIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid #e2e8f0;
        }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            background: #f1f5f9; cursor: pointer; display: flex; align-items: center;
            justify-content: center; font-size: 16px; color: #64748b; transition: all 0.15s;
        }
        .modal-close:hover { background: #e2e8f0; color: #1a1a2e; }
        .modal-body { padding: 24px; }
        .modal-footer {
            display: flex; align-items: center; justify-content: flex-end;
            gap: 10px; padding: 18px 24px; border-top: 1px solid #e2e8f0;
        }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }
        .form-group label .req { color: #ef4444; }
        .form-control {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 13px;
            outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif;
            background: #f8fafc; color: #1a1a2e;
        }
        .form-control:focus { border-color: #8b5cf6; background: #fff; box-shadow: 0 0 0 4px rgba(139,92,246,0.1); }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: 10px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.ghost { background: #f1f5f9; color: #475569; }
        .btn.ghost:hover { background: #e2e8f0; }
        .btn.primary {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #fff; box-shadow: 0 4px 14px rgba(139,92,246,0.3);
        }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,92,246,0.4); }
        .btn.danger {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #fff; box-shadow: 0 4px 14px rgba(244,63,94,0.3);
        }
        .btn.danger:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(244,63,94,0.4); }

        .soal-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: toastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .soal-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .soal-toast.error { background: #fef2f2; border-color: #ef4444; }
        .soal-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .soal-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .soal-toast .toast-body { flex: 1; }
        .soal-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .soal-toast .toast-msg { font-size: 12px; color: #555; }
        .soal-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; font-size: 20px; color: #999;
        }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }
    </style>

    <a href="{{ route('admin.kuis-ujian') }}" class="soal-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

    <div class="soal-stats">
        <div class="soal-stat">
            <div class="soal-stat-icon purple"><i class="fa-solid fa-list"></i></div>
            <div>
                <div class="soal-stat-label">Total Soal</div>
                <div class="soal-stat-value" id="totalSoal">{{ count($soalList) }}</div>
            </div>
        </div>
        <div class="soal-stat">
            <div class="soal-stat-icon green"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="soal-stat-label">{{ $record->jenis }}</div>
                <div class="soal-stat-value" style="font-size:15px;font-weight:600;color:#475569;">{{ $record->judul }}</div>
            </div>
        </div>
        <div class="soal-stat">
            <div class="soal-stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="soal-stat-label">Durasi</div>
                <div class="soal-stat-value" style="font-size:15px;font-weight:600;color:#475569;">{{ $record->durasi }} menit</div>
            </div>
        </div>
    </div>

    <div class="soal-toolbar">
        <div class="soal-info">
            <i class="fa-solid fa-book-quran"></i>
            <span>{{ $record->mapel }} — Kelas {{ $record->kelas ?? '-' }}</span>
        </div>
        <button class="btn primary" onclick="openTambahSoal()"><i class="fa-solid fa-plus"></i> Tambah Soal</button>
    </div>

    <div id="soalContainer"></div>

    {{-- Form Modal --}}
    <div class="modal-overlay" id="formModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 style="font-size:16px;font-weight:700;color:#1a1a2e;margin:0;" id="formModalTitle">
                    <i class="fa-solid fa-pen" style="color:#8b5cf6;margin-right:8px;"></i>Tambah Soal
                </h3>
                <button class="modal-close" onclick="closeForm()">&times;</button>
            </div>
            <form id="soalForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="form-group">
                        <label>Pertanyaan <span class="req">*</span></label>
                        <textarea id="formSoal" class="form-control" style="min-height:70px;" placeholder="Tulis pertanyaan..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tipe Soal <span class="req">*</span></label>
                        <select id="formTipe" class="form-control" onchange="toggleTipeSoal()">
                            <option value="pg">Pilihan Ganda (PG)</option>
                            <option value="essay">Essai</option>
                        </select>
                    </div>
                    <div id="soalPgFields">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Pilihan A <span class="req">*</span></label>
                                <input type="text" id="formA" class="form-control" placeholder="Opsi A" required>
                            </div>
                            <div class="form-group">
                                <label>Pilihan B <span class="req">*</span></label>
                                <input type="text" id="formB" class="form-control" placeholder="Opsi B" required>
                            </div>
                            <div class="form-group">
                                <label>Pilihan C <span class="req">*</span></label>
                                <input type="text" id="formC" class="form-control" placeholder="Opsi C">
                            </div>
                            <div class="form-group">
                                <label>Pilihan D <span class="req">*</span></label>
                                <input type="text" id="formD" class="form-control" placeholder="Opsi D">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jawaban Benar <span class="req">*</span></label>
                            <select id="formKunci" class="form-control">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>
                    <div id="soalEssayFields" style="display:none;">
                        <div class="form-group">
                            <label>Kunci Jawaban <span class="req">*</span></label>
                            <textarea id="formJawaban" class="form-control" style="min-height:80px;" placeholder="Tulis kunci jawaban..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeForm()">Batal</button>
                    <button type="submit" class="btn primary" id="formSubmitBtn"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Hapus Modal --}}
    <div class="modal-overlay" id="hapusModal">
        <div class="modal-box" style="max-width:400px;">
            <div class="modal-header">
                <h3 style="font-size:16px;font-weight:700;color:#1a1a2e;margin:0;display:flex;align-items:center;gap:8px;">
                    <i class="fa-solid fa-trash" style="color:#ef4444;"></i> Hapus Soal
                </h3>
                <button class="modal-close" onclick="closeHapus()">&times;</button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p style="font-size:14px;color:#475569;line-height:1.6;">Yakin ingin menghapus soal ini?</p>
                <input type="hidden" id="hapusId">
            </div>
            <div class="modal-footer" style="justify-content:center;">
                <button class="btn ghost" onclick="closeHapus()" style="padding:10px 28px;">Batal</button>
                <button class="btn danger" onclick="confirmHapusSoal()" style="padding:10px 28px;"><i class="fa-solid fa-trash"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        const soalList = @json($soalList);

        function toggleTipeSoal() {
            const tipe = document.getElementById('formTipe').value;
            const pgFields = document.getElementById('soalPgFields');
            const essayFields = document.getElementById('soalEssayFields');
            const formA = document.getElementById('formA');
            const formB = document.getElementById('formB');
            const formJawaban = document.getElementById('formJawaban');
            if (tipe === 'pg') {
                pgFields.style.display = 'block';
                essayFields.style.display = 'none';
                formA.required = true;
                formB.required = true;
                formJawaban.required = false;
            } else {
                pgFields.style.display = 'none';
                essayFields.style.display = 'block';
                formA.required = false;
                formB.required = false;
                formJawaban.required = true;
            }
        }

        function renderSoal() {
            const container = document.getElementById('soalContainer');
            document.getElementById('totalSoal').textContent = soalList.length;
            if (soalList.length === 0) {
                container.innerHTML = '<div class="soal-empty"><i class="fa-solid fa-file-pen"></i><h3>Belum Ada Soal</h3><p>Klik "Tambah Soal" untuk menambahkan pertanyaan.</p></div>';
                return;
            }
            const letters = ['a', 'b', 'c', 'd'];
            const labels = ['A', 'B', 'C', 'D'];
            container.innerHTML = soalList.map((s, i) => {
                let bodyHtml = '';
                if (s.tipe === 'essay') {
                    bodyHtml = '<div class="soal-essay-answer"><i class="fa-solid fa-pen"></i>' + (s.jawaban || '(kunci jawaban belum diisi)') + '</div>';
                } else {
                    const options = [s.a, s.b, s.c, s.d];
                    const optsHtml = options.map((o, oi) => {
                        const isBenar = letters[oi] === s.kunci;
                        return '<div class="soal-opt-item' + (isBenar ? ' benar' : '') + '">' +
                            '<div class="opt-letter' + (isBenar ? '' : ' purple') + '">' + labels[oi] + '</div>' +
                            (o || '-') + (isBenar ? ' <i class="fa-solid fa-check-circle"></i>' : '') +
                            '</div>';
                    }).join('');
                    bodyHtml = '<div class="soal-options-preview">' + optsHtml + '</div>';
                }
                const tipeBadge = '<span class="soal-tipe-badge ' + (s.tipe || 'pg') + '">' + (s.tipe === 'essay' ? 'Essai' : 'PG') + '</span>';
                return '<div class="soal-card" data-id="' + s.id + '">' +
                    '<div class="soal-card-header" onclick="toggleSoal(this)">' +
                    '<div class="soal-num">' + (i + 1) + '</div>' +
                    '<div class="soal-text">' + s.soal + '</div>' +
                    tipeBadge +
                    '<div class="soal-actions">' +
                    '<button class="soal-action-btn edit" onclick="event.stopPropagation();openEditSoal(' + s.id + ')"><i class="fa-solid fa-pen"></i></button>' +
                    '<button class="soal-action-btn delete" onclick="event.stopPropagation();openHapusSoal(' + s.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                    '</div>' +
                    '<div class="soal-chevron"><i class="fa-solid fa-chevron-down"></i></div>' +
                    '</div>' +
                    '<div class="soal-card-body">' + bodyHtml + '</div>' +
                    '</div>';
            }).join('');
        }

        function toggleSoal(el) {
            const card = el.closest('.soal-card');
            card.classList.toggle('open');
        }

        function openTambahSoal() {
            document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-plus-circle" style="color:#8b5cf6;margin-right:8px;"></i>Tambah Soal';
            document.getElementById('formId').value = '';
            document.getElementById('soalForm').reset();
            document.getElementById('formTipe').value = 'pg';
            document.getElementById('formKunci').value = 'a';
            toggleTipeSoal();
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').classList.add('active');
        }

        function openEditSoal(id) {
            const s = soalList.find(d => d.id === id);
            if (!s) return;
            document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:#8b5cf6;margin-right:8px;"></i>Edit Soal';
            document.getElementById('formId').value = s.id;
            document.getElementById('formSoal').value = s.soal;
            document.getElementById('formTipe').value = s.tipe || 'pg';
            toggleTipeSoal();
            if ((s.tipe || 'pg') === 'essay') {
                document.getElementById('formJawaban').value = s.jawaban || '';
            } else {
                document.getElementById('formA').value = s.a || '';
                document.getElementById('formB').value = s.b || '';
                document.getElementById('formC').value = s.c || '';
                document.getElementById('formD').value = s.d || '';
                document.getElementById('formKunci').value = s.kunci || 'a';
            }
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
            document.getElementById('formModal').classList.add('active');
        }

        function closeForm() { document.getElementById('formModal').classList.remove('active'); }

        document.getElementById('soalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const tipe = document.getElementById('formTipe').value;
            const data = {
                pertanyaan: document.getElementById('formSoal').value,
                tipe: document.getElementById('formTipe').value,
                pilihan_a: document.getElementById('formA').value,
                pilihan_b: document.getElementById('formB').value,
                pilihan_c: document.getElementById('formC').value,
                pilihan_d: document.getElementById('formD').value,
                jawaban_benar: document.getElementById('formKunci').value,
                jawaban_essay: document.getElementById('formJawaban').value,
            };
            const soalId = document.getElementById('formId').value;
            const url = soalId ? '/admin/kuis-ujian/soal/' + soalId : '/admin/kuis-ujian/' + {{ $record->id }} + '/soal';
            const method = soalId ? 'PUT' : 'POST';
            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify(data),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    closeForm();
                    showToast('success', 'Berhasil!', 'Soal berhasil ' + (soalId ? 'diupdate' : 'disimpan') + '.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        });

        function openHapusSoal(id) {
            document.getElementById('hapusId').value = id;
            document.getElementById('hapusModal').classList.add('active');
        }
        function closeHapus() { document.getElementById('hapusModal').classList.remove('active'); }
        function confirmHapusSoal() {
            const id = document.getElementById('hapusId').value;
            fetch('/admin/kuis-ujian/soal/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    closeHapus();
                    showToast('success', 'Berhasil!', 'Soal berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        }

        function showToast(type, title, msg) {
            const existing = document.querySelector('.soal-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.className = 'soal-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { t.style.animation = 'toastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); }, 4000);
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) closeForm(); });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) closeHapus(); });

        renderSoal();
    </script>

</x-admin-layout>
