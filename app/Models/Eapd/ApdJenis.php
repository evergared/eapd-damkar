<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdJenis extends Model
{
    use HasFactory;

    protected $table = "apd_jenis";

    protected $fillable = [
        'id_jenis',
        'nama_jenis',
        'keterangan'
    ];

    public function apd()
    {
        $this->hasMany(ApdList::class, 'id_jenis', 'id_jenis');
    }
}
