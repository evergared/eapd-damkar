<?php

namespace App\Models\Eapd\Sql;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class InputSewaktuWaktu extends Model
{
    use HasFactory;

    protected $table = 'input_sewaktu_waktu';

    // butuh kolom status verified? boolean atau enum?
    protected $fillable = [
        "id_pegawai",
        "id_apd",
        "size",
        "status_barang",
        "kondisi",
        "image",
        "kebutuhan",
        "keterangan",
        "verified_by",
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id');
    }

    public function apd()
    {
        return $this->hasMany(ApdList::class);
    }

    // trigger
    protected static function booted()
    {
        static::updated(function ($InputApd) {
            // event
        });
    }
}
