<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran', 20)->unique();
            $table->string('nama', 100);
            $table->enum('jk', ['L', 'P']);
            $table->string('tmp_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('ortu', 100)->nullable();
            $table->string('ibu', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('kampung', 100)->nullable();
            $table->string('rt_rw', 20)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->enum('status', ['Mendaftar', 'Diterima', 'Ditolak'])->default('Mendaftar');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
