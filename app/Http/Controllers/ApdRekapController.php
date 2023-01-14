<?php

namespace App\Http\Controllers;

use App\Enum\StatusApd;
use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\InputApd;
use App\Models\Eapd\Pegawai;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Kontroller yang mengatur penyajian data rekap pegawai
 */
class ApdRekapController extends Controller
{
    public function bangunDataTabelRekapApdSektor($id_periode = 1, $sektor = "")
    {
        if($sektor == "")
            $sektor = Auth::user()->data->sektor;
        
        try{

            $data_rekap_apd = collect();

            if($semua_inputan = InputApd::where('id_periode','=',$id_periode)->get())
            {
                $inputan_anggota = $semua_inputan->filter(function($value,$key) use($sektor){
                    $a = Pegawai::where('id','=',$value['id_pegawai'])->first();

                    return $a->sektor == $sektor;
                });

                $list_jenis_apd = $inputan_anggota->unique('id_jenis');

                foreach($list_jenis_apd as $apd)
                {
                    $nama_jenis_apd = ApdJenis::where('id_jenis','=',$apd->id_jenis)->first()->nama_jenis;

                    $baik = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::baik())->count();
                    $rusak_ringan = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakRingan())->count();
                    $rusak_sedang = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakSedang())->count();
                    $rusak_berat = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakBerat())->count();
                    $belum_terima = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::belumTerima())->count();
                    $hilang = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::hilang())->count();
                    $total = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->count();

                    $data_rekap_apd->push([
                        "id_jenis" => $apd->id_jenis,
                        "jenis_apd" => $nama_jenis_apd,
                        "baik" => $baik,
                        "rusak_ringan" => $rusak_ringan,
                        "rusak_sedang" => $rusak_sedang,
                        "rusak_berat" => $rusak_berat,
                        "belum_terima" => $belum_terima,
                        "hilang" => $hilang,
                        "total" => $total
                    ]);
                }
            }

            return $data_rekap_apd;

        }
        catch(Throwable $e)
        {
            error_log("gagal membangun data tabel rekap tingkat sektor ".$e);
        }
    }

    public function bangunListDetailRekapApdSektor($id_jenis, $id_periode = 1, $sektor = "", $target_status = null)
    {
        if($sektor == "")
            $sektor = Auth::user()->data->sektor;
        
        try
        {
            $detail_rekap_apd = collect();

            if($semua_inputan = InputApd::where('id_jenis','=',$id_jenis)->where('id_periode','=',$id_periode)->get())
            {
                $inputan_anggota = $semua_inputan->filter(function($value,$key) use($sektor){
                    $a = Pegawai::where('id','=',$value['id_pegawai'])->first();

                    return $a->sektor == $sektor;
                });

                foreach($inputan_anggota as $inputan)
                {
                    if(is_null($target_status))
                    {
                        $detail_rekap_apd->push($inputan);
                    }
                    else
                    {
                        if($inputan->kondisi == $target_status)
                        {
                            $detail_rekap_apd->push($inputan);
                        }
                    }
                }
            }

            return $detail_rekap_apd;

        }
        catch(Throwable $e)
        {
            error_log("gagal membangun data detail rekap tingkat sektor ".$e);
        }
    }
}