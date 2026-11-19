<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProfilMahasiswaController extends Controller
{
    // Menampilkan profil mahasiswa yang sedang login (UI Profil Mahasiswa)
    public function tampil()
    {
        // Ambil id pengguna dari sesi login
        $idPengguna = session('idPengguna');

        // Jika belum login, arahkan ke halaman login
        if (!$idPengguna) {
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu');
        }

        // Ambil data mahasiswa beserta prodi dan fakultasnya
        $mhs = DB::table('Pengguna')
            ->join('Mahasiswa', 'Pengguna.idPengguna', '=', 'Mahasiswa.idPengguna')
            ->join('ProgramStudi', 'Mahasiswa.idProdi', '=', 'ProgramStudi.idProdi')
            ->join('Fakultas', 'ProgramStudi.idFakultas', '=', 'Fakultas.idFakultas')
            ->where('Pengguna.idPengguna', $idPengguna)
            ->select(
                'Pengguna.nama',
                'Pengguna.nim',
                'Mahasiswa.angkatan',
                'ProgramStudi.namaProdi',
                'Fakultas.namaFakultas'
            )
            ->first();

        // Jika data mahasiswa tidak ditemukan, kembali ke login
        if (!$mhs) {
            return redirect('/login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        // Ambil pengajuan terbaru untuk mendapatkan foto (kolom dokumen)
        $pengajuan = DB::table('PengajuanKTM')
            ->where('idPengguna', $idPengguna)
            ->orderByDesc('idPengajuan')
            ->first();

        // Kirim data ke tampilan profil
        return view('profil-mahasiswa', [
            'namaMahasiswa' => $mhs->nama,
            'nim'           => $mhs->nim,
            'prodi'         => $mhs->namaProdi,
            'fakultas'      => $mhs->namaFakultas,
            'angkatan'      => $mhs->angkatan,
            'statusAkun'    => 'Aktif',
            'foto'          => $pengajuan ? asset('storage/' . $pengajuan->dokumen) : null,
        ]);
    }

    // Keluar dari akun: hapus sesi lalu kembali ke login
    public function keluar()
    {
        session()->flush();
        return redirect('/login');
    }
}