<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiSantri extends Model
{
    protected $table = 'mutasi_santri';

    protected $fillable = [
        'santri_id', 'kelas_asal', 'kelas_tujuan', 'tgl_mutasi',
        'alasan', 'keterangan',
    ];

    protected $casts = [
        'tgl_mutasi' => 'date',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}
