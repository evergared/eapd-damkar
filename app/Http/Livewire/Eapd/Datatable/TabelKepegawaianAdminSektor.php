<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use App\Models\Eapd\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TabelKepegawaianAdminSektor extends DataTableComponent
{
    // protected $model = Pegawai::class;

    public $columnSearch = [
        'nama'=>null,

    ];

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

        // join tabel pegawai dengan tabel penempatan
        ->join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')

        // join tabel pegawai dengan tabel grup
        ->join('grup','pegawai.id_grup','=','grup.id_grup')

        // penempatan sesuai sektor kasie
        ->where('pegawai.id_penempatan','like',Auth::user()->data->sektor . '%');
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", 'nama')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-kepegawaian-admin-sektor", ['img' => $row->profile_img, 'nrk' => $row->nrk, 'nama'=>$value]);
                })
                ->sortable()
                ->searchable()
                ->excludeFromColumnSelect(),
            Column::make("Nrk", "nrk")
                ->sortable()
                ->searchable()
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Nip", "nip")
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Profile img", "profile_img")
                ->isHidden(),
            Column::make("No telp", "no_telp")
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Jabatan", "jabatan.nama_jabatan")
                ->sortable()
                ->collapseOnMobile()
                ->searchable(),
            Column::make("Penempatan", "penempatan.nama_penempatan")
                ->searchable()
                ->sortable(),
            Column::make("Grup Jaga", "grup.nama_grup")
                ->sortable()
                ->searchable(),
            BooleanColumn::make("Masih Aktif", "aktif")
                ->sortable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Tindakan')
                ->buttons([
                    LinkColumn::make('ubah data')
                        ->title(function(){return 'Ubah Data';})
                        ->location(function(){return '#modal-kepegawaian';})
                        ->attributes(function ($row){
                            return [
                                'class' => 'underline',
                                'onclick' => "modal('modal-kepegawaian','".$row->nrk."','modalKepegawaian')"
                            ];
                        })
                ])
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Masih Aktif','aktif')
            ->setFilterPillTitle('Masih Aktif')
            ->setFilterPillValues([
                '1' => 'aktif',
                '0' => 'tidak aktif / pensiun'
            ])
            ->options([
                '' => 'Semua',
                '1' => 'Aktif',
                '0' => 'Tidak Aktif / Pensiun'
            ])
            ->filter(function(Builder $b, string $val){
                if($val === '1')
                    $b->where('pegawai.aktif',true);
                elseif($val === '0')
                    $b->where('pegawai.aktif',false);
            })
        ];
    }
}
