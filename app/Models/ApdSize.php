<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApdSize extends Model
{
    use SoftDeletes;

    protected   $table = 'apd_size',
                $primaryKey = 'id_size';
    
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    protected $fillable = [
        'id_size',
        'nama_size',
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
        return $this->hasMany(ApdList::class, 'id_size', 'id_size');
    }
}
