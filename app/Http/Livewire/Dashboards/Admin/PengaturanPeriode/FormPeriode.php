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
        $formEditMode = false,
        $formEditId = false,

        $formIdPeriode = "",
        $formNamaPeriode = "",
        $formTglAwal = "",
        $formTglAkhir = "",
        $formPesanBerjalan = "",
        $formAktif = false,
        $formKumpulUkuran = false,        
        $formKumpulRekap = false,
        $formIdPeriode_cache = "",
        $formNamaPeriode_cache = "",
        $formTglAwal_cache = "",
        $formTglAkhir_cache = "",
        $formPesanBerjalan_cache = "",
        $formAktif_cache = false,        
        $formKumpulUkuran_cache = false,        
        $formKumpulRekap_cache = false;

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

            $this->formEditMode = true;

            $this->formIdPeriode = $this->formIdPeriode_cache = $periode->id_periode;
            $this->formNamaPeriode = $this->formNamaPeriode_cache = $periode->nama_periode;
            $this->formTglAwal = $this->formTglAwal_cache = $periode->tgl_awal;
            $this->formTglAkhir = $this->formTglAkhir_cache = $periode->tgl_akhir;
            $this->formPesanBerjalan = $this->formPesanBerjalan_cache = $periode->pesan_berjalan;
            $this->formAktif = $this->formAktif_cache = $periode->aktif;
            $this->formKumpulRekap = $this->formKumpulRekap_cache = $periode->kumpul_rekap;
            $this->formKumpulUkuran = $this->formKumpulUkuran_cache = $periode->kumpul_ukuran;

            $this->dispatchBrowserEvent("card_detail_periode_tampil");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam melihat detil periode " . $e);
        }
    }

    public function buatPeriodeBaru()
    {
        $this->formEditMode = false;

        $this->formIdPeriode = $this->formIdPeriode_cache = "";
        $this->formNamaPeriode = $this->formNamaPeriode_cache = "";
        $this->formTglAwal = $this->formTglAwal_cache = "";
        $this->formTglAkhir = $this->formTglAkhir_cache = "";
        $this->formPesanBerjalan = $this->formPesanBerjalan_cache = "";
        $this->formAktif = $this->formAktif_cache = false;
        $this->formKumpulRekap = $this->formKumpulRekap_cache = false;
        $this->formKumpulUkuran = $this->formKumpulUkuran_cache = false;

        $this->dispatchBrowserEvent("card_detail_periode_tampil");
    }

    public function CardFormPeriodeAturTemplateInputanApd()
    {
        if($this->formEditMode)
            $this->emit('inisiasiTabelTemplate',$this->formIdPeriode);
        else
            $this->emit('inisiasiTabelTemplate',null);

        $this->dispatchBrowserEvent('hideFormPeriode');
        $this->dispatchBrowserEvent('tampilTabelTemplate');
    }

    public function CardFormPeriodeSimpan()
    {
        try {

            if ($this->formEditMode)
                $periode = PeriodeInputApd::find($this->formIdPeriode_cache);
            else
                $periode = new PeriodeInputApd;

            if ($this->formIdPeriode != "" || $this->formIdPeriode != $this->formIdPeriode_cache)
                $periode->id_periode = $this->formIdPeriode;

            $periode->nama_periode = $this->formNamaPeriode;
            $periode->tgl_awal = $this->formTglAwal;
            $periode->tgl_akhir = $this->formTglAkhir;
            $periode->pesan_berjalan = $this->formPesanBerjalan;
            $periode->aktif = $this->formAktif;
            $periode->kumpul_rekap = $this->formKumpulRekap;
            $periode->kumpul_ukuran = $this->formKumpulUkuran;

            $periode->save();

            // jika aktif, nonaktifkan semua entry kecuali periode yang baru disimpan
            if ($this->formAktif)
                PeriodeInputApd::where('id_periode', '!=', $periode->id_periode)->where('aktif', true)->update(['aktif' => false]);


            if ($input = InputApdTemplate::where('id_periode', $this->formIdPeriode)->get()->first()) {
                if (count($this->tabel_template_data_original) > 0)
                    if (!($this->tabel_template_data_original === $this->tabel_template_data_original_cache)) {
                        $pic = new PeriodeInputController;
                        $input->template = $pic->ubahDatasetArrayTemplateKeTemplate($pic->ubahDataTabelTemplateKeDataset($this->tabel_template_data_original));
                        $input->save();
                    }

                if ($periode->id_periode != $input->id_periode) {
                    $input->id_periode = $periode->id_periode;
                    $input->save();
                }
            } else {
                $newTemplate = new InputApdTemplate;
                $newTemplate->nama = 'template inputan ' . $this->formNamaPeriode;
                $newTemplate->id_periode = $periode->id_periode;
                if (count($this->tabel_template_data_original) > 0) {
                    $pic = new PeriodeInputController;
                    $newTemplate->template = $pic->ubahDatasetArrayTemplateKeTemplate($pic->ubahDataTabelTemplateKeDataset($this->tabel_template_data_original));
                } else
                    $newTemplate->template = [];
                $newTemplate->save();
            }

            $this->dispatchBrowserEvent('jsToast',[
                "class"=>'bg-success',
                "title"=>"Berhasil Simpan Data Periode!",
                "subtitle"=>"Form Periode",
                "body"=>"Data periode ".$this->formNamaPeriode." berhasil disimpan ke database!"
            ]);

        } catch (Throwable $e) {
            error_log("Card Form Periode : Gagal dalam menyimpan periode " . $e);
            $this->dispatchBrowserEvent('jsToast',[
                "class"=>'bg-danger',
                "title"=>"Gagal Simpan Data Periode!",
                "subtitle"=>"Form Periode",
                "body"=>"Data periode ".$this->formNamaPeriode." gagal disimpan!"
            ]);
        }
    }

    public function CardFormPeriodeReset()
    {
        $this->formIdPeriode = $this->formIdPeriode_cache;
        $this->formNamaPeriode = $this->formNamaPeriode_cache;
        $this->formTglAwal = $this->formTglAwal_cache;
        $this->formTglAkhir = $this->formTglAkhir_cache;
        $this->formPesanBerjalan = $this->formPesanBerjalan_cache;
        $this->formAktif = $this->formAktif_cache;
        $this->formKumpulRekap = $this->formKumpulRekap_cache;
        $this->formKumpulUkuran = $this->formKumpulUkuran_cache;
        
    }

}
