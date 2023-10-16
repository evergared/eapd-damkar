<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Models\Penempatan;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{
    public
        $opsi_dropdown_wilayah = [],
        $opsi_dropdown_penempatan = [];
    
    public
        $model_dropdown_wilayah = '',
        $model_dropdown_penempatan = '';
    
    public
        $error_time_page = null,
        $error_time_alert = null;

#region Livewire lifecycle
    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan APD Saat ini"]);
    }

    public function mount()
    {
        $this->error_time_page = null;
        try{

            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];

            $fetch_wilayah = null;
            $fetch_penempatan = null;

            $target_penempatan = Auth::user()->id_penempatan;
            $tipe_admin = Auth::user()->tipe;

            if( $tipe_admin == "Admin Dinas")
            {
                $fetch_wilayah = Wilayah::all();
            }
            elseif($tipe_admin == "Admin Sudin")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            elseif($tipe_admin == "Admin Sektor")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            elseif($tipe_admin == "Admin Bagian")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            elseif($tipe_admin == "Admin Subbag")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            else
            {
                throw new Exception("Tidak ada kondisi yang sesuai dengan jenis admin untuk akun dengan id ".Auth::user()->id);
            }

            foreach($fetch_wilayah as $f)
            {
                array_push($this->opsi_dropdown_wilayah,[
                    "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                ]);
            }

            foreach($fetch_penempatan as $f)
            {
                array_push($this->opsi_dropdown_penempatan,[
                    "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                ]);
            }

        }
        catch(Throwable $e)
        {
            $this->error_time_page = now();
            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
        }
    }
#endregion

#region wire:change
    public function changeDropdownWilayah()
    {
        $this->error_time_alert = null;
        try{
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_penempatan = '';

            $fetch_penempatan = Penempatan::where('id_penempatan', 'like',$this->model_dropdown_wilayah.'%');

            foreach($fetch_penempatan as $f)
            {
                array_push($this->opsi_dropdown_penempatan,[
                    "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                ]);
            }
        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_wilayah = '';
            $this->model_dropdown_penempatan = '';
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
        }
    }
#endregion
}
