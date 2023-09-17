<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected   $table = 'jabatan',
                $primaryKey = 'id_jabatan';
    
    protected $timestamps = false;

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
