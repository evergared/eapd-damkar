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
        $this->setPrimaryKey('id_template');
    }

    public function columns(): array
    {
        return [
            Column::make("Id template", "id_template")
                ->sortable()
                ->hideIf(true),
            Column::make("Jabatan", "jabatan.id_jabatan")
                ->sortable(),
            Column::make("Periode", "periode.id_periode")
                ->sortable(),
            Column::make("Template", "template")
                ->sortable()
        ];
    }
}
