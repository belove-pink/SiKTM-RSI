<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// UI-11 / AN-PC04: Daftar Pengajuan KTM (Admin Fakultas dan Admin Rektorat)
class DaftarPengajuanController extends Controller
{
    // nilai ENUM status -> label di tampilan
    private const LABEL = [
        'Diajukan'     => 'Diajukan',
        'Diverifikasi' => 'Sedang Diverifikasi',
        'Diterima'     => 'Disetujui',
        'Ditolak'      => 'Ditolak',
    ];

    public function index(Request $request)
    {
        $idPengguna = session('idPengguna');
        $admin = $idPengguna
            ? DB::table('Pengguna')->where('idPengguna', $idPengguna)->first()
            : null;

        if (!$admin) {
            return redirect('/login');
        }

        $adminFakultas = $admin->peran === 'AdminFakultas';
        if (!$adminFakultas && $admin->peran !== 'AdminRektorat') {
            abort(403, 'Halaman ini hanya untuk admin.');
        }
        if ($adminFakultas && !$admin->idFakultas) {
            abort(403, 'Akun admin fakultas belum terhubung ke fakultas.');
        }

        $q      = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');

        $query = DB::table('PengajuanKTM as p')
            ->join('Pengguna as u', 'u.idPengguna', '=', 'p.idPengguna')
            ->join('Mahasiswa as m', 'm.idPengguna', '=', 'p.idPengguna')
            ->join('ProgramStudi as ps', 'ps.idProdi', '=', 'm.idProdi')
            ->where('p.jalur', 'Rektorat')
            ->select('p.idPengajuan', 'p.nim', 'p.status', 'p.tanggalPengajuan', 'u.nama', 'ps.namaProdi')
            ->orderByDesc('p.tanggalPengajuan')
            ->orderByDesc('p.idPengajuan');

        // Admin Fakultas: hanya fakultasnya sendiri. Admin Rektorat: semua fakultas.
        if ($adminFakultas) {
            $query->where('u.idFakultas', $admin->idFakultas);
        }

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('p.nim', 'like', "%{$q}%")
                  ->orWhere('u.nama', 'like', "%{$q}%");
            });
        }

        if (isset(self::LABEL[$status])) {
            $query->where('p.status', $status);
        }

        $daftar = $query->simplePaginate(15)->withQueryString();

        // NIM di halaman ini yang punya pengajuan aktif di jalur Bank
        $nimBank = DB::table('PengajuanKTM')
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->whereIn('nim', collect($daftar->items())->pluck('nim'))
            ->pluck('nim')
            ->all();

        return view('daftar-pengajuan', [
            'nama'       => $admin->nama,
            'urlBeranda' => url($adminFakultas ? '/dashboard-admin-fakultas' : '/dashboard-admin-rektorat'),
            'q'          => $q,
            'status'     => $status,
            'label'      => self::LABEL,
            'daftar'     => $daftar,
            'nimBank'    => $nimBank,
        ]);
    }
}
