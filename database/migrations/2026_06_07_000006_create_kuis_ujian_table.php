<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis_ujian', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->enum('jenis', ['Kuis', 'Ujian']);
            $table->string('kelas', 20)->nullable();
            $table->string('mapel', 100);
            $table->date('tanggal');
            $table->integer('durasi')->nullable()->comment('Dalam menit');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Akan Datang', 'Sedang Berlangsung', 'Selesai'])->default('Akan Datang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis_ujian');
    }
};
