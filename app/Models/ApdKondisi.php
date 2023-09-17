<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApdKondisi extends Model
{
    protected   $table = 'apd_kondisi',
                $primaryKey = 'id_kondisi';
    
    public $timestamps = false;

    protected $fillable = [
        'id_kondisi',
        'nama_kondisi',
        'opsi'
    ];

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_kondisi', 'id_kondisi');
    }
}
