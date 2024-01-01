<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class ModalUbahSatuTemplate extends Component
{

    public
        $mode = "";

    protected $listeners = [
        'inisiasiModalUbahSatuTemplate'
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.modal-ubah-satu-template');
    }

    public function insiasiModalUbahSatuTemplate($args)
    {
        $this->mode = $args['mode'];
        $this->emit("RefreshTabelSatu", $args);
        $this->dispatchBrowserEvent('panggilModalSatuTemplate');
    }

    public function TabelJabatanTemplateSinglePilih($value)
    {
        try {
            error_log('jabatan telah dipilih');
            $this->card_single_template_inputan_apd_formJabatan_id = $value;
            $this->card_single_template_inputan_apd_formJabatan = Jabatan::find($value)->nama_jabatan;
        } catch (Throwable $e) {
            error_log("Modal Ubah Single Template Inputan Apd : Gagal dalam menambahkan jabatan " . $e);
            $this->card_single_template_inputan_apd_formJabatan = "";
            $this->card_single_template_inputan_apd_formJabatan_id = "";
        }
    }

    public function TabelJenisApdTemplateSinglePilih($value)
    {
        try {
            error_log('jenis apd telah dipilih ' . $value);
            $this->card_single_template_inputan_apd_formJenisApd_id = $value;
            $this->card_single_template_inputan_apd_formJenisApd = ApdJenis::find($value)->nama_jenis;
            $this->card_single_template_inputan_apd_formApd = "";
            $this->card_single_template_inputan_apd_formApd_id = "";
        } catch (Throwable $e) {
            error_log("Modal Ubah Single Template Inputan Apd : Gagal dalam menambahkan jenis apd " . $e);
            $this->card_single_template_inputan_apd_formJenisApd = "";
            $this->card_single_template_inputan_apd_formJenisApd_id = "";
        }
    }

    public function TabelApdTemplateSinglePilih($value)
    {
        try {
            error_log("apd telah dipilih");
            $this->card_single_template_inputan_apd_formApd_id = $value;
            $this->card_single_template_inputan_apd_formApd = ApdList::find($value)->nama_apd;
        } catch (Throwable $e) {
            error_log("Modal Ubah Single Template Inputan Apd : Gagal dalam menambahkan apd " . $e);
            $this->card_single_template_inputan_apd_formApd = "";
            $this->card_single_template_inputan_apd_formApd_id = "";
        }
    }
    #endregion
}
