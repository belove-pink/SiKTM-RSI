
<?php

use App\Http\Controllers\BantuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ValidasiPengajuanController;
use App\Http\Controllers\TrackStatusController;
use App\Http\Controllers\KontrolRekap;
use App\Http\Controllers\BerandaMahasiswaController;
use App\Http\Controllers\ProfilMahasiswaController;

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

// Preview tampilan UI-06 ZN Pengajuan Terkirim tanpa database 
Route::get('/preview-pengajuan-terkirim', function () {
    return view('pengajuan-terkirim', [
        'namaMahasiswa' => 'Contoh Mahasiswa',
        'alasan' => 'KTM baru',
        'jalur' => 'Rektorat',
        'tanggal' => '13 November 2026',
    ]);
});

// Preview tampilan UI-07 tanpa database
Route::get('/verifikasi-ktm', function () {
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

// Halaman Rekapitulasi KTM (ZN-UC05)
Route::get('/rekap-ktm', [
    KontrolRekap::class,
    'tampilkanRekapitulasi'
])->name('rekap-ktm');
// Route::get('/beranda-mahasiswa', function () {
//     return view('beranda-mahasiswa');
// });

// Preview tampilan UI-12 tanpa database
Route::get('/preview-rekap-ktm', function () {
    return view('rekap-ktm', [
        'namaAdmin' => 'Admin Fakultas',
        'belum' => 40, 'proses' => 25, 'sudah' => 135,
        'daftarProdi' => collect([
            (object) ['idProdi' => 1, 'namaProdi' => 'Sistem Informasi'],
            (object) ['idProdi' => 2, 'namaProdi' => 'Teknik Informatika'],
        ]),
        'daftar' => [
            ['nim' => '255150400111000', 'prodi' => 'Sistem Informasi', 'status' => 'Sudah Memiliki KTM'],
            ['nim' => '255150400111001', 'prodi' => 'Teknik Informatika', 'status' => 'Sedang Diproses'],
            ['nim' => '255150400111002', 'prodi' => 'Sistem Informasi', 'status' => 'Belum Mengajukan'],
            ['nim' => '255150400111003', 'prodi' => 'Teknik Komputer', 'status' => 'Sudah Memiliki KTM'],
            ['nim' => '255150400111004', 'prodi' => 'Sistem Informasi', 'status' => 'Sedang Diproses'],
        ],
    ]);
});
// Beranda mahasiswa
Route::get('/beranda-mahasiswa', [
    BerandaMahasiswaController::class,
    'index'
])->name('beranda.mahasiswa');

// Preview tampilan Ajukan KTM tanpa database
Route::get('/preview-ajukan-ktm', function () {
    return view('ajukan-ktm', [
        'namaMahasiswa' => '',
        'nim' => '',
        'fakultas' => '',
        'prodi' => '',
        'daftarFakultas' => collect([
            (object) ['namaFakultas' => 'Fakultas Ilmu Komputer'],
            (object) ['namaFakultas' => 'Fakultas Teknik'],
            (object) ['namaFakultas' => 'Fakultas Ekonomi dan Bisnis'],
            (object) ['namaFakultas' => 'Fakultas Hukum'],
        ]),
    ]);
});

Route::post('/ajukan-ktm', function (\Illuminate\Http\Request $request) {
    return redirect('/pengajuan-terkirim')->with([
        'alasan'  => $request->input('alasan'),
        'jalur'   => 'Rektorat',
        'tanggal' => now()->translatedFormat('d F Y'),
    ]);
});

Route::get('/pengajuan-terkirim', function () {
    return view('pengajuan-terkirim', [
        'namaMahasiswa' => session('namaMahasiswa'),
        'alasan'        => session('alasan'),
        'jalur'         => session('jalur'),
        'tanggal'       => session('tanggal'),
    ]);
});

// Preview tampilan Profil Mahasiswa tanpa database
Route::get('/preview-profil-mahasiswa', function () {
    return view('profil-mahasiswa', [
        'namaMahasiswa' => 'Contoh Mahasiswa',
        'nim' => '255150400111000',
        'statusAkun' => 'Aktif',
        'prodi' => 'Sistem Informasi',
        'fakultas' => 'Fakultas Ilmu Komputer',
        'angkatan' => '2025',
        'emailUb' => 'contoh@student.ub.ac.id',
        'telepon' => '081234567890',
    ]);
});

// Profil mahasiswa (data dari database)
Route::get('/profil-mahasiswa', [ProfilMahasiswaController::class, 'tampil']);
Route::post('/keluar', [ProfilMahasiswaController::class, 'keluar']);

// Bantuan (FAQ)
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan');
