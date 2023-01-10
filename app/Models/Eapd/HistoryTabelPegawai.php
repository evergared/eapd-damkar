<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HistoryTabelPegawai extends Model
{
    // kemungkinan tabel ini tidak terpakai

    use Notifiable;
    
    protected $table = "history_tabel_pegawai";

    protected $fillable = [
        'id_pegawai',
        'sebelumnya',
        'perubahan',
        'komentar_perubahan',
        'id_pengubah',
        'dilihat_admin_sektor',
        'dilihat_admin_sudin',
        'dilihat_admin_dinas'
    ];

    public function sebelumnya():Attribute
    {
        return Attribute::make(
            get : fn($value) => json_decode($value,true),
            set : fn($value) => json_encode($value)
        );
    }

    public function perubahan():Attribute
    {
        return Attribute::make(
            get : fn($value) => json_decode($value,true),
            set : fn($value) => json_encode($value)
        );
    }

    protected static function booted()
    {
        parent::boot();

        static::created(function ($val){

        });

        static::updated(function($val){

        });

    }
}
