<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_santri', 100);
            $table->string('nis', 30)->nullable();
            $table->string('kelas', 20)->nullable();
            $table->string('semester', 20)->nullable();
            $table->string('tahun_ajaran', 20)->nullable();
            $table->json('nilai_mapel')->nullable()->comment('Mapel-specifik values');
            $table->decimal('rata_rata', 5, 2)->default(0);
            $table->enum('status', ['Lulus', 'Tidak Lulus', 'Cadangan'])->default('Cadangan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
