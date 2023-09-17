<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected   $table = 'kelurahan',
                $primaryKey = 'id_kelurahan';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_kelurahan',
        'nama_kelurahan',
        'keterangan'
    ];

    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'id_kelurahan', 'id_kelurahan');
    }

}
