<?php

namespace Tests\Unit;

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
        $pegawai->ukuran = ['apd1'=>'S','apd2'=>'M','date'=>Carbon::now("Asia/Jakarta")->toDateTimeString()];
        $pegawai->save();

        $this->assertTrue(true);
    }

    public function test_read()
    {
        // $tes = User::find('63e1329904da9dc16d021793')->get()->first()->data;
        // $tes1 = InputApdTemplate::whereIn('jabatan',['L001'])->first()->template;
        // $penempatan = Penempatan::where('_id','like','1.11%')
        //                 ->get(['_id as value','nama_penempatan as data'])
        //                 ->toArray();
        // $penempatan = Penempatan::where('_id','like','1.11%')
        //                 ->project(['value'=>'$_id', 'text' => '$nama_penempatan'])
        //                 ->get()
        //                 ->toArray();
        $test_embed = Pegawai::find('63ef1bf873da03f7b9046f03')->first()->ukuran;
        $read = $test_embed['date'];
        print_r($read);
        $this->assertTrue(true);
    }
}
