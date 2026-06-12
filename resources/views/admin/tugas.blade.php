<x-admin-layout>
    <x-slot name="title">Pengumpulan Tugas</x-slot>
    @section('header_title', 'Pengumpulan Tugas')
    @section('header_subtitle', 'Kelola tugas dan pengumpulan santri')

    <style>
        :root {
            --tg-primary: #e11d48;
            --tg-primary-dark: #be123c;
            --tg-primary-light: #fff1f2;
            --tg-gradient: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
        }

        .tg-stats {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin: 0 0 28px;
        }
        .tg-stat {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 14px 15px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03); transition: all 0.2s;
        }
        .tg-stat:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,0.05); }
        .tg-stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .tg-stat-icon.pink { background: var(--tg-primary-light); color: var(--tg-primary); }
        .tg-stat-icon.green { background: #ecfdf5; color: #059669; }
        .tg-stat-icon.amber { background: #fef3c7; color: #d97706; }
        .tg-stat-icon.blue { background: #eff6ff; color: #2563eb; }
        .tg-stat-label { font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.4px; }
        .tg-stat-value { font-size: 22px; font-weight: 700; color: #1e293b; letter-spacing: -0.5px; }

        .tg-toolbar {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            padding: 12px 18px; margin-bottom: 18px;
        }
        .tg-filters { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .tg-filters select, .tg-filters input {
            padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 12px; outline: none; background: #fff; font-family: 'Inter', sans-serif;
            color: #1e293b; transition: all 0.2s;
        }
        .tg-filters select:focus, .tg-filters input:focus {
            border-color: var(--tg-primary); box-shadow: 0 0 0 3px rgba(225,29,72,0.1);
        }
        .tg-filters select { min-width: 140px; }
        .tg-filters input[type="search"] { min-width: 200px; }

        .tg-table-wrap {
            background: #fff; border-radius: 12px; border: 1px solid var(--border-color);
            overflow-x: auto; box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .tg-table {
            width: 100%; border-collapse: collapse; font-size: 13px;
        }
        .tg-table thead { background: var(--tg-gradient); }
        .tg-table thead th {
            text-align: center; padding: 12px 14px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.3px; color: #fff;
        }
        .tg-table tbody td {
            padding: 12px 14px; border-bottom: 1px solid #f1f5f9; color: #475569;
            vertical-align: middle; text-align: center;
        }
        .tg-table tbody tr:hover { background: #f8fafc; }
        .tg-table tbody tr:last-child td { border-bottom: none; }

        .tg-table tbody td.tg-judul {
            text-align: left; font-weight: 600; color: #1e293b; max-width: 200px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .tg-deskripsi {
            font-size: 11px; color: #94a3b8; font-weight: 400; display: block;
        }

        .tg-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .tg-badge.aktif { background: #fef3c7; color: #d97706; }
        .tg-badge.selesai { background: #ecfdf5; color: #059669; }

        .tg-progress {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 12px; font-weight: 600; color: #64748b;
        }
        .tg-progress-bar {
            width: 60px; height: 6px; border-radius: 4px; background: #e2e8f0; overflow: hidden;
        }
        .tg-progress-fill { height: 100%; border-radius: 4px; transition: width 0.3s; }
        .tg-progress-fill.baik { background: #22c55e; }
        .tg-progress-fill.sedang { background: #eab308; }
        .tg-progress-fill.kurang { background: #ef4444; }

        .tg-lampiran {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px;
        }
        .tg-lampiran.ada { background: #fff1f2; color: #e11d48; }
        .tg-lampiran.tidak { background: #f1f5f9; color: #94a3b8; }

        .tg-action-btns { display: flex; align-items: center; gap: 4px; justify-content: center; }
        .tg-action-btn {
            width: 32px; height: 32px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 13px; transition: all 0.15s;
        }
        .tg-action-btn.view { background: var(--tg-primary-light); color: var(--tg-primary); }
        .tg-action-btn.view:hover { background: #ffe4e6; }
        .tg-action-btn.edit { background: #fef3c7; color: #d97706; }
        .tg-action-btn.edit:hover { background: #fde68a; }
        .tg-action-btn.delete { background: #fef2f2; color: #dc2626; }
        .tg-action-btn.delete:hover { background: #fee2e2; }

        /* Modal */
        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5);
            z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #fff; border-radius: 18px; width: 90%; max-width: 520px;
            max-height: 90vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: modalIn 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .modal-box.wide { max-width: 640px; }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid #e2e8f0;
        }
        .modal-header h3 { font-size: 16px; font-weight: 700; color: #1a1a2e; margin: 0; }
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

        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }
        .form-group label .req { color: #ef4444; }
        .form-control {
            width: 100%; padding: 10px 14px; box-sizing: border-box;
            border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 13px;
            outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif;
            background: #f8fafc; color: #1a1a2e;
        }
        .form-control:focus { border-color: var(--tg-primary); box-shadow: 0 0 0 4px rgba(225,29,72,0.1); background: #fff; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: 10px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif; text-decoration: none;
        }
        .btn.ghost { background: #f1f5f9; color: #475569; }
        .btn.ghost:hover { background: #e2e8f0; }
        .btn.primary {
            background: var(--tg-gradient); color: #fff;
            box-shadow: 0 4px 14px rgba(225,29,72,0.3);
        }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(225,29,72,0.4); }
        .btn.danger {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #fff; box-shadow: 0 4px 14px rgba(244,63,94,0.3);
        }
        .btn.danger:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(244,63,94,0.4); }
        .btn.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff; box-shadow: 0 4px 14px rgba(16,185,129,0.3);
        }
        .btn.success:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }

        .tg-toast {
            position: fixed; top: 24px; right: 24px; z-index: 9999;
            display: flex; align-items: center; gap: 14px; padding: 16px 20px;
            border-radius: 12px; min-width: 320px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            animation: toastSlide 0.4s cubic-bezier(0.22, 1, 0.36, 1); border-left: 4px solid;
        }
        .tg-toast.success { background: #f0fdf4; border-color: #22c55e; }
        .tg-toast .toast-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
        }
        .tg-toast.success .toast-icon { background: #dcfce7; color: #16a34a; }
        .tg-toast .toast-body { flex: 1; }
        .tg-toast .toast-title { font-size: 14px; font-weight: 700; color: #1a1a2e; margin-bottom: 2px; }
        .tg-toast .toast-msg { font-size: 12px; color: #555; }
        .tg-toast .toast-close {
            width: 28px; height: 28px; border-radius: 8px; border: none;
            background: transparent; cursor: pointer; font-size: 20px; color: #999;
        }
        @keyframes toastSlide {
            from { opacity: 0; transform: translateX(40px) scale(0.95); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(40px) scale(0.95); }
        }

        /* Detail Modal */
        .detail-siswa-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 0; border-bottom: 1px solid #f1f5f9;
        }
        .detail-siswa-item:last-child { border-bottom: none; }
        .detail-siswa-avatar {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; flex-shrink: 0;
        }
        .detail-siswa-avatar.baik { background: #ecfdf5; color: #059669; }
        .detail-siswa-avatar.telat { background: #fef3c7; color: #d97706; }
        .detail-siswa-avatar.belum { background: #f1f5f9; color: #94a3b8; }
        .detail-siswa-info { flex: 1; padding: 0 12px; }
        .detail-siswa-nama { font-size: 13px; font-weight: 600; color: #1e293b; }
        .detail-siswa-tgl { font-size: 11px; color: #94a3b8; }
        .detail-status {
            font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px;
        }
        .detail-status.baik { background: #ecfdf5; color: #059669; }
        .detail-status.telat { background: #fef3c7; color: #d97706; }
        .detail-status.belum { background: #f1f5f9; color: #94a3b8; }
        .detail-summary {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 16px;
        }
        .detail-sum-item { text-align: center; padding: 12px; border-radius: 10px; background: #f8fafc; }
        .detail-sum-value { font-size: 22px; font-weight: 700; }
        .detail-sum-value.baik { color: #059669; }
        .detail-sum-value.telat { color: #d97706; }
        .detail-sum-value.belum { color: #94a3b8; }
        .detail-sum-label { font-size: 10px; font-weight: 600; text-transform: uppercase; color: #94a3b8; margin-top: 2px; }

        @media (max-width: 767px) {
            .tg-stats { grid-template-columns: repeat(2, 1fr); }
            .form-row { grid-template-columns: 1fr; }
            .tg-filters input[type="search"] { min-width: 140px; }
        }
    </style>

    <div class="tg-stats">
        <div class="tg-stat">
            <div class="tg-stat-icon pink"><i class="fa-solid fa-folder-open"></i></div>
            <div>
                <div class="tg-stat-label">Total Tugas</div>
                <div class="tg-stat-value" id="statTotal">{{ count($records) }}</div>
            </div>
        </div>
        <div class="tg-stat">
            <div class="tg-stat-icon green"><i class="fa-solid fa-play"></i></div>
            <div>
                <div class="tg-stat-label">Aktif</div>
                <div class="tg-stat-value" id="statAktif">{{ $totalAktif }}</div>
            </div>
        </div>
        <div class="tg-stat">
            <div class="tg-stat-icon amber"><i class="fa-solid fa-clock"></i></div>
            <div>
                <div class="tg-stat-label">Deadline Hari Ini</div>
                <div class="tg-stat-value" id="statDeadline">{{ $deadlineHariIni }}</div>
            </div>
        </div>
        <div class="tg-stat">
            <div class="tg-stat-icon blue"><i class="fa-solid fa-check-circle"></i></div>
            <div>
                <div class="tg-stat-label">Selesai</div>
                <div class="tg-stat-value" id="statSelesai">{{ $totalSelesai }}</div>
            </div>
        </div>
    </div>

    <div class="tg-toolbar">
        <div class="tg-filters">
            <select id="filterStatus" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Selesai">Selesai</option>
            </select>
            <select id="filterKelas" onchange="filterTable()">
                <option value="">Semua Kelas</option>
                <option value="1A">1A</option>
                <option value="1B">1B</option>
                <option value="2A">2A</option>
                <option value="2B">2B</option>
                <option value="3A">3A</option>
                <option value="3B">3B</option>
            </select>
            <input type="search" id="searchInput" placeholder="Cari tugas..." oninput="filterTable()">
        </div>
        <button class="btn primary" onclick="openTambah()"><i class="fa-solid fa-plus"></i> Tambah Tugas</button>
    </div>

    <div class="tg-table-wrap">
        <table class="tg-table">
            <thead>
                <tr>
                    <th style="width:50px;text-align:center;">No</th>
                    <th style="text-align:center;">Judul Tugas</th>
                    <th style="text-align:center;">Kelas</th>
                    <th style="text-align:center;">Mapel</th>
                    <th style="text-align:center;">Deadline</th>
                    <th style="text-align:center;">Pengumpul</th>
                    <th style="text-align:center;">Lampiran</th>
                    <th style="text-align:center;">Status</th>
                    <th style="width:120px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tgTableBody">
                @foreach($records as $i => $r)
                <tr data-status="{{ $r->status }}" data-kelas="{{ $r->kelas }}">
                    <td>{{ $i + 1 }}</td>
                    <td class="tg-judul">{{ $r->judul }}<span class="tg-deskripsi">{{ $r->deskripsi }}</span></td>
                    <td>{{ $r->kelas }}</td>
                    <td>{{ $r->mapel }}</td>
                    <td><span style="font-size:12px;">{{ \Carbon\Carbon::parse($r->tanggal_deadline)->isoFormat('D MMM') }}</span></td>
                    <td>
                        <div class="tg-progress">
                            <span>{{ $r->pengumpul ?? 0 }}/{{ $r->total_santri ?? 0 }}</span>
                            <div class="tg-progress-bar">
                                @php $total = $r->total_santri ?? 0; $pct = $total > 0 ? round((($r->pengumpul ?? 0) / $total) * 100) : 0; @endphp
                                <div class="tg-progress-fill {{ $pct >= 80 ? 'baik' : ($pct >= 50 ? 'sedang' : 'kurang') }}" style="width:{{ $pct }}%;"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="tg-lampiran {{ $r->lampiran ?? 'tidak' }}">
                            <i class="fa-solid {{ ($r->lampiran ?? false) ? 'fa-paperclip' : 'fa-minus' }}"></i>
                            {{ ($r->lampiran ?? false) ? 'Ada' : 'Tidak' }}
                        </span>
                        @if($r->lampiran ?? false)
                        <a href="{{ asset('storage/'.$r->lampiran) }}" target="_blank" style="display:inline-flex;align-items:center;gap:4px;margin-left:4px;font-size:10px;color:#e11d48;text-decoration:none;font-weight:600;"><i class="fa-solid fa-external-link-alt"></i></a>
                        @endif
                    </td>
                    <td>
                        <span class="tg-badge {{ strtolower($r->status) }}">
                            <i class="fa-solid {{ $r->status === 'Aktif' ? 'fa-play' : 'fa-check' }}"></i> {{ $r->status }}
                        </span>
                    </td>
                    <td>
                        <div class="tg-action-btns">
                            <a href="{{ route('admin.tugas.kerjakan', $r->id) }}" class="tg-action-btn view" title="Kerjakan Tugas" style="background:#ecfdf5;color:#10b981;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:14px;"><i class="fa-solid fa-play"></i></a>
                            <button class="tg-action-btn view" title="Detail Pengumpulan" onclick="openDetail({{ $r->id }})"><i class="fa-solid fa-eye"></i></button>
                            <button class="tg-action-btn edit" title="Edit" onclick="openEdit({{ $r->id }})"><i class="fa-solid fa-pen"></i></button>
                            <button class="tg-action-btn delete" title="Hapus" onclick="openHapus({{ $r->id }})"><i class="fa-solid fa-trash"></i></button>
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
                <h3 id="formModalTitle"><i class="fa-solid fa-plus-circle" style="color:var(--tg-primary);margin-right:8px;"></i>Tambah Tugas</h3>
                <button class="modal-close" onclick="closeForm()">&times;</button>
            </div>
            <form id="tugasForm" onsubmit="return false;">
                <div class="modal-body">
                    <input type="hidden" id="formId">
                    <div class="form-group">
                        <label>Judul Tugas <span class="req">*</span></label>
                        <input type="text" id="formJudul" class="form-control" placeholder="Contoh: Mengerjakan Soal Tahsin" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="formDeskripsi" class="form-control" style="min-height:60px;" placeholder="Deskripsi tugas..."></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kelas <span class="req">*</span></label>
                            <select id="formKelas" class="form-control">
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                                <option value="2A">2A</option>
                                <option value="2B">2B</option>
                                <option value="3A">3A</option>
                                <option value="3B">3B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mapel <span class="req">*</span></label>
                            <select id="formMapel" class="form-control">
                                <option value="Tahsin Al-Qur'an">Tahsin Al-Qur'an</option>
                                <option value="Tahfidz Juz 30">Tahfidz Juz 30</option>
                                <option value="Fiqih Ibadah">Fiqih Ibadah</option>
                                <option value="Aqidah Akhlak">Aqidah Akhlak</option>
                                <option value="Sejarah Islam">Sejarah Islam</option>
                                <option value="Bahasa Arab">Bahasa Arab</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tanggal Deadline <span class="req">*</span></label>
                            <input type="date" id="formDeadline" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="formStatus" class="form-control">
                                <option value="Aktif">Aktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lampiran (File Soal/Materi)</label>
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                            <label style="flex:1;display:flex;align-items:center;gap:10px;padding:10px 14px;border:1.5px dashed #e2e8f0;border-radius:10px;cursor:pointer;transition:all 0.2s;background:#f8fafc;" id="fileLabel" onmouseover="this.style.borderColor='#e11d48'" onmouseout="this.style.borderColor='#e2e8f0'">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:20px;color:#e11d48;"></i>
                                <span style="font-size:13px;color:#94a3b8;" id="fileName">Belum ada file dipilih</span>
                                <input type="file" id="formFile" accept=".pdf" style="display:none;" onchange="handleFile(this)">
                            </label>
                            <button type="button" class="btn ghost" onclick="hapusFile()" id="hapusFileBtn" style="display:none;padding:8px 14px;font-size:12px;"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:4px;"><i class="fa-solid fa-info-circle"></i> Format PDF maksimal 2MB</div>
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
                <h3><i class="fa-solid fa-trash" style="color:#ef4444;margin-right:8px;"></i> Hapus Tugas</h3>
                <button class="modal-close" onclick="closeHapus()">&times;</button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p style="font-size:14px;color:#475569;line-height:1.6;">Yakin ingin menghapus tugas ini?</p>
                <p style="font-size:12px;color:#94a3b8;" id="hapusInfo"></p>
                <input type="hidden" id="hapusId">
            </div>
            <div class="modal-footer" style="justify-content:center;">
                <button class="btn ghost" onclick="closeHapus()" style="padding:10px 28px;">Batal</button>
                <button class="btn danger" onclick="confirmHapus()" style="padding:10px 28px;"><i class="fa-solid fa-trash"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div class="modal-overlay" id="detailModal">
        <div class="modal-box wide">
            <div class="modal-header">
                <h3><i class="fa-solid fa-users" style="color:var(--tg-primary);margin-right:8px;"></i> Detail Pengumpulan</h3>
                <button class="modal-close" onclick="closeDetail()">&times;</button>
            </div>
            <div class="modal-body" id="detailBody"></div>
        </div>
    </div>

    <script>
        const recordsData = @json($records);
        let fileSimpan = null;
        let fileNameSimpan = '';
        let lampiranDihapus = false;

        function handleFile(input) {
            const f = input.files[0];
            if (!f) return;
            if (f.type !== 'application/pdf') {
                showToast('error', 'Format Salah', 'Hanya file PDF yang diperbolehkan.');
                input.value = '';
                return;
            }
            if (f.size > 2 * 1024 * 1024) {
                showToast('error', 'Terlalu Besar', 'Maksimal 2MB.');
                input.value = '';
                return;
            }
            fileSimpan = f;
            fileNameSimpan = f.name;
            document.getElementById('fileName').textContent = f.name;
            document.getElementById('fileName').style.color = '#1e293b';
            document.getElementById('hapusFileBtn').style.display = '';
        }

        function hapusFile() {
            fileSimpan = null;
            fileNameSimpan = '';
            document.getElementById('formFile').value = '';
            document.getElementById('fileName').textContent = 'Belum ada file dipilih';
            document.getElementById('fileName').style.color = '#94a3b8';
            document.getElementById('hapusFileBtn').style.display = 'none';
            if (document.getElementById('formId').value) {
                lampiranDihapus = true;
            }
        }

        function renderRow(r, i) {
            const pct = r.total_santri > 0 ? Math.round(((r.pengumpul || 0) / r.total_santri) * 100) : 0;
            const fillCls = pct >= 80 ? 'baik' : (pct >= 50 ? 'sedang' : 'kurang');
            const statusCls = r.status.toLowerCase();
            const icon = r.status === 'Aktif' ? 'fa-play' : 'fa-check';
            const adaLampiran = r.lampiran || false;
            const lampiranHtml = '<span class="tg-lampiran ' + (adaLampiran ? 'ada' : 'tidak') + '"><i class="fa-solid ' + (adaLampiran ? 'fa-paperclip' : 'fa-minus') + '"></i> ' + (adaLampiran ? 'Ada' : 'Tidak') + '</span>' +
                (adaLampiran ? '<a href="/storage/' + r.lampiran + '" target="_blank" style="display:inline-flex;align-items:center;gap:4px;margin-left:4px;font-size:10px;color:#e11d48;text-decoration:none;font-weight:600;"><i class="fa-solid fa-external-link-alt"></i></a>' : '');
            return '<tr data-status="' + r.status + '" data-kelas="' + r.kelas + '">' +
                '<td>' + (i + 1) + '</td>' +
                '<td class="tg-judul">' + r.judul + '<span class="tg-deskripsi">' + r.deskripsi + '</span></td>' +
                '<td>' + r.kelas + '</td>' +
                '<td>' + r.mapel + '</td>' +
                '<td><span style="font-size:12px;">' + r.tanggal_deadline + '</span></td>' +
                '<td><div class="tg-progress"><span>' + r.pengumpul + '/' + r.total_santri + '</span><div class="tg-progress-bar"><div class="tg-progress-fill ' + fillCls + '" style="width:' + pct + '%;"></div></div></div></td>' +
                '<td>' + lampiranHtml + '</td>' +
                '<td><span class="tg-badge ' + statusCls + '"><i class="fa-solid ' + icon + '"></i> ' + r.status + '</span></td>' +
                '<td><div class="tg-action-btns">' +
                '<a href="/admin/tugas/' + r.id + '/kerjakan" class="tg-action-btn view" title="Kerjakan Tugas" style="background:#ecfdf5;color:#10b981;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:14px;"><i class="fa-solid fa-play"></i></a>' +
                '<button class="tg-action-btn view" title="Detail" onclick="openDetail(' + r.id + ')"><i class="fa-solid fa-eye"></i></button>' +
                '<button class="tg-action-btn edit" title="Edit" onclick="openEdit(' + r.id + ')"><i class="fa-solid fa-pen"></i></button>' +
                '<button class="tg-action-btn delete" title="Hapus" onclick="openHapus(' + r.id + ')"><i class="fa-solid fa-trash"></i></button>' +
                '</div></td></tr>';
        }

        function filterTable() {
            const status = document.getElementById('filterStatus').value;
            const kelas = document.getElementById('filterKelas').value;
            const q = document.getElementById('searchInput').value.toLowerCase();
            const tbody = document.getElementById('tgTableBody');
            let filtered = recordsData.filter(r => {
                if (status && r.status !== status) return false;
                if (kelas && r.kelas !== kelas) return false;
                if (q && !r.judul.toLowerCase().includes(q) && !r.deskripsi.toLowerCase().includes(q)) return false;
                return true;
            });
            tbody.innerHTML = filtered.map((r, i) => renderRow(r, i)).join('');
            updateStats(filtered);
        }

        function updateStats(filtered) {
            document.getElementById('statTotal').textContent = filtered.length;
            document.getElementById('statAktif').textContent = filtered.filter(r => r.status === 'Aktif').length;
            document.getElementById('statSelesai').textContent = filtered.filter(r => r.status === 'Selesai').length;
            const today = new Date().toISOString().slice(0, 10);
            document.getElementById('statDeadline').textContent = filtered.filter(r => r.tanggal_deadline === today).length;
        }

        function openTambah() {
            lampiranDihapus = false;
            document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-plus-circle" style="color:var(--tg-primary);"></i> Tambah Tugas';
            document.getElementById('formId').value = '';
            document.getElementById('tugasForm').reset();
            document.getElementById('formDeadline').value = new Date().toISOString().slice(0, 10);
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Simpan';
            document.getElementById('formModal').classList.add('active');
        }

        function openEdit(id) {
            lampiranDihapus = false;
            fetch('/admin/tugas/' + id + '/edit')
                .then(res => res.json())
                .then(r => {
                    document.getElementById('formModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:var(--tg-primary);"></i> Edit Tugas';
                    document.getElementById('formId').value = r.id;
                    document.getElementById('formJudul').value = r.judul;
                    document.getElementById('formDeskripsi').value = r.deskripsi || '';
                    document.getElementById('formKelas').value = r.kelas;
                    document.getElementById('formMapel').value = r.mapel;
                    document.getElementById('formDeadline').value = r.tanggal_deadline;
                    document.getElementById('formStatus').value = r.status;
                    if (r.lampiran) {
                        fileNameSimpan = 'lama';
                        fileSimpan = true;
                        document.getElementById('fileName').textContent = 'File lampiran tersimpan';
                        document.getElementById('fileName').style.color = '#1e293b';
                        document.getElementById('hapusFileBtn').style.display = '';
                    } else {
                        hapusFile();
                    }
                    document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update';
                    document.getElementById('formModal').classList.add('active');
                });
        }

        function closeForm() { document.getElementById('formModal').classList.remove('active'); }

        document.getElementById('tugasForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('formId').value;
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('judul', document.getElementById('formJudul').value);
            formData.append('deskripsi', document.getElementById('formDeskripsi').value);
            formData.append('kelas', document.getElementById('formKelas').value);
            formData.append('mapel', document.getElementById('formMapel').value);
            formData.append('tanggal_deadline', document.getElementById('formDeadline').value);
            formData.append('status', document.getElementById('formStatus').value);
            const file = document.getElementById('formFile').files[0];
            if (file) formData.append('file', file);
            if (id && !file && lampiranDihapus) {
                formData.append('hapus_lampiran', '1');
            }
            if (id) formData.append('_method', 'PUT');

            const url = id ? '/admin/tugas/' + id : '/admin/tugas';
            fetch(url, { method: 'POST', headers: { 'Accept': 'application/json' }, body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        hapusFile();
                        closeForm();
                        showToast('success', 'Berhasil!', 'Tugas berhasil ' + (id ? 'diupdate' : 'disimpan'));
                        setTimeout(() => location.reload(), 500);
                    }
                })
                .catch(err => showToast('error', 'Gagal!', 'Terjadi kesalahan.'));
        });

        function openHapus(id) {
            const r = recordsData.find(d => d.id === id);
            document.getElementById('hapusId').value = id;
            document.getElementById('hapusInfo').textContent = '"' + (r ? r.judul : '') + '"';
            document.getElementById('hapusModal').classList.add('active');
        }
        function closeHapus() { document.getElementById('hapusModal').classList.remove('active'); }
        function confirmHapus() {
            const id = document.getElementById('hapusId').value;
            fetch('/admin/tugas/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeHapus();
                    showToast('success', 'Berhasil!', 'Tugas berhasil dihapus.');
                    setTimeout(() => location.reload(), 500);
                }
            });
        }

        function openDetail(id) {
            const r = recordsData.find(d => d.id === id);
            if (!r) return;
            fetch('/admin/tugas/' + id + '/detail')
                .then(res => res.json())
                .then(data => {
                    if (!data.success) return;
                    const list = data.data;
                    const total = r.total_santri || 0;
                    const pengumpul = list.length;
                    const belum = total - pengumpul;
                    const tepat = list.filter(d => d.status === 'tepat' || d.tipe !== '-').length;
                    const telat = pengumpul - tepat;

                    let siswaHtml = '';
                    list.slice(0, 8).forEach(d => {
                        const avatarCls = d.tipe !== '-' ? 'baik' : 'belum';
                        const statusCls = d.tipe !== '-' ? 'baik' : 'belum';
                        const statusLabel = d.tipe !== '-' ? 'Tepat Waktu' : 'Belum';
                        const tipeLabel = d.tipe === 'upload' ? 'Upload PDF' : (d.tipe === 'tulis' ? 'Tulis' : '-');
                        const tipeIcon = d.tipe === 'upload' ? 'fa-file-pdf' : (d.tipe === 'tulis' ? 'fa-pen' : '');
                        const jawabanPreview = d.tipe === 'upload'
                            ? '<span style="font-size:11px;color:#e11d48;cursor:pointer;font-weight:600;" onclick="showToast(\'success\',\'Lihat File\',\'' + d.konten.replace(/'/g, "\\'") + '\')"><i class="fa-solid fa-eye"></i> Lihat PDF</span>'
                            : (d.tipe === 'tulis' ? '<span style="font-size:11px;color:#64748b;cursor:pointer;" onclick="alert(\'' + d.konten.replace(/'/g, "\\'") + '\')"><i class="fa-solid fa-comment"></i> Lihat Jawaban</span>' : '');
                        siswaHtml += '<div class="detail-siswa-item">' +
                            '<div class="detail-siswa-avatar ' + avatarCls + '">' + d.nama.charAt(0) + '</div>' +
                            '<div class="detail-siswa-info"><div class="detail-siswa-nama">' + d.nama + '</div><div class="detail-siswa-tgl">' + d.tanggal + (d.tipe !== '-' ? ' &middot; <i class="fa-solid ' + tipeIcon + '" style="color:#e11d48;"></i> ' + tipeLabel : '') + '</div></div>' +
                            '<div style="text-align:right;"><span class="detail-status ' + statusCls + '" style="display:inline-block;margin-bottom:4px;">' + statusLabel + '</span>' +
                            (d.tipe !== '-' ? '<br>' + jawabanPreview : '') +
                            '</div>' +
                            '</div>';
                    });
                    if (total > 8) {
                        siswaHtml += '<div style="text-align:center;padding:8px 0;font-size:12px;color:#94a3b8;">+ ' + (total - 8) + ' lainnya</div>';
                    }

                    document.getElementById('detailBody').innerHTML =
                        '<div style="margin-bottom:16px;"><strong style="font-size:15px;color:#1e293b;">' + r.judul + '</strong><br><span style="font-size:12px;color:#64748b;">' + r.mapel + ' — Kelas ' + r.kelas + '</span></div>' +
                        '<div class="detail-summary">' +
                        '<div class="detail-sum-item"><div class="detail-sum-value baik">' + tepat + '</div><div class="detail-sum-label">Tepat Waktu</div></div>' +
                        '<div class="detail-sum-item"><div class="detail-sum-value telat">' + telat + '</div><div class="detail-sum-label">Terlambat</div></div>' +
                        '<div class="detail-sum-item"><div class="detail-sum-value belum">' + belum + '</div><div class="detail-sum-label">Belum</div></div>' +
                        '</div>' +
                        '<div style="font-size:12px;font-weight:600;color:#475569;margin-bottom:8px;"><i class="fa-solid fa-users" style="color:var(--tg-primary);"></i> Data Pengumpulan</div>' +
                        siswaHtml;

                    document.getElementById('detailModal').classList.add('active');
                });
        }
        function closeDetail() { document.getElementById('detailModal').classList.remove('active'); }

        function showToast(type, title, msg) {
            const existing = document.querySelector('.tg-toast');
            if (existing) existing.remove();
            const t = document.createElement('div');
            t.className = 'tg-toast ' + type;
            t.innerHTML = '<div class="toast-icon"><i class="fa-solid fa-check-circle"></i></div><div class="toast-body"><div class="toast-title">' + title + '</div><div class="toast-msg">' + msg + '</div></div><button class="toast-close" onclick="this.parentElement.remove()">&times;</button>';
            document.body.appendChild(t);
            setTimeout(() => { t.style.animation = 'toastOut 0.3s ease forwards'; setTimeout(() => t.remove(), 300); }, 4000);
        }

        document.getElementById('formModal').addEventListener('click', function(e) { if (e.target === this) closeForm(); });
        document.getElementById('hapusModal').addEventListener('click', function(e) { if (e.target === this) closeHapus(); });
        document.getElementById('detailModal').addEventListener('click', function(e) { if (e.target === this) closeDetail(); });
    </script>

</x-admin-layout>
