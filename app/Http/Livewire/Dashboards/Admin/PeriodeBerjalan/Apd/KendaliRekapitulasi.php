<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
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
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
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
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat memproses wilayah ref : '.$this->error_time_alert]);
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
        try{
            
            $jenis = $param[0];
            $kondisi = StatusApd::tryFrom($param[1]);

            if(is_null($kondisi))
                throw new Exception('kondisi '.$param[1].' tidak dapat ditemukan.');

            $paket = [
                'id_jenis' => $jenis,
                'enum_kondisi' => $kondisi,
                'penempatan'=>$this->model_dropdown_penempatan
            ];

            $this->emit('paketUntukDetailRekap', $paket);
            $this->dispatchBrowserEvent('rekap-kendali-ke-detail');
        }
        catch(Throwable $e)
        {
            $this->error_time_detail = now();
            
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_detail.') : Kesalahan saat melihat detail rekapitulasi '.$e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_detail.') : Kesalahan saat melihat detail rekapitulasi '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail. ref : '.$this->error_time_detail]);
        }
    }

    public function rekapData()
    {
        $this->error_time_tabel = now();
        $this->data_rekap = null;

        try{

            $arc = new ApdRekapController;
            $data = $arc->bangunDataTabelRekapPenempatan($this->model_dropdown_penempatan, $this->id_periode_berjalan);

            if(is_bool($data) && $data == false)
                throw new Exception('Data gagal di rekap oleh Apd Rekap Controller');

            $this->data_rekap = $data; 

        }
        catch(Throwable $e)
        {
            $this->error_time_tabel = now();
            $this->data_rekap = null;
            error_log('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_tabel.') : Kesalahan saat menghitung rekapitulasi data '.$e);
            Log::error('Kendali Rekapitulasi @ Dashboard Progress APD Admin ref ('.$this->error_time_tabel.') : Kesalahan saat menghitung rekapitulasi data '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat mengolah data rekap. ref : '.$this->error_time_tabel]);
        }
    }

}
