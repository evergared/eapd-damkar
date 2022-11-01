<?php

namespace App\Http\Livewire\Datatable;

use App\Models\DataPegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mediconesystems\LivewireDatatables\Action;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ContohTabel extends LivewireDatatable
{

    public $searchable = ['nama', 'email'];
    public $exportable = true;
    /**
     * untuk export sementara otomatis dari LivewireDatatable
     * workaround untuk edit file yang akan dieksport dapat dilihat dari contoh : 
     * https://github.com/MedicOneSystems/livewire-datatables/issues/93
     */


    public function builder()
    {
        return DataPegawai::query();
    }

    public function columns()
    {
        return [

            Column::callback('foto', function ($foto) {
                return view('kolom-tambahan-datatable.profil-contoh-tabel', ['img' => $foto]);
            })
                ->unsortable()
                ->excludeFromExport()
                ->label('Foto Profil'),

            NumberColumn::name('nrk')
                ->label('NRK / ID PJLP')
                ->sortBy('nrk')
                ->defaultSort('asc'),

            Column::name('nama')
                ->label('Nama Pegawai'),

            Column::name('telpon')
                ->label('Nomer Telepon'),

            Column::name('email')
                ->label('E-Mail'),

            Column::callback(['nama', 'nrk'], function ($nama, $nrk) {
                return view('kolom-tambahan-datatable.tindakan-contoh-tabel', ['nama' => $nama, 'nrk' => $nrk]);
            })
                ->unsortable()
                ->label("Tindakan")
                ->excludeFromExport()
        ];
    }
}
