<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected   $table = 'admin',
                $guard = 'admin',
                $primaryKey = 'id';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_akun',
        'id_pegawai',
        'id_pegawai_plt',
        'id_penempatan',
        'tipe',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function data()
    {
        if(is_null($this->id_pegawai))
            return $this->belongsTo(Pegawai::class, 'id_pegawai_plt', 'id_pegawai');
        else
            return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function plt()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_plt', 'id_pegawai');
    }
}
