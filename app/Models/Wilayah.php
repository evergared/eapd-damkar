<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected   $table = 'wilayah',
        $primaryKey = 'id_wilayah';

    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_wilayah',
        'nama_wilayah',
        'nama_print',
        'keterangan'
    ];

    public function penempatan()
    {
        return $this->hasMany(Penempatan::class, 'id_wilayah', 'id_wilayah');
    }
}
