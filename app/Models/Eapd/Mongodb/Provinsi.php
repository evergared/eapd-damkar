<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Provinsi extends Model
{

    protected $collection = "provinsi";

    protected $fillable = [
        "nama_provinsi",
        "keterangan",
    ];

    public function wilayah()
    {
        return $this->hasMany(Wilayah::class,'id_provinsi','_id');
    }
}
