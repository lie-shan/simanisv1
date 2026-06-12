<x-admin-layout>
    <x-slot name="title">Koreksi {{ $record->jenis }}</x-slot>
    @section('header_title', 'Koreksi Jawaban')
    @section('header_subtitle', $record->judul . ' — ' . $record->mapel)

    <style>
        .koreksi-back {
            display: inline-flex; align-items: center; gap: 7px; margin: 8px 0 18px;
            padding: 10px 22px; border-radius: 10px; font-size: 13px; font-weight: 600;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #fff; text-decoration: none; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 14px rgba(139,92,246,0.3);
        }
        .koreksi-back:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,92,246,0.4); }

        .koreksi-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;
        }
        .koreksi-stat {
            background: #fff; border-radius: 14px; border: 1px solid #e2e8f0;
            padding: 16px 18px; display: flex; align-items: center; gap: 12px;
        }
        .koreksi-stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .koreksi-stat-icon.purple { background: #f5f3ff; color: #7c3aed; }
        .koreksi-stat-icon.green { background: #ecfdf5; color: #059669; }
        .koreksi-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .koreksi-stat-icon.blue { background: #eff6ff; color: #2563eb; }
        .koreksi-stat-label { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; }
        .koreksi-stat-value { font-size: 20px; font-weight: 700; color: #1e293b; letter-spacing: -0.3px; }

        .koreksi-siswa-card {
            background: #fff; border: 1px solid #e2e8f0; border-radius: 16px;
            margin-bottom: 20px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .koreksi-siswa-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; cursor: pointer; gap: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .koreksi-siswa-header:hover { background: #f8fafc; }
        .koreksi-siswa-avatar {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; flex-shrink: 0;
        }
        .koreksi-siswa-info { flex: 1; }
        .koreksi-siswa-nama { font-size: 14px; font-weight: 600; color: #1e293b; }
        .koreksi-siswa-nis { font-size: 11px; color: #94a3b8; }
        .koreksi-siswa-score {
            font-size: 22px; font-weight: 800; color: #1e293b;
        }
        .koreksi-siswa-score .label { font-size: 11px; font-weight: 400; color: #94a3b8; }
        .koreksi-siswa-body { padding: 0; display: none; }
        .koreksi-siswa-card.open .koreksi-siswa-body { display: block; }

        .koreksi-soal-row {
            display: grid; grid-template-columns: 48px 1fr auto;
            gap: 12px; padding: 14px 20px; border-bottom: 1px solid #f1f5f9;
            align-items: start;
        }
        .koreksi-soal-row:last-child { border-bottom: none; }

        .koreksi-soal-num {
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 12px; flex-shrink: 0;
        }
        .koreksi-soal-num.pg { background: #f5f3ff; color: #7c3aed; }
        .koreksi-soal-num.essay { background: #fef3c7; color: #d97706; }

        .koreksi-soal-text { font-size: 13px; color: #475569; }
        .koreksi-soal-text .soal { font-weight: 600; color: #1e293b; margin-bottom: 4px; }

        .koreksi-jawaban-pg {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;
        }
        .koreksi-jawaban-pg.benar { background: #ecfdf5; color: #059669; }
        .koreksi-jawaban-pg.salah { background: #fef2f2; color: #ef4444; }

        .koreksi-jawaban-essay {
            background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;
            padding: 10px 14px; font-size: 13px; color: #475569; line-height: 1.5; margin: 6px 0;
        }
        .koreksi-jawaban-essay .label {
            font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;
        }

        .koreksi-nilai-input {
            width: 70px; padding: 6px 10px; border: 1.5px solid #e2e8f0;
            border-radius: 8px; font-size: 14px; font-weight: 600; text-align: center;
            outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif;
        }
        .koreksi-nilai-input:focus { border-color: #8b5cf6; box-shadow: 0 0 0 3px rgba(139,92,246,0.1); }
        .koreksi-nilai-input.dinilai { border-color: #22c55e; background: #f0fdf4; }

        .koreksi-action-bar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;
            flex-wrap: wrap; gap: 12px;
        }
        .koreksi-action-bar .left { font-size: 13px; color: #64748b; }
        .koreksi-action-bar .left i { color: #8b5cf6; margin-right: 4px; }

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
        .btn.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff; box-shadow: 0 4px 14px rgba(16,185,129,0.3);
        }
        .btn.success:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }

        .koreksi-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: korIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .koreksi-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .koreksi-toast.error { background: #fef2f2; border-color: #ef4444; }
        .koreksi-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .koreksi-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .koreksi-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .koreksi-toast .toast-body { flex: 1; }
        .koreksi-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .koreksi-toast .toast-msg { font-size: 12px; color: #555; }
        .koreksi-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; font-size: 20px; color: #999;
        }
        @keyframes korIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes korOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        @media (max-width: 767px) {
            .koreksi-stats { grid-template-columns: repeat(2, 1fr); }
            .koreksi-soal-row { grid-template-columns: 1fr; }
        }
    </style>

    <a href="{{ route('admin.kuis-ujian') }}" class="koreksi-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

    <div class="koreksi-stats">
        <div class="koreksi-stat">
            <div class="koreksi-stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="koreksi-stat-label">Siswa</div>
                <div class="koreksi-stat-value">{{ count($siswaList) }}</div>
            </div>
        </div>
        <div class="koreksi-stat">
            <div class="koreksi-stat-icon green"><i class="fa-solid fa-file-pen"></i></div>
            <div>
                <div class="koreksi-stat-label">{{ $record->jenis }}</div>
                <div class="koreksi-stat-value" style="font-size:15px;font-weight:600;color:#475569;">{{ $record->judul }}</div>
            </div>
        </div>
        <div class="koreksi-stat">
            <div class="koreksi-stat-icon amber"><i class="fa-solid fa-list"></i></div>
            <div>
                <div class="koreksi-stat-label">Total Soal</div>
                <div class="koreksi-stat-value" id="statTotalSoal">{{ count($soalList) }}</div>
            </div>
        </div>
        <div class="koreksi-stat">
            <div class="koreksi-stat-icon blue"><i class="fa-solid fa-pen"></i></div>
            <div>
                <div class="koreksi-stat-label">Essai</div>
                <div class="koreksi-stat-value" id="statEssay">{{ $essayCount }}</div>
            </div>
        </div>
    </div>

    <div id="siswaContainer"></div>

    <script>
        const soalData = @json($soalList);
        const siswaList = @json($siswaList);
        const jawabanData = @json($jawabanSiswa);
        const pgKunci = {};
        soalData.forEach(s => { if ((s.tipe || 'pg') !== 'essay') pgKunci[s.id] = s.kunci; });
        const essayIds = soalData.filter(s => (s.tipe || 'pg') === 'essay').map(s => s.id);

        const nilaiSiswa = {};

        function renderSiswa() {
            const container = document.getElementById('siswaContainer');
            container.innerHTML = siswaList.map((siswa, si) => {
                let pgBenar = 0, totalPg = 0, totalEssay = 0, essayDinilai = 0, totalEssayNilai = 0;

                const siswaJawaban = jawabanData[si] || [];
                soalData.forEach(s => {
                    const sj = siswaJawaban.find(j => j.soal_id === s.id);
                    if (!sj) return;
                    if ((s.tipe || 'pg') === 'essay') {
                        totalEssay++;
                        const key = si + '_' + s.id;
                        const n = nilaiSiswa[key];
                        if (n !== undefined && n !== '') {
                            essayDinilai++;
                            totalEssayNilai += parseInt(n) || 0;
                        }
                    } else {
                        totalPg++;
                        if (sj.jawaban === s.kunci) pgBenar++;
                    }
                });

                const pgContrib = totalPg > 0 ? (pgBenar / totalPg) * (totalEssay > 0 ? 50 : 100) : 0;
                const essayContrib = totalEssay > 0 ? (totalEssayNilai / (totalEssay * 100)) * (totalPg > 0 ? 50 : 100) : 0;
                const totalScore = Math.round(pgContrib + essayContrib);

                const avatarLetter = siswa.nama.charAt(0);

                return '<div class="koreksi-siswa-card" data-siswa="' + si + '">' +
                    '<div class="koreksi-siswa-header" onclick="toggleSiswa(this)">' +
                    '<div class="koreksi-siswa-avatar">' + avatarLetter + '</div>' +
                    '<div class="koreksi-siswa-info">' +
                    '<div class="koreksi-siswa-nama">' + siswa.nama + '</div>' +
                    '<div class="koreksi-siswa-nis">NIS: ' + siswa.nis + '</div>' +
                    '</div>' +
                    '<div style="text-align:right;">' +
                    '<div class="koreksi-siswa-score" id="totalScore_' + si + '">' + totalScore + '<span class="label">/100</span></div>' +
                    '<div style="font-size:11px;color:' + (pgBenar === totalPg ? '#10b981' : '#94a3b8') + ';">PG: ' + pgBenar + '/' + totalPg +
                    (totalEssay > 0 ? ' &middot; Essai: ' + essayDinilai + '/' + totalEssay : '') +
                    '</div>' +
                    '</div>' +
                    '<div class="soal-chevron"><i class="fa-solid fa-chevron-down"></i></div>' +
                    '</div>' +
                    '<div class="koreksi-siswa-body">' +
                    soalData.map(s => {
                        const sj = siswaJawaban.find(j => j.soal_id === s.id);
                        const isEssay = (s.tipe || 'pg') === 'essay';
                        const numCls = isEssay ? 'essay' : 'pg';
                        const jawabanTeks = sj ? sj.jawaban : '-';

                        let jawabanHtml = '';
                        if (isEssay) {
                            const key = si + '_' + s.id;
                            const val = nilaiSiswa[key] !== undefined ? nilaiSiswa[key] : (sj ? (sj.nilai !== null ? sj.nilai : '') : '');
                            jawabanHtml = '<div class="koreksi-jawaban-essay"><div class="label">Jawaban Siswa</div>' + jawabanTeks + '</div>' +
                                '<div style="display:flex;align-items:center;gap:8px;">' +
                                '<label style="font-size:12px;font-weight:600;color:#475569;">Nilai (0-100):</label>' +
                                '<input type="number" min="0" max="100" class="koreksi-nilai-input" value="' + val + '" onchange="updateNilai(' + si + ', ' + s.id + ', this.value)" placeholder="0">' +
                                '</div>';
                        } else {
                            const isBenar = sj && sj.jawaban === s.kunci;
                            jawabanHtml = '<div class="koreksi-jawaban-pg ' + (isBenar ? 'benar' : 'salah') + '">' +
                                (isBenar ? '<i class="fa-solid fa-check-circle"></i>' : '<i class="fa-solid fa-times-circle"></i>') +
                                ' Jawaban: ' + (jawabanTeks || '-').toUpperCase() +
                                (s.kunci ? ' (Kunci: ' + s.kunci.toUpperCase() + ')' : '') +
                                '</div>';
                        }

                        return '<div class="koreksi-soal-row">' +
                            '<div class="koreksi-soal-num ' + numCls + '">' + (isEssay ? 'E' : 'PG') + '</div>' +
                            '<div class="koreksi-soal-text"><div class="soal">' + s.soal + '</div>' + jawabanHtml + '</div>' +
                            '</div>';
                    }).join('') +
                    '<div class="koreksi-action-bar">' +
                    '<div class="left"><i class="fa-solid fa-check-circle"></i> <span id="statusText_' + si + '">' + (essayDinilai === totalEssay && totalEssay > 0 ? 'Semua essai sudah dinilai' : (totalEssay > 0 ? 'Menunggu penilaian essai' : 'Tidak ada soal essai')) + '</span></div>' +
                    (totalEssay > 0 ? '<button class="btn success" onclick="simpanSemua(' + si + ')" style="padding:8px 18px;font-size:12px;"><i class="fa-solid fa-save"></i> Simpan Semua</button>' : '') +
                    '</div>' +
                    '</div>' +
                    '</div>';
            }).join('');
        }

        function toggleSiswa(el) {
            el.closest('.koreksi-siswa-card').classList.toggle('open');
        }

        function updateNilai(si, soalId, val) {
            const key = si + '_' + soalId;
            if (val === '') {
                delete nilaiSiswa[key];
            } else {
                nilaiSiswa[key] = val;
            }

            const totalEssay = essayIds.length;
            let essayDinilai = 0;
            essayIds.forEach(id => {
                const k = si + '_' + id;
                if (nilaiSiswa[k] !== undefined && nilaiSiswa[k] !== '') essayDinilai++;
            });
            const st = document.getElementById('statusText_' + si);
            if (st) {
                st.textContent = essayDinilai === totalEssay ? 'Semua essai sudah dinilai' : 'Menunggu penilaian essai (' + essayDinilai + '/' + totalEssay + ')';
            }
        }

        function simpanSemua(si) {
            const totalEssay = essayIds.length;
            let essayDinilai = 0;
            const nilaiData = {};
            essayIds.forEach(id => {
                const k = si + '_' + id;
                if (nilaiSiswa[k] !== undefined && nilaiSiswa[k] !== '') {
                    essayDinilai++;
                    nilaiData[id] = nilaiSiswa[k];
                }
            });
            if (essayDinilai < totalEssay) {
                showToast('error', 'Belum Lengkap', 'Masih ada ' + (totalEssay - essayDinilai) + ' soal essai belum dinilai.');
                return;
            }
            const siswaId = siswaList[si] ? siswaList[si].id : null;
            if (!siswaId) {
                showToast('error', 'Gagal!', 'Data siswa tidak ditemukan.');
                return;
            }
            fetch('/admin/kuis-ujian/' + {{ $record->id }} + '/koreksi/simpan', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify({ nilai: nilaiData, siswa_id: siswaId }),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    renderSiswa();
                    showToast('success', 'Semua Nilai Tersimpan', 'Jawaban essai untuk siswa ini sudah dinilai semua.');
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        }

        function showToast(type, title, msg) {
            const existing = document.querySelector('.koreksi-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.className = 'koreksi-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { t.style.animation = 'korOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); }, 4000);
        }

        renderSiswa();
    </script>

</x-admin-layout>
