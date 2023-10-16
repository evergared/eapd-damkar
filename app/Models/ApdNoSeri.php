<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApdNoSeri extends Model
{
    protected   $table = 'apd_no_seri',
                $primaryKey = 'id_apd';
    
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_apd',
        'list_no_seri'
    ];

    public function apd()
    {
        $this->belongsTo(ApdList::class, 'id_apd', 'id_apd');
    }

    public function listNoSeri(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
