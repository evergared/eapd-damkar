<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class KeluhanReply extends Model
{
    use HasUlids;

    protected   $table = 'keluhan_reply',
                $primaryKey = 'id_reply';
    
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_reply',
        'id_parent_reply',
        'id_keluhan',
        'id_pegawai',
        'isi',
        'image',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'id_keluhan', 'id_keluhan');
    }

    public function replies()
    {
        return $this->hasMany($this, 'id_parent_reply', 'id_reply');
    }

    public function parent_reply()
    {
        return $this->belongsTo($this, 'id_parent_reply', 'id_reply');
    }
}
