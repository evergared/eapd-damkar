<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdList;

class TabelUbahSatuTemplateOpsiApd extends DataTableComponent
{
    protected $model = ApdList::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id apd", "id_apd")
                ->sortable(),
            Column::make("Id apd", "id_apd")
                ->sortable(),
            Column::make("Nama apd", "nama_apd")
                ->sortable(),
            Column::make("Id jenis", "id_jenis")
                ->sortable(),
            Column::make("Merk", "merk")
                ->sortable(),
            Column::make("Id size", "id_size")
                ->sortable(),
            Column::make("Id kondisi", "id_kondisi")
                ->sortable(),
            Column::make("Input no seri", "input_no_seri")
                ->sortable(),
            Column::make("Strict no seri", "strict_no_seri")
                ->sortable(),
            Column::make("Id referensi", "id_referensi")
                ->sortable(),
            Column::make("Sumber id referensi", "sumber_id_referensi")
                ->sortable(),
            Column::make("Image", "image")
                ->sortable(),
            Column::make("Deleted at", "deleted_at")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
