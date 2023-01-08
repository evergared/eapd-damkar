<?php

namespace App\Models\Eapd;

use App\Enum\LevelUser;
use App\Enum\TipeJabatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class Pegawai extends Model
{
    use HasFactory;

    public $incrementing = false;

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

        static::creating(function ($val) {
            $val->{$val->getKeyName()} = (string) Str::uuid();
        });

        static::updating(function ($val){
            error_log('updating pegawai');

            try{
                // cek apakah nrk yang diganti sama dengan nrk user saat ini
                if($val->nrk == Auth::user()->nrk)
                {
                    // jika ya, maka tidak perlu dimasukan ke tabel history
                    // karena biasanya pada case ini,
                    // user meng-update data pegawai melalui menu profil
                    // dan dimenu profil tidak ada data data penting yang dapat diubah 
                }
                else
                {
                    // cek apakah data tersebut ada di tabel history
                    if($data = HistoryTabelPegawai::find($val->{$val->getKeyName()}))
                    {
                        // jika ada, cek apakah para admin telah melihat perubahan sebelumnya

                        // jika sudah dilihat oleh para admin
                        if($data->dilihat_admin_sektor && $data->dilihat_admin_sudin && $data->dilihat_admin_dinas)
                        {
                            // ambil data original
                            $data_original = $val->getOriginal();

                            // ambil data yang diubah
                            $data_dirty = $val;

                            // simpan data ke tabel history
                            $data->sebelumnya = $data_original;
                            $data->perubahan = $data_dirty;

                            // reset semua flag
                            $data->dilihat_admin_sektor = false;
                            $data->dilihat_admin_sudin = false;
                            $data->dilihat_admin_dinas = false;

                            // flag admin yang mengubah
                            switch(Auth::user()->data->jabatan->level_user)
                            {
                                case LevelUser::adminSektor()->value: $data->dilihat_admin_sektor = true; break;
                                case LevelUser::adminSudin()->value: $data->dilihat_admin_sudin = true; break;
                                case LevelUser::adminDinas()->value: $data->dilihat_admin_dinas = true; break;
                                default: break;
                            }

                            // eloquent save
                            $data->save();
                            error_log('sukses qq');
                        }
                        // jika para admin ada yang belum lihat
                        else
                        {
                            // ambil data yang diubah
                            $data_dirty = $val;

                            // simpan ke tabel history
                            $data->perubahan = $data_dirty;

                            // reset semua flag
                            $data->dilihat_admin_sektor = false;
                            $data->dilihat_admin_sudin = false;
                            $data->dilihat_admin_dinas = false;

                            // flag admin yang mengubah
                            switch(Auth::user()->data->jabatan->level_user)
                            {
                                case LevelUser::adminSektor()->value: $data->dilihat_admin_sektor = true; break;
                                case LevelUser::adminSudin()->value: $data->dilihat_admin_sudin = true; break;
                                case LevelUser::adminDinas()->value: $data->dilihat_admin_dinas = true; break;
                                default: break;
                            }

                            // eloquent save
                            $data->save();
                            error_log('sukses');
                        }
                    }
                    // jika tidak ada data tersebut di tabel history
                    else
                    {
                        error_log('pegawai id : '.$val->{$val->getKeyName()});
                        $data_original = $val->getOriginal();

                        $data_dirty = $val;
                        

                        HistoryTabelPegawai::create([
                            'id' => $val->{$val->getKeyName()},
                            'sebelumnya' => $data_original,
                            'perubahan' => $data_dirty,
                            'nrk_pengubah' => Auth::user()->nrk
                        ]);
                    }
                }
            }
            catch(Throwable $e)
            {
                error_log('Kesalahan saat merekam perubahan ke tabel history data pegawai '.$e);
            }

            

            // kendala : belum bisa dapat id dari data yang diinput
            
            
        });

        static::updated(function ($val) {
            error_log('updated pegawai');

            // kirim event untuk notifikasi disini
        });
    }


    // function-function non model

    function resetFlagAdmin($eloquent)
    {
        $eloquent->dilihat_admin_sektor = false;
        $eloquent->dilihat_admin_sudin = false;
        $eloquent->dilihat_admin_dinas = false;
    }

    function gantiFlagAdminYangMerubah($eloquent)
    {
        switch(Auth::user()->data->jabatan->level_user)
        {
            case LevelUser::adminSektor()->value: $eloquent->dilihat_admin_sektor = true; break;
            case LevelUser::adminSudin(): $eloquent->dilihat_admin_sudin = true; break;
            case LevelUser::adminDinas(): $eloquent->dilihat_admin_dinas = true; break;
            default: break;
        }
    }
}
