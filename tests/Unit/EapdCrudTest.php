<?php

namespace Tests\Unit;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\InputApd;
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
        // $query = InputApd::with(['pegawai' => function($query){
        //     $query->with(['jabatan' => function($query){
        //         $query->where('nama_jabatan','like','%PJLP%')->select('nama_jabatan');
        //     }])->select('nama as nama_pegawai');
        // }])->get(['id_apd','nama']);
        $adc = new ApdDataController;
        $inputan = $adc->muatDataUkuranApd('11');
        error_log('inputan : ');
        print_r($inputan);

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
