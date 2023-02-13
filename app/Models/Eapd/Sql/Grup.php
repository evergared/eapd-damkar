<?php

namespace App\Models\Eapd\Sql;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $table = "grup";

    protected $fillable = [
        'id_grup',
        'nama_grup',
        'keterangan'
    ];

    public function anggota()
    {
        return $this->hasMany(Pegawai::class, 'id_grup', 'id_grup');
    }
}
