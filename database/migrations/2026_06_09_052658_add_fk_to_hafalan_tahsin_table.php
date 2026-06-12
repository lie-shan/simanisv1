<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hafalan_tahsin', function (Blueprint $table) {
            $table->foreignId('santri_id')->nullable()->after('id')->constrained('santri')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->after('santri_id')->constrained('kelas')->nullOnDelete();
            $table->foreignId('guru_id')->nullable()->after('kelas_id')->constrained('guru')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hafalan_tahsin', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['guru_id']);
            $table->dropColumn(['santri_id', 'kelas_id', 'guru_id']);
        });
    }
};
