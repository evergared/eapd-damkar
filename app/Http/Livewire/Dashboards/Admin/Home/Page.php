<?php

namespace App\Http\Livewire\Dashboards\Admin\Home;

use App\Http\Controllers\ApdDataController;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class Page extends Component
{

    public 
        $chart_labels = [],
        $chart_warna = [],
        $chart_data = [];

    public function render()
    {
        return view('livewire.dashboards.admin.home.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Admin"]);
    }

    public function mount()
    {
        //$this->fetchJumlahInputan();
    }

    public function fetchJumlahInputan()
    {
        error_log('haha');
        try{

            $this->chart_labels = [];
            $this->chart_warna = [];
            $this->chart_data = [];

            $admin = Auth::user();
            $tipe_admin = $admin->tipe;
            $id_penempatan = null;

            if ($tipe_admin == "Admin Dinas") {
                $id_wilayah = "semua";
            } elseif ($tipe_admin == "Admin Sudin") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                // $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($tipe_admin == "Admin Subcc") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($tipe_admin == "Admin Pusdik") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($tipe_admin == "Admin Lab") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($tipe_admin == "Admin Bidops") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($tipe_admin == "Admin Sektor") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } else {
                throw new Exception("Tidak ada kondisi yang sesuai dengan tipe admin untuk akun dengan id " . Auth::user()->id);
            }

            // hitung jumlah perolehan data inputan per wilayah
            $data_label = [];
            $data_warna = [];
            $data_jumlah = [];

            $adc = new ApdDataController;

            $fetch_penempatan = Penempatan::query();

            if($id_wilayah != "semua")
            {
                $fetch_penempatan = $fetch_penempatan->where('id_wilayah',$id_wilayah);

                if(!is_null($id_penempatan))
                    $fetch_penempatan = $fetch_penempatan->where('id_penempatan','like',$id_penempatan.'%');

                $fetch_penempatan = $fetch_penempatan->get()->all();

            }
            else
            {
                $fetch_penempatan = Wilayah::get()->all();
            }
                


            foreach($fetch_penempatan as $p)
            {
                $warna = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

                $total_max = 0;
                $total_validasi = 0;
                if($id_wilayah == "semua")
                {
                    $list_pegawai = Pegawai::join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')
                    ->where('pegawai.aktif',true)->where('pegawai.kalkulasi',true)->where('penempatan.id_wilayah',$p->id_wilayah)->get()->all();
                    $label = $p->nama_wilayah;
                }
                else
                {
                    $list_pegawai = Pegawai::where('id_penempatan',$p->id_penempatan)->where('aktif',true)->where('pegawai.kalkulasi',true)->get()->all();
                    $label = $p->nama_penempatan;
                }

                foreach($list_pegawai as $pegawai)
                {
                    $max = 0;
                    $validasi = 0;
                    $adc->hitungCapaianInputPegawai($pegawai->id_pegawai, $max,$validasi,null,3);

                    $total_max += $max;
                    $total_validasi += $validasi;
                }

                if($total_max > 0 && $total_validasi > 0)
                {
                    $persen = round(($total_validasi/$total_max)*100,2) . '%';
                }
                else
                    $persen = '0%';

                $label = $label . ' ' . $persen;

                $data_label[] = $label;
                $data_warna[] = $warna;
                $data_jumlah[] = $total_validasi;
            }
            

            $this->chart_labels = $data_label;
            $this->chart_warna = $data_warna;
            $this->chart_data = $data_jumlah;

            // $this->chart_labels = json_encode($data_label);
            // $this->chart_warna = json_encode($data_warna);
            // $this->chart_data = json_encode($data_jumlah);

            // $this->dispatchBrowserEvent('loadChart',["label" => $this->chart_labels, 'warna'=>$this->chart_warna, "data"=>$this->chart_data]);
        }
        catch(Throwable $e)
        {
            error_log($e);
            $this->chart_labels = [];
            $this->chart_warna = [];
            $this->chart_data = [];
        }
    }
}
