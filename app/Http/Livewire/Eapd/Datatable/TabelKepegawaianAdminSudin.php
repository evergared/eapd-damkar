<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Models\Grup;
use App\Models\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use App\Models\Pegawai;
use App\Models\Penempatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TabelKepegawaianAdminSudin extends DataTableComponent
{
    // protected $model = Pegawai::class;

    public $columnSearch = [
        'nama' => null,

    ];

    public function configure(): void
    {
        // $this->setDebugEnabled();
        $this->setPrimaryKey('id_pegawai');
        $this->setSearchEnabled();
        // $this->setAdditionalSelects(['nama','nrk','nip','profile_img','no_telp','id_grup','id_jabatan','id_penempatan']);
    }

    public function builder(): Builder
    {
        return Pegawai::query()
            // ->select('nama','nrk','nip')
            // // join tabel pegawai dengan tabel jabatan
            // ->join('jabatan as j','pegawai.id_jabatan','=','j._id')

            // // join tabel pegawai dengan tabel penempatan
            // ->join('penempatan','pegawai.id_penempatan','=','penempatan._id')

            // // join tabel pegawai dengan tabel grup
            // ->join('grup','pegawai.id_grup','=','grup._id')

            // penempatan sesuai sektor kasie
            ->select(['nama', 'nrk', 'nip', 'profile_img', 'no_telp',  'id_jabatan', 'id_penempatan', 'jabatan_pegawai'])
            ->where('id_wilayah', '=', Auth::user()->data->id_wilayah)
            // ->whereRaw(function($collection){
            //                     return $collection->aggregate([
            //                         ['$lookup' => [
            //                                 'from' => 'jabatan',
            //                                 'localField' => 'id_jabatan',
            //                                 'foreignField' => '_id',
            //                                 'as' => 'jabatan_pegawai'
            //                                 ]
            //                         ],
            //                         ['$unwind' => '$jabatan']
            //                         ]);
            //                 })
        ;
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", 'nama')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-kepegawaian-admin-sektor", ['img' => $row->profile_img, 'id_pegawai' => $row->id, 'nama' => $value]);
                })
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('nama', $direction)
                )
                ->searchable(
                    fn (Builder $query, string $kata_pencarian) => $query->orWhere('nama', 'like', '%' . $kata_pencarian . '%')
                )
                ->excludeFromColumnSelect(),
            Column::make('id_pegawai')
                ->hideIf(true),
            Column::make("Nrk", "nrk")
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('nrk', $direction)

                )
                ->searchable(
                    fn (Builder $query, string $kata_pencarian) => $query->orWhere('nrk', 'like', '%' . $kata_pencarian . '%')
                )
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Nip", "nip")
                ->deselected()
                ->searchable(
                    fn (Builder $query, string $kata_pencarian) => $query->orWhere('nip', 'like', '%' . $kata_pencarian . '%')
                )
                ->collapseOnMobile(),
            Column::make("Profile img", "profile_img")
                ->hideIf(true),
            Column::make("No telp", "no_telp")
                ->deselected()
                ->searchable(
                    fn (Builder $query, string $kata_pencarian) => $query->orWhere('no_telp', 'like', '%' . $kata_pencarian . '%')
                )
                ->collapseOnMobile(),
            Column::make("Jabatan", "id_jabatan")
                ->format(function ($value) {
                    return Jabatan::where('id_jabatan', '=', $value)->first()->nama_jabatan;
                })
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('id_jabatan', $direction)

                )
                ->collapseOnMobile()
                ->searchable(
                    fn (Builder $query, $kata_pencarian) =>
                    $query->orWhere(function ($query) use ($kata_pencarian) {
                        $ids = Jabatan::where('nama_jabatan', 'like', '%' . $kata_pencarian . '%')->get()->pluck('id_jabatan');
                        foreach ($ids as $id)
                            $query->orWhere('id_jabatan', $id);
                    })
                    // function(Builder $query, $kata_pencarian)
                    // {
                    //     error_log('kata pencarian');
                    //     return 
                    //     // $query->whereRaw(function($collection){
                    //     //     return $collection->aggregate([
                    //     //         ['$lookup' => [
                    //     //                 'from' => 'jabatan',
                    //     //                 'localField' => 'id_jabatan',
                    //     //                 'foreignField' => '_id',
                    //     //                 'as' => 'jabatan'
                    //     //                 ]
                    //     //         ],
                    //     //         ['$unwind' => '$jabatan']
                    //     //         ]);
                    //     // })->orWhere('jabatan_pegawai.nama_jabatan','like',$kata_pencarian.'%');
                    //     $query->with('jabatan',function($query)use($kata_pencarian){
                    //         error_log('search jabatan : '.$kata_pencarian);
                    //         $ids = Jabatan::where('nama_jabatan','like',$kata_pencarian.'%')->get()->pluck('_id');
                    //         error_log('id jabatan : '.$ids);
                    //         foreach($ids as $id)
                    //             $query->orWhere('id_jabatan',$id);
                    //     });
                    // }
                ),
            // Column::make('id_penempatan')
            //     ->hideIf(true),
            Column::make("Penempatan", "id_penempatan")
                ->format(function ($value) {
                    return Penempatan::where('id_penempatan', '=', $value)->first()->nama_penempatan;
                })
                ->searchable()
                ->sortable(),
            Column::make("Grup Jaga", "grup")
                ->sortable()
                ->searchable(),
            BooleanColumn::make("Masih Aktif", "aktif")
                ->sortable()
                ->collapseOnMobile(),
            ButtonGroupColumn::make('Tindakan')
                // ->attributes(function(){
                //     return ;
                //     })
                ->buttons([
                    LinkColumn::make('ubah data')
                        ->title(function () {
                            return 'Ubah Data';
                        })
                        ->location(function () {
                            return '#modal-kepegawaian';
                        })
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-link text-nowrap',
                                'onclick' => "modal('modal-kepegawaian','" . $row->id . "','panggilModalKepegawaian')"
                            ];
                        }),
                ])
        ];
    }

    public function filters(): array
    {
        // untuk filter penempatan
        $penempatan = Penempatan::where('id_penempatan', 'like', Auth::user()->data->sektor . '%')
            ->project(['value' => '$id_penempatan', 'text' => '$nama_penempatan'])
            ->get()
            ->toArray();

        $opsi_penempatan = [];
        foreach ($penempatan as $p) {
            $opsi_penempatan[$p['value']] = $p['text'];
        }

        // untuk filter grup
        $grup = [
            ["id" => "A", "nama" => "Ambon"],
            ["id" => "B", "nama" => "Bandung"],
            ["id" => "C", "nama" => "Cepu"],
            ["id" => "non-grup", "nama" => "Non Grup"]
        ];
        $opsi_grup = [];
        foreach ($grup as $p) {
            $opsi_grup[$p['id']] = $p['nama'];
        }

        return [
            SelectFilter::make('Penempatan', 'id_penempatan')
                ->setFilterPillTitle(' Penempatan di ')
                ->setFilterPillValues($opsi_penempatan)
                ->options($opsi_penempatan)
                ->filter(function (Builder $b, string $val) {
                    $b->where('id_penempatan', '=', $val);
                }),
            SelectFilter::make('Grup', 'grup')
                ->setFilterPillTitle(' Grup Jaga ')
                ->setFilterPillValues($opsi_grup)
                ->options($opsi_grup)
                ->filter(function (Builder $b, string $val) {
                    error_log('filter grup : ' . $val);
                    $b->where('id_grup', '=', $val);
                }),
            SelectFilter::make('Masih Aktif', 'aktif')
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
                ->filter(function (Builder $b, string $val) {
                    if ($val === '1')
                        $b->where('aktif', true);
                    elseif ($val === '0')
                        $b->where('aktif', false);
                }),

        ];
    }
}
