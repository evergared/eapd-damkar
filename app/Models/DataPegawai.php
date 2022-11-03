<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\InputDilakukan;

class DataPegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nrk',
        'nip',
        'foto',
        'email',
        'telpon'
    ];

    protected static function booted()
    {
        // parent::boot();

        static::updated(function ($callback) {
            error_log('data pegawai is updated!');
            syslog('data pegawai is updated!', $callback);
            event(new InputDilakukan($callback));
        });

        static::updating(function ($callback) {
            error_log('data pegawai is updating!');
            syslog('data pegawai is updating!', $callback);
            // event(new InputDilakukan($callback));
        });
    }
}
