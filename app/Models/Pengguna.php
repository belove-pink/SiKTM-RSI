<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    // Nama tabel dan primary key sesuai PDM
    protected $table = 'Pengguna';
    protected $primaryKey = 'idPengguna';
    public $timestamps = false;
}