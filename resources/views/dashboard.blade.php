<x-app-layout>
    <h1 class="page-title">Dashboard</h1>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <!-- IPK Card -->
        <div class="stat-card purple">
            <div class="stat-header">
                <i class="fa-solid fa-star"></i> IPK
            </div>
            <div class="stat-value">
                3,45
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" style="color: rgba(255,255,255,0.4);"></i>
                </div>
            </div>
            <div class="stat-subtext">
                <i class="fa-solid fa-arrow-trend-down trend-down"></i> Menurun dari semester lalu
            </div>
        </div>

        <!-- Tagihan Card -->
        <div class="stat-card blue">
            <div class="stat-header">
                <i class="fa-solid fa-file-invoice"></i> Tagihan
            </div>
            <div class="stat-value">
                Rp 0
            </div>
            <div class="stat-subtext">
                Total tunggakan terakhir
            </div>
        </div>

        <!-- Semester Card -->
        <div class="stat-card red">
            <div class="stat-header">
                <i class="fa-solid fa-trophy"></i> Semester
            </div>
            <div class="stat-value" style="justify-content: center; margin-top: 10px;">
                4
            </div>
            <div class="stat-subtext">
                Batas studi : 14 semester
            </div>
        </div>

        <!-- Jumlah SKS Card -->
        <div class="stat-card pink">
            <div class="stat-header">
                <i class="fa-solid fa-book"></i> Jumlah SKS
            </div>
            <div class="sks-content">
                <div class="progress-circle">
                    <span>0%</span>
                </div>
                <div class="sks-value">
                    66 SKS
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <div class="schedule-section">
        <div class="section-header">
            <div>
                <div class="section-title">
                    <i class="fa-regular fa-calendar" style="color: #666;"></i> Jadwal Pertemuan Kuliah
                </div>
                <div class="section-subtitle">Jumat, 5 Juni 2026</div>
            </div>
            <select class="filter-dropdown">
                <option value="hari-ini">Hari Ini</option>
            </select>
        </div>

        <div class="schedule-grid">
            <!-- Schedule 1 -->
            <div class="schedule-card">
                <div class="schedule-info">
                    <div class="schedule-time">
                        <i class="fa-regular fa-clock"></i> 08:00 WIB - 10:05 WIB <span style="color: #ccc;">|</span> Pertemuan Ke 26
                    </div>
                    <div class="schedule-course">SISTEM INFORMASI KESEHATAN</div>
                    <div class="schedule-meta">
                        <i class="fa-solid fa-location-dot"></i> Online
                    </div>
                    <div class="schedule-meta">
                        <i class="fa-regular fa-user"></i> ANDHIKA LUNGGUH PERCEKA
                    </div>
                </div>
                <div class="tag-online">
                    <i class="fa-solid fa-video"></i> Online
                </div>
            </div>

            <!-- Schedule 2 -->
            <div class="schedule-card">
                <div class="schedule-info">
                    <div class="schedule-time">
                        <i class="fa-regular fa-clock"></i> 13:00 WIB - 14:40 WIB <span style="color: #ccc;">|</span> Pertemuan Ke 26
                    </div>
                    <div class="schedule-course">KEPERAWATAN KESEHATAN REPRODUKSI</div>
                    <div class="schedule-meta">
                        <i class="fa-solid fa-location-dot"></i> Online
                    </div>
                    <div class="schedule-meta">
                        <i class="fa-regular fa-user"></i> KURNIAWAN DEWI BUDIARTI
                    </div>
                </div>
                <div class="tag-online">
                    <i class="fa-solid fa-video"></i> Online
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Section -->
    <div class="grafik-section">
        <div class="section-title">
            <i class="fa-solid fa-book" style="color: var(--primary-blue);"></i> Grafik Masa Studi
        </div>
        <!-- Area for chart -->
    </div>
</x-app-layout>
