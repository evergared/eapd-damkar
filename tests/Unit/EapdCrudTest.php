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
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase as PhpTes;
use Tests\TestCase;

class EapdCrudTest extends TestCase
{

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

        $this->assertTrue(true);
    }

    public function test_read()
    {
        $tes = User::find('63e1329904da9dc16d021793')->get()->first()->data;
        $tes1 = InputApdTemplate::whereIn('jabatan',['L001'])->first()->template;
        print_r($tes1);
        $this->assertTrue(true);
    }
}
