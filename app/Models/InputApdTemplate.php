<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputApdTemplate extends Model
{

    use HasUlids;
    protected   $table = 'input_apd_template',
        $primaryKey = 'id_template';

    public $timestamps = false;

    protected $fillable = [
        'id_template',
        'id_jabatan',
        'id_periode',
        'nama',
        'template'
    ];

    public function template(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class, 'id_periode', 'id_periode');
    }
}
