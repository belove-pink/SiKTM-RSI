<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel PengajuanKTM sesuai PDM
    public function up(): void
    {
        Schema::create('PengajuanKTM', function (Blueprint $table) {
            $table->increments('idPengajuan');
            $table->unsignedInteger('idPengguna');
            $table->string('nim', 20);
            $table->enum('jalur', ['Rektorat', 'Bank']);

            // Dokumen yang diunggah mahasiswa
            $table->string('dokumen')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('dokumen_pendukung')->nullable();

            // Status dan catatan verifikasi admin
            $table->enum('status', ['Diajukan', 'Diverifikasi', 'Diterima', 'Ditolak'])
                  ->default('Diajukan');
            $table->text('catatan')->nullable();

            $table->date('tanggalPengajuan')
                  ->default(DB::raw('(CURRENT_DATE)'));

            // Relasi ke tabel Mahasiswa
            $table->foreign('idPengguna')
                  ->references('idPengguna')
                  ->on('Mahasiswa');
        });
    }

    // Menghapus tabel PengajuanKTM
    public function down(): void
    {
        Schema::dropIfExists('PengajuanKTM');
    }
};