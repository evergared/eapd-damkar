<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\InputApd;

class TabelRekapApdAnggotaKaton extends DataTableComponent
{
    protected $model = InputApd::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Id pegawai", "id_pegawai")
                ->sortable(),
            Column::make("Id apd", "id_apd")
                ->sortable(),
            Column::make("Size", "size")
                ->sortable(),
            Column::make("Status barang", "status_barang")
                ->sortable(),
            Column::make("Kondisi", "kondisi")
                ->sortable(),
            Column::make("Image", "image")
                ->sortable(),
            Column::make("Keterangan", "keterangan")
                ->sortable(),
            Column::make("Id periode", "id_periode")
                ->sortable(),
            Column::make("Verifikasi oleh", "verifikasi_oleh")
                ->sortable(),
            Column::make("Verifikasi status", "verifikasi_status")
                ->sortable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
