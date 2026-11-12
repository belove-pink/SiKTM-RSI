
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ValidasiPengajuanController;
use App\Http\Controllers\TrackStatusController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman login
Route::get('/login', function () {
    return view('login');
});

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Mengecek pengajuan KTM aktif berdasarkan NIM
Route::get('/pengajuan-ktm/cek/{nim}', [
    ValidasiPengajuanController::class,
    'cariPengajuanAktif'
]);

// Memvalidasi dan menyimpan pengajuan KTM
Route::post('/pengajuan-ktm', [
    ValidasiPengajuanController::class,
    'validasiPengajuanGanda'
]);

// Halaman verifikasi pengajuan KTM
Route::get('/pengajuan-ktm/verifikasi/{idPengajuan}', [
    ValidasiPengajuanController::class,
    'halamanVerifikasi'
])->name('pengajuan-ktm.verifikasi');

// Menyimpan keputusan verifikasi
Route::post('/pengajuan-ktm/verifikasi/{idPengajuan}', [
    ValidasiPengajuanController::class,
    'simpanKeputusan'
])->name('pengajuan-ktm.keputusan');

// Track status pengajuan KTM (AN-UC04)
Route::get('/status-pengajuan', [TrackStatusController::class, 'index'])->name('status-pengajuan');
Route::post('/status-pengajuan', [TrackStatusController::class, 'kirimNIM'])->name('status-pengajuan.kirim');

// Preview tampilan UI-07 tanpa database
Route::get('/preview-verifikasi', function () {
    return view('verifikasi-pengajuan', [
        'pengajuan' => (object) [
            'idPengajuan' => 1,
            'nim' => '245150200111001',
            'jalur' => 'Rektorat',
            'tanggalPengajuan' => '2026-11-12',
            'status' => 'Diajukan',
            'dokumen' => 'Surat Pengajuan KTM.pdf',
            'mahasiswa' => (object) [
                'nama' => 'Contoh Mahasiswa'
            ]
        ],
        'validasiLolos' => true
    ]);
});

// Preview tampilan UI-09/UI-10 tanpa database
// Coba: /preview-status-pengajuan?status=Diajukan | Diverifikasi | Diterima | Siap | Ditolak
Route::get('/preview-status-pengajuan', function () {
    $status = request('status', 'Ditolak');
    $kondisi = match ($status) {
        'Diajukan'     => ['berjalan', 'menunggu', 'menunggu', 'menunggu'],
        'Diverifikasi' => ['selesai', 'berjalan', 'menunggu', 'menunggu'],
        'Diterima'     => ['selesai', 'selesai', 'selesai', 'menunggu'],
        'Siap'         => ['selesai', 'selesai', 'selesai', 'selesai'],
        default        => ['selesai', 'ditolak', 'berhenti', 'berhenti'],
    };
    $nama = ['Diajukan', 'Sedang Diverifikasi', 'Disetujui', 'KTM Siap Diambil'];
    $ket = ['selesai' => 'Selesai', 'berjalan' => 'Sedang berjalan', 'menunggu' => 'Menunggu',
            'ditolak' => 'Ditolak', 'berhenti' => 'Tidak berlanjut'];
    $tahap = [];
    foreach ($kondisi as $i => $k) {
        $tahap[] = ['nama' => $nama[$i], 'kondisi' => $k, 'keterangan' => $ket[$k]];
    }
    $badge = ['Diajukan' => 'Diajukan', 'Diverifikasi' => 'Sedang Diverifikasi',
              'Diterima' => 'Disetujui', 'Siap' => 'KTM Siap Diambil'][$status] ?? 'Ditolak';

    return view('status-pengajuan', [
        'nim' => '245150200111001',
        'status' => $badge === 'Ditolak' ? 'Ditolak' : $status,
        'badge' => $badge,
        'tahap' => $tahap,
        'pengajuan' => (object) [
            'tanggalPengajuan' => '2026-11-12',
            'catatan' => 'Ditemukan pengajuan aktif melalui Bank untuk NIM kamu, sehingga pengajuan lewat Rektorat tidak dapat diproses.',
            'lokasiPengambilan' => 'Gedung Kemahasiswaan Lt. 1',
            'jadwalPengambilan' => 'Senin-Jumat, 09.00-15.00',
            'keteranganPengambilan' => 'Bawa KTP atau bukti pengajuan',
        ],
    ]);
});