<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode_mapel', 'nama_mapel', 'kategori', 'deskripsi', 'status',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function kuisUjian()
    {
        return $this->hasMany(KuisUjian::class, 'mata_pelajaran_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mata_pelajaran_id');
    }
}
