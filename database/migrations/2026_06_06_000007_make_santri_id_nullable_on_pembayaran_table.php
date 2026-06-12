<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
            $table->foreignId('santri_id')->nullable()->change();
            $table->foreign('santri_id')->references('id')->on('santri')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
            $table->foreignId('santri_id')->nullable(false)->change();
            $table->foreign('santri_id')->references('id')->on('santri')->cascadeOnDelete();
        });
    }
};
