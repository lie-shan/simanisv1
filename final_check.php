<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$ok = true;

echo "=== 1. MIGRATIONS ===" . PHP_EOL;
$m = DB::select("SELECT count(*) as c FROM migrations");
echo "  " . $m[0]->c . " migrations, semuanya Ran" . PHP_EOL;

echo PHP_EOL . "=== 2. FK CONSTRAINTS ===" . PHP_EOL;
$fks = [
    'absensi:santri_id:santri.id','hafalan_tahsin:santri_id:santri.id','hafalan_tahsin:kelas_id:kelas.id','hafalan_tahsin:guru_id:guru.id',
    'jadwal:kelas_id:kelas.id','jadwal:guru_id:guru.id','jadwal:mata_pelajaran_id:mata_pelajaran.id',
    'kuis_ujian:kelas_id:kelas.id','kuis_ujian:mata_pelajaran_id:mata_pelajaran.id',
    'mutasi_santri:santri_id:santri.id','nilai:santri_id:santri.id','nilai:mata_pelajaran_id:mata_pelajaran.id',
    'pembayaran:santri_id:santri.id','pengumuman:user_id:users.id','santri:kelas_id:kelas.id',
    'soal_kuis:kuis_ujian_id:kuis_ujian.id','tugas:kelas_id:kelas.id','tugas:mata_pelajaran_id:mata_pelajaran.id',
];
$n = 0;
foreach ($fks as $f) {
    [$t,$c,$r] = explode(':', $f);
    $fk = DB::select("SELECT 1 FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? AND COLUMN_NAME=? AND REFERENCED_TABLE_NAME IS NOT NULL", [$t, $c]);
    echo empty($fk) ? "  FAIL $t.$c\n" : "  OK $t.$c -> $r\n";
    if (!empty($fk)) $n++; else $ok = false;
}
echo "  Total FK: $n/18" . PHP_EOL;

echo PHP_EOL . "=== 3. RELATIONSHIPS ===" . PHP_EOL;
$rels = [
    'Santri:absensi,Santri:kelasRelasi,Santri:mutasi,Santri:pembayaran,Santri:nilai,Santri:hafalanTahsin',
    'Kelas:santri,Kelas:santriByFk,Kelas:jadwal,Kelas:guru,Kelas:hafalanTahsin,Kelas:kuisUjian,Kelas:tugas',
    'Guru:jadwal,Guru:kelasWali,Guru:hafalanTahsin',
    'MataPelajaran:jadwal,MataPelajaran:nilai,MataPelajaran:kuisUjian,MataPelajaran:tugas',
    'HafalanTahsin:santriRelasi,HafalanTahsin:kelasRelasi,HafalanTahsin:guruRelasi',
    'KuisUjian:kelasRelasi,KuisUjian:mataPelajaranRelasi',
    'Tugas:kelasRelasi,Tugas:mataPelajaranRelasi',
    'Jadwal:kelas,Jadwal:guru,Jadwal:mataPelajaran',
    'Nilai:santri,Nilai:mataPelajaran',
    'Absensi:santri,Pembayaran:santri,MutasiSantri:santri',
];
$rc = 0;
foreach ($rels as $group) {
    foreach (explode(',', $group) as $item) {
        [$m,$mt] = explode(':', $item);
        $cls = "App\\Models\\$m";
        $inst = new $cls;
        if (!method_exists($inst, $mt)) { echo "  FAIL $m->$mt()\n"; $ok = false; }
        else { $rc++; }
    }
}
echo "  Total relasi: $rc/35" . PHP_EOL;

echo PHP_EOL . ($ok ? "=== ALL GOOD! Tidak ada yang kurang. ===" : "=== ADA MASALAH! ===") . PHP_EOL;