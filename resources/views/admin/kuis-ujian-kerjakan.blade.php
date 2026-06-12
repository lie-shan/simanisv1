<x-admin-layout>
    <x-slot name="title">Kerjakan {{ $record->jenis }}</x-slot>
    @section('header_title', 'Kerjakan ' . $record->jenis)
    @section('header_subtitle', $record->judul . ' — ' . $record->mapel)

    <style>
        .quiz-container {
            max-width: 820px;
            margin: 0 auto;
        }
        .quiz-header {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            border-radius: 18px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .quiz-header::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
            animation: quizGlow 6s ease-in-out infinite;
        }
        @keyframes quizGlow {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10%, 10%); }
        }
        .quiz-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative; z-index: 1;
            flex-wrap: wrap;
            gap: 12px;
        }
        .quiz-header-info h1 {
            font-size: 20px; font-weight: 700; margin: 0;
        }
        .quiz-header-info p {
            font-size: 13px; opacity: 0.8; margin: 4px 0 0;
        }
        .quiz-timer {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.15);
            padding: 10px 20px;
            border-radius: 12px;
            backdrop-filter: blur(8px);
        }
        .quiz-timer i { font-size: 20px; }
        .quiz-timer .time {
            font-size: 28px;
            font-weight: 800;
            font-family: monospace;
            letter-spacing: 2px;
        }
        .quiz-timer .time.warning { color: #fbbf24; animation: timerPulse 1s ease-in-out infinite; }
        .quiz-timer .time.danger { color: #f87171; animation: timerPulse 0.5s ease-in-out infinite; }
        @keyframes timerPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .quiz-meta {
            display: flex;
            gap: 20px;
            margin-top: 14px;
            position: relative; z-index: 1;
            flex-wrap: wrap;
        }
        .quiz-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            opacity: 0.85;
        }
        .quiz-meta-item i { font-size: 14px; }

        .quiz-progress {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .quiz-progress-bar {
            flex: 1;
            height: 8px;
            background: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .quiz-progress-bar .fill {
            height: 100%;
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
            border-radius: 8px;
            transition: width 0.4s ease;
        }
        .quiz-progress-text {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            white-space: nowrap;
        }

        .quiz-question-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 28px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            animation: quizCardIn 0.3s ease both;
        }
        @keyframes quizCardIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .quiz-q-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 8px;
            background: #f5f3ff;
            color: #7c3aed;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 12px;
        }
        .quiz-q-text {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
            line-height: 1.5;
        }
        .quiz-options {
            display: grid;
            gap: 10px;
        }
        .quiz-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .quiz-option:hover {
            border-color: #8b5cf6;
            background: #f5f3ff;
        }
        .quiz-option.selected {
            border-color: #8b5cf6;
            background: #ede9fe;
            box-shadow: 0 0 0 3px rgba(139,92,246,0.1);
        }
        .quiz-option input[type="radio"] {
            display: none;
        }
        .quiz-option .radio-custom {
            width: 20px; height: 20px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        .quiz-option.selected .radio-custom {
            border-color: #8b5cf6;
            background: #8b5cf6;
        }
        .quiz-option.selected .radio-custom::after {
            content: '';
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #fff;
        }
        .quiz-option .opt-label {
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
            flex: 1;
        }
        .quiz-option .opt-letter {
            width: 26px; height: 26px;
            border-radius: 6px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            flex-shrink: 0;
        }
        .quiz-option.selected .opt-letter {
            background: #8b5cf6;
            color: #fff;
        }

        .quiz-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }
        .quiz-nav-left { display: flex; gap: 8px; }
        .quiz-nav-right { display: flex; gap: 8px; }

        .quiz-num-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }
        .quiz-num-pill {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s;
        }
        .quiz-num-pill:hover { border-color: #8b5cf6; color: #8b5cf6; }
        .quiz-num-pill.active { background: #8b5cf6; color: #fff; border-color: #8b5cf6; }
        .quiz-num-pill.answered { background: #ede9fe; border-color: #8b5cf6; color: #7c3aed; }
        .quiz-num-pill.active.answered { background: #8b5cf6; color: #fff; }

        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: 10px; font-size: 13px;
            font-weight: 600; border: none; cursor: pointer;
            transition: all 0.2s; font-family: 'Inter', sans-serif;
            text-decoration: none;
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

        .quiz-result-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }
        .quiz-result-overlay.active { display: flex; }
        .quiz-result-box {
            background: #fff;
            border-radius: 24px;
            width: 90%;
            max-width: 480px;
            padding: 40px 32px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            animation: resultIn 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        @keyframes resultIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .quiz-result-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 36px;
        }
        .quiz-result-icon.perfect { background: #ecfdf5; color: #10b981; }
        .quiz-result-icon.good { background: #f5f3ff; color: #8b5cf6; }
        .quiz-result-icon.fail { background: #fef2f2; color: #ef4444; }
        .quiz-result-score {
            font-size: 56px;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: -2px;
        }
        .quiz-result-label {
            font-size: 16px;
            font-weight: 600;
            margin-top: 4px;
        }
        .quiz-result-label.perfect { color: #10b981; }
        .quiz-result-label.good { color: #8b5cf6; }
        .quiz-result-label.fail { color: #ef4444; }
        .quiz-result-detail {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin: 20px 0;
        }
        .quiz-result-detail-item {
            text-align: center;
        }
        .quiz-result-detail-item .val {
            font-size: 24px;
            font-weight: 700;
        }
        .quiz-result-detail-item .lbl {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .quiz-result-detail-item .val.benar { color: #10b981; }
        .quiz-result-detail-item .val.salah { color: #ef4444; }

        @media (max-width: 767px) {
            .quiz-header { padding: 20px; }
            .quiz-header-top { flex-direction: column; align-items: stretch; }
            .quiz-timer { justify-content: center; }
            .quiz-question-card { padding: 18px 20px; }
            .quiz-nav { flex-direction: column; }
            .quiz-nav-left, .quiz-nav-right { width: 100%; }
            .quiz-nav-left .btn, .quiz-nav-right .btn { flex: 1; justify-content: center; }
        }
    </style>

    <div class="quiz-container">
        <div class="quiz-header">
            <div class="quiz-header-top">
                <div class="quiz-header-info">
                    <h1>{{ $record->judul }}</h1>
                    <p>{{ $record->jenis }} — {{ $record->mapel }}</p>
                </div>
                <div class="quiz-timer">
                    <i class="fa-regular fa-clock"></i>
                    <div class="time" id="quizTimer">00:00</div>
                </div>
            </div>
            <div class="quiz-meta">
                <span class="quiz-meta-item"><i class="fa-solid fa-layer-group"></i> {{ count($soalList) }} Soal</span>
                <span class="quiz-meta-item"><i class="fa-solid fa-clock"></i> {{ $record->durasi }} Menit</span>
                <span class="quiz-meta-item"><i class="fa-solid fa-users"></i> Kelas {{ $record->kelas ?? '-' }}</span>
            </div>
        </div>

        <div class="quiz-progress">
            <div class="quiz-progress-bar">
                <div class="fill" id="progressFill" style="width:0%;"></div>
            </div>
            <div class="quiz-progress-text" id="progressText">0/{{ count($soalList) }}</div>
        </div>

        <div class="quiz-num-pills" id="numPills"></div>

        <div id="quizQuestions"></div>

        <form id="quizForm" onsubmit="return false;">
            <div class="quiz-nav">
                <div class="quiz-nav-left">
                    <button type="button" class="btn ghost" id="prevBtn" onclick="prevSoal()"><i class="fa-solid fa-chevron-left"></i> Sebelumnya</button>
                </div>
                <div class="quiz-nav-right">
                    <button type="button" class="btn primary" id="nextBtn" onclick="nextSoal()">Selanjutnya <i class="fa-solid fa-chevron-right"></i></button>
                    <button type="button" class="btn success" id="submitBtn" onclick="confirmSubmit()" style="display:none;"><i class="fa-solid fa-check"></i> Kumpulkan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Result Modal --}}
    <div class="quiz-result-overlay" id="resultModal">
        <div class="quiz-result-box">
            <div class="quiz-result-icon" id="resultIcon">-</div>
            <div class="quiz-result-score" id="resultScore">0</div>
            <div class="quiz-result-label" id="resultLabel">-</div>
            <div class="quiz-result-detail">
                <div class="quiz-result-detail-item">
                    <div class="val benar" id="resultBenar">0</div>
                    <div class="lbl">Benar</div>
                </div>
                <div class="quiz-result-detail-item">
                    <div class="val salah" id="resultSalah">0</div>
                    <div class="lbl">Salah</div>
                </div>
                <div class="quiz-result-detail-item">
                    <div class="val" style="color:#64748b;" id="resultTotal">0</div>
                    <div class="lbl">Total</div>
                </div>
            </div>
            <a href="{{ route('admin.kuis-ujian') }}" class="btn primary" style="margin-top:8px;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <script>
        const soalData = @json($soalList);
        const durasi = {{ $record->durasi }};
        const jawaban = {};
        let current = 0;
        let timeLeft = durasi * 60;
        let timerInterval = null;

        function formatTime(s) {
            const m = String(Math.floor(s / 60)).padStart(2, '0');
            const d = String(s % 60).padStart(2, '0');
            return m + ':' + d;
        }

        function updateTimer() {
            const el = document.getElementById('quizTimer');
            el.textContent = formatTime(timeLeft);
            el.className = 'time';
            if (timeLeft <= 60) el.classList.add('danger');
            else if (timeLeft <= 120) el.classList.add('warning');
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
            timeLeft--;
        }

        function renderSoal() {
            const container = document.getElementById('quizQuestions');
            container.innerHTML = '';
            soalData.forEach((s, i) => {
                const answered = jawaban[i] !== undefined && jawaban[i] !== '';
                let inputHtml = '';
                if (s.tipe === 'essay') {
                    inputHtml = '<textarea class="form-control" style="width:100%;min-height:120px;padding:14px;border:1.5px solid #e2e8f0;border-radius:12px;font-size:14px;font-family:\'Inter\',sans-serif;outline:none;resize:vertical;transition:all 0.2s;background:#f8fafc;color:#1a1a2e;box-sizing:border-box;" placeholder="Tulis jawaban essai..." onchange="pilihJawaban(' + i + ', this.value)">' + (jawaban[i] || '') + '</textarea>';
                } else {
                    const letters = ['a', 'b', 'c', 'd'];
                    const options = [s.a, s.b, s.c, s.d];
                    inputHtml = '<div class="quiz-options">';
                    options.forEach((opt, oi) => {
                        const letter = letters[oi];
                        const selected = jawaban[i] === letter;
                        inputHtml += '<label class="quiz-option' + (selected ? ' selected' : '') + '">' +
                            '<input type="radio" name="soal_' + i + '" value="' + letter + '" ' + (selected ? 'checked' : '') + ' onchange="pilihJawaban(' + i + ', \'' + letter + '\')">' +
                            '<div class="radio-custom"></div>' +
                            '<div class="opt-letter">' + letter.toUpperCase() + '</div>' +
                            '<div class="opt-label">' + (opt || '-') + '</div>' +
                            '</label>';
                    });
                    inputHtml += '</div>';
                }
                const tipeBadge = '<span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;text-transform:uppercase;' + (s.tipe === 'essay' ? 'background:#fef3c7;color:#d97706;' : 'background:#f5f3ff;color:#7c3aed;') + '">' + (s.tipe === 'essay' ? 'Essai' : 'PG') + '</span>';
                const card = document.createElement('div');
                card.className = 'quiz-question-card';
                card.style.display = i === current ? 'block' : 'none';
                card.innerHTML = '<div style="display:flex;align-items:center;justify-content:space-between;">' +
                    '<div style="display:flex;align-items:center;gap:8px;">' +
                    '<div class="quiz-q-num" style="margin-bottom:0;">' + (i + 1) + '</div>' +
                    tipeBadge +
                    '</div>' +
                    (answered ? '<span style="font-size:11px;color:#10b981;font-weight:600;"><i class="fa-solid fa-check-circle"></i> Terjawab</span>' : '<span style="font-size:11px;color:#94a3b8;font-weight:500;">Belum dijawab</span>') +
                    '</div>' +
                    '<div class="quiz-q-text">' + s.soal + '</div>' +
                    inputHtml;
                container.appendChild(card);
            });
            updateNav();
        }

        function pilihJawaban(i, val) {
            jawaban[i] = val;
            updatePills();
            updateProgress();
        }

        function updateNav() {
            document.getElementById('prevBtn').style.display = current === 0 ? 'none' : '';
            document.getElementById('nextBtn').style.display = current === soalData.length - 1 ? 'none' : '';
            document.getElementById('submitBtn').style.display = current === soalData.length - 1 ? '' : 'none';
            updatePills();
            updateProgress();
        }

        function nextSoal() {
            if (current < soalData.length - 1) { current++; renderSoal(); }
        }

        function prevSoal() {
            if (current > 0) { current--; renderSoal(); }
        }

        function goToSoal(i) {
            current = i;
            renderSoal();
        }

        function updatePills() {
            const container = document.getElementById('numPills');
            container.innerHTML = '';
            soalData.forEach((s, i) => {
                const pill = document.createElement('div');
                pill.className = 'quiz-num-pill' + (i === current ? ' active' : '') + (jawaban[i] !== undefined ? ' answered' : '');
                pill.textContent = i + 1;
                pill.onclick = () => goToSoal(i);
                container.appendChild(pill);
            });
        }

        function updateProgress() {
            const answered = Object.keys(jawaban).length;
            const pct = (answered / soalData.length) * 100;
            document.getElementById('progressFill').style.width = pct + '%';
            document.getElementById('progressText').textContent = answered + '/' + soalData.length;
        }

        function confirmSubmit() {
            const unanswered = soalData.length - Object.keys(jawaban).length;
            if (unanswered > 0) {
                if (!confirm('Masih ada ' + unanswered + ' soal belum dijawab. Kumpulkan tetap?')) return;
            } else {
                if (!confirm('Yakin ingin mengumpulkan jawaban?')) return;
            }
            submitQuiz();
        }

        function submitQuiz() {
            clearInterval(timerInterval);
            fetch('/admin/kuis-ujian/' + {{ $record->id }} + '/submit', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                body: JSON.stringify({ jawaban: jawaban }),
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    let pgBenar = 0, totalPg = 0, totalEssay = 0;
                    soalData.forEach((s, i) => {
                        if (s.tipe === 'essay') {
                            totalEssay++;
                        } else {
                            totalPg++;
                            if (jawaban[i] === s.kunci) pgBenar++;
                        }
                    });
                    const total = soalData.length;
                    const pgScore = totalPg > 0 ? Math.round((pgBenar / totalPg) * 100) : 0;
                    const overallScore = Math.round(((pgBenar) / total) * 100);

                    const icon = document.getElementById('resultIcon');
                    const label = document.getElementById('resultLabel');
                    if (totalEssay > 0) {
                        icon.className = 'quiz-result-icon good';
                        icon.innerHTML = '<i class="fa-solid fa-clock"></i>';
                        label.className = 'quiz-result-label good';
                        label.textContent = 'Menunggu Koreksi';
                    } else if (overallScore === 100) {
                        icon.className = 'quiz-result-icon perfect';
                        icon.innerHTML = '<i class="fa-solid fa-star"></i>';
                        label.className = 'quiz-result-label perfect';
                        label.textContent = 'Sempurna!';
                    } else if (overallScore >= 70) {
                        icon.className = 'quiz-result-icon good';
                        icon.innerHTML = '<i class="fa-solid fa-check-circle"></i>';
                        label.className = 'quiz-result-label good';
                        label.textContent = 'Lulus';
                    } else {
                        icon.className = 'quiz-result-icon fail';
                        icon.innerHTML = '<i class="fa-solid fa-times-circle"></i>';
                        label.className = 'quiz-result-label fail';
                        label.textContent = 'Perlu Belajar Lagi';
                    }

                    let detailHtml = '';
                    if (totalPg > 0) {
                        detailHtml += '<div class="quiz-result-detail-item"><div class="val benar">' + pgBenar + '/' + totalPg + '</div><div class="lbl">PG Benar</div></div>';
                    }
                    if (totalEssay > 0) {
                        detailHtml += '<div class="quiz-result-detail-item"><div class="val" style="color:#d97706;">' + totalEssay + '</div><div class="lbl">Essai (Blm dikoreksi)</div></div>';
                    }

                    document.getElementById('resultScore').textContent = overallScore;
                    document.getElementById('resultBenar').textContent = pgBenar;
                    document.getElementById('resultSalah').textContent = totalPg - pgBenar;
                    document.getElementById('resultTotal').textContent = total;
                    if (detailHtml) {
                        document.querySelector('.quiz-result-detail').innerHTML = detailHtml;
                    }
                    document.getElementById('resultModal').classList.add('active');
                }
            })
            .catch(() => alert('Gagal mengirim jawaban.'));
        }

        timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
        renderSoal();
    </script>

</x-admin-layout>
