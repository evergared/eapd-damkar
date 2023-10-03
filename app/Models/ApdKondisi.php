<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ApdKondisi extends Model
{
    protected   $table = 'apd_kondisi',
                $primaryKey = 'id_kondisi';
    
    public $timestamps = false;

    protected $fillable = [
        'id_kondisi',
        'nama_kondisi',
        'opsi'
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
        return $this->hasMany(ApdList::class, 'id_kondisi', 'id_kondisi');
    }
}
