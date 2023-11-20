<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
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

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-buat-satu-template');
    }

    public function ubah()
    {
        $this->emit('inisiasiModalSatuTemplate',['mode'=>'opsi_apd', 'id_jenis' => $this->formJenisApd_id]);
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
}
