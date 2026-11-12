<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKTM extends Model
{
    protected $table = 'PengajuanKTM';

    protected $primaryKey = 'idPengajuan';

    public $timestamps = false;

    protected $fillable = [
        'idPengguna',
        'nim',
        'jalur',
        'dokumen',
        'status',
        'tanggalPengajuan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'idPengguna',
            'idPengguna'
        );
    }

    // cariDataPengajuan(nim): pengajuan terbaru milik NIM tersebut
    public static function cariDataPengajuan(string $nim): ?self
    {
        return static::where('nim', $nim)
            ->orderByDesc('tanggalPengajuan')
            ->orderByDesc('idPengajuan')
            ->first();
    }

    // bacaStatusPengajuan(): status pengajuan ini
    public function bacaStatusPengajuan(): string
    {
        return $this->status;
    }
}
