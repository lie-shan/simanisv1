<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'nama_santri', 'nis', 'kelas', 'semester',
        'tahun_ajaran', 'nilai_mapel', 'rata_rata', 'status', 'keterangan',
        'santri_id', 'mata_pelajaran_id',
    ];

    protected $casts = [
        'nilai_mapel' => 'array',
        'rata_rata' => 'decimal:2',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
