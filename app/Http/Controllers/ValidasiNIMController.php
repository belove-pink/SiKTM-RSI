<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

class ValidasiNIMController extends Controller
{
    /** validasiNIM(nim): hasilValidasi (ditemukan / tidak) */
    public function validasiNIM(string $nim): bool
    {
        return Mahasiswa::cekNIM($nim) !== null;
    }
}
