<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel Mahasiswa sesuai PDM
    public function up(): void
    {
        Schema::create('Mahasiswa', function (Blueprint $table) {
            $table->unsignedInteger('idPengguna')->primary();
            $table->integer('angkatan');
            $table->unsignedInteger('idProdi');

            $table->foreign('idPengguna')->references('idPengguna')->on('Pengguna');
            $table->foreign('idProdi')->references('idProdi')->on('ProgramStudi');
        });
    }

    // Menghapus tabel Mahasiswa
    public function down(): void
    {
        Schema::dropIfExists('Mahasiswa');
    }
};
