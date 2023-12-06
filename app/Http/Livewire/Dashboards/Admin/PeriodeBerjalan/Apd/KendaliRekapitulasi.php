<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\Pegawai;
use App\Models\TestPenempatan;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class KendaliRekapitulasi extends Component
{

    public
        $tampil_dropdown_wilayah = true,
        $tampil_dropdown_penempatan = true;

    public
        $opsi_dropdown_wilayah = [],
        $opsi_dropdown_penempatan = [];

    public
        $model_dropdown_wilayah = '',
        $model_dropdown_penempatan = '';

    public
        $error_time_page = null,
        $error_time_alert = null,
        $error_time_detail = null,
        $error_time_tabel = null;

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;

    public $data_rekap = null;


    protected $listeners = [
        'sharePeriodeBerjalan' => 'terimaPeriodeBerjalan'
    ];



    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.apd.kendali-rekapitulasi');
    }

    public function mount()
    {
        $this->error_time_page = null;
        try {

            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];

            $fetch_wilayah = null;
            $fetch_penempatan = null;

            $target_penempatan = Auth::user()->id_penempatan;
            $tipe_admin = Auth::user()->tipe;

            array_push($this->opsi_dropdown_wilayah, [
                "value" => 'semua', "text" => 'Semua Wilayah'
            ]);
            array_push($this->opsi_dropdown_penempatan, [
                "value" => 'semua', "text" => 'Semua Penempatan'
            ]);


            if ($tipe_admin == "Admin Dinas") {
                $fetch_wilayah = Wilayah::all();
                $this->tampil_dropdown_penempatan = false;
            } elseif ($tipe_admin == "Admin Sudin") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->data->penempatan->id_wilayah)->get()->all();
            } elseif ($tipe_admin == "Admin Subcc") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $this->opsi_dropdown_penempatan = [];
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->data->penempatan->id_wilayah)->get()->all();
            } elseif ($tipe_admin == "Admin Pusdik") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $this->opsi_dropdown_penempatan = [];
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->data->penempatan->id_wilayah)->get()->all();
            } elseif ($tipe_admin == "Admin Lab") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $this->opsi_dropdown_penempatan = [];
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->data->penempatan->id_wilayah)->get()->all();
            } elseif ($tipe_admin == "Admin Bidops") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $this->opsi_dropdown_penempatan = [];
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->data->penempatan->id_wilayah)->get()->all();
            } elseif ($tipe_admin == "Admin Sektor") {
                $this->tampil_dropdown_wilayah = false;
                $this->model_dropdown_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $this->opsi_dropdown_penempatan = [];
                $fetch_penempatan = Penempatan::where('id_penempatan', 'like', $target_penempatan . '%')->get()->all();
            } else {
                throw new Exception("Tidak ada kondisi yang sesuai dengan tipe admin untuk akun dengan id " . Auth::user()->id);
            }

            if (!is_null($fetch_wilayah))
                foreach ($fetch_wilayah as $f) {
                    array_push($this->opsi_dropdown_wilayah, [
                        "value" => $f->id_wilayah, "text" => $f->nama_wilayah
                    ]);
                }

            if (!is_null($fetch_penempatan))
                foreach ($fetch_penempatan as $f) {
                    array_push($this->opsi_dropdown_penempatan, [
                        "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                    ]);
                }

            $pic = new PeriodeInputController;

            $this->id_periode_berjalan = $pic->ambilIdPeriodeInput(null, true);
            $this->nama_periode_berjalan = PeriodeInputApd::find($this->id_periode_berjalan)->nama_periode;
        } catch (Throwable $e) {
            $this->error_time_page = now();
            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_page . ') : Kesalahan saat inisiasi ' . $e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_page . ') : Kesalahan saat inisiasi ' . $e);
        }
    }

    public function printPdf()
    {
        $tipe_admin = Auth::user()->tipe;
        $tipe_penempatan = '';

        if ($tipe_admin == "Admin Dinas" || $tipe_admin == "Admin Bidops" || $tipe_admin == "Admin Lab" || $tipe_admin == "Admin Pusdik") {
            $tipe_penempatan = 'Dinas ';
            $mengetahui = Pegawai::where('id_jabatan', 'KD01')->first();
            $penandatangan = Auth::user()->data;
        } elseif ($tipe_admin == "Admin Sudin" || $tipe_admin == "Admin Sektor" || $tipe_admin == "Admin Subcc") {
            $tipe_penempatan = 'Suku Dinas ';
            $mengetahui = Pegawai::join('penempatan', 'pegawai.id_penempatan', '=', 'penempatan.id_penempatan')->where('id_jabatan', 'KSUD001')->where('penempatan.id_wilayah', Auth::user()->data->penempatan->id_wilayah)->first();
            $penandatangan = Auth::user()->data;
        }
        // error_log('test');
        $arc = new ApdRekapController;
        $rekap = $arc->bangunDataTabelRekapPenempatan($this->model_dropdown_wilayah,$this->model_dropdown_penempatan,);


        // return dd($tableyo);
        try {
            $pdf = Pdf::loadView('livewire.dokumen.rekap', ['rekap' => $rekap, 'tahun_pengadaan' => "test", 'mengetahui' => $mengetahui, 'penandatangan' => $penandatangan])->setPaper('A4', 'landscape')->output();
            // return dd($pdf);
            return response()->streamDownload(
                fn () => print($pdf),
                "kib-apd.pdf"
            );
            // return $pdf->download('invoice.pdf');
        } catch (Throwable $e) {
            error_log($e);
        }
    }
    #region wire:change
    public function changeDropdownWilayah()
    {
        $this->error_time_alert = null;
        try {
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_penempatan = '';

            if($this->model_dropdown_wilayah == "semua")
            {
                $this->tampil_dropdown_penempatan = false;
                $this->changeDropdownPenempatan();
        
            }
            else{
                $fetch_penempatan = Penempatan::where('id_wilayah', $this->model_dropdown_wilayah)->get()->all();
                $this->tampil_dropdown_penempatan = true;

                if (!is_null($fetch_penempatan))
                    foreach ($fetch_penempatan as $f) {
                        array_push($this->opsi_dropdown_penempatan, [
                            "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                        ]);
                    }
            }
            
        } catch (Throwable $e) {
            $this->error_time_alert = now();
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_wilayah = '';
            $this->model_dropdown_penempatan = '';
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_alert . ') : Kesalahan saat wire change dropdown wilayah ' . $e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_alert . ') : Kesalahan saat wire change dropdown wilayah ' . $e);
            $this->dispatchBrowserEvent('jsAlert', ['pesan' => 'Kesalahan saat memproses wilayah ref : ' . $this->error_time_alert]);
        }
    }

    public function changeDropdownPenempatan()
    {
        $this->rekapData();
    }
    #endregion

    public function detailJumlah($param)
    {
        $this->error_time_detail = null;
        try {

            $jenis = $param[0];
            $kondisi = StatusApd::tryFrom($param[1]);

            if (is_null($kondisi))
                throw new Exception('kondisi ' . $param[1] . ' tidak dapat ditemukan.');

            $paket = [
                'id_jenis' => $jenis,
                'enum_kondisi' => $kondisi,
                'penempatan' => $this->model_dropdown_penempatan
            ];

            $this->emit('paketUntukDetailRekap', $paket);
            $this->dispatchBrowserEvent('rekap-kendali-ke-detail');
        } catch (Throwable $e) {
            $this->error_time_detail = now();

            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_detail . ') : Kesalahan saat melihat detail rekapitulasi ' . $e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_detail . ') : Kesalahan saat melihat detail rekapitulasi ' . $e);
            $this->dispatchBrowserEvent('jsAlert', ['pesan' => 'Kesalahan saat melihat detail. ref : ' . $this->error_time_detail]);
        }
    }

    public function rekapData()
    {
        $this->error_time_tabel = now();
        $this->data_rekap = null;

        try {

            $arc = new ApdRekapController;
            $data = $arc->bangunDataTabelRekapPenempatan($this->model_dropdown_wilayah,$this->model_dropdown_penempatan, $this->id_periode_berjalan);

            if (is_bool($data) && $data == false)
                throw new Exception('Data gagal di rekap oleh Apd Rekap Controller');

            $this->data_rekap = $data;
        } catch (Throwable $e) {
            $this->error_time_tabel = now();
            $this->data_rekap = null;
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_tabel . ') : Kesalahan saat menghitung rekapitulasi data ' . $e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref (' . $this->error_time_tabel . ') : Kesalahan saat menghitung rekapitulasi data ' . $e);
            $this->dispatchBrowserEvent('jsAlert', ['pesan' => 'Kesalahan saat mengolah data rekap. ref : ' . $this->error_time_tabel]);
        }
    }
}
