<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hafalan_tahsin', function (Blueprint $table) {
            $table->id();
            $table->string('santri', 100);
            $table->string('kelas', 20)->nullable();
            $table->enum('jenis', ['Hafalan', 'Tahsin']);
            $table->string('surah', 100);
            $table->string('ayat', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Lancar', 'Kurang Lancar', 'Belum Lancar'])->default('Belum Lancar');
            $table->date('tanggal');
            $table->string('pengajar', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hafalan_tahsin');
    }
};
