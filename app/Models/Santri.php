<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';

    protected $fillable = [
        'no_registrasi', 'nama', 'kelas', 'jk', 'tmp_lahir',
        'tgl_lahir', 'ortu', 'ibu', 'foto', 'no_hp', 'kampung', 'desa', 'kecamatan', 'kabupaten', 'status',
        'kelas_id',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function kelasRelasi()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function mutasi()
    {
        return $this->hasMany(MutasiSantri::class);
    }

    public function hafalanTahsin()
    {
        return $this->hasMany(HafalanTahsin::class, 'santri_id');
    }
}
