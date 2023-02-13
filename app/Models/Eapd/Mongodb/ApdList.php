<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class ApdList extends Model
{

    protected $collection = "apd_list";

    protected $fillable = [
        '_id',
        'nama_apd',
        'merk',
        'id_jenis',
        'id_size',
        'id_kondisi',
        'id_periode',
        'image',
        'ingub',
        'keterangan',
    ];

    protected $casts = [
        'ingub' => 'boolean'
    ];

    // relationship
    public function jenis()
    {
        return $this->belongsTo(ApdJenis::class,'id_jenis', '_id');
    }

    public function size()
    {
        return $this->belongsTo(ApdSize::class,'id_size', '_id');
    }

    public function kondisi()
    {
        return $this->belongsTo(ApdKondisi::class,'id_kondisi', '_id');
    }
}
