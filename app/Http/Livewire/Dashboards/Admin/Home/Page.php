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

    public $tipe_admin = null;

    public function render()
    {
        return view('livewire.dashboards.admin.home.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Halaman Admin"]);
    }

    public function mount()
    {
        $this->fetchJumlahInputan();
    }

    public function fetchJumlahInputan()
    {
        try{

            $admin = Auth::user();
            $this->tipe_admin = $admin->tipe;
            $id_penempatan = null;

            if ($this->tipe_admin == "Admin Dinas") {
                $id_wilayah = "semua";
            } elseif ($this->tipe_admin == "Admin Sudin") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                // $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($this->tipe_admin == "Admin Subcc") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($this->tipe_admin == "Admin Pusdik") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($this->tipe_admin == "Admin Lab") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($this->tipe_admin == "Admin Bidops") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } elseif ($this->tipe_admin == "Admin Sektor") {
                $id_wilayah = Auth::user()->data->penempatan->id_wilayah;
                $id_penempatan = Auth::user()->data->id_penempatan;
            } else {
                throw new Exception("Tidak ada kondisi yang sesuai dengan tipe admin untuk akun dengan id " . Auth::user()->id);
            }

            $adc = new ApdDataController;

            $data = $adc->kueriCapaianInputPegawaiSektoralUntukJS(null,$id_penempatan,$id_wilayah);

            $this->dispatchBrowserEvent('JSWorkerCall-dashboard', ['data'=>$data]);

        }
        catch(Throwable $e)
        {

        }
    }
}
