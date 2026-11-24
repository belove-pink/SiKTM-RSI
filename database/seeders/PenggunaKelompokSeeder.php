<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaKelompokSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil idFakultas dari akun Mahasiswa yang sudah ada (misal Mahasiswa Dummy).
        // Kalau mau pasti FILKOM, ganti dengan angkanya langsung, contoh: $idFakultas = 1;
        $idFakultas = Pengguna::where('peran', 'Mahasiswa')->value('idFakultas');

        $akun = [
            ['nim' => '255150401111012', 'nama' => 'Aluna Sassy Elfriyan'],
            ['nim' => '255150401111027', 'nama' => 'Aqila Najia Puterykitta'],
            ['nim' => '255150401111034', 'nama' => 'Zahra Naila Irwannda'],
            ['nim' => '255150401111049', 'nama' => 'Viona Adelaide Fibrianty'],
        ];

        foreach ($akun as $a) {
            Pengguna::updateOrCreate(
                ['nim' => $a['nim'], 'peran' => 'Mahasiswa'],
                [
                    'nama'       => $a['nama'],
                    'kataSandi'  => Hash::make('siktm123'),
                    'idFakultas' => $idFakultas,
                ]
            );
        }
    }
}