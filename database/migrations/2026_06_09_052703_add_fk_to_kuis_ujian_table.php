<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuis_ujian', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable()->after('jenis')->constrained('kelas')->nullOnDelete();
            $table->foreignId('mata_pelajaran_id')->nullable()->after('kelas_id')->constrained('mata_pelajaran')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kuis_ujian', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['mata_pelajaran_id']);
            $table->dropColumn(['kelas_id', 'mata_pelajaran_id']);
        });
    }
};
