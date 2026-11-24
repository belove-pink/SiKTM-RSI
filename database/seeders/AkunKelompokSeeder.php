<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunKelompokSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['nim' => '255150401111012', 'name' => 'Aluna Sassy Elfriyan'],
            ['nim' => '255150401111027', 'name' => 'Aqila Najia Puterykitta'],
            ['nim' => '255150401111034', 'name' => 'Zahra Naila Irwannda'],
            ['nim' => '255150401111049', 'name' => 'Viona Adelaide Fibrianty'],
        ];

        foreach ($akun as $a) {
            User::updateOrCreate(
                ['nim' => $a['nim']],
                [
                    'name'     => $a['name'],
                    'email'    => $a['nim'] . '@student.ub.ac.id',
                    'password' => Hash::make('siktm123'),
                ]
            );
        }
    }
}