<?php

namespace Tests\Unit;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\InputApd;
use App\Models\Eapd\Mongodb\InputApdTemplate;
use App\Models\Eapd\Mongodb\Jabatan;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase as PhpTes;
use Tests\TestCase;
use MongoDb\BSON\Regex;


class EapdCrudTest extends TestCase
{
    // Panggil menggunakan php artisan test Tests\Unit\EapdCrudTest.php

    // use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insert()
    {
        $adc = new PeriodeInputController;
        $id_periode = PeriodeInputApd::get()->first()->id;
        $dataset = $adc->muatTemplateSebagaiTabelDatasetArray($id_periode);
        print_r($dataset);

        $datatable = $adc->bangunDataTabelTemplateDariDataset($dataset);
        print_r($datatable);

        $dataset_return = $adc->ubahDataTabelTemplateKeDataset($datatable);
        print_r($dataset_return);

        // print_r(InputApdTemplate::where('id_periode',$id_periode)->get()->first()->template);
        print_r($adc->ubahDatasetArrayTemplateKeTemplate($dataset_return));

        $this->assertTrue(true);
    }

    public function test_read()
    {
        // $apr = new ApdRekapController;
        // $read = $apr->bangunDataTabelRekapApdSektor();
        // dd($read);
        $this->assertTrue(true);
    }
}
