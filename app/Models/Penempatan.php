<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penempatan extends Model
{
    use SoftDeletes;

    protected   $table = 'penempatan',
                $primaryKey = 'id_penempatan';
    
    public $timestamps = false;

    protected $dates = ['deleted_at'];
    protected $keyType = 'string';

    protected $fillable = [
        'id_penempatan',
        'id_parent_penempatan',
        'nama_penempatan',
        'id_kelurahan',
        'id_kecamatan',
        'id_wilayah',
        'tipe',
        'keterangan'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_penempatan', 'id_penempatan');
    }

    public function adminList()
    {
        return $this->hasMany(AdminList::class, 'id_penempatan', 'id_penempatan');
    }

    public function atasan()
    {
        return $this->belongsTo($this, 'id_parent_penempatan', 'id_penempatan');
    }

    public function bawahan()
    {
        return $this->hasMany($this, 'id_parent_penempatan', 'id_penempatan');
    }
}
