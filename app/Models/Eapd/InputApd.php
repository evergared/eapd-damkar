<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class InputApd extends Model
{
    use HasFactory, Notifiable;

    public $incrementing = false;
    protected $table = "input_apd";
    protected $keyType = 'string';

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
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
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
