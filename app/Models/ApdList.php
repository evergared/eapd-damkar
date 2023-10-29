<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApdList extends Model
{
    use SoftDeletes;

    protected   $table = 'apd_list',
                $primaryKey = 'id_apd';
    
    public $timestamps = false;

    protected $dates = ['deleted_at'];
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_apd',
        'nama_apd',
        'id_jenis',
        'merk',
        'id_size',
        'id_kondisi',
        'input_no_seri',
        'strict_no_seri',
        'id_referensi',
        'sumber_id_referensi',
        'image',
        'deleted_at'
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

    public function no_seri()
    {
        return $this->hasOne(ApdNoSeri::class, 'id_apd','id_apd');
    }
}
