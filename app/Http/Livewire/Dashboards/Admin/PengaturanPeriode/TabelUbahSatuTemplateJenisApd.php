<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdJenis;

class TabelUbahSatuTemplateJenisApd extends DataTableComponent
{
    protected $model = ApdJenis::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make("Deleted at", "deleted_at")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
