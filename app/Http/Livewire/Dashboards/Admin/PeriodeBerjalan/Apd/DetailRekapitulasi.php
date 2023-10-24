<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class DetailRekapitulasi extends Component
{

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;

    public
        $id_jenis_detail = null,
        $nama_jenis_detail = null,
        $enum_kondisi_detail = null;

    
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

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput(null,true);
        $this->nama_periode_berjalan = PeriodeInputApd::find($this->id_periode_berjalan)->nama_periode;
        
    }

    public function terimaPaket($paket)
    {
        $this->id_jenis_detail = $paket['id_jenis'];
        $this->enum_kondisi_detail = $paket['enum_kondisi'];
        $jenis = ApdJenis::find($this->id_jenis_detail);
        $this->nama_jenis_detail = '';
        if(!is_null($jenis))
            $this->nama_jenis_detail = $jenis->nama_jenis;
        $this->emit('tabelGantiDetailRekap',[$this->id_jenis_detail, $this->enum_kondisi_detail, $paket['penempatan']]);
    }
    
            
}
