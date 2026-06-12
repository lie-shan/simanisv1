<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [
        'judul', 'pesan', 'icon', 'warna', 'link', 'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    public function scopeBelumDibaca($query)
    {
        return $query->where('dibaca', false);
    }
}
