<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\InputApdTemplate;
use App\Models\Jabatan;
use App\Models\PeriodeInputApd;
use Illuminate\Support\Str;
use Throwable;
use Livewire\Component;

class Page1 extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Periode Input APD"]);
    }

    // variabel untuk card single template inputan apd


    // variabel untuk card multi template inputan apd


    // variabel untuk modal ubah single template inputan apd


    // variabel untuk modal ubah multi template inputan apd
    public
        $modal_ubah_multi_inputan_apd_mode = "";


    protected $listeners = [
        // card list periode
        'TabelListPeriodeClone',
        'TabelListPeriodeTesPesanBerjalan',
        'TabelListPeriodeAktifkanKumpulRekap',
        'TabelListPeriodeAktifkanKumpulUkuran',
        'TabelListPeriodeAktifkan',
        'TabelListPeriodeNonAktifkanKumpulRekap',
        'TabelListPeriodeNonAktifkanKumpulUkuran',
        'TabelListPeriodeNonAktifkan',
        'TabelListPeriodeDetil',
        'TabelListPeriodeHapus',

        // card multi template inputan apd
        'CardMultiTemplateTerimaJabatan',
        'CardMultiTemplateTerimaJenisApd',
        'CardMultiTemplateTerimaApd',

        // modal ubah single template inputan apd
        'TabelJabatanTemplateSinglePilih',
        'TabelApdTemplateSinglePilih',
        'TabelJenisApdTemplateSinglePilih',
    ];

    #region livewire function
    public function mount()
    {
        $pic = new PeriodeInputController;
        // $this->card_form_periode_formIdPeriode_cache = $pic->ambilIdPeriodeInput();
        // $this->InisiasiTabelTemplate();
    }
    #endregion

    #region card list periode

    #endregion

    #region card form periode

    #endregion


    public function CardTabelInputanApdSimpan()
    {
        try {

            if ($this->card_form_periode_formEditMode) {
                $template_inputan = InputApdTemplate::where('id_periode', $this->card_form_periode_formIdPeriode_cache)->get()->first();

                $pic = new PeriodeInputController;

                $template_inputan->template = $pic->ubahDatasetArrayTemplateKeTemplate($pic->ubahDataTabelTemplateKeDataset($this->tabel_template_data_original));

                $template_inputan->save();

                $this->InisiasiTabelTemplate();

                error_log('Card Tabel Inputan APD : Berhasil menyimpan data');
            }

            session()->flash("tabel_inputan_apd_success", "Data berhasil disimpan! Pastikan anda menyimpan periode untuk menerapkan perubahan.");
        } catch (Throwable $e) {
            error_log('Card Tabel Inputan APD : Gagal menyimpan data array template ke database ' . $e);
            session()->flash("tabel_inputan_apd_danger", "Data berhasil disimpan!");
        }
    }

    public function CardTabelInputanApdReset()
    {
        $this->tabel_template_data_original = $this->tabel_template_data_original_cache;
    }

    public function CardTabelInputanApdKosongkan()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original = [];
    }




    #region modal ubah multi template inputan apd
    public function ModalUbahMultiTemplateInputanApdSimpan()
    {
        switch ($this->modal_ubah_multi_inputan_apd_mode) {
            case "jabatan":
                $this->emit('TabelJabatanTemplateMultiPilih');
                break;
            case "jenis_apd":
                $this->emit('TabelJenisApdTemplateMultiPilih');
                break;
            case "opsi_apd":
                $this->emit('TabelApdTemplateMultiPilih');
                break;
            default:
                return;
                break;
        }
    }
    #endregion

}
