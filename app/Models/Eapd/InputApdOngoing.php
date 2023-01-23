<?php

namespace App\Models\Eapd;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class InputApdOngoing extends Model
{
    protected $table = 'input_apd_ongoing';

    protected $fillable = [
        'id_input_apd',
        'cache',
    ];
}
