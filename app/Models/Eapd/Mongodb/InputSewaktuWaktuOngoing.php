<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class InputSewaktuWaktuOngoing extends Model
{
    protected $collection = 'input_sewaktu_waktu_ongoing';
    protected $primaryKey = 'id_sewaktu_waktu_apd';

    protected $fillable = [
        'id_sewaktu_waktu_apd',
        'cache',
    ];
}
