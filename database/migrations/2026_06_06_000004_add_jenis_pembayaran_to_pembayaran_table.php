<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->string('jenis_pembayaran', 50)->default('SPP')->after('santri_id');
            $table->string('bulan', 20)->nullable()->change();
            $table->string('tahun', 4)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn('jenis_pembayaran');
            $table->string('bulan', 20)->nullable(false)->change();
            $table->string('tahun', 4)->nullable(false)->change();
        });
    }
};
