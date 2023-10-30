<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class ModalUbahSatuTemplate extends Component
{

    public
        $modal_ubah_single_inputan_apd_mode = "";

    protected $listeners = [
        'inisiasiModalSatuTemplate'
    ];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.modal-ubah-satu-template');
    }

    public function insiasiModalSatuTemplate($val)
    {
        $this->modal_ubah_single_inputan_apd_mode = $val['mode'];
        $this->emit("RefreshTabelAtributTemlateSingle", $val['id_jenis']);
    }
}
