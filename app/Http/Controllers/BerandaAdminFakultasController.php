<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BerandaAdminFakultasController extends Controller
{
    public function index()
    {
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data admin fakultas
        $admin = DB::table('Pengguna')
            ->join(
                'Fakultas',
                'Pengguna.idFakultas',
                '=',
                'Fakultas.idFakultas'
            )
            ->where('Pengguna.idPengguna', $idPengguna)
            ->where('Pengguna.peran', 'AdminFakultas')
            ->select(
                'Pengguna.idPengguna',
                'Pengguna.nama',
                'Pengguna.idFakultas',
                'Fakultas.namaFakultas'
            )
            ->first();

        if (!$admin) {
            return redirect('/login')
                ->with('error', 'Akun Admin Fakultas tidak ditemukan.');
        }

        $idFakultas = $admin->idFakultas;

        // Query dasar mahasiswa dalam fakultas admin
        $mahasiswaQuery = DB::table('Mahasiswa')
            ->join(
                'Pengguna',
                'Mahasiswa.idPengguna',
                '=',
                'Pengguna.idPengguna'
            )
            ->join(
                'ProgramStudi',
                'Mahasiswa.idProdi',
                '=',
                'ProgramStudi.idProdi'
            )
            ->where('ProgramStudi.idFakultas', $idFakultas)
            ->where('Pengguna.peran', 'Mahasiswa');

        // Total mahasiswa
        $totalMahasiswa = (clone $mahasiswaQuery)->count();

        // Mahasiswa yang belum pernah mengajukan KTM
        $belumMengajukan = (clone $mahasiswaQuery)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('PengajuanKTM')
                    ->whereColumn(
                        'PengajuanKTM.idPengguna',
                        'Mahasiswa.idPengguna'
                    );
            })
            ->count();

        // Total pengajuan yang sedang diproses
        $sedangDiproses = DB::table('PengajuanKTM')
            ->join(
                'Mahasiswa',
                'PengajuanKTM.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->join(
                'ProgramStudi',
                'Mahasiswa.idProdi',
                '=',
                'ProgramStudi.idProdi'
            )
            ->where('ProgramStudi.idFakultas', $idFakultas)
            ->whereIn('PengajuanKTM.status', [
                'Diajukan',
                'Diverifikasi'
            ])
            ->count();

        // Total KTM diterima
        $ktmDiterima = DB::table('PengajuanKTM')
            ->join(
                'Mahasiswa',
                'PengajuanKTM.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->join(
                'ProgramStudi',
                'Mahasiswa.idProdi',
                '=',
                'ProgramStudi.idProdi'
            )
            ->where('ProgramStudi.idFakultas', $idFakultas)
            ->where('PengajuanKTM.status', 'Diterima')
            ->count();

        // Daftar pengajuan mahasiswa fakultas
        $daftarPengajuan = DB::table('PengajuanKTM')
            ->join(
                'Mahasiswa',
                'PengajuanKTM.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->join(
                'Pengguna',
                'Mahasiswa.idPengguna',
                '=',
                'Pengguna.idPengguna'
            )
            ->join(
                'ProgramStudi',
                'Mahasiswa.idProdi',
                '=',
                'ProgramStudi.idProdi'
            )
            ->where('ProgramStudi.idFakultas', $idFakultas)
            ->select(
                'PengajuanKTM.idPengajuan',
                'PengajuanKTM.nim',
                'Pengguna.nama',
                'ProgramStudi.namaProdi',
                'PengajuanKTM.jalur',
                'PengajuanKTM.status',
                'PengajuanKTM.tanggalPengajuan'
            )
            ->orderByDesc('PengajuanKTM.tanggalPengajuan')
            ->orderByDesc('PengajuanKTM.idPengajuan')
            ->get();

        return view('beranda-admin-fakultas', compact(
            'admin',
            'totalMahasiswa',
            'belumMengajukan',
            'sedangDiproses',
            'ktmDiterima',
            'daftarPengajuan'
        ));
    }
}
