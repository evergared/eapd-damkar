<?php

namespace App\Models\Eapd\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;

class ApdJenis extends Model
{

    protected $collection = "apd_jenis";

    protected $fillable = [
        'nama_jenis',
        'keterangan'
    ];

    public function apd()
    {
        $this->hasMany(ApdList::class,'id_jenis', '_id');
    }
}
