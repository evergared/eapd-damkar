<?php

namespace App\Models\Eapd\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class InputApdTemplate extends Model
{

    protected $collection = 'input_apd_template';

    protected $fillable = [
        '_id',
        'template'
    ];


    public function template(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }


    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class,'id_periode','_id');
    }

}
