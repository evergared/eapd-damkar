<?php

namespace App\Models\Eapd\Sql;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class PeriodeInputApd extends Model
{
    use HasFactory;

    protected $table = "periode_input_apd";

    protected $fillable = [
        'nama_periode',
        'tgl_awal',
        'tgl_akhir',
        'keterangan'
    ];

    protected $casts = [
        'tgl_awal' => 'date',
        'tgl_akhir' => 'date'
    ];

    public function input_apd()
    {
        return $this->hasMany(InputApd::class, 'id_periode', 'id_periode');
    }

    public function template()
    {
        return $this->belongsToMany(InputApdTemplate::class, 'pivot_input_apd_template');
    }
}
