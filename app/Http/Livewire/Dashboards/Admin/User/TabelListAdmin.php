<?php

namespace App\Http\Livewire\Dashboards\Admin\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Admin;

class TabelListAdmin extends DataTableComponent
{
    protected $model = Admin::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama akun", "nama_akun")
                ->sortable(),
            Column::make("Id pegawai", "id_pegawai")
                ->sortable(),
            Column::make("Id pegawai plt", "id_pegawai_plt")
                ->sortable(),
            Column::make("Id penempatan", "id_penempatan")
                ->sortable(),
            Column::make("Tipe", "tipe")
                ->sortable(),
           
        ];
    }
}
