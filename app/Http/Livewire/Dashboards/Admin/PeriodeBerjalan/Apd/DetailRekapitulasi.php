<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\PeriodeInputController;
use App\Models\PeriodeInputApd;
use Livewire\Component;

class DetailRekapitulasi extends Component
{

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;

    
        protected $listeners =[
            'paketUntukDetailRekap' => 'terimaPaket',
            'sharePeriodeBerjalan' => 'terimaPeriodeBerjalan'
        ];

    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.apd.detail-rekapitulasi');
    }

    public function mount()
    {

        $pic = new PeriodeInputController;

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput();
        $this->nama_periode_berjalan = PeriodeInputApd::find($this->id_periode_berjalan)->nama_periode;
        
    }
}
