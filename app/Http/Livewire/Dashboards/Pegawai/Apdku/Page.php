<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Apdku;

use App\Http\Controllers\ApdDataController;
use Livewire\Component;
use Throwable;

class Page extends Component
{
    // berisi apd apa saja yang perlu diinput oleh user
    public $daftarApd = [];

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];

    public function render()
    {
        $this->bangunDaftarInputApd();
        return view('livewire.dashboards.pegawai.apdku.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'APDku Pegawai']);
    }

    public function bangunDaftarInputApd()
    {
        $this->daftarApd = [];
        try {
            $adc = new ApdDataController;

            $periode = $adc->ambilIdPeriodeInput(null, true);

            $this->daftarApd =  $adc->bangunListInputApdDariTemplate($periode);

        } catch (Throwable $e) {
            $this->daftarApd = [];
            error_log('Dashboard ApdKu Pegawai Error : Kesalahan saat membangun daftar perlu input apd '.$e);
        }
    }

    public function panggilModal($id_jenis)
    {
        $this->emit('panggilKendaliInput', ['id_jenis' => $id_jenis]);
    }
}
