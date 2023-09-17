<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeluhanKategori extends Model
{
    protected   $table = 'keluhan_kategori',
                $primaryKey = 'id_kategori';

    protected $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'keterangan'
    ];

    public function keluhan()
    {
        return $this->hasMany(Keluhan::class, 'id_kategori', 'id_kategori');
    }
}
