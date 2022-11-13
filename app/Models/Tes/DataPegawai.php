<?php

namespace App\Models\Tes;

use App\Events\ContohEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\InputDilakukan;

class DataPegawai extends Model
{
    use HasFactory;

    protected $table = 'tes_pegawai';


    protected $fillable = [
        'nrk',
        'nip',
        'foto',
        'email',
        'no_telp'
    ];

    protected static function booted()
    {
        parent::boot();

        static::updated(function ($DataPegawai) {
            error_log("TEst : " . $DataPegawai->nrk);
            // ContohEvent::dispatch($DataPegawai);
            event(new ContohEvent("test"));
        });

        static::created(function ($DataPegawai) {
            // ContohEvent::dispatch($DataPegawai);
            event(new ContohEvent($DataPegawai->nrk));
        });
    }
}
