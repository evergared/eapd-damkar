<?php

namespace App\Models\Eapd\Sql;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class InputSewaktuWaktuOngoing extends Model
{
    protected $table = 'input_sewaktu_waktu_ongoing';

    protected $fillable = [
        'id_sewaktu_waktu_apd',
        'cache',
    ];
}
