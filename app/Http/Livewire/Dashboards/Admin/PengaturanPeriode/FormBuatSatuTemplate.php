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
    $opsiCek = false;

    public
    $radio1 = null,
    $radio2 = null,
    $tampilListDuplikat = false,
    $listJenisDuplikat = [];

    public
    $simpanEnabled = false;


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

        $this->kosongkan();

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

        $this->jabatanCek = false;
        $this->jenisCek = false;
        $this->jenisDuplikatCek = false;
        $this->opsiCek = false;

        $this->formIndex = "";

        $this->formJabatan = "";
        $this->formJabatan_id = "";
        $this->formJenisApd = "";
        $this->formJenisApd_id = "";
        $this->formApd = "";
        $this->formApd_id = "";
    
        $this->listJenisDuplikat = [
            ['index'=>'0','nama_jenis'=>'Sempak (opsi : a, bn, c)'],
            ['index'=>'2','nama_jenis'=>'Kalung (opsi : test, a, test)'],
            ['index'=>'6','nama_jenis'=>'Clurit (opsi : bece, be be, ee)'],
        ];

        $this->tampilListDuplikat = false;
        $this->radio1 = null;
        $this->radio2 = null;
    }

    public function simpan()
    {
        try {

            $target_template = InputApdTemplate::where('id_periode',$this->id_periode)
            ->where('id_jabatan',$this->formJabatan_id)
            ->first();

            $template = $target_template->template;

            if($this->radio1 == "0")
            {
                // 0 : tambahkan apd sebagai opsi baru pada jenis apd yang sudah ada
                
            }
            else if($this->radio1 == "1")
            {
                // 1 : buat perlu input baru untuk jenis apd dengan apd sebagai opsinya
            }
            else if($this->radio1 == "2")
            {
                // 2 : ganti opsi apd pada jenis apd dengan apd
            }

            $target_template->template = $template;
            $target_template->save();

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

            $this->jabatanCek = false;
            $this->jenisCek = false;
            $this->jenisDuplikatCek = false;
            $this->opsiCek = false;

            $this->listJenisDuplikat = [];

            $this->formJenisApd_id == "";
            $this->formJenisApd == "";
            $this->formOpsiApd_id == "";
            $this->formOpsiApd == "";

            $this->tampilListDuplikat = false;
            $this->radio1 = null;
            $this->radio2 = null;

            if($this->formJabatan_id == "" || ($this->id_periode == "" || is_null($this->id_periode)))
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

            $this->jenisCek = false;
            $this->jenisDuplikatCek = false;
            $this->opsiCek = false;

            $this->listJenisDuplikat = [];

            $this->formOpsiApd_id == "";
            $this->formOpsiApd == "";

            $this->tampilListDuplikat = false;
            $this->radio1 = null;
            $this->radio2 = null;

            if($this->formJenisApd_id == "" || ($this->id_periode == "" || is_null($this->id_periode)))
                return;

            $template = InputApdTemplate::where('id_periode',$this->id_periode)
                ->where('id_jabatan',$this->formJabatan_id)
                ->first()->template;

            
            $cek = array_filter($template, function($val){
                return $val['id_jenis'] == $this->formJenisApd_id;                
            });

            $this->jenisCek = count($cek) > 0;
            $this->jenisDuplikatCek = count($cek) > 1;

            foreach($cek as $c)
            {
                try{

                    $opsi = [];
                    foreach($c['opsi_apd'] as $o)
                        $opsi[] = ApdList::find($o)->nama_apd;
                    $this->listJenisDuplikat[] = ['index' => $c['index_duplikat'], 'nama_jenis' => ApdJenis::find($c['id_jenis'])->nama_jenis." (opsi : ".implode(",",$opsi).")"];

                }
                catch(Throwable $e)
                {
                    continue;
                }
            }
        }
        catch(Throwable $e)
        {
            $this->jenisCek = false;
            $this->jenisDuplikatCek = false;
        }
    }

    public function opsiApdOnChange()
    {
        try{
            $this->opsiCek = false;

            $this->tampilListDuplikat = false;
            $this->radio1 = null;
            $this->radio2 = null;

            if(($this->formOpsiApd_id == "" || $this->formJenisApd_id == "") || ($this->id_periode == "" || is_null($this->id_periode)))
            return;

            $template = InputApdTemplate::where('id_periode',$this->id_periode)
                ->where('id_jabatan',$this->formJabatan_id)
                ->first()->template;

            $cek = array_filter($template, function($val){
                if($val['id_jenis'] == $this->formJenisApd_id)
                    return in_array( $this->formApd_id, $val['opsi_apd']);
            });

            $this->opsiCek = count($cek) > 0;

        }
        catch(Throwable $e)
        {
            $this->opsiCek = false;
        }
    }
    #endregion

    #region on change untuk radio
    public function onChangeRadio1()
    {
        if($this->radio1 == 2 || $this->radio1 == 0)
            if($this->jenisDuplikatCek)
                $this->tampilListDuplikat = true;
    }
    public function onChangeRadio2()
    {
        
    }
    #endregion

}
