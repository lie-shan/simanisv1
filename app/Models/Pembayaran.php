<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'no_transaksi', 'santri_id', 'tipe', 'jenis_pembayaran', 'bulan', 'tahun', 'jumlah',
        'tanggal_bayar', 'metode', 'keterangan', 'status',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date:Y-m-d',
        'jumlah' => 'decimal:2',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}
