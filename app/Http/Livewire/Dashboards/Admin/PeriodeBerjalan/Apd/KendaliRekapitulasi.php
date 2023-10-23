<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class KendaliRekapitulasi extends Component
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
        $error_time_tabel = null;

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;

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

                $pic = new PeriodeInputController;

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput();
        $this->nama_periode_berjalan = PeriodeInputApd::find($this->id_periode_berjalan)->nama_periode;

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
        $this->emit('tabelGantiPenempatan',$this->model_dropdown_penempatan);
        
    }
#endregion

    public function detailJumlah($param)
    {
        $this->error_time_tabel = null;
        try{
            
            $jenis = $param[0];
            $kondisi = $param[1];


            $paket = [
                'id_jenis' => $jenis,
                'enum_kondisi' => $kondisi
            ];

            $this->emit('paketUntukDetailRekap', $paket);
            $this->dispatchBrowserEvent('rekap-kendali-ke-detail');
        }
        catch(Throwable $e)
        {
            $this->error_time_tabel = now();
            
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_tabel.') : Kesalahan saat melihat detail by personil '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_tabel.') : Kesalahan saat melihat detail by personil '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail : '.$this->error_time_tabel]);
        }
    }

}
