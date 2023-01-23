<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

use function PHPUnit\Framework\assertJson;

class ApdKondisi extends Model
{
    use HasFactory;

    protected $table = "apd_kondisi";

    protected $fillable = [
        'nama_kondisi',
        'opsi',
        'keterangan'
    ];

    public function opsi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }


    public function apd()
    {
        $this->hasMany(ApdList::class, 'id_kondisi', 'id');
    }
}
