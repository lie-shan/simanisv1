<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisUjian extends Model
{
    protected $table = 'kuis_ujian';

    protected $fillable = [
        'judul', 'jenis', 'kelas_id', 'mata_pelajaran_id',
        'kelas', 'mapel', 'tanggal',
        'durasi', 'keterangan', 'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'durasi' => 'integer',
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
