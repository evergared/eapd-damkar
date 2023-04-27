<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\PeriodeInputController;
use App\Models\Eapd\Mongodb\InputApdTemplate;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class LayoutPengaturanPeriode extends Component
{

    // variabel untuk card form periode
    public 
        $card_form_periode_formEditMode = false,

        $card_form_periode_formIdPeriode = "",
        $card_form_periode_formNamaPeriode = "",
        $card_form_periode_formTglAwal = "",
        $card_form_periode_formTglAkhir = "",
        $card_form_periode_formPesanBerjalan = "",
        $card_form_periode_formAktif = false,
        $card_form_periode_formIdPeriode_cache = "",
        $card_form_periode_formNamaPeriode_cache = "",
        $card_form_periode_formTglAwal_cache = "",
        $card_form_periode_formTglAkhir_cache = "",
        $card_form_periode_formPesanBerjalan_cache = "",
        $card_form_periode_formAktif_cache = false;

    // variabel untuk card tabel inputan apd
    public 
        $tabel_template_data = [],
        $tabel_template_data_cache = [],
        $tabel_template_data_original = [],
        $tabel_template_pageCurrent = 0,
        $tabel_template_pageTotal = 0,
        $tabel_template_toolsCari = "",
        $tabel_template_toolsCari_column = "jabatan",
        $tabel_template_toolsCari_column_option = [
            ['text'=>'Jabatan','value'=>'jabatan'],
            ['text'=>'Jenis APD','value'=>'jenis_apd'],
            ['text'=>'APD','value'=>'opsi_apd'],
            ['text'=>'No','value'=>'index'],
            ],
        $tabel_template_toolsCari_init = false,
        $tabel_template_toolsPerPage = 5,
        $tabel_template_toolsPerPage_option = [5,10,25,50,100,0],
        $tabel_template_toolsSort_column = "",
        $tabel_template_toolsSort_order = "asc";

    // variabel untuk card single template inputan apd
    public 
        $card_single_template_inputan_apd_formEditMode = false,

        $card_single_template_inputan_apd_formJabatan = "",
        $card_single_template_inputan_apd_formJenisApd = "",
        $card_single_template_inputan_apd_formApd = "";
    

    protected $listeners = [
        // card list periode
        'TabelListPeriodeClone',
        'TabelListPeriodeAktifkan',
        'TabelListPeriodeNonAktifkan',
        'TabelListPeriodeDetil',
        'TabelListPeriodeHapus',

        // card tabel inputan apd
        'TabelTemplateEdit',
        'TabelTemplateHapus'
    ];

    #region livewire function
    public function render()
    {
        return view('eapd.livewire.layout.layout-pengaturan-periode');
    }

    public function mount()
    {
        $pic = new PeriodeInputController;
        $this->card_form_periode_formIdPeriode_cache = $pic->ambilIdPeriodeInput();
        // $this->InisiasiTabelTemplate();
    }
    #endregion

    #region card list periode
    public function TabelListPeriodeClone($value)
    {
        try{

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode',$value)->get()->first();

            $newPeriode = new PeriodeInputApd;
            $newPeriode->nama_periode = "salinan ".$periode->nama_periode;
            $newPeriode->tgl_awal = $periode->tgl_awal;
            $newPeriode->tgl_akhir = $periode->tgl_akhir;
            $newPeriode->pesan_berjalan = $periode->pesan_berjalan;
            $newPeriode->aktif = false;
            $newPeriode->save();

            $newTemplate = new InputApdTemplate;
            $newTemplate->nama = 'template inputan '.$newPeriode->nama_periode;
            $newTemplate->id_periode = $newPeriode->id;
            $newTemplate->template = $template->template;
            $newTemplate->save();

            $this->emit("RefreshTabelListPeriode");

        }
        catch(Throwable $e)
        {
            error_log("Tabel List Periode : Gagal dalam cloning periode ".$e);
        }
    }

    public function TabelListPeriodeAktifkan($value)
    {
        try{

            PeriodeInputApd::where("aktif",true)->update(['aktif'=>false]);

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = true;
            $periode->save();   
            $this->emit("RefreshTabelListPeriode");
        }
        catch(Throwable $e)
        {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode ".$e);
        }
    }

    public function TabelListPeriodeNonAktifkan($value)
    {
        try{

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = false;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");

        }
        catch(Throwable $e)
        {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode ".$e);
        }
    }

    public function TabelListPeriodeDetil($value)
    {
        try{

            $periode = PeriodeInputApd::find($value);

            $this->card_form_periode_formEditMode = true;

            $this->card_form_periode_formIdPeriode = $this->card_form_periode_formIdPeriode_cache = $periode->id;
            $this->card_form_periode_formNamaPeriode = $this->card_form_periode_formNamaPeriode_cache = $periode->nama_periode;
            $this->card_form_periode_formTglAwal = $this->card_form_periode_formTglAwal_cache = $periode->tgl_awal;
            $this->card_form_periode_formTglAkhir = $this->card_form_periode_formTglAkhir_cache = $periode->tgl_akhir;
            $this->card_form_periode_formPesanBerjalan = $this->card_form_periode_formPesanBerjalan_cache = $periode->pesan_berjalan;
            $this->card_form_periode_formAktif = $this->card_form_periode_formAktif_cache = $periode->aktif;

        }
        catch(Throwable $e)
        {
            error_log("Tabel List Periode : Gagal dalam melihat detil periode ".$e);
        }
    }

    public function TabelListPeriodeHapus($value)
    {
        try{

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode',$value)->get()->first();

            $periode->delete();
            $template->delete();
            $this->emit("RefreshTabelListPeriode");

        }
        catch(Throwable $e)
        {
            error_log("Tabel List Periode : Gagal dalam menghapus periode ".$e);
        }
    }

    public function CardListPeriodeBuatPeriodeBaru()
    {
            $this->card_form_periode_formEditMode = false;
            
            $this->card_form_periode_formIdPeriode = $this->card_form_periode_formIdPeriode_cache = "";
            $this->card_form_periode_formNamaPeriode = $this->card_form_periode_formNamaPeriode_cache = "";
            $this->card_form_periode_formTglAwal = $this->card_form_periode_formTglAwal_cache = "";
            $this->card_form_periode_formTglAkhir = $this->card_form_periode_formTglAkhir_cache = "";
            $this->card_form_periode_formPesanBerjalan = $this->card_form_periode_formPesanBerjalan_cache = "";
            $this->card_form_periode_formAktif = $this->card_form_periode_formAktif_cache = false;
    }
    #endregion

    #region card form periode
    public function CardFormPeriodeAturTemplateInputanApd()
    {
            $this->InisiasiTabelTemplate();
    }

    public function CardFormPeriodeSimpan()
    {
        try{

        }
        catch(Throwable $e)
        {
            error_log("Card Form Periode : Gagal dalam menyimpan periode ".$e);
        }
    }

    public function CardFormPeriodeReset()
    {
            $this->card_form_periode_formIdPeriode = $this->card_form_periode_formIdPeriode_cache;
            $this->card_form_periode_formNamaPeriode = $this->card_form_periode_formNamaPeriode_cache;
            $this->card_form_periode_formTglAwal = $this->card_form_periode_formTglAwal_cache;
            $this->card_form_periode_formTglAkhir = $this->card_form_periode_formTglAkhir_cache;
            $this->card_form_periode_formPesanBerjalan = $this->card_form_periode_formPesanBerjalan_cache;
            $this->card_form_periode_formAktif = $this->card_form_periode_formAktif_cache;
    }
    #endregion

    #region card tabel inputan apd function
    public function InisiasiTabelTemplate()
    {
        if($this->card_form_periode_formIdPeriode_cache != "")
        {
            $pic = new PeriodeInputController;
            $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original = $pic->bangunDataTabelTemplateDariDataset($pic->muatTemplateSebagaiTabelDatasetArray($this->card_form_periode_formIdPeriode_cache));
            $this->TabelTemplatePerPageChange();
        }
        else
        {
            $this->tabel_template_data = [] ; $this->tabel_template_data_cache = [];
            $this->tabel_template_data_original = [];
        }
    }

    public function TabelTemplateCari()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = array_filter($this->tabel_template_data_cache,function($data){
            return is_int(mb_stripos($data[$this->tabel_template_toolsCari_column],$this->tabel_template_toolsCari));
        });
        $this->tabel_template_toolsCari_init = true;
        $this->TabelTemplatePerPageChange();
    }

    public function TabelTemplateCariReset()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original;
        $this->tabel_template_toolsCari_init = false;
    }

    public function TabelTemplatePerPageChange()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache;

        if($this->tabel_template_toolsPerPage != 0)
        {
            $this->tabel_template_data = array_slice($this->tabel_template_data,$this->tabel_template_pageCurrent,$this->tabel_template_toolsPerPage);

            $this->TabelTemplatePaginate();
        }
        
    }

    public function TabelTemplatePaginate()
    {
        $this->tabel_template_pageTotal = ceil(count($this->tabel_template_data_cache)/$this->tabel_template_toolsPerPage);

        error_log('paginate : '.$this->tabel_template_pageTotal);
    }

    public function TabelTemplatePageNavigate($value)
    {
        if($value == 'max')
            $this->tabel_template_pageCurrent = $value;

    }

    public function TabelTemplateSortirKolom($value)
    {
        if($this->tabel_template_toolsSort_column != $value)
        {
            $this->tabel_template_toolsSort_order = 'asc';
            $this->tabel_template_toolsSort_column = $value;
        }
        else
        {
            if($this->tabel_template_toolsSort_order == 'asc')
                $this->tabel_template_toolsSort_order = 'dsc';
            else
                $this->tabel_template_toolsSort_order = 'asc';
        }

        $sorted_column = array_column($this->tabel_template_data,$this->tabel_template_toolsSort_column);

        if($this->tabel_template_toolsSort_order == 'asc')
            array_multisort($sorted_column,SORT_ASC,$this->tabel_template_data);
        else
            array_multisort($sorted_column,SORT_DESC,$this->tabel_template_data);

    }

    public function TabelTemplateEdit($value)
    {
        error_log('message : '.$value);
        $this->dispatchBrowserEvent("JS_TabelTemplateEdit");

    }

    public function TabelTemplateHapus($value)
    {

    }

    public function CardTabelInputanApdTambahBanyak()
    {
    }

    public function CardTabelInputanApdTambahSatu()
    {
        $this->card_single_template_inputan_apd_formEditMode = false;

    }

    public function CardTabelInputanApdSimpan()
    {

    }

    public function CardTabelInputanApdKosongkan()
    {

    }
    #endregion
}
