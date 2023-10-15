<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Apd;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdList;
use App\Models\Pegawai;
use App\Models\PeriodeInputApd;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{

    public
        $tahun_terpilih = '',
        $periode_terpilih = '';
    
    
    
    public
        $opsi_dropdown_tahun = [],
        $opsi_dropdown_periode = [];
    
    public
        $path_gambar = 'storage/';

    public
        $periode_jumlah = 0;

    public
        $id_pegawai = null, 
        $nama_pegawai = null, 
        $list_inputan_pegawai = null;

    public
        $gambar_detail = null,
        $data_detail_inputan = null,
        $nama_apd_detail = null,
        $gambar_apd_template = null;
    
    public
        $error_time_page = null,
        $error_time_alert = null;

    protected $listeners = [
        'lihatList',
        'lihatDetail'
    ];

    public function render()
    {
        return view('livewire.dashboards.pegawai.data.apd.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Data APD Anggota']);
    }

    public function mount()
    {
        $this->inisiasiPage();
    }

    public function inisiasiPage()
    {
        $this->error_time_page = null;
        try{

            $periode_all = PeriodeInputApd::all();
            foreach($periode_all as $p)
            {
                // ambil tahun dari batas tanggal
                $tahun_awal = substr($p->tgl_awal,0,4);
                $tahun_akhir = substr($p->tgl_akhir,0,4);

                // jika tahun sama
                if($tahun_awal == $tahun_akhir)
                {
                    // cek apakah tahun sudah ada
                    $index = array_search($tahun_awal, array_column($this->opsi_dropdown_tahun, "value"));

                    // jika tidak ada, masukan ke opsi dropdown
                    if(is_bool($index) && $index == false)
                    {   
                        array_push($this->opsi_dropdown_tahun,[
                            "value" => $tahun_awal, "text" => $tahun_awal
                        ]);
                    }
                }
                // jika tahun tidak sama
                else
                {
                    // cek apakah tahun sudah ada
                    $index = array_search($tahun_awal, array_column($this->opsi_dropdown_tahun, "value"));

                    // jika tidak ada, masukan ke opsi dropdown
                    if(is_bool($index) && $index == false)
                    {   
                        array_push($this->opsi_dropdown_tahun,[
                            "value" => $tahun_awal, "text" => $tahun_awal
                        ]);
                    }

                    // cek apakah tahun sudah ada
                    $index = array_search($tahun_akhir, array_column($this->opsi_dropdown_tahun, "value"));

                    // jika tidak ada, masukan ke opsi dropdown
                    if(is_bool($index) && $index == false)
                    {   
                        array_push($this->opsi_dropdown_tahun,[
                            "value" => $tahun_akhir, "text" => $tahun_akhir
                        ]);
                    }
                }

            }

        }
        catch(Throwable $e)
        {
            $this->error_time_page = now();
            error_log('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_page.' : Kesalahan saat inisiasi halaman '.$e);
            Log::error('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_page.' : Kesalahan saat inisiasi halaman '.$e);
        }
    }

    #region function tombol
    public function lihatList($value)
    {
            $this->error_time_alert = null;
        try
        {
            $this->id_pegawai = $value[0];
            $this->nama_pegawai = Pegawai::find($this->id_pegawai)->nama;

            $adc = new ApdDataController;
            $this->periode_terpilih = $adc->ambilIdPeriodeInput();
            $this->list_inputan_pegawai = $adc->muatInputanPegawai($this->periode_terpilih,$this->id_pegawai);
            $this->dispatchBrowserEvent('tabel-ke-list');
        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            error_log('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat list inputan anggota '.$e);
            Log::error('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat list inputan anggota '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail. ref ('.$this->error_time_alert.')']);
        }
    }

    public function lihatDetail($value)
    {
        $this->error_time_alert = null;
        $this->data_detail_inputan = null;
        $this->nama_apd_detail = null;
        $this->gambar_apd_template = null;

        try{

            $this->data_detail_inputan = null;
            if(array_key_exists($value,$this->list_inputan_pegawai))
            {
                $this->data_detail_inputan = $this->list_inputan_pegawai[$value];
                $this->nama_apd_detail = $this->data_detail_inputan['nama_jenis'];

                $apd = ApdList::where('id_apd', $this->data_detail_inputan['id_apd'])->first();
                if(!is_null($apd))
                {
                    $adc = new ApdDataController;
                    $this->gambar_apd_template = $adc->siapkanGambarTemplateBesertaPathnya($apd->image, $this->data_detail_inputan['id_jenis'], $this->data_detail_inputan['id_apd']);
                }
            }
            $this->dispatchBrowserEvent('list-ke-detail');

        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            $this->data_detail_inputan = null;
            $this->nama_apd_detail = null;
            $this->gambar_apd_template = null;
            error_log('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat detail inputan anggota '.$e);
            Log::error('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat detail inputan anggota '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail. ref ('.$this->error_time_alert.')']);
        }
    }

    public function lihatGambar($value)
    {
        $this->gambar_detail = null;
        if(is_array($value))
        {
            $target_inputan = $this->list_inputan_pegawai[$value[0]];
            $this->gambar_detail = $target_inputan['gambar_apd'][$value[1]];
        }
        else
        {
            $this->gambar_detail = $this->list_inputan_pegawai[$value]['gambar_apd'];
        }
        $this->dispatchBrowserEvent('panggilModal',['id'=>'modal-gambar']);
    }
    #endregion

    #region wire:change
    public function changeDropdownTahun()
    {
        $this->periode_terpilih = '';
        $this->opsi_dropdown_periode = [];
        $this->error_time_alert = null;
        $this->periode_jumlah = 0;
        try{

            $periode_query = PeriodeInputApd::where('tgl_awal','like','%'.$this->tahun_terpilih.'%')
                                ->orWhere('tgl_akhir','like','%'.$this->tahun_terpilih.'%')
                                ->get()->toArray();

            foreach($periode_query as $p)
            {
                array_push($this->opsi_dropdown_periode,[
                    "value" => $p['id_periode'], 'text' => $p['nama_periode']
                ]);
            }

            $this->periode_jumlah = count($periode_query);

        }
        catch(Throwable $e)
        {
            $this->periode_terpilih = '';
            $this->opsi_dropdown_periode = [];
            $this->error_time_alert = now();
            $this->periode_jumlah = 0;
            error_log('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat memilih dropdown tahun '.$e);
            Log::error('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat memilih dropdown tahun '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Terjadi kesalahan saat melihat periode pada tahun '.$this->tahun_terpilih.'. ref ('.$this->error_time_alert.')']);
        }

    }
    public function changeDropdownPeriode()
    {
        $this->emit('tabelGantiPeriode',$this->periode_terpilih);
    }
    #endregion
}
