<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nrk',
        'nip',
        'nama',
        'profile_img',
        'no_telp',
        'id_jabatan',
        'id_wilayah',
        'id_penempatan',
        'id_grup',
        'aktif',
        'plt',
        'kurang',
    ];

    public function apd_terinput()
    {
        return $this->hasMany(InputApd::class, 'nrk', 'nrk');
    }

    public function apd_terlapor()
    {
        return $this->hasMany(InputSewaktuWaktu::class, 'nrk', 'nrk');
    }
}
