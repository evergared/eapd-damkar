<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasUlids;

    protected   $table = "keluhan",
                $primaryKey = 'id_keluhan';

    protected $fillable = [
        'id_keluhan',
        'id_kategori',
        'id_pegawai_pelapor',
        'id_pegawai_pengirim',
        'id_pegawai_penerima',
        'perihal',
        'isi',
        'image',
        'flag_pelapor',
        'flag_penerima'
    ];

    public function kategori()
    {
        return $this->belongsTo(KeluhanKategori::class, 'id_kategori', 'id_kategori');
    }

    public function reply()
    {
        return $this->hasMany(KeluhanReply::class, 'id_keluhan', 'id_keluhan');
    }

    public function pelapor()
    {
        return $this->belongsTo(Pegawai::class, 'id_pagawai_pelapor', 'id_pegawai');
    }

    public function pengirim()
    {
        return $this->belongsTo(Pegawai::class, 'id_pagawai_pengirim', 'id_pegawai');
    }

    public function penerima()
    {
        return $this->belongsTo(Pegawai::class, 'id_pagawai_penerima', 'id_pegawai');
    }
}
