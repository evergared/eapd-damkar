<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = "penempatan";

    protected $fillable = [
        "id_penempatan",
        "nama_penempatan",
        "keterangan",
    ];

    public function anggota()
    {
        return $this->hasMany(Pegawai::class, 'id_penempatan', 'id_penempatan');
    }
}
