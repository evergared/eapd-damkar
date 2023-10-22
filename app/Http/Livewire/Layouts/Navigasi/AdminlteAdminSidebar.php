<?php

namespace App\Http\Livewire\Layouts\Navigasi;

use App\Models\InputApdReupload;
use Livewire\Component;
use Throwable;

class AdminlteAdminSidebar extends Component
{
    public
        $notif_permintaan_ubah_data = 0;

    protected $listeners = [
        // ketika komponen lain refresh secara global
        'refreshComponent' => '$refresh',

        // ketika komponen lain hanya meminta sidebar yang di refresh
        'refreshSidebar' => '$refresh'
    ];

    public function render()
    {
        $this->hitungMintaUbahData();
        return view('livewire.layouts.navigasi.adminlte-admin-sidebar');
    }

    public function hitungMintaUbahData()
    {
        try
        {
            $this->notif_permintaan_ubah_data = InputApdReupload::where('selesai',false)->get()->count();
        }
        catch(Throwable $e)
        {
            error_log('gagal hitung minta update '.$e);
        }
    }
}
