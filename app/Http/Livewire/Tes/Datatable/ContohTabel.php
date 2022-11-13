<?php

namespace App\Http\Livewire\Tes\Datatable;

use App\Models\Tes\DataPegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mediconesystems\LivewireDatatables\Action;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

/**
 * Contoh tabel menggunakan MedicOneSystems/livewire-datatable
 * dokumentasi : https://github.com/MedicOneSystems/livewire-datatables
 * demo : https://livewire-datatables.com/
 */
class ContohTabel extends LivewireDatatable
{

    public $searchable = ['nama', 'email'];
    public $exportable = true;


    /**
     * Fungsi override dari render() untuk mengganti default table.
     * Pada dasarnya fungsi render ini tidak perlu dioverride,
     * namun jika ingin mengubah style dari tabel, fungsi ini perlu dioverride
     * dengan view buatan kita sendiri.
     * sumber : https://github.com/MedicOneSystems/livewire-datatables#styling
     */
    public function render()
    {
        parent::render();
        return view('tes.livewire.datatable.contoh-tabel')->with('title', 'contoh-tabel');
    }

    public function builder()
    {
        return DataPegawai::query();
    }

    public function columns()
    {
        return [

            Column::callback('profile_img', function ($foto) {
                return view('tes.livewire.datatable.kolom-tambahan-datatable.profil-contoh-tabel', ['img' =>  $foto]);
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

            Column::name('no_telp')
                ->label('Nomer Telepon'),

            Column::name('email')
                ->label('E-Mail'),

            Column::callback(['nama', 'nrk'], function ($nama, $nrk) {
                return view('tes.livewire.datatable.kolom-tambahan-datatable.tindakan-contoh-tabel', ['nama' => $nama, 'nrk' => $nrk]);
            })
                ->unsortable()
                ->label("Tindakan")
                ->excludeFromExport()
        ];
    }

    /**
     * untuk export sementara otomatis dari LivewireDatatable
     * workaround untuk edit file yang akan dieksport dapat dilihat dari contoh : 
     * https://github.com/MedicOneSystems/livewire-datatables/issues/93
     */
}
