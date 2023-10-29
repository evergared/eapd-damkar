<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use App\Models\ApdList;
use App\Models\ApdSize;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class FormSize extends Component
{

    public $error_form = null;

    public $editing = false;

    public 
        $model_id_size = null,
        $model_nama_size = null,
        $model_opsi_size = [],
        $jumlah_apd = 0;

    protected $listeners = [
        "editSize",
        "buatSize"
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-barang.apd.form-size');
    }

    public function editSize($id)
    {
        $this->error_form = null;
        $this->editing = true;
        try{

            $Size = ApdSize::find($id);
            $this->model_id_size = $Size->id_Size;
            $this->model_nama_size = $Size->nama_Size;
            $this->model_opsi_size = $Size->opsi;
            $this->jumlah_apd = ApdList::where('id_size',$this->model_id_size)->count();

        }
        catch(Throwable $e)
        {
            $this->error_form = now();
            error_log('Form Size Barang @ Pengaturan Size Barang Dashboards Admin error ref ('.$this->error_form.') : Kesalahan saat melakukan inisiasi data untuk edit Size apd '.$e);
            Log::error('Form Size Barang @ Pengaturan Size Barang Dashboards Admin error ref ('.$this->error_form.') : Kesalahan saat melakukan inisiasi data untuk edit Size apd '.$e);
            session()->flash('overlay-error', 'Kesalahan saat inisiasi data. ref ('.$this->error_form.')');
        }
    }

    public function buatSize()
    {
        $this->editing = false;
        $this->model_id_size = null;
        $this->model_nama_size = null;
        $this->error_form = null;
        $this->model_opsi_size = [];
        $this->dispatchBrowserEvent('kendali-ke-form-size');
    }

    public function simpan()
    {
        try{

            if($this->editing)
            {
                $Size = ApdSize::find($this->model_id_size);
            
                $Size->nama_size = $this->model_nama_size;
                $Size->opsi = $this->model_opsi_size;
            }
            else
            {
                $Size = new ApdSize;

                $Size->id_size = $this->model_id_size;
                $Size->opsi = $this->model_opsi_size;
                $Size->nama_size = $this->model_nama_size;
            }

            $Size->save();
            session()->flash('alert-success-size',"Berhasil menyimpan data.");

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Form Size Barang @ Pengaturan Size Barang Dashboards Admin error ref ('.$time.') : Kesalahan saat menyimpan data Size apd '.$e);
            Log::error('Form Size Barang @ Pengaturan Size Barang Dashboards Admin error ref ('.$time.') : Kesalahan saat menyimpan data Size apd '.$e);
            session()->flash('alert-error-size',"Gagal menyimpan data. ref : ".$time);
        }
    }
}
