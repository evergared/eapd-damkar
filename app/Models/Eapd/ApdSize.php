<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdSize extends Model
{
    use HasFactory;

    protected $table = "apd_size";

    protected $fillable = [
        'id_size',
        'nama_size',
        'opsi',
        'keterangan'
    ];


    public function apd()
    {
        $this->hasMany(ApdList::class, 'id_size', 'id_size');
    }
}
