<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Eapd\Pegawai;
use App\Http\Controllers\FileController;

class TabelAnggotaKaton extends DataTableComponent
{
    protected $model = Pegawai::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
        // $this->setDebugEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Nrk", "nrk")
                ->sortable(),
            Column::make("Nip", "nip")
                ->sortable(),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            ImageColumn::make("Profile img")
                ->location(
                    fn ($row) => (is_null($row->profile_img) ?? false) ? asset(FileController::$avatarPlaceholder) : asset(FileController::$avatarUploadBasePath . $row->profile_img)
                )
                ->attributes(
                    fn ($row) => [
                        'class' => 'img-thumbnail rounded-full border-gray-200 border transform hover:scale-125',
                        'alt' => $row->name . ' Avatar',
                    ]
                ),
            Column::make("No telp", "no_telp")
                ->sortable()
                ->searchable(),
            Column::make("Id penempatan", "id_penempatan")
                ->sortable()
                ->searchable(),
        ];
    }
}
