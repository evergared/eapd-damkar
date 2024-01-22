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
use Exception;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Throwable;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $array = [
            ["index"=>"a", "test" => "1", "isi" => "satu"],
            ["index"=>"a", "test" => "2", "isi" => "testing"],
            ["index"=>"ab", "test" => "3", "isi" => "satusdfs"],
            ["index"=>"ab", "test" => "4", "isi" => "satu d d d d d d"],
            ["index"=>"ac", "test" => "5", "isi" => "satu d d d d d ddssdfsdfsdfsd"],
        ];

        // $el = array_intersect_key($array,[["index" => "a", "test" => "2", "isi"]]);
        $el = array_filter($array, function($value){

            return $value['index'] == "a" && $value["test"] == "2";
        });

        $k = key($el);

        // var_dump($k);
        printf($k);
        $this->assertTrue(true);

    }

    public function test_haha()
    {
        try{
            throw new Exception('TEST');
        }
        catch(Throwable $e)
        {
            
        }
    }
}
