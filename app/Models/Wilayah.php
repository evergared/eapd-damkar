<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected   $table = 'wilayah',
                $primaryKey = 'id_wilayah';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_wilayah',
        'nama_wilayah',
        'keterangan'
    ];

    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'id_wilayah', 'id_wilayah');
    }
}
