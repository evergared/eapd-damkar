<?php

namespace App\Http\Controllers;

use App\Enum\KeberadaanApd;
use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Models\Admin;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\InputApdTemplate;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Kontroller yang mengatur penyajian data rekap pegawai
 */
class ApdRekapController extends Controller
{

    public function bangunDataTabelRekapPenempatan($id_wilayah, $id_penempatan, $id_periode = null)
    {
        try
        {
            // query semua pegawai
            $list_pegawai = Pegawai::
            join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')
            ->where('pegawai.aktif',true)
            ->where('pegawai.kalkulasi',true);
            
            if($id_wilayah != "semua")
            {
                $list_pegawai = $list_pegawai->where('penempatan.id_wilayah',$id_wilayah);
            }

            if($id_penempatan != "semua")
            {
                $list_pegawai = $list_pegawai->where('pegawai.id_penempatan','like',$id_penempatan.'%');
            }

            return $this->rekap($list_pegawai,$id_periode);
            
        }
        catch(Throwable $e)
        {
            error_log('gagal membuat datatable rekap admin '.$e);
            return false;
        }
    }

    public function rekap(Builder $query_pegawai, $id_periode = null)
    {
        try{

            // pengecekan id periode
            if(is_null($id_periode))
            {
                $pic = new PeriodeInputController;
                $id_periode = $pic->ambilIdPeriodeInput();
            }
            else{

                $cek = PeriodeInputApd::find($id_periode);

                if(is_null($cek))
                    throw new Exception("Id periode ".$id_periode."tidak ditemukan!");
            }

            // memuat queri pegawai yang diberikan
            $list_pegawai = $query_pegawai->get()->toArray();

            $data_rekap = [];

            // ambil semua inputan yang sudah di verifikasi dari db
            $semua_inputan = InputApd::where('id_periode',$id_periode)->where('verifikasi_status','3')->get();


            // filter data tsb berdasarkan list pegawai
            $inputan_anggota = $semua_inputan->filter(function($value,$key) use($list_pegawai){

                $test = in_array($value['id_pegawai'],array_column($list_pegawai,'id_pegawai'));
                if($test)
                    return true;
                else
                    return false;
            });

            // ambil semua jenis apd yang sudah diinput pada periode ini
            $list_jenis_apd = $inputan_anggota->unique('keterangan_jenis_apd_template');
            
            
            // pengulangan untuk ambil rangkuman data berdasarkan list jenis apd yang telah diambil
            foreach($list_jenis_apd as $apd)
            {

                // nama_jenis_apd adalah nama yang akan ditampilkan pada tabel rekap di view kendaliRekapitulasi
                $nama_jenis_apd = $apd->keterangan_jenis_apd_template;
                    
                $baik = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',StatusApd::baik()->value)->count();
                $rusak_ringan = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',StatusApd::rusakRingan()->value)->count();
                $rusak_sedang = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',StatusApd::rusakSedang()->value)->count();
                $rusak_berat = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',StatusApd::rusakBerat()->value)->count();
                $belum_terima = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',KeberadaanApd::belumTerima()->value)->count();
                $hilang = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','=',KeberadaanApd::hilang()->value)->count();
                $ada = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->where('kondisi','!=',KeberadaanApd::hilang()->value)->where('kondisi','!=',KeberadaanApd::belumTerima()->value)->count();
                $total = $inputan_anggota->where('keterangan_jenis_apd_template','=',$nama_jenis_apd)->count();

                // id_jenis untuk value wire:click pada view kendaliRekapitulasi, berfungsi sebagai referensi untuk TabelDetailRekap
                array_push($data_rekap,[
                    //"id_jenis" => $apd->id_jenis,
                    "id_jenis" => $nama_jenis_apd,
                    "jenis_apd" => $nama_jenis_apd,
                    "baik" => $baik,
                    "rusak_ringan" => $rusak_ringan,
                    "rusak_sedang" => $rusak_sedang,
                    "rusak_berat" => $rusak_berat,
                    "belum_terima" => $belum_terima,
                    "hilang" => $hilang,
                    "ada" => $ada,
                    "total" => $total,
                ]);
            }

            return $data_rekap;
        }
        catch(Throwable $e)
        {
            // ambil waktu saat ini untuk dijadikan referensi 
            $time = now();
            error_log("ApdRekapController error (".$time.") : Terjadi kesalahan saat merekap ".$e);
            Log::error("ApdRekapController error (".$time.") : Terjadi kesalahan saat merekap ".$e);
            return false;
        }
    }

    public function renameJenisDuplikat($id_jenis, string|array $opsi_apd)
    {
        $apd = null;

        if(is_array($opsi_apd))
            $apd = ApdList::where('id_apd',$opsi_apd[0])->first()->nama_apd;
        else
            $apd = ApdList::where('id_apd',$opsi_apd)->first()->nama_apd;

        $nama = ApdJenis::where('id_jenis',$id_jenis)->first()->nama_jenis;

        $nama = $nama ." (".$apd.")";

        return $nama;
    }
}