<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\JenisBarang;

use App\Models\ApdJenis;
use App\Models\ApdList;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class FormJenisBarang extends Component
{
    public $error_form = null;

    public $editing = false;

    public 
        $model_id_jenis = null,
        $model_nama_jenis = null,
        $jumlah_apd = 0;

    protected $listeners = [
        "editJenis",
        "buatJenis"
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-barang.jenis-barang.form-jenis-barang');
    }

    public function editJenis($id)
    {
        $this->error_form = null;
        $this->editing = true;
        try{

            $jenis = ApdJenis::find($id);
            $this->model_id_jenis = $jenis->id_jenis;
            $this->model_nama_jenis = $jenis->nama_jenis;
            $this->jumlah_apd = ApdList::where('id_jenis',$this->model_id_jenis)->count();

        }
        catch(Throwable $e)
        {
            $this->error_form = now();
            error_log('Form Jenis Barang @ Pengaturan Jenis Barang Dashboards Admin error ref ('.$this->error_form.') : Kesalahan saat melakukan inisiasi data untuk edit jenis apd '.$e);
            Log::error('Form Jenis Barang @ Pengaturan Jenis Barang Dashboards Admin error ref ('.$this->error_form.') : Kesalahan saat melakukan inisiasi data untuk edit jenis apd '.$e);
            session()->flash('overlay-error', 'Kesalahan saat inisiasi data. ref ('.$this->error_form.')');
        }
    }

    public function buatJenis()
    {
        $this->editing = false;
        $this->model_id_jenis = null;
        $this->model_nama_jenis = null;
    }

    public function simpan()
    {
        $this->validate([
            'model_id_jenis' => ['required','unique:apd_jenis,id_jenis'],
            'model_nama_jenis' => 'required'
        ],
        [
            'model_id_jenis.required' => "Id Jenis perlu diisi untuk referensi di database.",
            'model_id_jenis.unique' => "Id jenis ini sudah ada di database! Harap masukan id jenis baru.",
            'model_nama_jenis.required' => 'Nama Jenis APD perlu diisi.'

        ]);

        try{

            if($this->editing)
            {
                $jenis = ApdJenis::find($this->model_id_jenis);
            
                $jenis->nama_jenis = $this->model_nama_jenis;
            }
            else
            {
                $jenis = new ApdJenis;

                $jenis->id_jenis = $this->model_id_jenis;
                $jenis->nama_jenis = $this->model_nama_jenis;
            }

            $jenis->save();
            session()->flash('alert-success',"Berhasil menyimpan data.");

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Form Jenis Barang @ Pengaturan Jenis Barang Dashboards Admin error ref ('.$time.') : Kesalahan saat menyimpan data jenis apd '.$e);
            Log::error('Form Jenis Barang @ Pengaturan Jenis Barang Dashboards Admin error ref ('.$time.') : Kesalahan saat menyimpan data jenis apd '.$e);
            session()->flash('alert-error',"Gagal menyimpan data. ref : ".$time);
        }
    }

    
}
