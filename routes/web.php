<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\BerandaAdminFakultasController;
use App\Http\Controllers\BerandaAdminRektoratController;
use App\Http\Controllers\BerandaMahasiswaController;
use App\Http\Controllers\DaftarPengajuanController;
use App\Http\Controllers\KontrolRekap;
use App\Http\Controllers\PengajuanKTMController;
use App\Http\Controllers\ProfilMahasiswaController;
use App\Http\Controllers\RiwayatPengajuanController;
use App\Http\Controllers\TrackStatusController;
use App\Http\Controllers\ValidasiPengajuanController;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Halaman utama -> arahkan ke login
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Keluar dari akun (mahasiswa dan admin)
Route::post('/keluar', [ProfilMahasiswaController::class, 'keluar'])
    ->name('keluar');

/*
|--------------------------------------------------------------------------
| Beranda
|--------------------------------------------------------------------------
*/
// Beranda mahasiswa (nama 'beranda' dipakai Bantuan, Kontak, dan Status Pengajuan)
Route::get('/beranda-mahasiswa', [BerandaMahasiswaController::class, 'index'])
    ->name('beranda');

// Beranda admin rektorat (URL tujuan login)
Route::get('/dashboard-admin-rektorat', [BerandaAdminRektoratController::class, 'index'])
    ->name('beranda.admin.rektorat');

// Alias URL dari branch fitur-beranda
Route::get('/beranda-admin-rektorat', [BerandaAdminRektoratController::class, 'index']);

// Beranda admin fakultas (URL tujuan login)
Route::get('/dashboard-admin-fakultas', [BerandaAdminFakultasController::class, 'index'])
    ->name('beranda.admin.fakultas');

// Alias URL dari branch fitur-beranda
Route::get('/beranda-admin-fakultas', [BerandaAdminFakultasController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Mahasiswa
|--------------------------------------------------------------------------
*/
// Profil mahasiswa (data dari database)
Route::get('/profil-mahasiswa', [ProfilMahasiswaController::class, 'tampil'])
    ->name('profil-mahasiswa');

// Bantuan (FAQ)
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan');

// Riwayat pengajuan
Route::get('/riwayat-pengajuan', [RiwayatPengajuanController::class, 'index'])
    ->name('riwayat.pengajuan');

// Halaman Ajukan KTM (identitas diisi dari akun yang login)
Route::get('/ajukan-ktm', function () {
    $daftarFakultas = DB::table('Fakultas')
        ->orderBy('namaFakultas')
        ->get();

    $pengguna = Pengguna::find(session('idPengguna'));

    // Prodi dan fakultas mahasiswa lewat Mahasiswa -> ProgramStudi -> Fakultas
    $data = $pengguna
        ? DB::table('Mahasiswa as m')
            ->join('ProgramStudi as ps', 'ps.idProdi', '=', 'm.idProdi')
            ->join('Fakultas as f', 'f.idFakultas', '=', 'ps.idFakultas')
            ->where('m.idPengguna', $pengguna->idPengguna)
            ->select('ps.namaProdi', 'f.namaFakultas')
            ->first()
        : null;

    return view('ajukan-ktm', [
        'namaMahasiswa'  => $pengguna->nama ?? '',
        'nim'            => $pengguna->nim ?? '',
        'fakultas'       => $data->namaFakultas ?? '',
        'prodi'          => $data->namaProdi ?? '',
        'daftarFakultas' => $daftarFakultas,
    ]);
})->name('ajukan-ktm');

// Menyimpan pengajuan dari form Ajukan KTM
Route::post('/ajukan-ktm', [PengajuanKTMController::class, 'simpan']);

// Halaman Pengajuan Terkirim
Route::get('/pengajuan-terkirim', function () {
    return view('pengajuan-terkirim', [
        'namaMahasiswa' => session('namaMahasiswa'),
        'alasan'        => session('alasan'),
        'jalur'         => session('jalur'),
        'tanggal'       => session('tanggal'),
    ]);
})->name('pengajuan-terkirim');

// Track status pengajuan KTM (AN-UC04)
Route::get('/status-pengajuan', [TrackStatusController::class, 'index'])
    ->name('status-pengajuan');
Route::post('/status-pengajuan', [TrackStatusController::class, 'kirimNIM'])
    ->name('status-pengajuan.kirim');

// TODO setelah branch fitur-kontak-kemahasiswaan digabung:
// use App\Http\Controllers\KontakController;
// Route::get('/kontak-kemahasiswaan', [KontakController::class, 'index'])->name('kontak-kemahasiswaan');

/*
|--------------------------------------------------------------------------
| Admin (Rektorat dan Fakultas)
|--------------------------------------------------------------------------
*/
// Daftar pengajuan KTM (admin rektorat dan admin fakultas)
Route::get('/daftar-pengajuan', [DaftarPengajuanController::class, 'index'])
    ->name('daftar-pengajuan');

// Halaman Rekapitulasi KTM (ZN-UC05)
Route::get('/rekap-ktm', [KontrolRekap::class, 'tampilkanRekapitulasi'])
    ->name('rekap-ktm');

// Mengecek pengajuan KTM aktif berdasarkan NIM
Route::get('/pengajuan-ktm/cek/{nim}', [ValidasiPengajuanController::class, 'cariPengajuanAktif']);

// Halaman verifikasi pengajuan KTM (admin rektorat)
Route::get('/pengajuan-ktm/verifikasi/{idPengajuan}', [ValidasiPengajuanController::class, 'halamanVerifikasi'])
    ->name('pengajuan-ktm.verifikasi');

// Menyimpan keputusan verifikasi
Route::post('/pengajuan-ktm/verifikasi/{idPengajuan}', [ValidasiPengajuanController::class, 'simpanKeputusan'])
    ->name('pengajuan-ktm.keputusan');