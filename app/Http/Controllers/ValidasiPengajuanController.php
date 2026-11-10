<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKTM;

class ValidasiPengajuanController extends Controller
{
    // Mengecek pengajuan KTM aktif melalui jalur Bank berdasarkan NIM
    public function cariPengajuanAktif($nim)
    {
        return PengajuanKTM::where('nim', $nim)
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->exists();
    }

    // Memvalidasi dan menyimpan pengajuan KTM
    public function validasiPengajuanGanda(Request $request)
    {
        // Memastikan pengguna sudah login
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Memvalidasi input formulir
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'jalur' => 'required|in:Rektorat,Bank',
            'dokumen' => 'required|string|max:255'
        ]);

        $nim = $validated['nim'];
        $jalur = $validated['jalur'];
        $dokumen = $validated['dokumen'];

        // Memastikan NIM sesuai dengan akun yang sedang login
        $pengguna = \App\Models\Pengguna::find($idPengguna);

        if (!$pengguna || $pengguna->nim !== $nim) {
            return back()->with(
                'error',
                'NIM tidak sesuai dengan akun yang sedang login.'
            );
        }

        // Mengecek pengajuan Bank yang masih aktif
        $pengajuanAktif = $this->cariPengajuanAktif($nim);

        // Menolak pengajuan Rektorat jika masih ada pengajuan Bank aktif
        if ($jalur === 'Rektorat' && $pengajuanAktif) {
            return back()->with(
                'error',
                'Anda masih memiliki pengajuan KTM aktif melalui jalur Bank.'
            );
        }

        // Menyimpan pengajuan KTM
        $pengajuan = PengajuanKTM::create([
            'idPengguna' => $idPengguna,
            'nim' => $nim,
            'jalur' => $jalur,
            'dokumen' => $dokumen,
            'status' => 'Diajukan',
            'tanggalPengajuan' => now()->toDateString()
        ]);

        return back()->with(
            'success',
            'Pengajuan KTM berhasil disimpan.'
        );
    }

    // Mengambil data pengajuan untuk Admin Rektorat
    public function teruskanKeAdminRektorat($idPengajuan)
    {
        return PengajuanKTM::findOrFail($idPengajuan);
    }

    // Menyimpan keputusan verifikasi Admin Rektorat
    public function simpanKeputusan(Request $request, $idPengajuan)
    {
        $pengajuan = PengajuanKTM::findOrFail($idPengajuan);

        $validated = $request->validate([
            'keputusan' => 'required|in:Diterima,Ditolak'
        ]);

        $pengajuan->update([
            'status' => $validated['keputusan']
        ]);

        return back()->with(
            'success',
            'Keputusan verifikasi berhasil disimpan.'
        );
    }
}
