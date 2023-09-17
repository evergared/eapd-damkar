<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected   $table = 'admin',
                $primaryKey = 'id_admin';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function data()
    {
        return $this->belongsTo(AdminList::class, 'id_admin', 'id_admin');
    }
}
