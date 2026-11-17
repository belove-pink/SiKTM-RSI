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
                $idFakultas = DB::table('Fakultas')
                    ->insertGetId([
                        'namaFakultas' => $namaFakultas
                    ]);
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
                $idProdi = DB::table('ProgramStudi')
                    ->insertGetId([
                        'namaProdi' => $namaProdi,
                        'idFakultas' => $idFakultas
                    ]);
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
                $idPengguna = DB::table('Pengguna')
                    ->insertGetId($dataPengguna);
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