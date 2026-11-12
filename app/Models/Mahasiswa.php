<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    protected $table = 'Mahasiswa';
    protected $primaryKey = 'idPengguna';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['idPengguna', 'angkatan', 'idProdi'];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'idPengguna', 'idPengguna');
    }

    /**
     * cekNIM(nim): dataMahasiswa | null  (Class Diagram: Mahasiswa)
     * NIM disimpan di tabel Pengguna, jadi dicari lewat relasi.
     */
    public static function cekNIM(string $nim): ?self
    {
        return static::whereHas('pengguna', fn ($q) => $q->where('nim', $nim))->first();
    }
}