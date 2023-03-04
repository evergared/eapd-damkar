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
        $adc = new ApdDataController;
        // $read = $adc->muatListInputApdDariTemplate("640220e5d7f5db34c60dca70","L001");
        $read = InputApdTemplate::whereIn('periode',["640220e5d7f5db34c60dca70"])->first()->template;
        dd($read);
        $this->assertTrue(true);
    }
}
