<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use Livewire\Component;

class LayoutProgressInputanSudinAdminSudinHalLaporanSektor extends Component
{

    public $data_semua_sektor = [];

    public 
        $id_detail_pos = "",
        $data_detail_pos = [];

    public $listeners = [
        'refreshDataKomponen',
        'inputSudin'
    ];

    #region livewire lifecycle
    public function render()
    {
        return view('eapd.livewire.layout.layout-progress-inputan-sudin-admin-sudin-hal-laporan-sektor');
    }

    public function mount()
    {
        $this->muatDataInputanSudin();
    }
    #endregion

    #region listener handler 
    public function refreshDataKomponen()
    {
        $this->muatDataInputanSudin();
        if($this->id_detail_pos != "")
            $this->muatDataInputanPos();
    }

    public function inputSudin($value)
    {
        error_log('inputan sudin');
        $this->id_detail_pos = $value;
        $this->muatDataInputanPos();
    }
    #endregion

    #region click handler
    public function ModalProgresSudin()
    {
        $this->dispatchBrowserEvent('ModalProgresSudin');
    }
    #endregion

    public function muatDataInputanSudin()
    {
        $adc = new ApdDataController;
        $this->data_semua_sektor = $adc->muatDataInputanSudin();
    }

    public function muatDataInputanPos()
    {
        $adc = new ApdDataController;
        $this->data_detail_pos = $adc->muatDataInputanPos($this->id_detail_pos,$adc->ambilIdPeriodeInput());
    }
}
