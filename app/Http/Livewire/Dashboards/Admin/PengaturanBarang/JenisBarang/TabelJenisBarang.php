<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\JenisBarang;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdJenis;
use App\Models\ApdList;

class TabelJenisBarang extends DataTableComponent
{
    protected $model = ApdJenis::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_jenis');
    }

    public function columns(): array
    {
        return [
            Column::make("Id jenis", "id_jenis")
                ->sortable(),
            Column::make("Id jenis", "id_jenis")
                ->sortable(),
            Column::make("Nama jenis", "nama_jenis")
                ->sortable(),
            Column::make("Jumlah Item APD",null)
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang berjenis ini.";
                })
                ->format(function($row){
                    return ApdList::where('id_jenis',$row->id_jenis)->get()->count();
                }),
            Column::make('Tindakan')
                ->format(function($row){
                    return;
                })
        ];
    }
}
