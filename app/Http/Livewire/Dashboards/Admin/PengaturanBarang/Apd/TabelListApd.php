<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdList;

class TabelListApd extends DataTableComponent
{
    protected $model = ApdList::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_apd');
    }

    public function columns(): array
    {
        return [

            Column::make("Id apd", "id_apd")
                ->sortable()
                ->hideIf(true),
            Column::make("Id jenis", "id_jenis")
                ->sortable()
                ->hideIf(true),
            Column::make("Nama apd", "nama_apd")
                ->sortable(),
            Column::make("Merk", "merk")
                ->sortable(),
            Column::make("Id size", "id_size")
                ->sortable(),
            Column::make("Id kondisi", "id_kondisi")
                ->sortable(),
            Column::make("Input no seri?", "input_no_seri")
                ->secondaryHeader(function(){
                    return "Apakah pegawai perlu menginput no seri apd saat menginput data?";
                })
                ->sortable(),
            Column::make("No Seri strict?", "strict_no_seri")
                ->secondaryHeader(function(){
                    return "Apakah nomer seri tsb bersifat mengikat?";
                })
                ->sortable(),
            Column::make("Nomer Referensi", "id_referensi")
                ->secondaryHeader(function(){
                    return "Nomer DPA atau nomer referensi lainnya yang disediakan saat pengadaan.";
                })
                ->sortable(),
            Column::make("Sumber Nomer Referensi", "sumber_id_referensi")
                ->secondaryHeader(function(){
                    return "Pihak yang menyediakan nomer referensi tersebut";
                })
                ->sortable(),
            Column::make("Gambar", "image")
                ->sortable(),
            Column::make("Tindakan")
                ->format(function($row){
                    return ;
                })
        ];
    }
}
