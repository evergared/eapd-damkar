<?php

namespace Tests\Unit;

use App\Models\Eapd\Mongodb\Pegawai;
use Carbon\Carbon;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $time = Carbon::now('Asia/Jakarta');
        error_log($time);
        // print_r($time);
        // if(!is_null($test = Pegawai::find('63ef1bf873da03f7b9046f03')->ukuran))
        // {
        //     print_r($test);
        //     $this->assertTrue(true);
        // }
        // else
        //     $this->assertTrue(false);
            $this->assertTrue(true);

    }
}
