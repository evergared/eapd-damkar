<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Livewire\Component;

class FormBuatBanyakTemplate extends Component
{

    public
        $list_jabatan = [],
        $list_jenis_apd = [],
        $list_apd = [];

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.form-buat-banyak-template');
    }

    public function CardTabelInputanApdTambahBanyak()
    {
        $this->list_apd = [];
        $this->list_jabatan = [];
        $this->list_jenis_apd = [];
        $this->dispatchBrowserEvent("card_template_multi_inputan_apd_tampil");
    }
}
