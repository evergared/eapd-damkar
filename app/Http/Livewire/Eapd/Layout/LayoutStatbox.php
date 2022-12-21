<?php

namespace App\Http\Livewire\Eapd\Layout;

use illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\InputApd;
use App\Enum\VerifikasiApd as verif;
use Livewire\Component;
use Throwable;

class LayoutStatbox extends Component
{

    public $tertolak = 0,
        $rusak = 0,
        $persentaseCapaian = 0,
        $persentaseTervalidasi = 0;

    protected $listeners = [
        'refreshStatbox' => 'render'
    ];

    public function render()
    {
        $this->kalkulasiTertolak();
        $this->kalkulasiRusak();
        $this->kalkulasiCapaian();
        $this->kalkulasiTervalidasi();
        return view('eapd.livewire.layout.layout-statbox');
    }

    public function kalkulasiTertolak()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();


            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseTertolak = '-';
            } else {
                $tertolak = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        if (verif::tryFrom($input->verifikasi_status) == verif::tertolak())
                            $tertolak++;
                    }
                }
                $this->persentaseTertolak = $tertolak;
            }
        } catch (Throwable $e) {
            $this->tertolak = '-';
        }
    }

    public function kalkulasiRusak()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();


            if ($butuhInput[0]['id_jenis'] == "") {
                $this->rusak = '-';
            } else {
                $rusak = 0;
                foreach ($butuhInput as $item) {
                    if (InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->where('kondisi', 'like', 'rusak %')->first()) {
                        $rusak++;
                    }
                }
                $this->rusak = $rusak;
            }
        } catch (Throwable $e) {
            $this->rusak = '-';
        }
    }

    public function kalkulasiCapaian()
    {
        try {
            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();


            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseCapaian = '-';
            } else {
                $terisi = 0;
                foreach ($butuhInput as $item) {
                    if (InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        $terisi++;
                    }
                }
                $this->persentaseCapaian = (($terisi / count($butuhInput)) * 100);
            }
        } catch (Throwable $e) {
            $this->persentaseCapaian = '-';
        }
    }

    public function kalkulasiTervalidasi()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();


            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseTervalidasi = '-';
            } else {
                $tervalidasi = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        if (verif::tryFrom($input->verifikasi_status) == verif::terverifikasi())
                            $tervalidasi++;
                    }
                }
                $this->persentaseTervalidasi = (($tervalidasi / count($butuhInput)) * 100);
            }
        } catch (Throwable $e) {
            $this->persentaseTervalidasi = '-';
        }
    }
}
