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

    public function sektor()
    {
        $sektor = Penempatan::find($this->data->id_penempatan);

        if($sektor->keterangan == "sektor")
            return $sektor->id_penempatan;
        
        if($sektor->keterangan == "pos")
            return $sektor->id_parent_penempatan;
        
        return null;
    }
}
