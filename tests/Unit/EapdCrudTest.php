<?php

namespace Tests\Unit;

use App\Http\Controllers\ApdDataController;
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

        // ApdJenis::factory()->create();
        // ApdSize::factory()->create();
        // ApdKondisi::factory()->create();
        // PeriodeInputApd::factory()->create();

        // ApdList::factory()->count(10)->create();

        // $this->assertDatabaseCount('apd_list', 10);

        $pegawai = Pegawai::find('63ef1bf873da03f7b9046f03');

        // $pegawai->update(['ukuran' => ['apd1'=>'S','apd2'=>'M']],['upsert'=>true]);
        // $pegawai->ukuran = ['apd1'=>'S','apd2'=>'M','date'=>Carbon::now("Asia/Jakarta")->toDateTimeString()];
        // $pegawai->save();

        $this->assertTrue(true);
    }

    public function test_read()
    {

        $id_sudin = '11';
        $id_periode = PeriodeInputApd::get()->first()->id;
        $id_wilayah = Penempatan::find($id_sudin)->id_wilayah;

            error_log('buat list sektor');
            // buat daftar seluruh sektor yang ada di id_wilayah tsb
            $list_sektor = Penempatan::where('id_wilayah','=',$id_wilayah)->where('keterangan','=','sektor')->pluck('_id')->toArray();

            // siapkan array untuk menampung data yang akan di return
            $read = array();

            error_log('pengulangan untuk mengambil data di tiap pos');
            // pengulangan untuk menghitung berapa data inputan setiap sektor
            foreach($list_sektor as $sektor)
            {
                $adc = new ApdDataController;
                // ambil nama sektor sebagai judul tabel
                $nama_sektor = Penempatan::find($sektor)->nama_penempatan;

                // list pos
                $list_pos = Penempatan::where('_id','like',$sektor)->where('keterangan','=','pos')->pluck('_id')->toArray();
                $data_pos = array();

                #region hitung jumlah karyawan yang perlu melakukan input apd pada tiap pos
                foreach($list_pos as $pos)
                {
                    $nama_pos = Penempatan::find($pos)->nama_penempatan;
                    $jumlah_asn = 0;
                    $jumlah_pjlp = 0;
                    $yang_harus_diinput = 0;
                    $yang_telah_diinput = 0;
                    $yang_telah_diverif = 0;
                    $seluruh_pegawai = Pegawai::where('penempatan','=',$pos)->get();
                    foreach($seluruh_pegawai as $pegawai)
                    {
                        $template = $adc->muatListInputApdDariTemplate($id_periode,$pegawai->id_jabatan);

                        if(!(is_null($template)))
                        {
                            // jika pegawai tsb merupakan pjlp
                            if($pegawai->id_jabatan == 'L001')
                            {
                                $jumlah_pjlp++;
                            }
                            // jika pegawi tsb bukan pjlp
                            else
                            {
                                $jumlah_asn++;
                            }

                            // hitung data inputan
                            foreach($template as $t)
                            {
                                $yang_harus_diinput++;
                            }

                            $inputan_terinput = $adc->muatInputanPegawai($id_periode,$pegawai->id,2);
                            foreach($inputan_terinput as $inputan)
                            {
                                $yang_telah_diinput++;
                            }

                            $inputan_terverif = $adc->muatInputanPegawai($id_periode,$pegawai->id,3);
                            foreach($inputan_terverif as $inputan)
                            {
                                $yang_telah_diverif++;
                            }
                        }
                    }

                    // masukan data tersebut kedalam array untuk di push ke array data pos
                    array_push($data_pos,[
                        'pos' => $nama_pos,
                        'pegawai_asn' => $jumlah_asn,
                        'pegawai_pjlp' => $jumlah_pjlp,
                        'perlu_diinput' => $yang_harus_diinput,
                        'telah_diinput' => $yang_telah_diinput,
                        'telah_diverif' => $yang_telah_diverif
                    ]);

                }
                #endregion

                array_push($read,[
                    'sektor' => $nama_sektor,
                    'data_pos' => $data_pos
                ]);  
            }
        print_r($read);
        $this->assertTrue(true);
    }
}
