<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranPegawai extends Model
{
    protected   $table = 'ukuran_pegawai',
                $primaryKey = "id_pegawai";

    public $timestamps = false;
    
    protected $fillable = [
        'id_pegawai',
        'history',
        'list_ukuran',
        'terakhir_diisi'
    ];

    public function listUkuran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

}
