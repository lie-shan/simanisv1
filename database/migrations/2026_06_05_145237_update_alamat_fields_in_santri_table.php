<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->string('kampung')->nullable()->after('no_hp');
            $table->string('desa')->nullable()->after('kampung');
            $table->string('kecamatan')->nullable()->after('desa');
            $table->string('kabupaten')->nullable()->after('kecamatan');
        });
    }

    public function down(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropColumn(['kampung', 'desa', 'kecamatan', 'kabupaten']);
            $table->text('alamat')->nullable();
        });
    }
};
