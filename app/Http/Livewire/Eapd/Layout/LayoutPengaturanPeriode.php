<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\PeriodeInputController;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Livewire\Component;

class LayoutPengaturanPeriode extends Component
{

    public $id_periode = "";
    public $tabel_template_data = [];

    #region livewire function
    public function render()
    {
        return view('eapd.livewire.layout.layout-pengaturan-periode');
    }

    public function mount()
    {
        $pic = new PeriodeInputController;
        $this->id_periode = $pic->ambilIdPeriodeInput();
        $this->inisiasiTabelTemplate();
    }
    #endregion

    #region card tabel inputan apd function
    public function inisiasiTabelTemplate()
    {
        $pic = new PeriodeInputController;
        $this->tabel_template_data = $pic->bangunDataTabelTemplateDariDataset($pic->muatTemplateSebagaiTabelDatasetArray($this->id_periode));
    }
    #endregion
}
