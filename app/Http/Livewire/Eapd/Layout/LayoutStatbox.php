<?php

namespace App\Http\Livewire\Eapd\Layout;

use illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\InputApd;
use App\Enum\VerifikasiApd as verif;
use App\Models\Eapd\ApdJenis;
use Livewire\Component;
use Throwable;

class LayoutStatbox extends Component
{

    // Untuk Nilai
    public $tertolak = 0,
        $rusak = 0,
        $persentaseCapaian = 0,
        $persentaseTervalidasi = 0;

    // untuk Tabel
    public $infoTertolak = [],
        $infoRusak = [],
        $infoCapaian = [],
        $infoTervalidasi = [];

    protected $listeners = [
        'refreshStatbox' => 'render'
    ];

    public function render()
    {
        $this->kalkulasiSemua();
        return view('eapd.livewire.layout.layout-statbox');
    }

    public function kalkulasiSemua()
    {
        $this->kalkulasiTertolak();
        $this->kalkulasiRusak();
        $this->kalkulasiCapaian();
        $this->kalkulasiTervalidasi();
    }

    public function kalkulasiTertolak()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();

            $this->infoTertolak = [];

            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseTertolak = '-';
            } else {
                $tertolak = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        if (verif::tryFrom($input->verifikasi_status) == verif::tertolak()) {
                            $tertolak++;

                            $nama_jenis = ApdJenis::where('id_jenis', '=', $item['id_jenis'])->first()->nama_jenis;
                            $kondisi = $input->kondisi;
                            $status = verif::tryFrom($input->verifikasi_status)->label;

                            array_push($this->infoTertolak, [
                                'jenis_apd' => $nama_jenis,
                                'keterangan' => $kondisi,
                                'status' => $status
                            ]);
                        }
                    }
                }
                $this->persentaseTertolak = $tertolak;
            }
        } catch (Throwable $e) {
            error_log('kalkulasi tertolak fail  ' . $e);
            $this->tertolak = '-';
            $this->infoTertolak = [];
        }
    }

    public function kalkulasiRusak()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();

            $this->infoRusak = [];

            if ($butuhInput[0]['id_jenis'] == "") {
                $this->rusak = '-';
            } else {
                $rusak = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->where('kondisi', 'like', 'rusak %')->first()) {
                        $rusak++;
                        $nama_jenis = ApdJenis::where('id_jenis', '=', $item['id_jenis'])->first()->nama_jenis;
                        $kondisi = $input->kondisi;
                        $status = verif::tryFrom($input->verifikasi_status)->label;

                        array_push($this->infoRusak, [
                            'jenis_apd' => $nama_jenis,
                            'keterangan' => $kondisi,
                            'status' => $status
                        ]);
                    }
                }
                $this->rusak = $rusak;
            }
        } catch (Throwable $e) {
            error_log('kalkulasi rusak fail  ' . $e);
            $this->rusak = '-';
            $this->infoRusak = [];
        }
    }

    public function kalkulasiCapaian()
    {
        try {
            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();

            $this->infoCapaian = [];

            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseCapaian = '-';
            } else {
                $terisi = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        $terisi++;

                        $nama_jenis = ApdJenis::where('id_jenis', '=', $item['id_jenis'])->first()->nama_jenis;
                        $kondisi = $input->kondisi;
                        $status = verif::tryFrom($input->verifikasi_status)->label;

                        array_push($this->infoCapaian, [
                            'jenis_apd' => $nama_jenis,
                            'keterangan' => $kondisi,
                            'status' => $status
                        ]);
                    }
                }
                $this->persentaseCapaian = round(($terisi / count($butuhInput)) * 100, 2);
            }
        } catch (Throwable $e) {
            $this->persentaseCapaian = '-';
            $this->infoCapaian = [];
        }
    }

    public function kalkulasiTervalidasi()
    {
        try {

            $adc = new ApdDataController;
            $butuhInput = $adc->muatListInputApdDariTemplate();

            $this->infoTervalidasi = [];

            if ($butuhInput[0]['id_jenis'] == "") {
                $this->persentaseTervalidasi = '-';
            } else {
                $tervalidasi = 0;
                foreach ($butuhInput as $item) {
                    if ($input = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $item['id_jenis'])->where('id_periode', '=', 1)->first()) {
                        if (verif::tryFrom($input->verifikasi_status) == verif::terverifikasi()) {
                            $tervalidasi++;

                            $nama_jenis = ApdJenis::where('id_jenis', '=', $item['id_jenis'])->first()->nama_jenis;
                            $kondisi = $input->kondisi;
                            $status = verif::tryFrom($input->verifikasi_status)->label;

                            array_push($this->infoTervalidasi, [
                                'jenis_apd' => $nama_jenis,
                                'keterangan' => $kondisi,
                                'status' => $status
                            ]);
                        }
                    }
                }
                $this->persentaseTervalidasi = round(($tervalidasi / count($butuhInput)) * 100, 2);
            }
        } catch (Throwable $e) {
            $this->persentaseTervalidasi = '-';
            $this->infoTervalidasi = [];
        }
    }
}
