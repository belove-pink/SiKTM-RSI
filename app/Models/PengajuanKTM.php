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
}