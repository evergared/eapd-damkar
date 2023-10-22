<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputApdReupload extends Model
{
    use HasUlids;

    protected   $table = 'input_apd_reupload',
                $primaryKey = 'id_reupload';

    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id_inputan',
        'id_apd',
        'size',
        'kondisi',
        'image',
        'komentar_pengupload',
        'data_diupdate',
        'terima',
        'selesai',
    ];

    public function inputan()
    {
        return $this->belongsTo(InputApd::class, 'id_inputan', 'id_inputan');
    }

    public function apd()
    {
        return $this->belongsTo(ApdList::class, 'id_apd', 'id_apd');
    }
}
