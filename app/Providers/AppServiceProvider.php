<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Kirim nama pengguna yang sedang login ke semua view sebagai $namaLogin
        View::composer('*', function ($view) {
            static $nama = false;

            if ($nama === false) {
                $nama = null;

                try {
                    if (session('idPengguna')) {
                        $nama = DB::table('Pengguna')
                            ->where('idPengguna', session('idPengguna'))
                            ->value('nama');
                    }
                } catch (\Throwable $e) {
                    $nama = null;
                }
            }

            $view->with('namaLogin', $nama);
        });
    }
}