<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id', 'jawaban', 'file',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
