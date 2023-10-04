<?php

namespace Tests\Unit;

use App\Models\ApdList;
use App\Models\InputApdTemplate;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\PeriodeInputApd;
use App\Models\UkuranPegawai;
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
            $jabatan = Pegawai::where('id_penempatan','!=',null)->get()->toArray();
            print_r($jabatan);
            $this->assertTrue(true);

    }
}
