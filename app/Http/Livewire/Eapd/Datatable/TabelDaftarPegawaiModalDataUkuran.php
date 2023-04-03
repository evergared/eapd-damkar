<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class TabelDaftarPegawaiModalDataUkuran extends DataTableComponent
{

    public $list_id_pegawai = [];
    public $nama_apd = "", $ukuran = "";

    protected $listeners = [
        'tampilTabel'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            "class" => "table table-head-fixed text-nowrap"
        ]);
    }

    public function builder(): Builder
    {
        return Pegawai::query()->whereIn('id',$this->list_id_pegawai);
    }

    public function columns(): array
    {
        return [
            Column::make(" id", "_id")
                ->sortable(),
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

    public function tampilTabel($value)
    {
        try{

            $this->nama_apd = $value[0];
            $this->ukuran = $value[1];
            $this->list_id_pegawai = $value[2];

        }
        catch(Throwable $e)
        {
            $this->nama_apd = "";
            $this->list_id_pegawai =[] ;
        }
    }
}
