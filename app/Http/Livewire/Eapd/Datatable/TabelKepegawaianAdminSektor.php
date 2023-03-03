<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use Illuminate\Support\Facades\Auth;
use Jenssegers\MongoDB\Eloquent\Builder;
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
        $this->setPrimaryKey('_id');
        $this->setSearchEnabled();
        $this->setAdditionalSelects(['nama','nrk','nip','profile_img','no_telp','id_grup','id_jabatan','id_penempatan']);
    }

    public function builder() : Builder
    {
        return Pegawai::query()

        // // join tabel pegawai dengan tabel jabatan
        // ->join('jabatan as j','pegawai.id_jabatan','=','j._id')

        // // join tabel pegawai dengan tabel penempatan
        // ->join('penempatan','pegawai.id_penempatan','=','penempatan._id')

        // // join tabel pegawai dengan tabel grup
        // ->join('grup','pegawai.id_grup','=','grup._id')

        // penempatan sesuai sektor kasie
        ->where('id_penempatan','like',Auth::user()->data->sektor . '%');
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", 'nama')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-kepegawaian-admin-sektor", ['img' => $row->profile_img, 'id_pegawai' => $row->id, 'nama'=>$value]);
                })
                ->sortable()
                ->searchable()
                ->excludeFromColumnSelect(),
            Column::make('_id')
                ->hideIf(true),
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
                ->hideIf(true),
            Column::make("No telp", "no_telp")
                ->deselected()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Jabatan", "id_jabatan")
                ->format(function($value){
                    return Jabatan::where('_id','=',$value)->first()->nama_jabatan;
                })
                ->sortable()
                ->collapseOnMobile()
                ->searchable(),
            // Column::make('id_penempatan')
            //     ->hideIf(true),
            Column::make("Penempatan", "id_penempatan")
                ->format(function($value){
                    return Penempatan::where('_id','=',$value)->first()->nama_penempatan;
                })
                ->searchable()
                ->sortable(),
            Column::make("Grup Jaga", "id_grup")
                ->format(function($value){
                    return Grup::where('id_grup','=',$value)->first()->nama_grup;
                })
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
                        ->title(function(){return 'Ubah Data';})
                        ->location(function(){return '#modal-kepegawaian';})
                        ->attributes(function ($row){
                            return [
                                'class' => 'btn btn-link text-nowrap',
                                'onclick' => "modal('modal-kepegawaian','".$row->id."','panggilModalKepegawaian')"
                            ];
                        }),
                    ])
        ];
    }

    public function filters(): array
    {
        // untuk filter penempatan
        $penempatan = Penempatan::where('_id','like',Auth::user()->data->sektor.'%')
                        ->project(['value'=>'$_id', 'text' => '$nama_penempatan'])
                        ->get()
                        ->toArray();
        
        $opsi_penempatan = [];
        foreach($penempatan as $p)
        {
            $opsi_penempatan[$p['value']] = $p['text'];
        }

        // untuk filter grup
        $grup = Grup::project(['value'=>'$_id','text'=>'$nama_grup'])
                        ->get()
                        ->toArray();
        $opsi_grup = [];
        foreach($grup as $p)
        {
            $opsi_grup[$p['value']] = $p['text'];
        }

        return [
            SelectFilter::make('Penempatan','_id')
            ->setFilterPillTitle(' Penempatan di ')
            ->setFilterPillValues($opsi_penempatan)
            ->options($opsi_penempatan)
            ->filter(function(Builder $b,string $val){
                $b->where('id_penempatan','=',$val);
            }),
            SelectFilter::make('Grup','grup')
            ->setFilterPillTitle(' Grup Jaga ')
            ->setFilterPillValues($opsi_grup)
            ->options($opsi_grup)
            ->filter(function(Builder $b,string $val){
                $b->where('id_grup','=',$val);
            }),
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
                    $b->where('aktif',true);
                elseif($val === '0')
                    $b->where('aktif',false);
            }),
            
        ];
    }
}
