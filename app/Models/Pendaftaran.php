<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'no_pendaftaran', 'nama', 'jk', 'tmp_lahir', 'tgl_lahir',
        'ortu', 'ibu', 'no_hp', 'kampung', 'rt_rw', 'desa', 'kecamatan', 'kabupaten', 'kode_pos',
        'status', 'keterangan', 'foto',
    ];

    protected $appends = ['tanggal_daftar', 'foto_url'];

    public function getTanggalDaftarAttribute()
    {
        return $this->created_at ? $this->created_at->format('Y-m-d') : null;
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }
}
