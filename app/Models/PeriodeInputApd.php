<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeInputApd extends Model
{
    use SoftDeletes;

    protected   $table = 'periode_input_apd',
                $primaryKey = 'id_periode';
    
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_periode',
        'nama_periode',
        'tgl_awal',
        'tgl_akhir',
        'aktif',
        'kumpul_rekap',
        'kumpul_ukuran',
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
