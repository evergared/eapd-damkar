<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use App\Models\ApdList;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdSize;

class TabelListSize extends DataTableComponent
{
    protected $model = ApdSize::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_size');
    }

    public function columns(): array
    {
        return [
            Column::make("Id size", "id_size")
                ->hideIf(true),
            Column::make("Nama size", "nama_size")
                ->sortable(),
            Column::make("Opsi", "opsi")
                ->sortable(),
            Column::make("Jumlah Item APD")
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang menggunakan opsi size ini.";
                })
                ->format(function($row){
                    return ApdList::where('id_size',$row->id_size)->get()->count();
                }),
            Column::make('Tindakan')
                ->format(function($row){
                    return;
                })
        ];
    }
}
