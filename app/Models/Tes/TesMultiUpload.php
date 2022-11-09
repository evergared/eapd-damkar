<?php

namespace App\Models\Tes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesMultiUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto'
    ];

    protected $cast = [
        'foto' => 'json'
    ];
}
