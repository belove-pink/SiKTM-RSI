<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDummySeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['email' => 'rektorat1@siktm.test', 'nama' => 'Admin Rektorat 1', 'role' => 'rektorat', 'fakultas' => null],
            ['email' => 'rektorat2@siktm.test', 'nama' => 'Admin Rektorat 2', 'role' => 'rektorat', 'fakultas' => null],
            ['email' => 'rektorat3@siktm.test', 'nama' => 'Admin Rektorat 3', 'role' => 'rektorat', 'fakultas' => null],
            ['email' => 'rektorat4@siktm.test', 'nama' => 'Admin Rektorat 4', 'role' => 'rektorat', 'fakultas' => null],
            ['email' => 'rektorat5@siktm.test', 'nama' => 'Admin Rektorat 5', 'role' => 'rektorat', 'fakultas' => null],

            // Nanti admin fakultas, contoh:
            // ['email' => 'fakultas1@siktm.test', 'nama' => 'Admin Fakultas 1', 'role' => 'fakultas', 'fakultas' => 'Ilmu Komputer'],
        ];

        foreach ($admins as $admin) {
            DB::table('admins')->updateOrInsert(
                ['email' => $admin['email']],
                $admin + [
                    'password'   => Hash::make('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}