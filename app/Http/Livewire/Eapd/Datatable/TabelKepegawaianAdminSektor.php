<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class TabelKepegawaianAdminSektor extends DataTableComponent
{
    // protected $model = Pegawai::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
    }

    public function builder() : Builder
    {
        return Pegawai::query()

        // join tabel pegawai dengan tabel jabatan
        ->join('jabatan as j','pegawai.id_jabatan','=','j.id_jabatan')

        // penempatan sesuai sektor kasie
        ->where('id_penempatan','like',Auth::user()->data->sektor . '%');
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-kepegawaian-admin-sektor", ['img' => $value, 'nrk' => $row->nrk]);
                }),
            Column::make("Nrk", "nrk")
                ->sortable(),
            Column::make("Nip", "nip")
                ->sortable(),
            Column::make("Nama", "nama")
                ->sortable(),
            Column::make("Profile img", "profile_img")
                ->sortable(),
            Column::make("No telp", "no_telp")
                ->sortable(),
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Id wilayah", "id_wilayah")
                ->sortable(),
            Column::make("Id penempatan", "id_penempatan")
                ->sortable(),
            Column::make("Id grup", "id_grup")
                ->sortable(),
            Column::make("Aktif", "aktif")
                ->sortable(),
            Column::make("Plt", "plt")
                ->sortable(),
            Column::make("Kurang", "kurang")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
