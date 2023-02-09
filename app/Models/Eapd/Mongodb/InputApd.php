<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class InputApd extends Model
{
    use  Notifiable;

    protected $collection = "input_apd";

    protected $fillable = [
        "id_pegawai",
        "id_apd",
        "size",
        "status_barang",
        "kondisi",
        "image",
        "keterangan",
        "id_periode",
        "verifikasi_oleh",
        "verifikasi_status",
        "komentar_verifikator"
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', '_id');
    }

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_apd', '_id');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class, 'id_periode', '_id');
    }

    // trigger
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($InputApd) {
            
        });

        static::updated(function ($InputApd) {
            // event
        });
    }
}
