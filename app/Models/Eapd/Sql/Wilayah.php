<?php

namespace App\Models\Eapd\Sql;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = "wilayah";

    protected $fillable = [
        "id_wilayah",
        "nama_wilayah",
        "keterangan",
    ];

    public function anggota()
    {
        return $this->hasMany(Pegawai::class, 'id_wilayah', 'id_wilayah');
    }
}
