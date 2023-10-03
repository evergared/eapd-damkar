<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminList extends Model
{
    protected   $table = 'admin_list',
                $primaryKey = 'id_admin';

    public $timestamps = false;
    
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_admin',
        'nama_akun',
        'id_pegawai',
        'id_pegawai_plt',
        'id_penempatan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function pegawai_plt()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_plt', 'id_pegawai');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'id_penempatan', 'id_penempatan');
    }
}