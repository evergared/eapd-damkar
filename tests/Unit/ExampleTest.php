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
            $periode = PeriodeInputApd::where('tgl_awal','like','%2023%')
            ->orWhere('tgl_akhir','like','%2023%')
            ->get()->toArray();

            print_r($periode);
            $this->assertTrue(true);

    }
}
