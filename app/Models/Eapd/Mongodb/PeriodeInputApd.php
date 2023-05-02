<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class PeriodeInputApd extends Model
{

    protected $collection = "periode_input_apd";

    protected $fillable = [
        'nama_periode',
        'tgl_awal',
        'tgl_akhir',
        'keterangan'
    ];

    protected $casts = [
        'tgl_awal' => 'date',
        'tgl_akhir' => 'date'
    ];

    public function getTglAwalAttribute($value)
    {
        return Carbon::parse($value,"Asia/Jakarta")->toDateString();
    }

    public function setTglAwalAttribute($value)
    {
        $this->attributes["tgl_awal"] = Carbon::parse($value,"Asia/Jakarta")->toDateString();
    }

    public function getTglAkhirAttribute($value)
    {
        return Carbon::parse($value,"Asia/Jakarta")->toDateString();
    }

    public function setTglAkhirAttribute($value)
    {
        $this->attributes["tgl_akhir"] = Carbon::parse($value,"Asia/Jakarta")->toDateString();
    }


    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_periode', '_id');
    }

    public function template()
    {
        return $this->hasOne(InputApdTemplate::class,'id_periode','_id');
    }
}
