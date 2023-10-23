<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\PeriodeInputController;
use App\Models\PeriodeInputApd;
use Livewire\Component;

class Page extends Component
{
    
    public function render()
    {
        $this->sharePeriode();
        return view('livewire.dashboards.admin.periode-berjalan.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan APD Saat ini"]);
    }

    public function sharePeriode()
    {
        $pic = new PeriodeInputController;
        $periode = $pic->ambilIdPeriodeInput();
        $nama = PeriodeInputApd::find($periode)->first()->nama_periode;
        $share = [
            'id' => $periode,
            'nama'=> $nama
        ];
        $this->emit('sharePeriodeBerjalan',$share);
    }

}
