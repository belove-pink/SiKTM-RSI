
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Pengguna', function (Blueprint $table) {
            $table->increments('idPengguna');
            $table->string('nim', 20)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('kataSandi', 255);
            $table->enum('peran', [
                'Mahasiswa',
                'AdminFakultas',
                'AdminRektorat'
            ]);
            $table->unsignedInteger('idFakultas')->nullable();

            $table->foreign('idFakultas')
                ->references('idFakultas')
                ->on('Fakultas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Pengguna');
    }
};
