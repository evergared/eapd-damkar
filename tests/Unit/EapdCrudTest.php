<?php

namespace Tests\Unit;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\InputApdTemplate;
use App\Models\Eapd\Mongodb\Jabatan;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase as PhpTes;
use Tests\TestCase;
use MongoDb\BSON\Regex;


class EapdCrudTest extends TestCase
{
    // Panggil menggunakan php artisan test Tests\Unit\EapdCrudTest.php

    // use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insert()
    {
        $apr = new ApdRekapController;

        $sudin = "1";

        // dapatkan semua sektor yang ada di sudin
            $list_sektor =  Penempatan::where('id_wilayah','=',$sudin)
                            ->where('keterangan','=','sektor')
                            ->pluck('id');

            $data_rekap = collect();
            // pengulangan untuk mengambil rangkuman data inputan tiap sektor
            foreach($list_sektor as $sektor)
            {
                // ambil rangkuman data sektor tersebut
                $data_sektor = $apr->bangunDataTabelRekapApdSektor(1,$sektor); // parameter 1 hanya untuk test

                // jika data rekap masih kosong, jadikan data yang baru diambil menjadi data rekap saat ini
                if($data_rekap->isEmpty())
                    $data_rekap = $data_sektor;
                else
                    {
                        foreach($data_sektor as $data)
                        {
                            // jika jenis apd tsb sudah ada di data rekap, maka tambahkan jumlah datanya saja
                            if($data_rekap->contains("id_jenis",$data["id_jenis"]))
                            {
                                $data_yang_sudah_ada = $data_rekap->where("id_jenis",$data["id_jenis"])->first();

                                $data_baru = [
                                    "baik" => $data_yang_sudah_ada["baik"] + $data["baik"],
                                    "rusak_ringan" => $data_yang_sudah_ada["rusak_ringan"] + $data["rusak_ringan"],
                                    "rusak_sedang" => $data_yang_sudah_ada["rusak_sedang"] + $data["rusak_sedang"],
                                    "rusak_berat" => $data_yang_sudah_ada["rusak_berat"] + $data["rusak_berat"],
                                    "belum_terima" => $data_yang_sudah_ada["belum_terima"] + $data["belum_terima"],
                                    "hilang" => $data_yang_sudah_ada["hilang"] + $data["hilang"],
                                    "ada" => $data_yang_sudah_ada["ada"] + $data["ada"],
                                    "total" => $data_yang_sudah_ada["total"] + $data["total"],
                                    "distribusi" => $data_yang_sudah_ada["distribusi"] + $data["distribusi"],
                                ];

                                $data_rekap->where("id_jenis",$data["id_jenis"])->replace($data_baru);
                                $data_yang_sudah_ada = $data_rekap->where("id_jenis",$data["id_jenis"])->first();

                            }

                            // jika apd tsb belum ada di data rekap, maka tambahkan sebagai entry baru
                            else
                            {
                                $data_rekap->push[$data];
                            }

                        }
                    }

            }

        $this->assertTrue(true);
    }

    public function test_read()
    {
        // $apr = new ApdRekapController;
        // $read = $apr->bangunDataTabelRekapApdSektor();
        // dd($read);
        $this->assertTrue(true);
    }
}
