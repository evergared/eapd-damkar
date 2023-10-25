<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdKondisi;
use App\Models\ApdList;

class TabelListKondisi extends DataTableComponent
{
    protected $model = ApdKondisi::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_kondisi');
    }

    public function columns(): array
    {
        return [
            Column::make("Id kondisi", "id_kondisi")
                ->sortable(),
            Column::make("Id kondisi", "id_kondisi")
                ->sortable(),
            Column::make("Nama kondisi", "nama_kondisi")
                ->sortable(),
            Column::make("Opsi", "opsi")
                ->sortable(),
            Column::make("Jumlah Item APD")
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang menggunakan opsi kondisi ini.";
                })
                ->format(function($row){
                    return ApdList::where('id_kondisi',$row->id_kondisi)->get()->count();
                }),
            Column::make('Tindakan')
                ->format(function($row){
                    return;
                })
        ];
    }
}
