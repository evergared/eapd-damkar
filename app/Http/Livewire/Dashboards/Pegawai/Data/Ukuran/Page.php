<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Ukuran;

use App\Models\ApdJenis;
use App\Models\UkuranPegawai;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{

    public $error_time_alert = null;

    public $data_detail_inputan = null;

    public $nama_pegawai = null;

    protected $listeners = [
        'lihatDetail'
    ];

    public function render()
    {
        return view('livewire.dashboards.pegawai.data.ukuran.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Data Ukuran Anggota']);
    }

    public function lihatDetail($value)
    {
        $this->error_time_alert = null;
        $this->data_detail_inputan = [];
        $this->nama_pegawai = null;

        try{



            $terinput = UkuranPegawai::where('id_pegawai',$value[0])->first();
            $this->nama_pegawai = $value[1];

            if(!is_null($terinput))
            {
                foreach($terinput->list_ukuran as $i=> $item)
                {
                    $this->data_detail_inputan[$i] = [
                        "index" => $i +1,
                        "nama" => ApdJenis::find($item["id_jenis"])->nama_jenis,
                        "ukuran" => $item["value"]
                    ];
                }
            }

            
            $this->dispatchBrowserEvent('tabel-ke-detail');

        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            $this->nama_pegawai = null;
            $this->data_detail_inputan = null;
            error_log('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat detail inputan anggota '.$e);
            Log::error('Page @ Dashboard Data Apd Anggota Pegawai '.$this->error_time_alert.' : Kesalahan saat mencoba melihat detail inputan anggota '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail. ref ('.$this->error_time_alert.')']);
        }
    }
}
