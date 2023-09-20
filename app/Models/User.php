<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected   $table = 'user',
                $primaryKey = 'id_pegawai';

    public $timestamps = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_pegawai',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function data()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
