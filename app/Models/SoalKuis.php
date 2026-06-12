<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalKuis extends Model
{
    protected $table = 'soal_kuis';

    protected $fillable = [
        'kuis_ujian_id', 'pertanyaan', 'tipe', 'pilihan_a', 'pilihan_b',
        'pilihan_c', 'pilihan_d', 'jawaban_benar', 'jawaban_essay',
    ];

    public function kuisUjian()
    {
        return $this->belongsTo(KuisUjian::class);
    }
}
