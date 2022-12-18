<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class InputApdTemplate extends Model
{
    use HasFactory;

    protected $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'input_apd_template';

    // trigger
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($InputApdTemplate) {
            $InputApdTemplate->{$InputApdTemplate->getKeyName()} = (string) Str::uuid();
        });

        static::updated(function ($InputApdtemplate) {
            // event
        });
    }
}
