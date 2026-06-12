<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'kelas_id', 'guru_id', 'mata_pelajaran_id',
        'hari', 'jam_ke', 'jam_mulai', 'jam_selesai',
    ];

    protected $casts = [
        'jam_ke' => 'integer',
        'jam_mulai' => 'string',
        'jam_selesai' => 'string',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
