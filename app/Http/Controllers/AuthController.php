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

        // Pilihan angkatan (2024 sampai 2026) berarti peran Mahasiswa
        if (is_numeric($peran)) {
            $peran = 'Mahasiswa';
        }

        // Jika NIM atau kata sandi kosong, tampilkan pesan
        if (empty($nim) || empty($kataSandi)) {
            return $this->loginGagal($request, 'Data wajib diisi');
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
                return $this->loginBerhasil($request, '/dashboard-mahasiswa', 'Berhasil masuk. Mengalihkan ke halaman pengajuan.');
            }

            if ($peranPengguna === 'AdminFakultas') {
                return $this->loginBerhasil($request, '/dashboard-admin-fakultas', 'Berhasil masuk. Mengalihkan ke dashboard.');
            }

            return $this->loginBerhasil($request, '/dashboard-admin-rektorat', 'Berhasil masuk. Mengalihkan ke dashboard.');
        }

        // Jika akun tidak ada atau kata sandi salah
        return $this->loginGagal($request, 'NIM atau kata sandi salah');
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

    // Kembali ke form login dengan pesan berhasil, lalu diarahkan otomatis (UI-03)
    private function loginBerhasil(Request $request, $tujuan, $pesan)
    {
        return redirect('/login')
            ->withInput($request->only('peran', 'nim'))
            ->with('success', $pesan)
            ->with('arahkan', $tujuan);
    }

    // Kembali ke form login dengan pesan gagal, peran dan NIM tetap terisi (UI-02)
    private function loginGagal(Request $request, $pesan)
    {
        return back()
            ->withInput($request->only('peran', 'nim'))
            ->with('error', $pesan);
    }
}