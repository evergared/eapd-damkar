<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TabelPengaturanApd extends DataTableComponent
{
    public string $tableName = "Tabel_Pengaturan_Apd";
    public array $Tabel_Pengaturan_Apd = [];

    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['id', 'nama_apd', 'merk', 'id_size', 'id_kondisi', 'image', 'id_jenis', 'keterangan']);
        $this->setRefreshVisible();
    }

    public function builder(): Builder
    {
        return ApdList::query();
    }

    public function columns(): array
    {
        return [
            Column::make("ID APD", "_id")
                ->searchable(fn(Builder $query, string $kata_pencarian) => $query->orWhere('id','like','%'.$kata_pencarian.'%'))
                ->sortable(),
            Column::make("Nama APD", "nama_apd")
                ->searchable(fn(Builder $query, string $kata_pencarian) => $query->orWhere('nama_apd','like','%'.$kata_pencarian.'%'))
                ->sortable(),
            Column::make("Merk", "merk")
                ->searchable(fn(Builder $query, string $kata_pencarian) => $query->orWhere('merk','like','%'.$kata_pencarian.'%'))
                ->sortable(),
            Column::make("Jenis APD", "id_jenis")
                ->format(fn($value)=>ApdJenis::find($value)->nama_jenis)
                ->searchable(function(Builder $query, string $kata_pencarian){
                    $id_jenis = ApdJenis::where('nama_jenis','like','%'.$kata_pencarian.'%')->get()->pluck('id');
                    foreach($id_jenis as $id)
                        $query->orWhere('id_jenis',$id);
                    })
                ->sortable(),
            Column::make("Kategori Size", "id_size")
                ->format(fn($value)=> ApdSize::find($value)->nama_size)
                ->deselected(),
            Column::make("Kategori Kerusakan", "id_kondisi")
                ->format(fn($value)=> ApdKondisi::find($value)->nama_kondisi)
                ->deselected(),
            Column::make("Keterangan", "keterangan")
                ->deselected(),
            ButtonGroupColumn::make("Tindakan")
                ->attributes(fn()=> [
                    "class" => "btn-group",
                    "role" => "group",
                    "aria-label" => "tabel-pengaturan-barang-apd-tindakan"
                ])
                ->buttons([
                    LinkColumn::make("Detail")
                        ->title(fn()=> "Detail")
                        ->attributes(fn($row)=>[
                            "class" => "btn btn-info mx-1",
                            "type" => "button",
                            'onclick' => "Livewire.emit('TabelPengaturanBarangApdDetail','".$row->id."')",
                        ])
                        ->location(fn()=> "#card-kendali-utama"),
                    LinkColumn::make("Hapus")
                        ->title(fn()=> "Hapus")
                        ->attributes(fn($row)=>[
                            "class" => "btn btn-danger mx-1",
                            "type" => "button",
                            'onclick' => "Livewire.emit('TabelPengaturanBarangApdHapus','".$row->id."')",
                        ])
                        ->location(fn()=> "#card-kendali-utama"),
                    
                ])
        ];
    }
    #endregion
}
