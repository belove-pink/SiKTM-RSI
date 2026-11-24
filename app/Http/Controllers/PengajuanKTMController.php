<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PengajuanKTM;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PengajuanKTMController extends Controller
{
    // Menyimpan pengajuan KTM dari form Ajukan KTM
    public function simpan(Request $request)
    {
        // Pastikan sudah login sebagai mahasiswa
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pengguna = Pengguna::find($idPengguna);

        if (!$pengguna || $pengguna->peran !== 'Mahasiswa') {
            return redirect('/login')->with('error', 'Hanya mahasiswa yang dapat mengajukan KTM.');
        }

        // Validasi isian form
        $validated = $request->validate([
            'alasan'          => 'required|in:KTM Baru,KTM Hilang,KTM Rusak',
            'nim'             => 'required|string|max:20',
            'pasFoto'         => 'required|image|max:2048',
            'suratKehilangan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // NIM yang diisi harus sama dengan NIM akun yang login
        if ($validated['nim'] !== $pengguna->nim) {
            return back()->withInput()->with('error', 'NIM tidak sesuai dengan akun yang sedang login.');
        }

        // Data mahasiswa harus ada di tabel Mahasiswa
        if (!Mahasiswa::where('idPengguna', $idPengguna)->exists()) {
            return back()->withInput()->with('error', 'Data mahasiswa belum terdaftar.');
        }

        // Jalur Rektorat ditolak jika masih ada pengajuan Bank yang aktif
        $bankAktif = PengajuanKTM::where('nim', $pengguna->nim)
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->exists();

        if ($bankAktif) {
            return back()->withInput()->with('error', 'Anda masih memiliki pengajuan KTM aktif melalui jalur Bank.');
        }

        // Simpan file yang diunggah
        $pasFoto = $request->file('pasFoto')->store('pengajuan-ktm/pas-foto', 'public');

        $surat = $request->hasFile('suratKehilangan')
            ? $request->file('suratKehilangan')->store('pengajuan-ktm/surat', 'public')
            : null;

        // Simpan pengajuan ke database (kolom 'dokumen' di database wajib terisi)
        PengajuanKTM::create([
            'idPengguna'        => $idPengguna,
            'nim'               => $pengguna->nim,
            'jalur'             => 'Rektorat',
            'alasan'            => $validated['alasan'],
            'dokumen'           => $pasFoto,
            'pas_foto'          => $pasFoto,
            'dokumen_pendukung' => $surat,
            'status'            => 'Diajukan',
            'tanggalPengajuan'  => now()->toDateString(),
        ]);

        return redirect('/pengajuan-terkirim')->with([
            'namaMahasiswa' => $pengguna->nama,
            'alasan'        => $validated['alasan'],
            'jalur'         => 'Rektorat',
            'tanggal'       => now()->translatedFormat('d F Y'),
        ]);
    }
}