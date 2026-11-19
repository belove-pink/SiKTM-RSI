<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaDummySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

// Daftar fakultas Universitas Brawijaya
$daftarFakultas = [
    'Fakultas Hukum',
    'Fakultas Ekonomi dan Bisnis',
    'Fakultas Ilmu Administrasi',
    'Fakultas Bio-Industri Pertanian dan Kehutanan',
    'Fakultas Sains dan Teknologi Peternakan',
    'Fakultas Perikanan dan Ilmu Kelautan',
    'Fakultas Kedokteran',
    'Fakultas Teknik',
    'Fakultas Sains, Teknologi, dan Matematika',
    'Fakultas Teknologi Agroindustri dan Biosistem',
    'Fakultas Ilmu Sosial dan Ilmu Politik',
    'Fakultas Ilmu Budaya',
    'Fakultas Kedokteran Hewan',
    'Fakultas Ilmu Komputer',
    'Fakultas Kedokteran Gigi',
    'Fakultas Ilmu Kesehatan',
    'Fakultas Vokasi',
];

// Masukkan fakultas yang belum tersedia
foreach ($daftarFakultas as $nama) {
    $sudahAda = DB::table('Fakultas')
        ->where('namaFakultas', $nama)
        ->exists();

    if (!$sudahAda) {
        DB::table('Fakultas')->insert([
            'namaFakultas' => $nama,
        ]);
    }
}


            // =====================================
            // 1. DATA FAKULTAS
            // =====================================

            $namaFakultas = 'Fakultas Ilmu Komputer';

            $fakultas = DB::table('Fakultas')
                ->where('namaFakultas', $namaFakultas)
                ->first();

            if ($fakultas) {
                $idFakultas = $fakultas->idFakultas;
            } else {
                $idFakultas = DB::table('Fakultas')->insertGetId([
                    'namaFakultas' => 'Fakultas Ilmu Komputer',
                ], 'idFakultas');
            }


            // =====================================
            // 2. DATA PROGRAM STUDI
            // =====================================

            $namaProdi = 'Sistem Informasi';

            $prodi = DB::table('ProgramStudi')
                ->where('namaProdi', $namaProdi)
                ->where('idFakultas', $idFakultas)
                ->first();

            if ($prodi) {
                $idProdi = $prodi->idProdi;
            } else {
                $idProdi = DB::table('ProgramStudi')->insertGetId([
                    'namaProdi' => 'Sistem Informasi',
                    'idFakultas' => $idFakultas,
                ], 'idProdi');
            }


            // =====================================
            // 3. DATA PENGGUNA
            // =====================================

            $nim = '262600000001';

            $dataPengguna = [
                'nim' => $nim,
                'nama' => 'Mahasiswa Dummy',
                'kataSandi' => Hash::make('DummyLogin2026!'),
                'peran' => 'Mahasiswa',
                'idFakultas' => $idFakultas
            ];

            $pengguna = DB::table('Pengguna')
                ->where('nim', $nim)
                ->first();

            if ($pengguna) {
                $idPengguna = $pengguna->idPengguna;

                DB::table('Pengguna')
                    ->where('idPengguna', $idPengguna)
                    ->update($dataPengguna);
            } else {
                $idPengguna = DB::table('Pengguna')->insertGetId([
                    'nim' => $nim,
                    'nama' => 'Mahasiswa Dummy', 'kataSandi' => Hash::make('DummyLogin2026!'),
                    'peran' => 'Mahasiswa','idFakultas' => $idFakultas,], 'idPengguna');
            }


            // =====================================
            // 4. DATA MAHASISWA
            // =====================================

            DB::table('Mahasiswa')->updateOrInsert(
                [
                    'idPengguna' => $idPengguna
                ],
                [
                    'angkatan' => 2026,
                    'idProdi' => $idProdi
                ]
            );

        });

        $this->command->info(
            'Data mahasiswa dummy berhasil disiapkan.'
        );
    }
}