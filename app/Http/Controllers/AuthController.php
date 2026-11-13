<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Method utama untuk memproses login (VA-PC01)
    public function login(Request $request)
    {
        // Ambil input dari form login
        $nim = $request->input('nim');
        $kataSandi = $request->input('kataSandi');
        $peran = $request->input('peran');

        // Jika NIM atau kata sandi kosong, tampilkan pesan
        if (empty($nim) || empty($kataSandi)) {
            return back()->with('error', 'Data wajib diisi');
        }

        // Cari akun berdasarkan NIM dan peran
        $dataAkun = Pengguna::where('nim', $nim)
            ->where('peran', $peran)
            ->first();

        // Jika akun ada dan kata sandi cocok, login berhasil
        if ($dataAkun && $this->verifikasiKataSandi($kataSandi, $dataAkun->kataSandi)) {
            // Simpan id pengguna ke sesi
            session(['idPengguna' => $dataAkun->idPengguna]);

            // Tentukan dashboard sesuai peran
            $peranPengguna = $this->identifikasiPeran($dataAkun);

            if ($peranPengguna === 'Mahasiswa') {
                return redirect('/dashboard-mahasiswa')->with('success', 'Berhasil masuk');
            }

            if ($peranPengguna === 'AdminFakultas') {
                return redirect('/dashboard-admin-fakultas')->with('success', 'Berhasil masuk');
            }

            return redirect('/dashboard-admin-rektorat')->with('success', 'Berhasil masuk');
        }

        // Jika akun tidak ada atau kata sandi salah
            return back()
        ->withInput($request->only('nim'))
        ->with('error', 'NIM atau kata sandi salah. Silakan coba lagi.');
    }

    // Membandingkan kata sandi input dengan hash di database
    public function verifikasiKataSandi($kataSandi, $hash)
    {
        return Hash::check($kataSandi, $hash);
    }

    // Mengambil peran dari data akun
    public function identifikasiPeran($dataAkun)
    {
        return $dataAkun->peran;
    }
}