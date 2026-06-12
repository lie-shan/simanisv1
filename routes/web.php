<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\HafalanTahsinController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KuisUjianController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\MutasiSantriController;
use App\Http\Controllers\Admin\PesanimController;
use App\Http\Controllers\Admin\PekaniController;
use App\Http\Controllers\PesanimLandingController;
use App\Http\Controllers\PekaniLandingController;
use App\Http\Controllers\Admin\TugasController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pesanim', [PesanimLandingController::class, 'create'])->name('pesanim');
Route::post('/pesanim', [PesanimLandingController::class, 'store'])->name('pesanim.store');

Route::get('/pekani', [PekaniLandingController::class, 'create'])->name('pekani');
Route::post('/pekani', [PekaniLandingController::class, 'store'])->name('pekani.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/santri', [AdminController::class, 'santri'])->name('santri');
    Route::post('/santri', [AdminController::class, 'store'])->name('santri.store');
    Route::get('/santri/{santri}/edit', [AdminController::class, 'edit'])->name('santri.edit');
    Route::put('/santri/{santri}', [AdminController::class, 'update'])->name('santri.update');
    Route::delete('/santri/{santri}', [AdminController::class, 'destroy'])->name('santri.destroy');
    Route::get('/santri/export', [AdminController::class, 'export'])->name('santri.export');
    Route::get('/santri/template', [AdminController::class, 'template'])->name('santri.template');
    Route::post('/santri/import', [AdminController::class, 'import'])->name('santri.import');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/guru/export', [GuruController::class, 'export'])->name('guru.export');
    Route::get('/guru/template', [GuruController::class, 'template'])->name('guru.template');
    Route::post('/guru/import', [GuruController::class, 'import'])->name('guru.import');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::get('/kelas/{kelas}/detail', [KelasController::class, 'detail'])->name('kelas.detail');

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
    Route::get('/pembayaran/export', [PembayaranController::class, 'export'])->name('pembayaran.export');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
    Route::get('/absensi/filter', [AbsensiController::class, 'filter'])->name('absensi.filter');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/qr/{santri}', [AbsensiController::class, 'qr'])->name('absensi.qr');
    Route::get('/absensi/recap', [AbsensiController::class, 'recap'])->name('absensi.recap');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran');
    Route::post('/mata-pelajaran', [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
    Route::get('/mata-pelajaran/{mataPelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('mata-pelajaran.edit');
    Route::put('/mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{mataPelajaran}', [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');
    Route::get('/mata-pelajaran/export', [MataPelajaranController::class, 'export'])->name('mata-pelajaran.export');

    Route::get('/hafalan-tahsin', [HafalanTahsinController::class, 'index'])->name('hafalan-tahsin');
    Route::post('/hafalan-tahsin', [HafalanTahsinController::class, 'store'])->name('hafalan-tahsin.store');
    Route::get('/hafalan-tahsin/{hafalanTahsin}/edit', [HafalanTahsinController::class, 'edit'])->name('hafalan-tahsin.edit');
    Route::put('/hafalan-tahsin/{hafalanTahsin}', [HafalanTahsinController::class, 'update'])->name('hafalan-tahsin.update');
    Route::delete('/hafalan-tahsin/{hafalanTahsin}', [HafalanTahsinController::class, 'destroy'])->name('hafalan-tahsin.destroy');
    Route::get('/hafalan-tahsin/export', [HafalanTahsinController::class, 'export'])->name('hafalan-tahsin.export');

    Route::get('/kuis-ujian', [KuisUjianController::class, 'index'])->name('kuis-ujian');
    Route::get('/kuis-ujian/export', [KuisUjianController::class, 'export'])->name('kuis-ujian.export');
    Route::get('/kuis-ujian/{id}/kerjakan', [KuisUjianController::class, 'kerjakan'])->name('kuis-ujian.kerjakan');
    Route::get('/kuis-ujian/{id}/soal', [KuisUjianController::class, 'soal'])->name('kuis-ujian.soal');
    Route::get('/kuis-ujian/{id}/koreksi', [KuisUjianController::class, 'koreksi'])->name('kuis-ujian.koreksi');
    Route::post('/kuis-ujian', [KuisUjianController::class, 'store'])->name('kuis-ujian.store');
    Route::get('/kuis-ujian/{kuisUjian}/edit', [KuisUjianController::class, 'edit'])->name('kuis-ujian.edit');
    Route::put('/kuis-ujian/{kuisUjian}', [KuisUjianController::class, 'update'])->name('kuis-ujian.update');
    Route::delete('/kuis-ujian/{kuisUjian}', [KuisUjianController::class, 'destroy'])->name('kuis-ujian.destroy');
    Route::post('/kuis-ujian/{id}/soal', [KuisUjianController::class, 'storeSoal'])->name('kuis-ujian.soal.store');
    Route::put('/kuis-ujian/soal/{soalKuis}', [KuisUjianController::class, 'updateSoal'])->name('kuis-ujian.soal.update');
    Route::delete('/kuis-ujian/soal/{soalKuis}', [KuisUjianController::class, 'destroySoal'])->name('kuis-ujian.soal.destroy');
    Route::post('/kuis-ujian/{id}/submit', [KuisUjianController::class, 'submitJawaban'])->name('kuis-ujian.submit');
    Route::post('/kuis-ujian/{id}/koreksi/simpan', [KuisUjianController::class, 'simpanKoreksi'])->name('kuis-ujian.koreksi.simpan');

    Route::get('/mutasi-santri', [MutasiSantriController::class, 'index'])->name('mutasi-santri');
    Route::post('/mutasi-santri', [MutasiSantriController::class, 'store'])->name('mutasi-santri.store');
    Route::get('/mutasi-santri/{mutasiSantri}/edit', [MutasiSantriController::class, 'edit'])->name('mutasi-santri.edit');
    Route::put('/mutasi-santri/{mutasiSantri}', [MutasiSantriController::class, 'update'])->name('mutasi-santri.update');
    Route::delete('/mutasi-santri/{mutasiSantri}', [MutasiSantriController::class, 'destroy'])->name('mutasi-santri.destroy');

    Route::get('/pesanim', [PesanimController::class, 'index'])->name('pesanim');
    Route::post('/pesanim', [PesanimController::class, 'store'])->name('pesanim.store');
    Route::get('/pesanim/{pendaftaran}/edit', [PesanimController::class, 'edit'])->name('pesanim.edit');
    Route::put('/pesanim/{pendaftaran}', [PesanimController::class, 'update'])->name('pesanim.update');
    Route::delete('/pesanim/{pendaftaran}', [PesanimController::class, 'destroy'])->name('pesanim.destroy');
    Route::get('/pesanim/export', [PesanimController::class, 'export'])->name('pesanim.export');

    Route::get('/pekani', [PekaniController::class, 'index'])->name('pekani');
    Route::post('/pekani', [PekaniController::class, 'store'])->name('pekani.store');
    Route::get('/pekani/{pendaftaranPekani}/edit', [PekaniController::class, 'edit'])->name('pekani.edit');
    Route::put('/pekani/{pendaftaranPekani}', [PekaniController::class, 'update'])->name('pekani.update');
    Route::delete('/pekani/{pendaftaranPekani}', [PekaniController::class, 'destroy'])->name('pekani.destroy');
    Route::get('/pekani/export', [PekaniController::class, 'export'])->name('pekani.export');

    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{tugas}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::post('/tugas/{id}/submit', [TugasController::class, 'submitJawaban'])->name('tugas.submit');
    Route::get('/tugas/export', [TugasController::class, 'export'])->name('tugas.export');
    Route::get('/tugas/{id}/kerjakan', [TugasController::class, 'kerjakan'])->name('tugas.kerjakan');
    Route::get('/tugas/{id}/detail', [TugasController::class, 'detail'])->name('tugas.detail');

    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::get('/nilai/export', [NilaiController::class, 'export'])->name('nilai.export');
    Route::get('/nilai/{id}/rapor', [NilaiController::class, 'rapor'])->name('nilai.rapor');
    Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/{nilai}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{nilai}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');

    Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna');
    Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{user}/edit', [UserController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{user}', [UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('pengaturan');
    Route::post('/pengaturan', [SettingsController::class, 'update'])->name('pengaturan.update');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/notifikasi/fetch', [NotifikasiController::class, 'fetch'])->name('notifikasi.fetch');
    Route::post('/notifikasi/store', [NotifikasiController::class, 'store'])->name('notifikasi.store');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'read'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'readAll'])->name('notifikasi.read-all');
    Route::put('/notifikasi/{id}/update', [NotifikasiController::class, 'update'])->name('notifikasi.update');
    Route::delete('/notifikasi/{id}/delete', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
});

require __DIR__.'/auth.php';
