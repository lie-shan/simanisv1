<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    protected $table = 'jawaban_kuis';

    protected $fillable = [
        'kuis_ujian_id', 'jawaban', 'nilai', 'nilai_akhir',
    ];

    protected $casts = [
        'jawaban' => 'array',
        'nilai' => 'array',
    ];

    public function kuisUjian()
    {
        return $this->belongsTo(KuisUjian::class, 'kuis_ujian_id');
    }
}
