<?php

namespace Tests\Unit;

use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
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
        $template = InputApdTemplate::where('id_periode','1')
                ->where('id_jabatan','AAMD001')
                ->first()->template;

            

            $cek = array_filter($template, function($val){
                error_log($val['id_jenis']);
                return $val['id_jenis'] == 'A001';                
            });


            print_r(count($cek));
            $this->assertTrue(true);

    }
}
