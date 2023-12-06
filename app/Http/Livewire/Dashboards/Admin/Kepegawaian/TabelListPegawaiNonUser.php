<?php

namespace App\Http\Livewire\Dashboards\Admin\Kepegawaian;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pegawai;

class TabelListPegawaiNonUser extends DataTableComponent
{
    protected $model = Pegawai::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id pegawai", "id_pegawai")
                ->sortable(),
            Column::make("Nip", "nip")
                ->sortable(),
            Column::make("Nrk", "nrk")
                ->sortable(),
            Column::make("Nama", "nama")
                ->sortable(),
            Column::make("Id penempatan", "id_penempatan")
                ->sortable(),
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Profile img", "profile_img")
                ->sortable(),
            Column::make("No telp", "no_telp")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Grup", "grup")
                ->sortable(),
            Column::make("Penanggung jawab", "penanggung_jawab")
                ->sortable(),
            Column::make("Aktif", "aktif")
                ->sortable(),
            Column::make("Ikut Kalkulasi Capaian?", "kalkulasi")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
