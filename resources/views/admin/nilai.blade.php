<x-admin-layout>
    <x-slot name="title">Nilai & Rapor</x-slot>
    @section('header_title', 'Nilai & Rapor')
    @section('header_subtitle', 'Kelola nilai santri dan cetak rapor')

    <style>
        :root {
            --nl-primary: #f59e0b;
            --nl-primary-dark: #d97706;
            --nl-primary-light: #fffbeb;
            --nl-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .nl-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px;
        }
        .nl-stat {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 14px 15px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03); transition: all 0.2s;
        }
        .nl-stat:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,0.05); }
        .nl-stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .nl-stat-icon.gold { background: var(--nl-primary-light); color: var(--nl-primary); }
        .nl-stat-icon.blue { background: #eff6ff; color: #2563eb; }
        .nl-stat-icon.green { background: #ecfdf5; color: #059669; }
        .nl-stat-icon.red { background: #fef2f2; color: #ef4444; }
        .nl-stat-label { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; }
        .nl-stat-value { font-size: 22px; font-weight: 700; color: #1e293b; letter-spacing: -0.5px; }

        .nl-toolbar {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 12px 18px; margin-bottom: 18px;
        }
        .nl-filters { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .nl-filters select, .nl-filters input {
            padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 12px; outline: none; background: #fff; font-family: 'Inter', sans-serif;
            color: #1e293b; transition: all 0.2s;
        }
        .nl-filters select:focus, .nl-filters input:focus {
            border-color: var(--nl-primary); box-shadow: 0 0 0 3px rgba(245,158,11,0.1);
        }
        .nl-filters select { min-width: 130px; }
        .nl-filters input[type="search"] { min-width: 180px; }

        .nl-table-wrap {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            overflow-x: auto; box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .nl-table { width: 100%; border-collapse: collapse; font-size: 12px; }
        .nl-table thead { background: var(--nl-gradient); }
        .nl-table thead th {
            text-align: center; padding: 11px 10px; font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.3px; color: #fff; white-space: nowrap;
        }
        .nl-table tbody td {
            padding: 10px; border-bottom: 1px solid #f1f5f9; color: #475569;
            vertical-align: middle; text-align: center;
        }
        .nl-table tbody tr:hover { background: #fffbeb; }
        .nl-table tbody tr:last-child td { border-bottom: none; }
        .nl-table .nama-cell { text-align: left; font-weight: 600; color: #1e293b; white-space: nowrap; }

        .nl-score {
            display: inline-flex; align-items: center; justify-content: center;
            width: 34px; height: 26px; border-radius: 6px; font-weight: 700; font-size: 12px;
        }
        .nl-score.baik { background: #ecfdf5; color: #059669; }
        .nl-score.sedang { background: #fef3c7; color: #d97706; }
        .nl-score.kurang { background: #fef2f2; color: #ef4444; }

        .nl-avg {
            font-weight: 800; font-size: 14px;
        }
        .nl-avg.baik { color: #059669; }
        .nl-avg.sedang { color: #d97706; }
        .nl-avg.kurang { color: #ef4444; }

        .nl-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 600;
        }
        .nl-badge.lulus { background: #ecfdf5; color: #059669; }
        .nl-badge.cadangan { background: #fef3c7; color: #d97706; }
        .nl-badge.tidak-lulus { background: #fef2f2; color: #ef4444; }

        .nl-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .nl-action-btn {
            width: 30px; height: 30px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 12px; transition: all 0.15s;
        }
        .nl-action-btn.view { background: var(--nl-primary-light); color: var(--nl-primary); }
        .nl-action-btn.view:hover { background: #fef3c7; }
        .nl-action-btn.edit { background: #fef3c7; color: #d97706; }
        .nl-action-btn.edit:hover { background: #fde68a; }
        .nl-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .nl-action-btn.delete:hover { background: #fee2e2; }
        .nl-action-btn.print {
            background: #eff6ff; color: #2563eb; text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center;
            width: 30px; height: 30px; border-radius: 6px; font-size: 12px;
        }
        .nl-action-btn.print:hover { background: #dbeafe; }

        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #fff; border-radius: 18px; width: 90%; max-width: 560px;
            max-height: 90vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: nlIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .modal-box.wide { max-width: 660px; }
        @keyframes nlIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid #e2e8f0;
        }
        .modal-header h3 { font-size: 16px; font-weight: 700; color: #1a1a2e; margin: 0; display: flex; align-items: center; gap: 8px; }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px; border: none; background: #f1f5f9;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #64748b; transition: all 0.15s;
        }
        .modal-close:hover { background: #e2e8f0; }
        .modal-body { padding: 24px; }
        .modal-footer {
            display: flex; align-items: center; justify-content: flex-end;
            gap: 10px; padding: 18px 24px; border-top: 1px solid #e2e8f0;
        }

        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }
        .form-group label .req { color: #ef4444; }
        .form-control {
            width: 100%; padding: 9px 12px; box-sizing: border-box;
            border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px;
            outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif;
            background: #f8fafc; color: #1a1a2e;
        }
        .form-control:focus { border-color: var(--nl-primary); box-shadow: 0 0 0 4px rgba(245,158,11,0.1); background: #fff; }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 20px; border-radius: 10px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.ghost { background: #f1f5f9; color: #475569; }
        .btn.ghost:hover { background: #e2e8f0; }
        .btn.primary {
            background: var(--nl-gradient); color: #fff;
            box-shadow: 0 4px 14px rgba(245,158,11,0.3);
        }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(245,158,11,0.4); }
        .btn.danger {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #fff; box-shadow: 0 4px 14px rgba(244,63,94,0.3);
        }
        .btn.danger:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(244,63,94,0.4); }

        .nl-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: nlToastIn 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .nl-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .nl-toast.error { background: #fef2f2; border-color: #ef4444; }
        .nl-toast.error .toast-icon { background: #fee2e2; color: #dc2626; }
        .nl-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .nl-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .nl-toast .toast-body { flex: 1; }
        .nl-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .nl-toast .toast-msg { font-size: 12px; color: #555; }
        .nl-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; font-size: 20px; color: #999;
        }
        @keyframes nlToastIn {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes nlToastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        .detail-mapel-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 14px 0; }
        .detail-mapel-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 14px; border-radius: 8px; background: #f8fafc;
        }
        .detail-mapel-nama { font-size: 12px; font-weight: 600; color: #1e293b; }
        .detail-mapel-nilai { font-weight: 800; font-size: 15px; }

        @media (max-width: 767px) {
            .nl-stats { grid-template-columns: repeat(2, 1fr); }
            .detail-mapel-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="nl-stats">
        <div class="nl-stat">
            <div class="nl-stat-icon gold"><i class="fa-solid fa-star"></i></div>
            <div>
                <div class="nl-stat-label">Total Santri</div>
                <div class="nl-stat-value" id="statTotal">{{ count($records) }}</div>
            </div>
        </div>
        <div class="nl-stat">
            <div class="nl-stat-icon blue"><i class="fa-solid fa-chart-line"></i></div>
            <div>
                <div class="nl-stat-label">Rata-rata</div>
                <div class="nl-stat-value" id="statRata">{{ $rataRataKeseluruhan }}</div>
            </div>
        </div>
        <div class="nl-stat">
            <div class="nl-stat-icon green"><i class="fa-solid fa-arrow-up"></i></div>
            <div>
                <div class="nl-stat-label">Nilai Tertinggi</div>
                <div class="nl-stat-value" id="statTertinggi">{{ $nilaiTertinggi }}</div>
            </div>
        </div>
        <div class="nl-stat">
            <div class="nl-stat-icon red"><i class="fa-solid fa-arrow-down"></i></div>
            <div>
                <div class="nl-stat-label">Nilai Terendah</div>
                <div class="nl-stat-value" id="statTerendah">{{ $nilaiTerendah }}</div>
            </div>
        </div>
    </div>

    <div class="nl-toolbar">
        <div class="nl-filters">
            <select id="filterKelas" onchange="filterTable()">
                <option value="">Semua Kelas</option>
                <option value="1A">1A</option><option value="1B">1B</option>
                <option value="2A">2A</option><option value="2B">2B</option>
                <option value="3A">3A</option><option value="3B">3B</option>
            </select>
            <select id="filterStatus" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="Lulus">Lulus</option>
                <option value="Cadangan">Cadangan</option>
                <option value="Tidak Lulus">Tidak Lulus</option>
            </select>
            <input type="search" id="searchInput" placeholder="Cari santri..." oninput="filterTable()">
        </div>
        <button class="btn primary" onclick="openTambah()"><i class="fa-solid fa-plus"></i> Tambah Nilai</button>
    </div>

    <div class="nl-table-wrap">
        <table class="nl-table">
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th style="text-align:left;min-width:140px;">Nama Santri</th>
                    <th>Kelas</th>
                    @foreach($mapelList as $mapel)
                    <th style="min-width:70px;">{{ Str::of($mapel)->limit(8, '..') }}</th>
                    @endforeach
                    <th style="min-width:60px;">Rata²</th>
                    <th style="min-width:72px;">Status</th>
                    <th style="width:110px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="nlTableBody">
                @foreach($records as $i => $r)
                <tr data-kelas="{{ $r->kelas }}" data-status="{{ $r->status }}">
                    <td>{{ $i + 1 }}</td>
                    <td class="nama-cell">{{ $r->nama_santri }}<br><span style="font-size:10px;color:#94a3b8;font-weight:400;">{{ $r->no_registrasi }}</span></td>
                    <td>{{ $r->kelas }}</td>
                    @foreach($mapelList as $mapel)
                    @php $score = $r->nilai_mapel[$mapel] ?? 0; @endphp
                    <td><span class="nl-score {{ $score >= 80 ? 'baik' : ($score >= 60 ? 'sedang' : 'kurang') }}">{{ $score }}</span></td>
                    @endforeach
                    <td><span class="nl-avg {{ $r->rata_rata >= 80 ? 'baik' : ($r->rata_rata >= 60 ? 'sedang' : 'kurang') }}">{{ $r->rata_rata }}</span></td>
                    <td><span class="nl-badge {{ str_replace(' ', '-', strtolower($r->status)) }}">{{ $r->status }}</span></td>
                    <td>
                        <div class="nl-action-btns">
                            <button class="nl-action-btn view" title="Detail" onclick="openDetail({{ $r->id }})"><i class="fa-solid fa-eye"></i></button>
                            <button class="nl-action-btn edit" title="Edit" onclick="openEdit({{ $r->id }})"><i class="fa-solid fa-pen"></i></button>
                            <button class="nl-action-btn delete" title="Hapus" onclick="openHapus({{ $r->id }})"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Form Modal --}}
    <div class="modal-overlay" id="formModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="formModalTitle"><i class="fa-solid fa-plus-circle" style="color:var(--nl-primary);"></i> Tambah Nilai</h3>
                <button class="modal-close" onclick="closeForm()">&times;</button>
            </div>
            <form id="nilaiForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="form-group">
                        <label>Nama Santri <span class="req">*</span></label>
                        <select id="formNama" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santriList as $s)
                                <option value="{{ $s->nama }}" data-id="{{ $s->id }}" data-noreg="{{ $s->no_registrasi }}" data-kelas="{{ $s->kelas }}">{{ $s->nama }} ({{ $s->kelas }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div class="form-group">
                            <label>No Registrasi</label>
                            <input type="text" id="formNoreg" class="form-control" readonly style="background:#f1f5f9;color:#94a3b8;">
                        </div>
                        <div class="form-group">
                            <label>Kelas <span class="req">*</span></label>
                            <input type="text" id="formKelas" class="form-control" readonly style="background:#f1f5f9;color:#94a3b8;">
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div class="form-group">
                            <label>Semester</label>
                            <select id="formSemester" class="form-control"><option value="Ganjil" {{ $semester === 'Ganjil' ? 'selected' : '' }}>Ganjil</option><option value="Genap" {{ $semester === 'Genap' ? 'selected' : '' }}>Genap</option></select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" id="formTahun" class="form-control" value="{{ $tahunAjaran }}">
                        </div>
                    </div>
                    <div style="font-size:12px;font-weight:600;color:#1e293b;margin-bottom:10px;"><i class="fa-solid fa-book-open" style="color:var(--nl-primary);"></i> Nilai per Mapel</div>
                    @foreach($mapelList as $mapel)
                    <div class="form-group">
                        <label>{{ $mapel }}</label>
                        <input type="number" min="0" max="100" class="form-control" id="form_{{ Str::slug($mapel) }}" placeholder="0-100">
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="formKeterangan" class="form-control" style="min-height:50px;" placeholder="Catatan..."></textarea>
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
        <div class="modal-box" style="max-width:380px;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-trash" style="color:#ef4444;"></i> Hapus Nilai</h3>
                <button class="modal-close" onclick="closeHapus()">&times;</button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p style="font-size:14px;color:#475569;line-height:1.6;">Yakin ingin menghapus data nilai ini?</p>
                <input type="hidden" id="hapusId">
            </div>
            <div class="modal-footer" style="justify-content:center;">
                <button class="btn ghost" onclick="closeHapus()">Batal</button>
                <button class="btn danger" onclick="confirmHapus()"><i class="fa-solid fa-trash"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div class="modal-overlay" id="detailModal">
        <div class="modal-box wide">
            <div class="modal-header">
                <h3><i class="fa-solid fa-file-lines" style="color:var(--nl-primary);"></i> Detail Nilai Santri</h3>
                <button class="modal-close" onclick="closeDetail()">&times;</button>
            </div>
            <div class="modal-body" id="detailBody"></div>
            <div class="modal-footer">
                <button class="btn ghost" onclick="closeDetail()">Tutup</button>
                <button class="btn primary" id="detailPrintBtn"><i class="fa-solid fa-print"></i> Cetak Rapor</button>
            </div>
        </div>
    </div>

    <script>
        const recordsData = @json($records);
        const mapelList = @json($mapelList);

        function getScoreCls(score) {
            return score >= 80 ? 'baik' : (score >= 60 ? 'sedang' : 'kurang');
        }

        function renderRow(r, i) {
            const mapelTds = mapelList.map(m => {
                const sc = (r.nilai_mapel && r.nilai_mapel[m]) || 0;
                return '<td><span class="nl-score ' + getScoreCls(sc) + '">' + sc + '</span></td>';
            }).join('');
            const statusCls = r.status.toLowerCase().replace(' ', '-');
            return '<tr data-kelas="' + r.kelas + '" data-status="' + r.status + '">' +
                '<td>' + (i + 1) + '</td>' +
                '<td class="nama-cell">' + r.nama_santri + '<br><span style="font-size:10px;color:#94a3b8;font-weight:400;">' + (r.no_registrasi || '-') + '</span></td>' +
                '<td>' + r.kelas + '</td>' +
                mapelTds +
                '<td><span class="nl-avg ' + getScoreCls(r.rata_rata) + '">' + r.rata_rata + '</span></td>' +
                '<td><span class="nl-badge ' + statusCls + '">' + r.status + '</span></td>' +
                '<td><div class="nl-action-btns">' +
                '<button class="nl-action-btn view" title="Detail" onclick="openDetail(' + r.id + ')"><i class="fa-solid fa-eye"></i></button>' +
                '<button class="nl-action-btn edit" title="Edit" onclick="openEdit(' + r.id + ')"><i class="fa-solid fa-pen"></i></button>' +
                '<button class="nl-action-btn delete" title="Hapus" onclick="openHapus(' + r.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                '</div></td></tr>';
        }

        function filterTable() {
            const kelas = document.getElementById('filterKelas').value;
            const status = document.getElementById('filterStatus').value;
            const q = document.getElementById('searchInput').value.toLowerCase();
            const tbody = document.getElementById('nlTableBody');
            let filtered = recordsData.filter(r => {
                if (kelas && r.kelas !== kelas) return false;
                if (status && r.status !== status) return false;
                if (q && !r.nama_santri.toLowerCase().includes(q) && !(r.no_registrasi || '').includes(q)) return false;
                return true;
            });
            tbody.innerHTML = filtered.map((r, i) => renderRow(r, i)).join('');
            updateStats(filtered);
        }

        function updateStats(filtered) {
            document.getElementById('statTotal').textContent = filtered.length;
            if (filtered.length === 0) {
                document.getElementById('statRata').textContent = '0';
                document.getElementById('statTertinggi').textContent = '0';
                document.getElementById('statTerendah').textContent = '0';
                return;
            }
            const total = filtered.reduce((s, r) => s + parseFloat(r.rata_rata), 0);
            document.getElementById('statRata').textContent = (total / filtered.length).toFixed(2);
            const sorted = [...filtered].sort((a, b) => b.rata_rata - a.rata_rata);
            document.getElementById('statTertinggi').textContent = sorted[0].rata_rata;
            document.getElementById('statTerendah').textContent = sorted[sorted.length - 1].rata_rata;
        }

        document.getElementById('formNama').addEventListener('change', function() {
            const opt = this.selectedOptions[0];
            document.getElementById('formNoreg').value = opt?.dataset?.noreg || '';
            document.getElementById('formKelas').value = opt?.dataset?.kelas || '';
        });

        function openTambah() {
            document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-plus-circle" style="color:var(--nl-primary);"></i> Tambah Nilai';
            document.getElementById('formId').value = '';
            document.getElementById('nilaiForm').reset();
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').classList.add('active');
        }

        function openEdit(id) {
            fetch('/admin/nilai/' + id + '/edit')
                .then(res => res.json())
                .then(r => {
                    document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:var(--nl-primary);"></i> Edit Nilai';
                    document.getElementById('formId').value = r.id;
                    document.getElementById('formNama').value = r.nama_santri;
                    document.getElementById('formNoreg').value = r.no_registrasi || '';
                    document.getElementById('formKelas').value = r.kelas;
                    document.getElementById('formSemester').value = r.semester || '{{ $semester }}';
                    document.getElementById('formTahun').value = r.tahun_ajaran || '{{ $tahunAjaran }}';
                    document.getElementById('formKeterangan').value = r.keterangan || '';
                    mapelList.forEach(m => {
                        const el = document.getElementById('form_' + m.toLowerCase().replace(/\s+/g, '-').replace(/'/g, ''));
                        if (el) el.value = (r.nilai_mapel && r.nilai_mapel[m]) || '';
                    });
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
                    document.getElementById('formModal').classList.add('active');
                });
        }

        function closeForm() { document.getElementById('formModal').classList.remove('active'); }

        document.getElementById('nilaiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const santriOpt = document.getElementById('formNama').selectedOptions[0];
            const nilaiMapel = {};
            mapelList.forEach(m => {
                const el = document.getElementById('form_' + m.toLowerCase().replace(/\s+/g, '-').replace(/'/g, ''));
                nilaiMapel[m] = parseInt(el?.value) || 0;
            });
            const data = {
                nama_santri: document.getElementById('formNama').value,
                no_registrasi: document.getElementById('formNoreg').value,
                kelas: document.getElementById('formKelas').value,
                semester: document.getElementById('formSemester').value,
                tahun_ajaran: document.getElementById('formTahun').value,
                nilai_mapel: nilaiMapel,
                keterangan: document.getElementById('formKeterangan').value,
                santri_id: santriOpt?.dataset?.id || '',
            };
            const url = id ? '/admin/nilai/' + id : '/admin/nilai';
            const method = id ? 'PUT' : 'POST';
            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify(data),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    showToast('success', 'Berhasil!', 'Data nilai berhasil ' + (id ? 'diupdate' : 'disimpan'));
                    closeForm();
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        });

        function openHapus(id) {
            document.getElementById('hapusId').value = id;
            document.getElementById('hapusModal').classList.add('active');
        }
        function closeHapus() { document.getElementById('hapusModal').classList.remove('active'); }
        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('/admin/nilai/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    closeHapus();
                    showToast('success', 'Berhasil!', 'Data nilai berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(() => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        }

        function openDetail(id) {
            const r = recordsData.find(d => d.id === id);
            if (!r) return;
            const mapelHtml = mapelList.map(m => {
                const sc = (r.nilai_mapel && r.nilai_mapel[m]) || 0;
                return '<div class="detail-mapel-item"><span class="detail-mapel-nama">' + m + '</span><span class="detail-mapel-nilai" style="color:' + (sc >= 80 ? '#059669' : (sc >= 60 ? '#d97706' : '#ef4444')) + '">' + sc + '</span></div>';
            }).join('');
            const statusCls = r.status.toLowerCase().replace(' ', '-');
            document.getElementById('detailBody').innerHTML =
                '<div style="display:flex;align-items:center;gap:14px;margin-bottom:16px;">' +
                '<div style="width:48px;height:48px;border-radius:12px;background:var(--nl-gradient);color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;flex-shrink:0;">' + r.nama_santri.charAt(0) + '</div>' +
                '<div><div style="font-size:16px;font-weight:700;color:#1e293b;">' + r.nama_santri + '</div><div style="font-size:12px;color:#64748b;">' + (r.no_registrasi || '-') + ' &middot; Kelas ' + r.kelas + ' &middot; ' + (r.semester || '-') + ' ' + (r.tahun_ajaran || '') + '</div></div>' +
                '<div style="margin-left:auto;text-align:right;"><div style="font-size:24px;font-weight:800;color:' + (r.rata_rata >= 80 ? '#059669' : (r.rata_rata >= 60 ? '#d97706' : '#ef4444')) + ';">' + r.rata_rata + '</div><div style="font-size:10px;color:#94a3b8;font-weight:600;text-transform:uppercase;">Rata-rata</div></div>' +
                '</div>' +
                '<div style="display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap;">' +
                '<span class="nl-badge ' + statusCls + '">' + r.status + '</span>' +
                '</div>' +
                '<div style="font-size:13px;font-weight:600;color:#1e293b;margin-bottom:8px;"><i class="fa-solid fa-book-open" style="color:var(--nl-primary);"></i> Nilai per Mata Pelajaran</div>' +
                '<div class="detail-mapel-grid">' + mapelHtml + '</div>' +
                (r.keterangan ? '<div style="margin-top:12px;padding:10px 14px;background:#fffbeb;border-radius:8px;font-size:12px;color:#92400e;"><i class="fa-solid fa-quote-left" style="color:#d97706;margin-right:6px;"></i>' + r.keterangan + '</div>' : '');
            document.getElementById('detailModal').classList.add('active');
            document.getElementById('detailPrintBtn').onclick = function() {
                window.open('/admin/nilai/' + r.id + '/rapor', '_blank');
            };
        }
        function closeDetail() { document.getElementById('detailModal').classList.remove('active'); }

        function showToast(type, title, msg) {
            const existing = document.querySelector('.nl-toast');
            if (existing) existing.remove();
            const icons = { success: 'fa-check-circle', error: 'fa-times-circle' };
            const t = document.createElement('div');
            t.className = 'nl-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid ' + (icons[type] || 'fa-check-circle') + '"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { t.style.animation = 'nlToastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); }, 4000);
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) closeForm(); });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) closeHapus(); });
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) closeDetail(); });
    </script>

</x-admin-layout>
