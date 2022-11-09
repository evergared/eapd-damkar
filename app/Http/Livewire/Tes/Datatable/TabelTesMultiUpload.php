<?php

namespace App\Http\Livewire\Tes\Datatable;

use App\Models\Tes\TesMultiUpload as Tes;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TabelTesMultiUpload extends LivewireDatatable
{
    public $searchable = ['nama', 'id'];

    public function builder()
    {
        return Tes::query();
    }

    public function columns()
    {
        return [
            Column::callback('foto', function ($foto) {
                return view('tes.livewire.datatable.kolom-tambahan-datatable.profil-contoh-tabel')->with(['img' => $foto]);
            })
                ->unsortable()
                ->excludeFromExport()
                ->label('Foto'),

            Column::name('id')
                ->Label('ID'),

            Column::name('nama')
                ->Label('Nama'),

            Column::callback('id', function ($id) {
                return view('tes.livewire.datatable.kolom-tambahan-datatable.tindakan-contoh-multi-upload-tabel', ['id' => $id]);
            })
                ->unsortable()
                ->label("Tindakan")
                ->excludeFromExport()
        ];
    }
}
