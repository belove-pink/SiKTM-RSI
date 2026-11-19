<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Menambah kolom yang ada di rancangan tapi belum ada di tabel
    public function up(): void
    {
        Schema::table('PengajuanKTM', function (Blueprint $table) {
            if (!Schema::hasColumn('PengajuanKTM', 'pas_foto')) {
                $table->string('pas_foto')->nullable();
            }

            if (!Schema::hasColumn('PengajuanKTM', 'dokumen_pendukung')) {
                $table->string('dokumen_pendukung')->nullable();
            }

            if (!Schema::hasColumn('PengajuanKTM', 'catatan')) {
                $table->text('catatan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('PengajuanKTM', function (Blueprint $table) {
            foreach (['pas_foto', 'dokumen_pendukung', 'catatan'] as $kolom) {
                if (Schema::hasColumn('PengajuanKTM', $kolom)) {
                    $table->dropColumn($kolom);
                }
            }
        });
    }
};