<?php

namespace App\Http\Controllers;

use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApdTemplate;
use App\Models\Jabatan;
use App\Models\PeriodeInputApd;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Kelas yang mengatur periode input dan template atau acuan input apd di periode tersebut.
 */
class PeriodeInputController extends Controller
{

    /**
     * Bentuk dari data template :
     * - template : data acuan untuk input yang diambil dari database
     * - tabel dataset / dataset : template yang diubah menjadi array biasa
     * - datatabel template : dataset yang bentuknya diubah untuk disajikan dengan tabel html
     * 
     * function terkait : 
     * - muatTemplateSebagaiTabelDatasetArray : template -> dataset
     * - bangunDataTabelTemplateDariDataset : dataset -> datatabel template
     * - ubahDataTabelTemplateKeDataset : datatabel template -> dataset
     * - ubahDatasetArrayTemplateKeTemplate : dataset -> template
     */
    public function ambilIdPeriodeInput($tanggal = null, $rekap = null)
    {
        if ($tanggal == null) {
            if ($rekap)
                $periode = PeriodeInputApd::where("kumpul_rekap", true)->get()->first();
            else
                // ambil periode pertama yang aktif
                $periode = PeriodeInputApd::where("aktif", true)->get()->first();

            if (is_null($periode))
                return null;
        } else
            $periode = PeriodeInputApd::where('tgl_awal', '<=', $tanggal)->where('tgl_akhir', '>=', $tanggal)->get()->first();

        return $periode->id_periode;
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }

    public function ambilIdPeriodeUkuran($tanggal = null, $rekap = null)
    {
        if ($tanggal == null) {
            if ($rekap)
                $periode = PeriodeInputApd::where("kumpul_rekap", true)->get()->first();
            else
                // ambil periode pertama yang aktif
                $periode = PeriodeInputApd::where("kumpul_ukuran", true)->get()->first();

            if (is_null($periode))
                return null;
        } else
            $periode = PeriodeInputApd::where('tgl_awal', '<=', $tanggal)->where('tgl_akhir', '>=', $tanggal)->get()->first();

        return $periode->id_periode;
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }
    
    public function muatTemplateUntukKolomDatatable($template_array)
    {
        try{

            $arranged_array = [];

            foreach($template_array as $item)
            {
                $val_jenis_apd = $item['id_jenis'];
                $val_opsi = $item['opsi_apd'];

                $jenis = ApdJenis::find($val_jenis_apd);

                if(is_null($jenis))
                    continue;

                // cek ada berapa template dengan jenis yang sama
                $col_id_jenis = array_column($template_array, 'id_jenis');
                $count_id_jenis = array_count_values($col_id_jenis);

                $nama_jenis = $jenis->nama_jenis;
            

                // jika jenis ini lebih dari satu di template ini dan opsinya hanya satu,
                // maka buat spt ini : Sepatu Rescue (Heritage)
                if($count_id_jenis[$val_jenis_apd] > 1)
                    if(count($val_opsi) == 1)
                    {
                        $apd = ApdList::find($val_opsi[0]);

                        if(!is_null($apd))
                            $nama_jenis += " (".$apd->nama_apd.")";
                    }

                $opsi = [];

                foreach($val_opsi as $a)
                {
                    $apd = ApdList::find($a);

                    if(!is_null($apd))
                        array_push($opsi, $apd->nama_apd);
                }

                $arranged_array[] = [
                    "jenis" => $nama_jenis,
                    "opsi" => $opsi
                ];

            }

            return $arranged_array;

        }
        catch(Throwable $e)
        {
            error_log($e);
            return null;
        }
    }

    public function buatTemplate(string $id_periode ,string|array $jabatan, string|array $jenis_apd, string|array $opsi_apd, bool $edit = false):bool|array
    {
        // buat template untuk input apd pegawai
        /**
         * new template akan seperti ini :
         * [
         *      ["id_jenis" => "A001", "opsi_apd"=> ["A-ari-0000", "A-ari-0001"]],
         * ]
         */

        $new_template = [];

        if(is_string($jenis_apd))
        {
            if(is_string($opsi_apd))
            {
                $opsi = [$opsi_apd];
            }
            elseif(is_array($opsi_apd))
            {
                $opsi = $opsi_apd;
            }

            $new_template = [
                "id_jenis" => $jenis_apd,
                "opsi_apd" => $opsi
            ];
        }
        elseif(is_array($jenis_apd))
        {
            foreach($jenis_apd as $jenis)
            {
                $opsi = [];
                foreach($opsi_apd as $o)
                {
                    $cek = ApdList::find($o);
                    if(is_null($cek))
                        continue;
                    if($cek->id_jenis != $jenis)
                        continue;
                    $opsi[] = $o;
                }

                $new_template[] = [
                    "id_jenis" => $jenis,
                    "opsi_apd" => $opsi
                ];
            }
        }

        // mulai insert ke database
        if(is_string($jabatan))
        {
            try{

                if($edit)
                {
                    $template = InputApdTemplate::where('id_periode',$id_periode)->where('id_jabatan',$jabatan)->first();
                    if(is_null($template))
                        throw new Exception("Template dengan id periode ".$id_periode." dan jabatan ".$jabatan." tidak ditemukan.");
                }
                else
                {
                    $template = new InputApdTemplate;
                    $template->id_periode = $id_periode;
                    $template->id_jabatan = $jabatan;
                }

                $template->template = $new_template;
                $template->save();
                return true;

            }
            catch(Throwable $e)
            {
                error_log('Gagal insert template untuk satu jabatan '.$jabatan.' '.$e);
                Log::error('Gagal insert template untuk satu jabatan '.$jabatan.' '.$e);
                return false;
            }
        }
        elseif(is_array($jabatan))
        {
            $report = [];

            foreach($jabatan as $j)
            {
                try{

                    if($edit)
                    {
                        $template = InputApdTemplate::where('id_periode',$id_periode)->where('id_jabatan',$jabatan)->first();
                        if(is_null($template))
                            throw new Exception("Template dengan id periode ".$id_periode." dan jabatan ".$jabatan." tidak ditemukan.");
                    }
                    else
                    {
                        $template = new InputApdTemplate;
                        $template->id_periode = $id_periode;
                        $template->id_jabatan = $jabatan;
                    }

                    $template->template = $new_template;
                    $template->save();
                    $report[] = ['jabatan' => $j, 'status' => true];

                }
                catch(Throwable $e)
                {
                    error_log('Gagal insert template untuk banyak jabatan '.$j.' '.$e);
                    Log::error('Gagal insert template untuk banyak jabatan '.$j.' '.$e);
                    $report[] = ['jabatan' => $j, 'status' => false];
                }
            }

            return $report;
            
        }

    }

}
