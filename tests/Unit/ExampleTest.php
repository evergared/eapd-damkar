<?php

namespace Tests\Unit;

use App\Models\ApdList;
use App\Models\InputApd;
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
            $id_pegawai = Pegawai::where('nrk','0001')->first()->id_pegawai;
            $inputan_pegawai = InputApd::where('id_periode','1')
                                ->where('id_pegawai',$id_pegawai)
                                ->get()->toArray();
            print_r($inputan_pegawai);
            $this->assertTrue(true);

    }
}
