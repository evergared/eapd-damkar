<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class FormBuatBanyakTemplate extends Component
{
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-buat-banyak-template');
    }

    public function CardTabelInputanApdTambahBanyak()
    {
        $this->card_multi_template_inputan_apd_listApd = [];
        $this->card_multi_template_inputan_apd_listJabatan = [];
        $this->card_multi_template_inputan_apd_listJenisApd = [];
        $this->dispatchBrowserEvent("card_template_multi_inputan_apd_tampil");
    }
}
