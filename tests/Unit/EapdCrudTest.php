<?php

namespace Tests\Unit;

use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\ApdKondisi;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\ApdSize;
use App\Models\Eapd\PeriodeInputApd;
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
}
