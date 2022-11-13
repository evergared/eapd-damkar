<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdList extends Model
{
    use HasFactory;

    protected $table = "apd_list";

    protected $fillable = [
        'id_apd',
        'nama_apd',
        'merk',
        'id_jenis',
        'id_size',
        'id_kondisi',
        'id_periode',
        'image',
        'ingub',
        'keterangan',
    ];

    protected $casts = [
        'ingub' => 'boolean'
    ];

    // relationship
    public function jenis()
    {
        return $this->belongsTo(ApdJenis::class, 'id_jenis', 'id_jenis');
    }

    public function size()
    {
        return $this->belongsTo(ApdSize::class, 'id_size', 'id_size');
    }

    public function kondisi()
    {
        return $this->belongsTo(ApdKondisi::class, 'id_kondisi', 'id_kondisi');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class, 'id_kondisi', 'id_kondisi');
    }
}
