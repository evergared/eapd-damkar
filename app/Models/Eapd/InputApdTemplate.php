<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;


class InputApdTemplate extends Model
{
    use HasFactory;


    protected $table = 'input_apd_template';


    public function template(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function jabatan()
    {
        return $this->belongsToMany(Jabatan::class)->wherePivot('pivot_input_apd_template', 'id_jabatan');
    }

    public function periode()
    {
        return $this->belongsToMany(PeriodeInputApd::class)->wherePivot('pivot_input_apd_template', 'id_periode');
    }
}
