<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TabelPengaturanUkuranApd extends DataTableComponent
{
    public string $tableName = "Tabel_Pengaturan_Ukuran_Apd";
    public array $Tabel_Pengaturan_Ukuran_Apd = [];

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['id', 'nama_size', 'keterangan']);
        $this->setRefreshVisible();
    }

    public function builder(): Builder
    {
        return ApdSize::query();
    }

    public function columns(): array
    {
        return [
            Column::make("ID Opsi Ukuran", "_id")
                ->searchable(fn(Builder $query, string $kata_pencarian) => $query->orWhere('id','like','%'.$kata_pencarian.'%'))
                ->sortable(),
            Column::make("Nama Ukuran", "nama_size")
                ->searchable(fn(Builder $query, string $kata_pencarian) => $query->orWhere('nama_size','like','%'.$kata_pencarian.'%'))
                ->sortable(),
            Column::make("Jumlah APD Terkait", "_id")
                ->format(function($value){
                    return ApdList::where('id_size',$value)->get()->count();
                }),
            Column::make("Keterangan", "keterangan")
                ->deselected(),
            ButtonGroupColumn::make("Tindakan")
                ->attributes(fn()=> [
                    "class" => "btn-group",
                    "role" => "group",
                    "aria-label" => "tabel-pengaturan-ukuran-apd-tindakan"
                ])
                ->buttons([
                    LinkColumn::make("Detail")
                        ->title(fn()=> "Detail")
                        ->attributes(fn($row)=>[
                            "class" => "btn btn-info mx-1",
                            "type" => "button",
                            'onclick' => "Livewire.emit('TabelPengaturanUkuranApdDetail','".$row->id."')",
                        ])
                        ->location(fn()=> "#card-kendali-utama"),
                    LinkColumn::make("Hapus")
                        ->title(fn()=> "Hapus")
                        ->attributes(fn($row)=>[
                            "class" => "btn btn-danger mx-1",
                            "type" => "button",
                            "onclick" => "confirm('Hapus opsi ukuran?') || event.stopImmediatePropagation()",
                            'wire:click' => "\$emit('TabelPengaturanUkuranApdHapus','".$row->id."')",
                        ])
                        ->location(fn()=> "#card-kendali-utama"),
                    
                ])
        ];
    }
    #endregion
}
