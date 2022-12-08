<?php

namespace App\Http\Livewire\Eapd\Datatable;

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
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    // error_log('profile img ' . $row->nama . ' ' . $value);
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'nrk' => $row->nrk]);
                }),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("Nrk", "nrk")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make("Nip", "nip")
                ->sortable()
                ->searchable()
                ->hideIf(true),
        ];
    }
}
