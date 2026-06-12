<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->cascadeOnDelete();
            $table->string('bulan', 20);
            $table->string('tahun', 4);
            $table->decimal('jumlah', 12, 2);
            $table->date('tanggal_bayar');
            $table->string('metode')->default('Tunai');
            $table->string('keterangan')->nullable();
            $table->string('status')->default('Lunas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
