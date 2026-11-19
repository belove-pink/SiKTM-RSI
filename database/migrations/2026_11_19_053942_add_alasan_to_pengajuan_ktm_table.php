<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Menambah kolom alasan pengajuan (KTM Baru, Hilang, Rusak)
    public function up(): void
    {
        Schema::table('PengajuanKTM', function (Blueprint $table) {
            if (!Schema::hasColumn('PengajuanKTM', 'alasan')) {
                $table->string('alasan', 30)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('PengajuanKTM', function (Blueprint $table) {
            if (Schema::hasColumn('PengajuanKTM', 'alasan')) {
                $table->dropColumn('alasan');
            }
        });
    }
};