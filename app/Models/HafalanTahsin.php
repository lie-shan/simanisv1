<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanTahsin extends Model
{
    protected $table = 'hafalan_tahsin';

    protected $fillable = [
        'santri_id', 'kelas_id', 'guru_id',
        'santri', 'kelas', 'jenis', 'surah', 'ayat',
        'keterangan', 'status', 'tanggal', 'pengajar',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];

    public function santriRelasi()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function kelasRelasi()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function guruRelasi()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
