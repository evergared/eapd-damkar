<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use App\Models\Pegawai;
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
        $error_time_alert = null,
        $error_time_capaian = null,
        $error_time_keberadaan = null,
        $error_time_detail_by_personil = null,
        $error_time_kerusakan = null;
    
    public
        $value_max_capaian = 0,
        $value_terinput_capaian = 0,
        $value_terverif_capaian = 0;

    public
        $value_keberadaan_ada = 0,
        $value_keberadaan_belum = 0,
        $value_keberadaan_hilang = 0;

    public
        $value_kerusakan_baik = 0,
        $value_kerusakan_ringan = 0,
        $value_kerusakan_sedang = 0,
        $value_kerusakan_berat = 0;
    
    public
        $detail_by_personil_id_pegawai = '',
        $detail_by_personil_nama_pegawai = '',
        $detail_by_personil_penempatan_pegawai = '',
        $detail_by_personil_data_inputan = [];

    protected $listeners =[
        'detailByPersonil'
    ];

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
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Subcc")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Pusdik")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Lab")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Bidops")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Sektor")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            else
            {
                throw new Exception("Tidak ada kondisi yang sesuai dengan tipe admin untuk akun dengan id ".Auth::user()->id);
            }

            if(!is_null($fetch_wilayah))
                foreach($fetch_wilayah as $f)
                {
                    array_push($this->opsi_dropdown_wilayah,[
                        "value" => $f->id_wilayah, "text" => $f->nama_wilayah
                    ]);
                }

            if(!is_null($fetch_penempatan))
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

#region penghitungan rangkuman
public function hitungCapaian()
{
        $this->error_time_capaian = null;
        $this->value_max_capaian = 0;
        $this->value_terinput_capaian = 0;
        $this->value_terverif_capaian = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
            

        }
        catch(Throwable $e)
        {
            $this->error_time_capaian = now();
            $this->value_max_capaian = 0;
            $this->value_terinput_capaian = 0;
            $this->value_terverif_capaian = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_capaian.') : Kesalahan saat hitung capaian '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_capaian.') : Kesalahan saat hitung capaian '.$e);
        }
}

public function hitungRangkumanKeberadaan()
{
        $this->error_time_keberadaan = null;
        $this->value_keberadaan_ada = 0;
        $this->value_keberadaan_belum = 0;
        $this->value_keberadaan_hilang = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
            

        }
        catch(Throwable $e)
        {
            $this->error_time_keberadaan = now();
            $this->value_keberadaan_ada = 0;
            $this->value_keberadaan_belum = 0;
            $this->value_keberadaan_hilang = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_keberadaan.') : Kesalahan saat hitung keberadaan '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_keberadaan.') : Kesalahan saat hitung keberadaan '.$e);
        }
}

public function hitungRangkumanKerusakan()
{
        $this->error_time_kerusakan = null;
        $this->value_kerusakan_baik = 0;
        $this->value_kerusakan_ringan = 0;
        $this->value_kerusakan_sedang = 0;
        $this->value_kerusakan_berat = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
            

        }
        catch(Throwable $e)
        {
            $this->error_time_kerusakan = now();
            $this->value_kerusakan_baik = 0;
            $this->value_kerusakan_ringan = 0;
            $this->value_kerusakan_sedang = 0;
            $this->value_kerusakan_berat = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_kerusakan.') : Kesalahan saat hitung keberadaan '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_kerusakan.') : Kesalahan saat hitung keberadaan '.$e);
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

            $fetch_penempatan = Penempatan::where('id_wilayah',$this->model_dropdown_wilayah)->get()->all();

            if(!is_null($fetch_penempatan))
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
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat memproses wilayah ref : '.$this->error_time_alert]);
        }
    }

    public function changeDropdownPenempatan()
    {
        error_log('dropdown changed');
        $this->emit('tabelGantiPenempatan',$this->model_dropdown_penempatan);
        $this->hitungCapaian();
    }
#endregion

#region tindakan tabel
    public function detailByPersonil($target_pegawai)
    {
        $this->error_time_detail_by_personil = null;
        try{
            
            $this->detail_by_personil_id_pegawai = $target_pegawai;
            $this->detail_by_personil_nama_pegawai = Pegawai::find($this->detail_by_personil_id_pegawai)->nama;
            $this->detail_by_personil_penempatan_pegawai = Pegawai::find($this->detail_by_personil_id_pegawai)->penempatan->nama_penempatan;

            $adc = new ApdDataController;
            $this->detail_by_personil_data_inputan = $adc->muatInputanPegawai(null, $this->detail_by_personil_id_pegawai);

        }
        catch(Throwable $e)
        {
            $this->error_time_detail_by_personil = now();
            $this->detail_by_personil_id_pegawai = '';
            $this->detail_by_personil_nama_pegawai = '';
            $this->detail_by_personil_penempatan_pegawai = '';
            $this->detail_by_personil_data_inputan = [];
            
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail : '.$this->error_time_detail_by_personil]);
        }
        error_log('panggil detail by personil : '.$target_pegawai);
        $this->dispatchBrowserEvent('kendali-ke-detail');
    }
#endregion

}
