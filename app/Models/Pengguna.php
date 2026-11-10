
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'Pengguna';

    protected $primaryKey = 'idPengguna';

    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'kataSandi',
        'peran',
        'idFakultas'
    ];
}
