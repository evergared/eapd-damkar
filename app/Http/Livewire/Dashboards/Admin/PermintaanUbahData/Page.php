<?php

namespace App\Http\Livewire\Dashboards\Admin\PermintaanUbahData;

use App\Http\Controllers\PeriodeInputController;
use Livewire\Component;

class Page extends Component
{

    public $id_periode = null;

    #region livewire
    public function render()
    {
        return view('livewire.dashboards.admin.permintaan-ubah-data.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Permintaan Perubahan Data Setelah Verifikasi"]);
    }
    public function mount()
    {
        $pic = new PeriodeInputController;
        $this->id_periode = $pic->ambilIdPeriodeInput();
        $this->emit('tabelGantiPeriode',$this->id_periode);
    }
    #endregion
}
