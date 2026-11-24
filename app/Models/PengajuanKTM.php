<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanKTM extends Model
{
    protected $table = 'PengajuanKTM';
    protected $primaryKey = 'idPengajuan';

    // Tabel tidak punya created_at / updated_at
    public $timestamps = false;

    protected $fillable = [
        'idPengguna',
        'nim',
        'jalur',
        'dokumen',
        'pas_foto',
        'dokumen_pendukung',
        'status',
        'catatan',
        'tanggalPengajuan',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'idPengguna', 'idPengguna');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'idPengguna', 'idPengguna');
    }

    // Dipakai TrackStatusController (AN-PC06): pengajuan terbaru berdasarkan NIM
    public static function cariDataPengajuan(string $nim)
    {
        return static::where('nim', $nim)
            ->orderByDesc('tanggalPengajuan')
            ->orderByDesc('idPengajuan')
            ->first();
    }

    // Dipakai TrackStatusController: membaca status dari data pengajuan
    public function bacaStatusPengajuan(): string
    {
        return $this->status;
    }
}