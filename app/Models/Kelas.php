<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas', 'wali_kelas', 'deskripsi',
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class, 'kelas', 'nama_kelas');
    }

    public function santriByFk()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas', 'nama');
    }

    public function hafalanTahsin()
    {
        return $this->hasMany(HafalanTahsin::class, 'kelas_id');
    }

    public function kuisUjian()
    {
        return $this->hasMany(KuisUjian::class, 'kelas_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kelas_id');
    }
}
