<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'no_registrasi', 'nama', 'jk', 'tmp_lahir', 'tgl_lahir',
        'no_hp', 'kampung', 'desa', 'kecamatan',
        'kabupaten', 'foto', 'status',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelasWali()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas', 'nama');
    }

    public function hafalanTahsin()
    {
        return $this->hasMany(HafalanTahsin::class, 'guru_id');
    }
}
