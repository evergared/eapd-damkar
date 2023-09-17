<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranPegawai extends Model
{
    protected   $table = 'ukuran_pegawai';

    public $timestamps = false;
    
    protected $fillable = [
        'id_pegawai',
        'id_template',
        'list_ukuran',
        'terakhir_diisi'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function template()
    {
        return $this->belongsTo(InputApdTemplate::class, 'id_template', 'id_template');
    }
}
