<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasUlids;

    protected   $table = 'pegawai',
                $primaryKey = 'id_pegawai';
    
    protected $fillable = [
        'nip',
        'nrk',
        'nama',
        'id_penempatan',
        'id_jabatan',
        'profile_img',
        'no_telp',
        'email',
        'grup',
        'aktif'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id_pegawai','id_pegawai');
    }

    public function ukuran_pegawai()
    {
        return $this->hasMany(UkuranPegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_pegawai', 'id_pegawai');
    }

    public function keluhan_dilaporkan()
    {
        return $this->hasMany(Keluhan::class, 'id_pegawai_pelapor', 'id_pegawai');
    }

    public function keluhan_dikirim()
    {
        return $this->hasMany(Keluhan::class, 'id_pegawai_pengirim', 'id_pegawai');
    }

    public function keluhan_diterima()
    {
        return $this->hasMany(Keluhan::class, 'id_pegawai_penerima', 'id_pegawai');
    }

    public function keluhan_dibalas()
    {
        return $this->hasMany(KeluhanReply::class, 'id_pegawai', 'id_pegawai');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'id_penempatan', 'id_penempatan');
    }
}
