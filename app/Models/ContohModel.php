<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ContohEvent;

class ContohModel extends Model
{
    // dapat diisi data dummy oleh factory
    use HasFactory;

    // override tabel yang digunakan model
    protected $table = 'pegawai';

    //override PK yang digunakan oleh model
    protected $primaryKey = "nrk";

    // kolom yang dapat diisi oleh model
    protected $fillable = [
        'nrk',
        'nip',
        'foto',
        'email',
        'telpon'
    ];

    /**
     * override fungsi boot dari modal
     * atur event crud disini
     * hanya dapat ditrigger jika metode model digunakan
     * ref : https://laravel.com/docs/9.x/eloquent#events
     */
    protected static function booted()
    {
        // parent::boot() //<--- gunakan jika booted tidak ter trigger

        static::updated(function ($DataPegawai) {
            event(new ContohEvent($DataPegawai->nrk));
        });
    }
}
