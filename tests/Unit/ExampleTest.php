<?php

namespace Tests\Unit;

use App\Models\Pegawai;
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
            $jabatan = Jabatan::where('id_jabatan','like','K%')->get()->first();
            print_r($jabatan['id_jabatan']);
            $this->assertTrue(true);

    }
}
