<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApdTemplate;

class TabelTemplate extends DataTableComponent
{
    protected $model = InputApdTemplate::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id template", "id_template")
                ->sortable(),
            Column::make("Id template", "id_template")
                ->sortable(),
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Id periode", "id_periode")
                ->sortable(),
            Column::make("Nama", "nama")
                ->sortable(),
            Column::make("Template", "template")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
