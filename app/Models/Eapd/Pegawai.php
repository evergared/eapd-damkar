<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Throwable;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

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
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'id_penempatan', 'id_penempatan');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah');
    }

    public function grup()
    {
        return $this->belongsTo(Grup::class,'id_grup','id_grup');
    }

    public function apd_terinput()
    {
        return $this->hasMany(InputApd::class, 'nrk', 'nrk');
    }

    public function apd_terlapor()
    {
        return $this->hasMany(InputSewaktuWaktu::class, 'nrk', 'nrk');
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

        static::creating(function ($Pegawai) {
            $Pegawai->{$Pegawai->getKeyName()} = (string) Str::uuid();
        });

        static::updating(function ($Pegawai){
            error_log('updating pegawai');

            // kendala : belum bisa dapat id dari data yang diinput
            
            // // cek apakah ada data dengan id data yg dirubah di tabel history
            // if($data = HistoryTabelPegawai::find($Pegawai->id))
            // {
            //     // jika ada, cek apakah para admin telah melihat perubahan sebelumnya

            //     // jika sudah dilihat oleh para admin
            //     if($data->dilihat_admin_sektor && $data->dilihat_admin_sudin && $data->dilihat_admin_dinas)
            //     {
            //         // ambil data original
            //         $data_original = $Pegawai->getOriginal();

            //         // ambil data yang diubah
            //         $data_dirty = $Pegawai->getDirty();

            //         // simpan data ke tabel history
            //         $data->data_sebelumnya = $data_original;
            //         $data->data_perubahan = $data_dirty;

            //         // reset semua flag
            //         $data->dilihat_admin_sektor = false;
            //         $data->dilihat_admin_sudin = false;
            //         $data->dilihat_admin_dinas = false;

            //         // eloquent save
            //         $data->save();
            //     }
            //     // jika para admin ada yang belum lihat
            //     else
            //     {
            //         // ambil data yang diubah
            //         $data_dirty = $Pegawai->getDirty();

            //         // simpan ke tabel history
            //         $data->data_perubahan = $data_dirty;

            //         // eloquent save
            //         $data->save();
            //     }
            // }
            // // jika tidak ada data tersebut di tabel history
            // else
            // {
            //     error_log('pegawai id : '.$Pegawai->getOriginal('id'));
            //     $data_original = $Pegawai->getOriginal();

            //     $data_dirty = $Pegawai->getDirty();

            //     $history = new HistoryTabelPegawai;

            //     $history->id = $Pegawai->getOriginal('id');
            //     // $history->data_sebelumnya = $data_original;
            //     // $history->data_perubahan = $data_dirty;

            //     $history->save();
            // }
        });

        static::updated(function ($Pegawai) {
            error_log('updated pegawai');

            // kirim event untuk notifikasi disini
        });
    }
}
