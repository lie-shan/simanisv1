<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mutasi_santri', function (Blueprint $table) {
            $table->foreign('santri_id')->references('id')->on('santri')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mutasi_santri', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
        });
    }
};
