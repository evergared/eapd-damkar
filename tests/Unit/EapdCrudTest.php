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
        $opsi_kondisi = [];
        $status_apd = StatusApd::toArray();
        // for($i = 0; $i++; $i < count($status_apd))
        foreach($status_apd as $key => $status)
        {

            $opsi_kondisi[$key] = $key;

        }

        // untuk filter grup
        $grup = Grup::project(['value'=>'$_id','text'=>'$nama_grup'])
                        ->get()
                        ->toArray();
        $opsi_grup = [];
        foreach($grup as $p)
        {
            $opsi_grup[$p['value']] = $p['text'];
        }
       print_r($opsi_kondisi);

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
