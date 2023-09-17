<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApdSize extends Model
{
    protected   $table = 'apd_size',
                $primaryKey = 'id_size';
    
    public $timestamps = false;

    protected $fillable = [
        'id_size',
        'nama_size',
        'opsi'
    ];

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_size', 'id_size');
    }
}
