<?php

namespace Tests\Unit;

use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Jabatan;
use Carbon\Carbon;
// use PHPUnit\Framework\TestCase;
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
            $jabatan = Jabatan::pluck('id_jabatan')->all();
            print_r($jabatan);
            $this->assertTrue(true);

    }
}
