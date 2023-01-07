<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTabelPegawai extends Model
{
    // kemungkinan tabel ini tidak terpakai
    
    protected $table = "history_tabel_pegawai";

    protected $fillable = [
        'id',
        'data_sebelumnya',
        'data_perubahan',
        'komentar_perubahan',
        'nrk_pengubah',
        'dilihat_admin_sektor',
        'dilihat_admin_sudin',
        'dilihat_admin_dinas'
    ];

    public function data_sebelumnya():Attribute
    {
        return Attribute::make(
            get : fn($value) => json_decode($value,true),
            set : fn($value) => json_encode($value)
        );
    }

    public function data_perubahan():Attribute
    {
        return Attribute::make(
            get : fn($value) => json_decode($value,true),
            set : fn($value) => json_encode($value)
        );
    }
}
