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

class Page extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Pengaturan Periode Input APD"]);
    }


    // variabel untuk card tabel inputan apd
    public
        $tabel_template_data = [],
        $tabel_template_data_cache = [],
        $tabel_template_data_original = [],
        $tabel_template_data_original_cache = [],
        $tabel_template_pageCurrent = 1,
        $tabel_template_pageTotal = 0,
        $tabel_template_toolsCari = "",
        $tabel_template_toolsCari_column = "jabatan",
        $tabel_template_toolsCari_column_option = [
            ['text' => 'Jabatan', 'value' => 'jabatan'],
            ['text' => 'Jenis APD', 'value' => 'jenis_apd'],
            ['text' => 'APD', 'value' => 'opsi_apd'],
            ['text' => 'No', 'value' => 'index'],
        ],
        $tabel_template_toolsCari_init = false,
        $tabel_template_toolsPerPage = 5,
        $tabel_template_toolsPerPage_showLimit = 5,
        $tabel_template_toolsPerPage_option = [5, 10, 25, 50, 100, 0],
        $tabel_template_toolsSort_column = "",
        $tabel_template_toolsSort_order = "asc";

    // variabel untuk card single template inputan apd


    // variabel untuk card multi template inputan apd
    public
        $card_multi_template_inputan_apd_listJabatan = [],
        $card_multi_template_inputan_apd_listJenisApd = [],
        $card_multi_template_inputan_apd_listApd = [];

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

        // card tabel inputan apd
        'TabelTemplateEdit',
        'TabelTemplateHapus',

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
    public function TabelListPeriodeClone($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode', $value)->get()->first();

            $newPeriode = new PeriodeInputApd;
            $newPeriode->nama_periode = "salinan " . $periode->nama_periode;
            $newPeriode->tgl_awal = $periode->tgl_awal;
            $newPeriode->tgl_akhir = $periode->tgl_akhir;
            $newPeriode->pesan_berjalan = $periode->pesan_berjalan;
            $newPeriode->aktif = false;
            $newPeriode->save();

            $newTemplate = new InputApdTemplate;
            $newTemplate->nama = 'template inputan ' . $newPeriode->nama_periode;
            $newTemplate->id_periode = $newPeriode->id_periode;
            $newTemplate->template = $template->template;
            $newTemplate->save();

            $this->emit("RefreshTabelListPeriode");
            session()->flash("card_list_periode_success", "Berhasil menggandakan periode! Tunggu sesaat untuk melihat hasil.");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam cloning periode " . $e);
            session()->flash("card_list_periode_danger", "Gagal menggandakan periode!");
        }
    }

    public function TabelListPeriodeTesPesanBerjalan($value)
    {
        try {

            if ($pesan = PeriodeInputApd::find($value)->pesan_berjalan)
                $this->emitTo('eapd.layout.layout-marquee-pengumuman-berjalan', 'TerimaPesanTes', $pesan);
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengetes pesan periode " . $e);
        }
    }

    public function TabelListPeriodeAktifkan($value)
    {
        try {

            PeriodeInputApd::where("aktif", true)->update(['aktif' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = true;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeAktifkanKumpulUkuran($value)
    {
        try {

            PeriodeInputApd::where("kumpul_ukuran", true)->update(['kumpul_ukuran' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_ukuran = true;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeAktifkanKumpulRekap($value)
    {
        try {

            PeriodeInputApd::where("kumpul_rekap", true)->update(['kumpul_rekap' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_rekap = true;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeNonAktifkan($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = false;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeNonAktifkanKumpulUkuran($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_ukuran = false;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeNonAktifkanKumpulRekap($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_rekap = false;
            $periode->save();
            $this->emit("RefreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function TabelListPeriodeDetil($value)
    {
        $this->emit('editPeriode',$value);
    }

    public function TabelListPeriodeHapus($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode', $value)->get()->first();

            $periode->delete();
            $template->delete();
            $this->emit("RefreshTabelListPeriode");
            session()->flash("card_list_periode_success", "Berhasil menghapus periode yang dipilih.");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam menghapus periode " . $e);
            session()->flash("card_list_periode_danger", "Gagal menghapus periode yang dipilih.");
        }
    }

    public function CardListPeriodeBuatPeriodeBaru()
    {
        $this->emit('buatPeriodeBaru');
    }
    #endregion

    #region card form periode
    
    #endregion

    #region card tabel inputan apd function
    public function InisiasiTabelTemplate()
    {
        // ini mengambil dari database

        if ($this->card_form_periode_formIdPeriode_cache != "") {
            $pic = new PeriodeInputController;
            $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original = $this->tabel_template_data_original_cache = $pic->bangunDataTabelTemplateDariDataset($pic->muatTemplateSebagaiTabelDatasetArray($this->card_form_periode_formIdPeriode_cache));
            $this->TabelTemplatePerPageChange();
        } else {
            $this->tabel_template_data = [];
            $this->tabel_template_data_cache = [];
            $this->tabel_template_data_original = $this->tabel_template_data_original_cache = [];
        }
    }

    public function RereshTabelTemplate()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original;
        $this->TabelTemplatePerPageChange();
    }

    public function RefreshTabelTemplate()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = $this->tabel_template_data_original;
        $this->TabelTemplatePerPageChange();
    }

    public function TabelTemplateCari()
    {
        $this->tabel_template_data = $this->tabel_template_data_cache = array_filter($this->tabel_template_data_cache, function ($data) {
            return is_int(mb_stripos($data[$this->tabel_template_toolsCari_column], $this->tabel_template_toolsCari));
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

        if ($this->tabel_template_toolsPerPage != 0) {
            $temp_pageCurrent = $this->tabel_template_pageCurrent;
            $this->tabel_template_pageCurrent = 1;
            $this->tabel_template_data = array_slice($this->tabel_template_data_cache, ($this->tabel_template_pageCurrent - 1) * $this->tabel_template_toolsPerPage, $this->tabel_template_toolsPerPage);

            $this->TabelTemplatePaginate();
        }
    }

    public function TabelTemplatePaginate()
    {
        $this->tabel_template_pageTotal = ceil(count($this->tabel_template_data_cache) / $this->tabel_template_toolsPerPage);

        error_log('paginate : ' . $this->tabel_template_pageTotal);
    }

    public function TabelTemplatePageNavigate($value)
    {
        if ($value == 'max')
            $this->tabel_template_pageCurrent = $this->tabel_template_pageTotal;
        elseif ($value == 'min')
            $this->tabel_template_pageCurrent = 1;
        else
            $this->tabel_template_pageCurrent = $value;

        $this->tabel_template_data = array_slice($this->tabel_template_data_cache, ($this->tabel_template_pageCurrent - 1) * $this->tabel_template_toolsPerPage, $this->tabel_template_toolsPerPage);
    }

    public function TabelTemplateSortirKolom($value)
    {
        if ($this->tabel_template_toolsSort_column != $value) {
            $this->tabel_template_toolsSort_order = 'asc';
            $this->tabel_template_toolsSort_column = $value;
        } else {
            if ($this->tabel_template_toolsSort_order == '')
                $this->tabel_template_toolsSort_order = 'asc';
            elseif ($this->tabel_template_toolsSort_order == 'asc')
                $this->tabel_template_toolsSort_order = 'desc';
            elseif ($this->tabel_template_toolsSort_order == 'desc')
                $this->tabel_template_toolsSort_order == '';
        }

        $sorted_column = array_column($this->tabel_template_data_cache, $this->tabel_template_toolsSort_column);

        if ($this->tabel_template_toolsSort_order == 'asc') {
            array_multisort($sorted_column, SORT_ASC, $this->tabel_template_data_cache);
            $this->tabel_template_data = $this->tabel_template_data_cache;
        } elseif ($this->tabel_template_toolsSort_order == 'desc') {
            array_multisort($sorted_column, SORT_DESC, $this->tabel_template_data_cache);
            $this->tabel_template_data = $this->tabel_template_data_cache;
        } else {
            $this->tabel_template_data_cache = $this->tabel_template_data_original;
            $this->tabel_template_data = $this->tabel_template_data_cache;
            $this->tabel_template_toolsSort_column = '';
        }

        $this->TabelTemplatePerPageChange();
    }

    public function TabelTemplateEdit($value)
    {
        $index = array_search($value, array_column($this->tabel_template_data_original, 'index'));
        $data = $this->tabel_template_data_original[$index];
        $this->card_single_template_inputan_apd_formIndex = $value;
        $this->card_single_template_inputan_apd_formJabatan = Str::after($data['jabatan'], "] ");
        $this->card_single_template_inputan_apd_formJabatan_id = Str::between($data['jabatan'], "[", "]");
        $this->card_single_template_inputan_apd_formJenisApd = Str::after($data['jenis_apd'], "] ");
        $this->card_single_template_inputan_apd_formJenisApd_id = Str::between($data['jenis_apd'], "[", "]");
        $this->card_single_template_inputan_apd_formApd = Str::after($data['opsi_apd'], "] ");
        $this->card_single_template_inputan_apd_formApd_id = Str::between($data['opsi_apd'], "[", "]");

        $this->card_single_template_inputan_apd_formEditMode = true;
        $this->dispatchBrowserEvent("JS_TabelTemplateEdit");
    }

    public function TabelTemplateHapus($value)
    {
        $current_index = array_search($value, array_column($this->tabel_template_data_original, 'index'));
        array_splice($this->tabel_template_data_original, $current_index, 1);
        $this->tabel_template_data_cache = $this->tabel_template_data_original;
        $this->TabelTemplatePerPageChange();
    }

    

    public function CardTabelInputanApdTambahSatu()
    {
        $this->card_single_template_inputan_apd_formEditMode = false;
        $this->CardSingleTemplateInputanApdKosongkan();
        $this->dispatchBrowserEvent("card_single_template_inputan_apd_tampil");
    }

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
    #endregion

    #region card multi template inputan apd
    
    #endregion

    #region modal ubah single template inputan apd
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
