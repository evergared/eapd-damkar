<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use App\Models\InputApdTemplate;
use App\Models\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class FormPeriode extends Component
{

    public
        $card_form_periode_formEditMode = false,
        $card_form_periode_formEditId = false,

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

    protected
        $listeners = [
            'editPeriode',
            'buatPeriodeBaru',
        ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-periode');
    }

    public function editPeriode($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);

            $this->card_form_periode_formEditMode = true;

            $this->card_form_periode_formIdPeriode = $this->card_form_periode_formIdPeriode_cache = $periode->id_periode;
            $this->card_form_periode_formNamaPeriode = $this->card_form_periode_formNamaPeriode_cache = $periode->nama_periode;
            $this->card_form_periode_formTglAwal = $this->card_form_periode_formTglAwal_cache = $periode->tgl_awal;
            $this->card_form_periode_formTglAkhir = $this->card_form_periode_formTglAkhir_cache = $periode->tgl_akhir;
            $this->card_form_periode_formPesanBerjalan = $this->card_form_periode_formPesanBerjalan_cache = $periode->pesan_berjalan;
            $this->card_form_periode_formAktif = $this->card_form_periode_formAktif_cache = $periode->aktif;

            $this->dispatchBrowserEvent("card_detail_periode_tampil");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam melihat detil periode " . $e);
        }
    }

    public function buatPeriodeBaru()
    {
        $this->card_form_periode_formEditMode = false;

        $this->card_form_periode_formIdPeriode = $this->card_form_periode_formIdPeriode_cache = "";
        $this->card_form_periode_formNamaPeriode = $this->card_form_periode_formNamaPeriode_cache = "";
        $this->card_form_periode_formTglAwal = $this->card_form_periode_formTglAwal_cache = "";
        $this->card_form_periode_formTglAkhir = $this->card_form_periode_formTglAkhir_cache = "";
        $this->card_form_periode_formPesanBerjalan = $this->card_form_periode_formPesanBerjalan_cache = "";
        $this->card_form_periode_formAktif = $this->card_form_periode_formAktif_cache = false;

        $this->dispatchBrowserEvent("card_detail_periode_tampil");
    }

    public function CardFormPeriodeAturTemplateInputanApd()
    {
        $this->InisiasiTabelTemplate();
        $this->dispatchBrowserEvent("card_tabel_inputan_tampil");
    }

    public function CardFormPeriodeSimpan()
    {
        try {

            if ($this->card_form_periode_formEditMode)
                $periode = PeriodeInputApd::find($this->card_form_periode_formIdPeriode_cache);
            else
                $periode = new PeriodeInputApd;

            if ($this->card_form_periode_formIdPeriode != "" || $this->card_form_periode_formIdPeriode != $this->card_form_periode_formIdPeriode_cache)
                $periode->id = $this->card_form_periode_formIdPeriode;

            $periode->nama_periode = $this->card_form_periode_formNamaPeriode;
            $periode->tgl_awal = $this->card_form_periode_formTglAwal;
            $periode->tgl_akhir = $this->card_form_periode_formTglAkhir;
            $periode->pesan_berjalan = $this->card_form_periode_formPesanBerjalan;
            $periode->aktif = $this->card_form_periode_formAktif;

            $periode->save();

            // jika aktif, nonaktifkan semua entry kecuali periode yang baru disimpan
            if ($this->card_form_periode_formAktif)
                PeriodeInputApd::where('id_periode', '!=', $periode->id)->where('aktif', true)->update(['aktif' => false]);


            if ($input = InputApdTemplate::where('id_periode', $this->card_form_periode_formIdPeriode)->get()->first()) {
                if (count($this->tabel_template_data_original) > 0)
                    if (!($this->tabel_template_data_original === $this->tabel_template_data_original_cache)) {
                        $pic = new PeriodeInputController;
                        $input->template = $pic->ubahDatasetArrayTemplateKeTemplate($pic->ubahDataTabelTemplateKeDataset($this->tabel_template_data_original));
                        $input->save();
                    }

                if ($periode->id != $input->id_periode) {
                    $input->id_periode = $periode->id_periode;
                    $input->save();
                }
            } else {
                $newTemplate = new InputApdTemplate;
                $newTemplate->nama = 'template inputan ' . $this->card_form_periode_formNamaPeriode;
                $newTemplate->id_periode = $periode->id_periode;
                if (count($this->tabel_template_data_original) > 0) {
                    $pic = new PeriodeInputController;
                    $newTemplate->template = $pic->ubahDatasetArrayTemplateKeTemplate($pic->ubahDataTabelTemplateKeDataset($this->tabel_template_data_original));
                } else
                    $newTemplate->template = [];
                $newTemplate->save();
            }

            session()->flash("card_form_periode_success", "Data periode berhasil disimpan!");
        } catch (Throwable $e) {
            error_log("Card Form Periode : Gagal dalam menyimpan periode " . $e);
            session()->flash("card_form_periode_danger", "Data periode gagal disimpan!");
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

}
