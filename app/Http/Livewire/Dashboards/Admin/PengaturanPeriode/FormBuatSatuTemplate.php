<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use Livewire\Component;
use Throwable;

class FormBuatSatuTemplate extends Component
{

    public
    $card_single_template_inputan_apd_formEditMode = false,
    $card_single_template_inputan_apd_formIndex = "",

    $card_single_template_inputan_apd_formJabatan = "",
    $card_single_template_inputan_apd_formJabatan_id = "",
    $card_single_template_inputan_apd_formJenisApd = "",
    $card_single_template_inputan_apd_formJenisApd_id = "",
    $card_single_template_inputan_apd_formApd = "",
    $card_single_template_inputan_apd_formApd_id = "";

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-buat-satu-template');
    }

    public function CardSingleTemplateInputanApdOpsiApdUbah()
    {
        $this->emit('inisiasiModalSatuTemplate',['mode'=>'opsi_apd', 'id_jenis' => $this->card_single_template_inputan_apd_formJenisApd_id]);
    }

    public function CardSingleTemplateInputanApdKosongkan()
    {
        $this->card_single_template_inputan_apd_formApd = "";
        $this->card_single_template_inputan_apd_formApd_id = "";
        $this->card_single_template_inputan_apd_formJabatan = "";
        $this->card_single_template_inputan_apd_formJabatan_id = "";
        $this->card_single_template_inputan_apd_formJenisApd = "";
        $this->card_single_template_inputan_apd_formJenisApd_id = "";
    }

    public function CardSingleTemplateInputanApdSimpan()
    {
        try {

            $pic = new PeriodeInputController;

            $new_data = [
                "id_jabatan" => $this->card_single_template_inputan_apd_formJabatan_id,
                "id_jenis" =>  $this->card_single_template_inputan_apd_formJenisApd_id,
                "id_apd" => $this->card_single_template_inputan_apd_formApd_id
            ];
            $new_data = $pic->bangunDataTabelTemplateDariDataset(array($new_data));


            if ($this->card_single_template_inputan_apd_formEditMode) {
                // dd($new_data[0]);

                $this->tabel_template_data_original[array_search($this->card_single_template_inputan_apd_formIndex, array_column($this->tabel_template_data_original, 'index'))]
                    = [
                        "index" => $this->card_single_template_inputan_apd_formIndex,
                        "jabatan" => $new_data[0]["jabatan"],
                        "jenis_apd" => $new_data[0]["jenis_apd"],
                        "opsi_apd" => $new_data[0]["opsi_apd"]
                    ];
            } else {
                $new_data[0]["index"] = count($this->tabel_template_data_original) + 1;
                $this->tabel_template_data_original[count($this->tabel_template_data_original)] = $new_data[0];
            }

            $this->RefreshTabelTemplate();
            session()->flash("card_template_single_success", "Berhasil menambahkan data!");
        } catch (Throwable $e) {
            session()->flash("card_template_single_danger", "Gagal menambahkan data!");
            error_log("Card Single Template Inputan Apd : Gagal dalam menyimpan " . $e);
        }
    }
}
