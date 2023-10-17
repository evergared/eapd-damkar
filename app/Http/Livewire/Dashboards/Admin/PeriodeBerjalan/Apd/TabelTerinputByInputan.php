<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApd;

class TabelTerinputByInputan extends DataTableComponent
{
    protected $model = InputApd::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id inputan", "id_inputan")
                ->sortable(),
            Column::make("Id inputan", "id_inputan")
                ->sortable(),
            Column::make("Id pegawai", "id_pegawai")
                ->sortable(),
            Column::make("Id periode", "id_periode")
                ->sortable(),
            Column::make("Id jenis", "id_jenis")
                ->sortable(),
            Column::make("Id apd", "id_apd")
                ->sortable(),
            Column::make("Size", "size")
                ->sortable(),
            Column::make("Kondisi", "kondisi")
                ->sortable(),
            Column::make("No seri", "no_seri")
                ->sortable(),
            Column::make("Image", "image")
                ->sortable(),
            Column::make("Komentar pengupload", "komentar_pengupload")
                ->sortable(),
            Column::make("Data diupdate", "data_diupdate")
                ->sortable(),
            Column::make("Verifikasi oleh", "verifikasi_oleh")
                ->sortable(),
            Column::make("Jabatan verifikator", "jabatan_verifikator")
                ->sortable(),
            Column::make("Verifikasi status", "verifikasi_status")
                ->sortable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->sortable(),
            
        ];
    }
}
