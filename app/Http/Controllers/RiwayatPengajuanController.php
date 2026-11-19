<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatPengajuanController extends Controller
{
    // Data dummy riwayat pengajuan
    private function dataRiwayat()
    {
        return [
            [
                'id' => 'KTM-2026-001',
                'jenis' => 'Pengajuan KTM Baru',
                'tanggal' => '18 November 2026',
                'status' => 'Sedang Diverifikasi',
                'kondisi' => 'diverifikasi',
            ],
            [
                'id' => 'KTM-2026-002',
                'jenis' => 'Penggantian KTM',
                'tanggal' => '12 November 2026',
                'status' => 'Ditolak',
                'kondisi' => 'ditolak',
            ],
            [
                'id' => 'KTM-2026-003',
                'jenis' => 'Pengajuan KTM Baru',
                'tanggal' => '5 November 2026',
                'status' => 'Siap Diambil',
                'kondisi' => 'siap-diambil',
            ],
        ];
    }

    // Menampilkan halaman riwayat dan melakukan filter
    public function index(Request $request)
    {
        $semuaRiwayat = $this->dataRiwayat();

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

        // Filter data berdasarkan status
        $riwayat = $filter === 'semua'
            ? $semuaRiwayat
            : array_filter($semuaRiwayat, function ($item) use ($filter) {
                return $item['kondisi'] === $filter;
            });

        return view('riwayat-pengajuan', [
            'riwayat' => array_values($riwayat),
            'filterAktif' => $filter,
        ]);
    }
}
