<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDummySeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdminRektorat();
        $this->seedAdminFakultas();
    }

    // Admin rektorat: admin1 sampai admin5
    private function seedAdminRektorat(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Pengguna::updateOrCreate(
                ['nim' => "admin{$i}", 'peran' => 'AdminRektorat'],
                [
                    'nama'       => "Admin Rektorat {$i}",
                    'kataSandi'  => Hash::make('password123'),
                    'idFakultas' => null,
                ]
            );
        }

        $this->command->info('Admin rektorat: admin1 sampai admin5');
    }

    // Admin fakultas: adminfak1 dan seterusnya, satu per fakultas
    private function seedAdminFakultas(): void
    {
        $daftarFakultas = DB::table('Fakultas')->orderBy('idFakultas')->get();

        if ($daftarFakultas->isEmpty()) {
            $this->command->warn('Tabel Fakultas masih kosong, admin fakultas dilewati. Jalankan MahasiswaDummySeeder dulu.');
            return;
        }

        foreach ($daftarFakultas as $urutan => $fakultas) {
            $nim = 'adminfak' . ($urutan + 1);

            Pengguna::updateOrCreate(
                ['nim' => $nim, 'peran' => 'AdminFakultas'],
                [
                    'nama'       => 'Admin ' . $fakultas->namaFakultas,
                    'kataSandi'  => Hash::make('password123'),
                    'idFakultas' => $fakultas->idFakultas,
                ]
            );

            $this->command->info("{$nim} => {$fakultas->namaFakultas}");
        }
    }
}