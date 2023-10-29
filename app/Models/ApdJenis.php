<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApdJenis extends Model
{
    use SoftDeletes;
    protected   $table = 'apd_jenis',
                $primaryKey = 'id_jenis';
    
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_jenis',
        'nama_jenis',
        'deleted_at'
    ];

    public function inputApd()
    {
        return $this->hasMany(InputApd::class, 'id_jenis', 'id_jenis');
    }

    public function apd()
    {
        return $this->hasMany(ApdList::class, 'id_jenis', 'id_jenis');
    }
}
