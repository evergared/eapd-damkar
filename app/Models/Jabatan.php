<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;

    protected   $table = 'jabatan',
                $primaryKey = 'id_jabatan';
    
    public $timestamps = false;

    protected $dates = ['deleted_at'];
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_jabatan',
        'nama_jabatan',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }

    public function template()
    {
        return $this->hasMany(InputApdTemplate::class, 'id_jabatan', 'id_jabatan');
    }

}
