<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TabelListPeriode extends DataTableComponent
{
    protected $model = PeriodeInputApd::class;
    protected $index = 0;

    protected $listners = [
        "RefreshTabelListPeriode"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshVisible();
        $this->setAdditionalSelects(['nama_periode','tgl_awal','tgl_akhir','aktif']);
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make("No")
                ->format(fn()=>++$this->index)
                ->sortable(),
            Column::make("ID", "_id")
                ->deselected()
                ->sortable(),
            Column::make("Nama periode", "nama_periode")
                ->sortable(),
            Column::make("Tgl awal", "tgl_awal")
                ->sortable(),
            Column::make("Tgl akhir", "tgl_akhir")
                ->sortable(),
            BooleanColumn::make('Aktif?',"aktif")
                ->sortable(),
            Column::make('Tindakan')
                ->label(function($row){
                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-tindakan-tabel-list-periode',['id'=>$row->id,'aktif'=>$row->aktif]);
                })
        ];
    }
    #endregion

    public function RefreshTabelListPeriode()
    {
        $this->emitSelf("refreshDatatable");
    }

}
