<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class ApdSize extends Model
{
    use HasFactory;

    protected $table = "apd_size";

    protected $fillable = [
        'id_size',
        'nama_size',
        'opsi',
        'keterangan'
    ];

    // protected $casts = [
    //     'opsi' => 'array'
    // ];

    public function opsi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function apd()
    {
        $this->hasMany(ApdList::class, 'id_size', 'id_size');
    }
}
