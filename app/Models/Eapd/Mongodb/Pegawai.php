<?php

namespace App\Models\Eapd\Mongodb;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Throwable;

class Pegawai extends Model
{
    use HasFactory;


    protected $collection = 'pegawai';

    protected $fillable = [
        'nrk',
        'nip',
        'nama',
        'profile_img',
        'no_telp',
        'id_jabatan',
        'id_wilayah',
        'id_penempatan',
        'id_grup',
        'aktif',
        'plt',
        'kurang',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', '_id');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'id_penempatan', '_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', '_id');
    }

    public function grup()
    {
        return $this->belongsTo(Grup::class,'id_grup','id_grup');
    }

    public function getSektorAttribute()
    {
        try{
            /**
             * pisahkan id_penempatan berdasarkan titik
             * contoh : 4.19.01
             * menjadi :
             * - $penempatan[0] = 4
             * - $penempatan[1] = 19
             * - $penempatan[2] = 01
             */
            $penempatan = explode('.',$this->id_penempatan);
            return $penempatan[0] . '.'.$penempatan[1];
        }
        catch(Throwable $e){
            /**
             * Jika struktur id_penempatan berbeda atau jika pemanggilan tidak berhasil,
             * return "-".
             * Gunanya adalah agar komponen lain yang memanggil function ini
             * tau bahwa ada kesalahan atau ada kegagalan saat pemanggilan function
             * karena function mereturn "-"
             * maka dari itu pastikan komponen lain yang memanggil function ini
             * dapat me-mitigasi ketika terjadi kegagalan pemanggilan
             * contohnya melalui if( == "-"), lalu dapat menggantinya dengan value lain.
             */
            return "-";
        }

    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($val) {

        });

        static::updating(function ($val){
            
        });

        static::updated(function ($val) {

        });
    }
}
