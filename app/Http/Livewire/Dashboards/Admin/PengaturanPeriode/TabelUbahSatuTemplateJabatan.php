<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Jabatan;

class TabelUbahSatuTemplateJabatan extends DataTableComponent
{
    protected $model = Jabatan::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Nama jabatan", "nama_jabatan")
                ->sortable(),
            Column::make("Keterangan", "keterangan")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
