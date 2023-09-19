<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputApdTemplate extends Model
{
    protected   $table = 'input_apd_template',
                $primaryKey = 'id_template';
    
    public $timestamps = false;

    protected $fillable = [
        'id_template',
        'id_jabatan',
        'id_periode',
        'nama',
        'template'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeInputApd::class, 'id_periode', 'id_periode');
    }
}
