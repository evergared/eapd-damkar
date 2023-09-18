<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected   $table = 'admin';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_akun',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
