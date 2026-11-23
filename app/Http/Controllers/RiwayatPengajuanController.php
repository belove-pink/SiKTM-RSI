<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKTM;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class RiwayatPengajuanController extends Controller
{
    // Menampilkan halaman riwayat dan melakukan filter
    public function index(Request $request)
    {
        // Pastikan sudah login sebagai mahasiswa
        $pengguna = Pengguna::find(session('idPengguna'));

        if (!$pengguna || $pengguna->peran !== 'Mahasiswa') {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mengambil filter dari URL
        $filter = $request->query('status', 'semua');

        // Validasi filter
        $daftarFilter = [
            'semua',
            'diverifikasi',
            'ditolak',
            'siap-diambil',
        ];

        if (!in_array($filter, $daftarFilter)) {
            abort(404);
        }

        // Ambil pengajuan milik mahasiswa yang login (terbaru di atas)
        $semuaRiwayat = PengajuanKTM::where('idPengguna', $pengguna->idPengguna)
            ->orderByDesc('tanggalPengajuan')
            ->orderByDesc('idPengajuan')
            ->get()
            ->map(function ($pengajuan) {
                return [
                    'id'      => 'KTM-' . date('Y', strtotime($pengajuan->tanggalPengajuan))
                                 . '-' . str_pad($pengajuan->idPengajuan, 3, '0', STR_PAD_LEFT),
                    'jenis'   => $pengajuan->alasan
                                 ? 'Pengajuan ' . $pengajuan->alasan
                                 : 'Pengajuan KTM',
                    'tanggal' => \Carbon\Carbon::parse($pengajuan->tanggalPengajuan)
                                 ->locale('id')->translatedFormat('d F Y'),
                    'status'  => match ($pengajuan->status) {
                        'Diajukan'     => 'Menunggu Verifikasi',
                        'Diverifikasi' => 'Sedang Diverifikasi',
                        'Diterima'     => 'Diterima',
                        'Ditolak'      => 'Ditolak',
                        default        => $pengajuan->status,
                    },
                    'kondisi' => match ($pengajuan->status) {
                        'Diajukan'     => 'diajukan',
                        'Diverifikasi' => 'diverifikasi',
                        'Diterima'     => 'diterima',
                        'Ditolak'      => 'ditolak',
                        default        => 'diajukan',
                    },
                ];
            })
            ->all();

        // Filter data berdasarkan status
        $riwayat = $filter === 'semua'
            ? $semuaRiwayat
            : array_filter($semuaRiwayat, function ($item) use ($filter) {
                return $item['kondisi'] === $filter;
            });

        return view('riwayat-pengajuan', [
            'riwayat'     => array_values($riwayat),
            'filterAktif' => $filter,
            'nama'        => $pengguna->nama,
        ]);
    }
}
