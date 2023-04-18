<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Mongodb\Wilayah;
use Livewire\Component;

class LayoutProgressInputanSudinAdminSudinHalLaporanSektor extends Component
{

    public
        $wilayah_yang_ditampilkan = "",
        $list_sudin = [];

    public $data_semua_sektor = [];

    public 
        $id_detail_pos = "",
        $data_detail_pos = [];

    public $listeners = [
        'refreshDataKomponenGlobal' => 'refreshDataKomponen', // untuk handle event global
        'refreshDataKomponenLokal' => 'refreshDataKomponen',
        'inputSudin'
    ];

    #region livewire lifecycle
    public function render()
    {
        return view('eapd.livewire.layout.layout-progress-inputan-dinas-admin-dinas-hal-laporan-sektor');
    }

    public function mount()
    {
        $this->muatListSudin();
    }
    #endregion

    #region listener handler 
    public function refreshDataKomponen()
    {
        $this->muatDataInputanSudin();
        if($this->id_detail_pos != "")
            $this->muatDataInputanPos();
    }

    public function aksiSudin($value)
    {
        error_log('inputan sudin');
        $this->id_detail_pos = $value;
        $this->muatDataInputanPos();
        $this->dispatchBrowserEvent('tampilAksiSudin');
    }
    #endregion

    #region click handler
    public function ModalProgresSudin()
    {
        $this->dispatchBrowserEvent('ModalProgresSudin');
    }
    #endregion

    public function muatListSudin()
    {
        $wilayah = Wilayah::where("id_provinsi","1")->get();
        $this->list_sudin = [];
        $this->wilayah_yang_ditampilkan = "";
        foreach($wilayah as $wil)
        {
            array_push($this->list_sudin,["value" => $wil->id,"text" => $wil->nama_wilayah]);
        }
    }

    public function muatDataInputanSudin()
    {
        $adc = new ApdDataController;
        $this->data_semua_sektor = [];
        $this->data_semua_sektor = $adc->muatDataInputanSudin("",$this->wilayah_yang_ditampilkan);
    }

    public function muatDataInputanPos()
    {
        $adc = new ApdDataController;
        $this->data_detail_pos = [];
        $this->data_detail_pos = $adc->muatDataInputanPos($this->id_detail_pos,$adc->ambilIdPeriodeInput());
    }
}
