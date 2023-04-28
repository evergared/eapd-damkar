<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\Jabatan;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Throwable;

class TabelJabatanTemplateSingle extends DataTableComponent
{

    protected $index = 0;

    protected $listeners = [
        'InisiasiTabelJabatanTemplateSingle'
    ];

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['_id','nama_jabatan']);
    }

    public function builder(): Builder
    {
        return Jabatan::query();
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make('No')
                ->format(fn()=>++$this->index),
            Column::make("ID", "_id")
                ->sortable()
                ->searchable(),
            Column::make("Nama", "nama_jabatan")
                ->sortable()
                ->searchable(),
            LinkColumn::make('Tindakan')
                ->title(fn()=>"Pilih")
                ->attributes(function($row){
                    return [
                    'class' => 'btn btn-primary',
                    'onclick' => '$emit("TabelJabatanTemplateSinglePilih","'.$row->id.'")'
                    ];
                })
                ->location(fn()=>"#modal-ubah-single-template-inputan-apd")
        ];
    }
    #endregion

    public function InisiasiTabelJabatanTemplateSingle()
    {
        $this->emitSelf('refreshDatatable');
    }
    
}
