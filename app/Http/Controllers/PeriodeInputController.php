<?php

namespace App\Http\Controllers;

use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\InputApdTemplate;
use App\Models\Eapd\Mongodb\Jabatan;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    public function ambilIdPeriodeInput($tanggal = null)
    {
        if($tanggal == null)
            {
                // ambil periode pertama yang aktif
                return PeriodeInputApd::where("aktif",true)->get()->first()->id;
            }
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }

        /**
     * Memuat template input dari database ke bentuk array yang dapat ditampilkan pada tabel biasa (tabel html)
     * @param string|int $id_periode id dari periode input apd, akan digunakan untuk mengambil data template dari database
     */
    public function muatTemplateSebagaiTabelDatasetArray($id_periode)
    {
        try{

            $data_template = InputApdTemplate::where("id_periode",$id_periode)->get()->first()->template;

            $dataset = [];

        // contoh : 
        //     [0] => Array
        // (
        //     [id_jabatan] => L001
        //     [id_jenis] => H002
        //     [id_apd] => H-fir-0001
        // )

            foreach($data_template as $jabatan => $template)
            {
                
                foreach($template as $apd)
                {
                    $id_jenis = $apd["id_jenis"];
                    foreach($apd["opsi_apd"] as $opsi)
                    {
                        array_push($dataset,["id_jabatan" => $jabatan, "id_jenis" => $id_jenis, "id_apd" => $opsi]);
                    }
                }

            }

            return $dataset;

        }
        catch(Throwable $e)
        {
            error_log("Gagal dalam memuat template sebagai dataset array ".$e);
            return [];
        }
    }

    public function bangunDataTabelTemplateDariDataset(array $dataset)
    {
        try{

            $table_data = [];
            foreach($dataset as $index => $data)
            {
                $jabatan = Jabatan::find($data['id_jabatan'])->nama_jabatan;
                $jenis_apd = ApdJenis::find($data['id_jenis'])->nama_jenis;
                $opsi_apd = ApdList::find($data['id_apd'])->nama_apd;

                array_push($table_data,[
                    "index" => $index + 1,
                    "jabatan" => "[".$data["id_jabatan"]."] ".$jabatan,
                    "jenis_apd" => "[".$data["id_jenis"]."] ".$jenis_apd,
                    "opsi_apd" => "[".$data["id_apd"]."] ".$opsi_apd,
                ]);
            }

            return $table_data;

        }
        catch(Throwable $e)
        {
            error_log("Gagal membangun data tabel template dari dataset ".$e);
            return [];
        }
    }

    public function ubahDataTabelTemplateKeDataset(array $table_data)
    {
        try{

            $dataset = [];
            foreach($table_data as $data)
            {
                $id_jabatan = Str::between($data["jabatan"], '[', '] ');
                $id_jenis = Str::between($data["jenis_apd"], '[', '] ');
                $id_apd = Str::between($data["opsi_apd"], '[', '] ');

                array_push($dataset, [
                    "id_jabatan" => $id_jabatan,
                    "id_jenis" => $id_jenis,
                    "id_apd" => $id_apd
                ]);
            }

            return $dataset;

        }
        catch(Throwable $e)
        {
            error_log("Gagal mengubah data table template kembali menjadi dataset ".$e);
            return [];
        }
    }

    public function ubahDatasetArrayTemplateKeTemplate(array $dataset)
    {
        try{

            $template = [];

            // list semua jabatan yang ada di dataset
            $list_jabatan = [];
            foreach($dataset as $data)
            {
                $id_jabatan = $data["id_jabatan"];

                if(!in_array($id_jabatan,$list_jabatan))
                    array_push($list_jabatan, $id_jabatan);
            }

            foreach($list_jabatan as $jabatan)
            {
                // list semua jenis apd yang ada di dataset jika jabatannya sesuai
                $list_jenis = [];
                foreach($dataset as $data)
                {
                    if($data["id_jabatan"] != $jabatan)
                        continue;
                    
                    if(!in_array($data['id_jenis'],$list_jenis))
                        array_push($list_jenis, $data['id_jenis']);
                }

                // buat data template untuk jabatan
                $data_template = [];
                foreach($list_jenis as $jenis)
                {
                    // list semua apd yang memiliki jabatan dan jenis yang sesuai
                    $list_apd = [];
                    foreach($dataset as $data)
                    {
                        if($data["id_jabatan"] != $jabatan)
                            continue;

                        if($data["id_jenis"] != $jenis)
                            continue;
                        
                        if(!in_array($data['id_apd'],$list_jenis))
                            array_push($list_apd, $data['id_apd']);
                    }

                    array_push($data_template,[
                        "id_jenis" => $jenis,
                        "opsi_apd" => $list_apd
                    ]);
                }

                $template[$jabatan] = $data_template;
            }

            return $template;

        }
        catch(Throwable $e)
        {
            error_log("Gagal dalam mengubah dataset ke template ".$e);
            return [];
        }
    }
}
