<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TabelAnggotaAdminSektor extends DataTableComponent
{

    public $kompi = "*";

    // protected $model = Pegawai::class;  //<-- dipakai saat tidak ada query spesifik untuk dipanggil

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
    }
    
    public function builder(): Builder
    {
        return Pegawai::query()

        // join tabel pegawai dengan tabel jabatan
        ->join('jabatan as j','pegawai.id_jabatan','=','j.id_jabatan')

        // penempatan sesuai sektor kasie
        ->where('id_penempatan','like',Auth::user()->data->sektor . '%')

        // jabatan yang akan di query
        // tambahkan jika perlu
        // https://laravel.com/docs/9.x/queries#or-where-clauses
        ->where(function ($q) {
            $q  ->where('id_jabatan','=','L001')    // pjlp damkar
                ->orWhere('id_jabatan','=','L002')  // ASN damkar
                ->orWhere('id_jabatan','=','L003')  // Kepala Regu
                ->orWhere('id_jabatan','=','L004')  // Kepala Pleton
                ->orWhere('id_jabatan','=','S001');  // Staff Sektor
        })

        // ambil pegawai yang masih aktif
        ->where('aktif','=',1)

        // berdasarkan grup
        ->where('id_grup','=',$this->kompi);
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'nrk' => $row->nrk]);
                }),
            Column::make("Nrk", "nrk")
                ->sortable(),
            Column::make("Nip", "nip")
                ->sortable(),
            Column::make("Nama", "nama")
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
