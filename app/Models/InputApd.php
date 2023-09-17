<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class InputApd extends Model
{
    use HasUlids;

    protected   $table = 'input_apd',
                $primaryKey = 'id_inputan';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_inputan',
        'id_pegawai',
        'id_jenis',
        'id_apd',
        'size',
        'kondisi',
        'image',
        'komentar_pengupload',
        'data_diupdate',
        'verifikasi_oleh',
        'jabatan_verifikator',
        'verifikasi_status',
        'komentar_verifikator',
        'terakhir_verifikasi'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function jenis_apd()
    {
        return $this->belongsTo(ApdJenis::class, 'id_jenis', 'id_jenis');
    }

    public function apd()
    {
        return $this->belongsTo(ApdList::class, 'id_apd', 'id_apd');
    }
}
