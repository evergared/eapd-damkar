<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Penempatan extends Model
{

    protected $collection = "penempatan";

    protected $fillable = [
        "nama_penempatan",
        "keterangan",
    ];

    public function anggota()
    {
        return $this->hasMany(Pegawai::class, 'id_penempatan', '_id');
    }

}
