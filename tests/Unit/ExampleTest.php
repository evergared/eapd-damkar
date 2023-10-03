<?php

namespace Tests\Unit;

use App\Models\ApdList;
use App\Models\InputApdTemplate;
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
            // $jabatan = ApdList::where('id_apd','H-fir-0001')->get()->first()->size->opsi;
            $jabatan = ApdList::where('id_apd','B-ari-0000')->get()->first()->size;
            print_r($jabatan->opsi);
            $this->assertTrue(true);

    }
}
