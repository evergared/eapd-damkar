<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Jenssegers\Mongodb\Eloquent\Model;


class ApdKondisi extends Model
{

    protected $collection = "apd_kondisi";

    protected $fillable = [
        'nama_kondisi',
        'opsi',
        'keterangan'
    ];

    public function opsi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }


    public function apd()
    {
        $this->hasMany(ApdList::class, 'id_kondisi', '_id');
    }
}
