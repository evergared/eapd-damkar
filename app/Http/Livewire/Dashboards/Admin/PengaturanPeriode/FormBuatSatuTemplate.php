<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApdTemplate;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class FormBuatSatuTemplate extends Component
{

    public
    $formEditMode = false,
    $formIndex = "",
    $id_periode = "",
    $formJabatan = "",
    $formJabatan_id = "",
    $formJenisApd = "",
    $formJenisApd_id = "",
    $formApd = "",
    $formApd_id = "";

    public
    $jabatanCek = false,
    $jenisCek = false,
    $jenisDuplikatCek = false,
    $opsiCek = false,
    $modeTimpa = 0;


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
        $this->id_periode = $args;

        $this->jabatanCek = false;
    $this->jenisCek = false;
    $this->jenisDuplikatCek = false;
    $this->opsiCek = false;
    $this->modeTimpa = 0;

            $this->formIndex = "";

            $this->formJabatan = "";
            $this->formJabatan_id = "";
            $this->formJenisApd = "";
            $this->formJenisApd_id = "";
            $this->formApd = "";
            $this->formApd_id = "";
        


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

    #region on change untuk input
    public function jabatanOnChange()
    {
        try{

            if($this->formJabatan_id == "")
                return;

            $cek = InputApdTemplate::where('id_periode',$this->id_periode)
                    ->where('id_jabatan',$this->formJabatan_id)
                    ->first();


            if(!is_null($cek))
                $this->jabatanCek = true;

        }
        catch(Throwable $e)
        {
            $this->jabatanCek = false;
        }
    }

    public function jenisApdOnChange()
    {
        try{

            if($this->formJenisApd_id == "")
                return;

            $template = InputApdTemplate::where('id_periode',$this->id_periode)
                ->where('id_jabatan',$this->formJabatan_id)
                ->first()->template;

            
            $cek = array_filter($template, function($val){
                return $val['id_jenis'] == $this->formJenisApd_id;                
            });

            $this->jenisCek = count($cek) > 0;
            $this->jenisDuplikatCek = count($cek) > 1;

        }
        catch(Throwable $e)
        {
            $this->jenisCek = false;
            $this->jenisDuplikatCek = false;
        }
    }

    public function opsiApdOnChange()
    {
        
    }
    #endregion
}
