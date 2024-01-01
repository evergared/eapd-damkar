<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class FormBuatSatuTemplate extends Component
{

    public
    $formEditMode = false,
    $formIndex = "",

    $formJabatan = "",
    $formJabatan_id = "",
    $formJenisApd = "",
    $formJenisApd_id = "",
    $formApd = "",
    $formApd_id = "";

    public $listeners = [
        'inisiasiSatuTemplate',
        'ubahSatuValue'
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-buat-satu-template');
    }

    public function ubah($mode)
    {
        $id = null;
        switch($mode){
            case 'jabatan' : $id = $this->formJabatan_id;break;
            case 'jenis_apd' : $id = $this->formJenisApd_id ;break;
            case 'opsi_apd' : $id = $this->formApd_id ;break;
            default : return; break;
        }

        $this->emit('inisiasiModalUbahSatuTemplate',['mode'=>$mode, 'id' => $id]);
    }

    public function inisiasiSatuTemplate($args)
    {
        $editmode = $args[0];

        if($editmode)
        {
            $item = $args[1];
            $this->formIndex = $item['index'];

            $this->formJabatan = $item['nama_jabatan'];
            $this->formJabatan_id = $item['id_jabatan'];
            $this->formJenisApd = $item['nama_jenis'];
            $this->formJenisApd_id = $item['id_jenis'];
            $this->formApd = $item['nama_apd'];
            $this->formApd_id = $item['id_apd'];
        }
        else
        {
            $this->formIndex = "";

            $this->formJabatan = "";
            $this->formJabatan_id = "";
            $this->formJenisApd = "";
            $this->formJenisApd_id = "";
            $this->formApd = "";
            $this->formApd_id = "";
        }

        $this->formEditMode = $editmode;

        $this->dispatchBrowserEvent('ke_form_buat_satu_template');

    }

    public function kosongkan()
    {
        $this->formApd = "";
        $this->formApd_id = "";
        $this->formJabatan = "";
        $this->formJabatan_id = "";
        $this->formJenisApd = "";
        $this->formJenisApd_id = "";
    }

    public function simpan()
    {
        try {

            $this->dispatchBrowserEvent('jsToast', [
                "class" => 'bg-success',
                "title" => "Simpan Data Berhasil!",
                "subtitle" => "Form Buat Satu Template",
                "body" => "Data template berhasil disimpan."
            ]);
            
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('jsToast', [
                "class" => 'bg-danger',
                "title" => "Simpan Data Gagal!",
                "subtitle" => "Form Buat Satu Template",
                "body" => "Terjadi Kesalahan saat menyimpan data template."
            ]);
            error_log("Card Single Template Inputan Apd : Gagal dalam menyimpan " . $e);
        }
    }

    public function ubahSatuValue($val)
    {
        try{

            $mode = $val['mode'];

            switch($mode){
                case 'jabatan' : $this->formJabatan_id= $val['value']; $this->formJabatan = Jabatan::find($val['value'])->nama_jabatan; break;
                case 'jenis_apd' : $this->formJenisApd_id = $val['value']; $this->formJenisApd = ApdJenis::find($val['value'])->nama_jenis; break;
                case 'opsi_apd' : $this->formApd_id = $val['value']; $this->formApd = ApdList::find($val['value'])->nama_apd; break;
                default : return; break;
            }

        }
        catch(Throwable $e)
        {
            error_log('form buat satu template : gagal menerima value dari tabel '.$e);
            Log::error('Form Buat Satu Template @ Admin Dashboard Error : Kesalahan saat menerima satu value dari tabel at ubahSatuValue() '.$e);
        }
        
    }
}
