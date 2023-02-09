<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Wilayah extends Model
{

    protected $collection = "wilayah";

    protected $fillable = [
        "nama_wilayah",
        "keterangan",
    ];

    public function anggota()
    {
        return $this->hasMany(Pegawai::class, 'id_wilayah', '_id');
    }
}
