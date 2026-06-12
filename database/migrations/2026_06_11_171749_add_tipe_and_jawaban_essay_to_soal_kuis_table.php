<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {
            $table->string('tipe', 10)->default('pg')->after('pertanyaan');
            $table->text('jawaban_essay')->nullable()->after('jawaban_benar');
        });

        DB::statement("ALTER TABLE soal_kuis MODIFY pilihan_a VARCHAR(255) NULL");
        DB::statement("ALTER TABLE soal_kuis MODIFY pilihan_b VARCHAR(255) NULL");
        DB::statement("ALTER TABLE soal_kuis MODIFY pilihan_c VARCHAR(255) DEFAULT NULL");
        DB::statement("ALTER TABLE soal_kuis MODIFY pilihan_d VARCHAR(255) DEFAULT NULL");
        DB::statement("ALTER TABLE soal_kuis MODIFY jawaban_benar VARCHAR(10) DEFAULT NULL");
    }

    public function down(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {
            $table->dropColumn(['tipe', 'jawaban_essay']);
        });
    }
};
