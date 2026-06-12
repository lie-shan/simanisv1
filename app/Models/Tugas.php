<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = [
        'judul', 'deskripsi', 'kelas_id', 'mata_pelajaran_id',
        'kelas', 'mapel',
        'tanggal_dibuat', 'tanggal_deadline', 'status', 'lampiran',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'date:Y-m-d',
        'tanggal_deadline' => 'date:Y-m-d',
    ];

    public function kelasRelasi()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mataPelajaranRelasi()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
}
