<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected   $table = 'kecamatan',
                $primaryKey = 'id_kecamatan';
    
    public $timestamps = false;

    protected $keyType = 'string';
   
    protected $fillable = [
        'id_kecamatan',
        'nama_kecamatan',
        'keterangan'
    ];

    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
