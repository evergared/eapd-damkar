<?php

namespace Tests\Unit;

use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\InputApdTemplate;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Penempatan;
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
        $fetch_penempatan = Penempatan::query();


            print_r($fetch_penempatan);
            $this->assertTrue(true);

    }
}
