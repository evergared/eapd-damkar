<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdJenis extends Model
{
    protected   $table = 'apd_jenis',
                $primaryKey = 'id_jenis';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_jenis',
        'nama_jenis'
    ];

    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_jenis', 'id_jenis');
    }

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_jenis', 'id_jenis');
    }
}
