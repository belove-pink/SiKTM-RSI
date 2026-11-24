<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunKelompokSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['nim' => '255150401111012', 'nama' => 'Aluna Sassy Elfriyan'],
            ['nim' => '255150401111027', 'nama' => 'Aqila Najia Puterykitta'],
            ['nim' => '255150401111034', 'nama' => 'Zahra Naila Irwannda'],
            ['nim' => '255150401111049', 'nama' => 'Viona Adelaide Fibrianty'],
        ];

        foreach ($akun as $a) {
            // 1. Isi / update tabel Pengguna
            DB::table('Pengguna')->updateOrInsert(
                ['nim' => $a['nim']],
                [
                    'nama'     => $a['nama'],
                    'email'    => $a['nim'] . '@student.ub.ac.id', // sesuaikan kalau kolomnya beda
                    'password' => Hash::make('siktm123'),         // sesuaikan nama kolomnya
                    'peran'    => 'Mahasiswa',
                ]
            );

            // 2. Ambil idPengguna yang baru dibuat
            $idPengguna = DB::table('Pengguna')
                ->where('nim', $a['nim'])
                ->value('idPengguna');

            // 3. Isi tabel Mahasiswa dengan idPengguna yang sama
            DB::table('Mahasiswa')->updateOrInsert(
                ['idPengguna' => $idPengguna],
                [
                    // tambahkan kolom lain milik tabel Mahasiswa di sini kalau ada
                ]
            );
        }
    }
}