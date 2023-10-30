<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Jabatan;
use App\Models\ApdJenis;
use App\Models\ApdList;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Throwable;

class TabelJabatanTemplateSingle extends DataTableComponent
{

    // https://rappasoft.com/docs/laravel-livewire-tables/v2/misc/multiple-tables#content-setting-the-table-name-and-data
    public string $tableName = "Table_Jabatan_Template_Single";
    public array $Table_Jabatan_Template_Single = [];

    protected $index = 0;

    protected $listeners = [
        'InisiasiTabelJabatanTemplateSingle'
    ];

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_jabatan');
        $this->setAdditionalSelects(['id_jabatan','nama_jabatan']);
    }

    public function builder(): Builder
    {
        return Jabatan::query();
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make("ID Jabatan", "id_jabatan")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('id_jabatan','like','%'.$kata_pencarian.'%')
                ),
            Column::make("Nama Jabatan", "nama_jabatan")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_jabatan','like','%'.$kata_pencarian.'%')
                ),
            LinkColumn::make('Tindakan')
                ->title(fn()=>"Pilih")
                ->attributes(function($row){
                    return [
                    'class' => 'btn btn-primary',
                    'onclick' => "Livewire.emit('TabelJabatanTemplateSinglePilih','".$row->id_jabatan."')",
                    'data-toggle' => "modal",
                    'data-target' => "#modal-ubah-single-template-inputan-apd"
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
