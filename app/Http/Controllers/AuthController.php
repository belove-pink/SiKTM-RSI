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

        // Jika NIM, kata sandi, atau peran kosong, tampilkan pesan
        if (empty($nim) || empty($kataSandi) || empty($peran)) {
            return $this->loginGagal($request, 'Data wajib diisi');
        }

        if (preg_match('/^\d{4}$/', $peran)) {
            // Pilihan angkatan (misal 2024 sampai 2026) berarti peran Mahasiswa
            // Dua angka pertama NIM harus sama dengan dua angka terakhir angkatan
            if (!$this->nimSesuaiAngkatan($nim, $peran)) {
                return $this->loginGagal($request, 'NIM tidak sesuai dengan angkatan yang dipilih');
            }

            $peran = 'Mahasiswa';
        } elseif (!in_array($peran, ['AdminFakultas', 'AdminRektorat'], true)) {
            // Peran selain angkatan, admin fakultas, dan admin rektorat ditolak
            return $this->loginGagal($request, 'Peran tidak valid');
        }

        // Cari akun berdasarkan NIM dan peran
        $dataAkun = Pengguna::where('nim', $nim)
            ->where('peran', $peran)
            ->first();

        // Jika akun ada dan kata sandi cocok, login berhasil
        if ($dataAkun && $this->verifikasiKataSandi($kataSandi, $dataAkun->kataSandi)) {
            // Buat ID sesi baru supaya aman dari session fixation
            $request->session()->regenerate();

            // Simpan id pengguna ke sesi
            session(['idPengguna' => $dataAkun->idPengguna]);
            session(['idFakultas' => $dataAkun->idFakultas]);

            // Tentukan dashboard sesuai peran
            $peranPengguna = $this->identifikasiPeran($dataAkun);

            return match ($peranPengguna) {
                'Mahasiswa' => $this->loginBerhasil($request, '/beranda-mahasiswa', 'Berhasil masuk. Mengalihkan ke halaman pengajuan.'),
                'AdminFakultas' => $this->loginBerhasil($request, '/dashboard-admin-fakultas', 'Berhasil masuk. Mengalihkan ke dashboard.'),
                'AdminRektorat' => $this->loginBerhasil($request, '/dashboard-admin-rektorat', 'Berhasil masuk. Mengalihkan ke dashboard.'),
                default => $this->loginGagal($request, 'Peran akun tidak dikenali'),
            };
        }

        // Jika akun tidak ada atau kata sandi salah
        return $this->loginGagal($request, 'NIM atau kata sandi salah');
    }

    // Keluar dari akun dan hapus sesi
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
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

    // Memeriksa dua angka pertama NIM sama dengan dua angka terakhir angkatan (misal 2025 dan NIM 25...)
    private function nimSesuaiAngkatan($nim, $angkatan)
    {
        return substr($nim, 0, 2) === substr($angkatan, -2);
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