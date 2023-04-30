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

class TabelApdTemplateSingle extends DataTableComponent
{

    // https://rappasoft.com/docs/laravel-livewire-tables/v2/misc/multiple-tables#content-setting-the-table-name-and-data

    public string $tableName = "Tabel_Apd_Template_Single";
    public array $Tabel_Apd_Template_Single = [];

    public string $id_jenis = "";

    protected $index = 0;

    protected $listeners = [
        "RefreshTabelAtributTemlateSingle"
    ];

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshVisible();
        $this->setAdditionalSelects(['_id','nama_apd']);
    }

    public function builder(): Builder
    {
        if($this->id_jenis)
            return ApdList::query()->where("id_jenis",$this->id_jenis);

        return ApdList::query();
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make("ID APD", "_id")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('_id','like','%'.$kata_pencarian.'%')
                ),
            Column::make("Nama APD", "nama_apd")
                ->sortable()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_apd','like','%'.$kata_pencarian.'%')
                    ),
            LinkColumn::make('Tindakan')
                ->title(fn()=>"Pilih")
                ->attributes(function($row){
                    return [
                    'class' => 'btn btn-primary',
                    'onclick' => "Livewire.emit('TabelApdTemplateSinglePilih','".$row->id."')",
                    'data-toggle' => "modal",
                    'data-target' => "#modal-ubah-single-template-inputan-apd"
                    ];
                })
                ->location(fn()=>"#modal-ubah-single-template-inputan-apd")
        ];
    }
    #endregion

    public function RefreshTabelAtributTemlateSingle($value)
    {
        $this->id_jenis = $value;
        $this->emitSelf("refreshDatatable");
    }
    
}
