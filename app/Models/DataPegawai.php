<?php

namespace App\Models;

use App\Events\ContohEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\InputDilakukan;

class DataPegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $primaryKey = 'nrk';

    protected $fillable = [
        'nrk',
        'nip',
        'foto',
        'email',
        'telpon'
    ];

    protected static function booted()
    {
        parent::boot();

        static::updated(function ($DataPegawai) {
            // ContohEvent::dispatch($DataPegawai);
            event(new ContohEvent($DataPegawai->nrk));
        });

        static::created(function ($DataPegawai) {
            // ContohEvent::dispatch($DataPegawai);
            event(new ContohEvent($DataPegawai->nrk));
        });
    }
}
