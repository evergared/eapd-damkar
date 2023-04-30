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

class TabelJenisApdTemplateSingle extends DataTableComponent
{

    // https://rappasoft.com/docs/laravel-livewire-tables/v2/misc/multiple-tables#content-setting-the-table-name-and-data
    public string $tableName = "Table_Jenis_Apd_Template_Single";
    public array $Table_Jenis_Apd_Template_Single = [];

    protected $index = 0;

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['_id','nama_jenis']);
    }

    public function builder(): Builder
    {
        return ApdJenis::query();
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make("ID Jenis APD", "_id")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('_id','like','%'.$kata_pencarian.'%')
                ),
            Column::make("Nama Jenis APD", "nama_jenis")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_jenis','like','%'.$kata_pencarian.'%')
                ),
            LinkColumn::make('Tindakan')
                ->title(fn()=>"Pilih")
                ->attributes(function($row){
                    return [
                    'class' => 'btn btn-primary',
                    'onclick' => "Livewire.emit('TabelJenisApdTemplateSinglePilih','".$row->id."')",
                    'data-toggle' => "modal",
                    'data-target' => "#modal-ubah-single-template-inputan-apd"
                    ];
                })
                ->location(fn()=>"#modal-ubah-single-template-inputan-apd")
        ];
    }
    #endregion
}
