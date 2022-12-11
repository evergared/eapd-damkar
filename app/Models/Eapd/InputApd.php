<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InputApd extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = "input_apd";
    protected $keyType = 'string';

    // butuh kolom status verified? boolean atau enum?
    protected $fillable = [
        "nrk",
        "id_apd",
        "size",
        "status_barang",
        "kondisi",
        "image",
        "keterangan",
        "id_periode",
        "verified_by",
    ];

    public function nrk()
    {
        return $this->belongsTo(Pegawai::class, 'nrk', 'nrk');
    }

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_apd', 'id_apd');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class, 'id_periode', 'id_periode');
    }

    // trigger
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($InputApd) {
            $InputApd->{$InputApd->getKeyName()} = (string) Str::uuid();
        });

        static::updated(function ($InputApd) {
            // event
        });
    }
}
