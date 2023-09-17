<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdList extends Model
{
    protected   $table = 'apd_list',
                $primaryKey = 'id_apd';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_apd',
        'nama_apd',
        'id_jenis',
        'merk',
        'id_size',
        'id_kondisi',
        'image'
    ];

    public function jenis()
    {
        return $this->belongsTo(ApdJenis::class, 'id_jenis', 'id_jenis');
    }

    public function size()
    {
        return $this->belongsTo(ApdSize::class, 'id_size','id_size');
    }

    public function kondisi()
    {
        return $this->belongsTo(ApdKondisi::class, 'id_kondisi', 'id_kondisi');
    }

    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_apd', 'id_apd');
    }
}
