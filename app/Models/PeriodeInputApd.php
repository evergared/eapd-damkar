<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeInputApd extends Model
{
    protected   $table = 'periode_input_apd',
                $primaryKey = 'id_periode';
    
    protected $timestamps = false;

    protected $fillable = [
        'id_periode',
        'nama_periode',
        'tgl_awal',
        'tgl_akhir',
        'aktif',
        'pesan_berjalan',
        'keterangan'
    ];

    public function template()
    {
        return $this->hasMany(InputApdTemplate::class, 'id_periode', 'id_periode');
    }

    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_periode', 'id_periode');
    }
}
