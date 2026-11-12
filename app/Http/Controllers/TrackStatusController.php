<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKTM;
use Illuminate\Http\Request;

class TrackStatusController extends Controller
{
    /** Urutan tahap pada stepper (UI-09 / UI-10) */
    private const TAHAP = ['Diajukan', 'Sedang Diverifikasi', 'Disetujui', 'KTM Siap Diambil'];

    /** Form Input NIM (TrackStatusForm) */
    public function index()
    {
        return view('status-pengajuan');
    }

    /** kirimNIM(nim) -- alur AN-SQ04 / AN-PC06 */
    public function kirimNIM(Request $request, ValidasiNIMController $validasi)
    {
        // JIKA nim kosong MAKA TAMPILKAN pesan "Masukkan NIM"
        $request->validate(
            ['nim' => 'required|string|max:20'],
            ['nim.required' => 'Masukkan NIM']
        );
        $nim = trim($request->input('nim'));

        // validasiNIM(nim) -> NIM tidak ditemukan: "Data tidak ditemukan"
        if (! $validasi->validasiNIM($nim)) {
            return back()->withInput()->withErrors(['nim' => 'Data tidak ditemukan']);
        }

        // cariDataPengajuan(nim) -> belum pernah mengajukan: "Belum ada pengajuan"
        $pengajuan = PengajuanKTM::cariDataPengajuan($nim);
        if (! $pengajuan) {
            return back()->withInput()->withErrors(['nim' => 'Belum ada pengajuan']);
        }

        // bacaStatusPengajuan(dataPengajuan) -> tampilkanStatusTerkini()
        $status = $pengajuan->bacaStatusPengajuan();

        return view('status-pengajuan', [
            'nim'       => $nim,
            'pengajuan' => $pengajuan,
            'status'    => $status,
            'badge'     => $this->badge($status, $pengajuan),
            'tahap'     => $this->susunTahap($status, $pengajuan),
        ]);
    }

    private function siapDiambil(string $status, $pengajuan): bool
    {
        return $status === 'Diterima' && ! empty($pengajuan->lokasiPengambilan);
    }

    private function badge(string $status, $pengajuan): string
    {
        return match (true) {
            $this->siapDiambil($status, $pengajuan) => 'KTM Siap Diambil',
            $status === 'Diterima'                  => 'Disetujui',
            $status === 'Diverifikasi'              => 'Sedang Diverifikasi',
            default                                 => $status, // Diajukan / Ditolak
        };
    }

    /**
     * Status tiap tahap: selesai | berjalan | menunggu | ditolak | berhenti
     * Pemetaan enum DDL -> tahap UI: Diajukan, Diverifikasi=Sedang Diverifikasi, Diterima=Disetujui.
     */
    private function susunTahap(string $status, $pengajuan): array
    {
        $kondisi = match (true) {
            $status === 'Ditolak'                   => ['selesai', 'ditolak', 'berhenti', 'berhenti'],
            $this->siapDiambil($status, $pengajuan) => ['selesai', 'selesai', 'selesai', 'selesai'],
            $status === 'Diterima'                  => ['selesai', 'selesai', 'selesai', 'menunggu'],
            $status === 'Diverifikasi'              => ['selesai', 'berjalan', 'menunggu', 'menunggu'],
            default                                 => ['berjalan', 'menunggu', 'menunggu', 'menunggu'],
        };

        $keterangan = [
            'selesai'  => 'Selesai',
            'berjalan' => 'Sedang berjalan',
            'menunggu' => 'Menunggu',
            'ditolak'  => 'Ditolak',
            'berhenti' => 'Tidak berlanjut',
        ];

        return array_map(
            fn ($nama, $k) => ['nama' => $nama, 'kondisi' => $k, 'keterangan' => $keterangan[$k]],
            self::TAHAP,
            $kondisi
        );
    }
}