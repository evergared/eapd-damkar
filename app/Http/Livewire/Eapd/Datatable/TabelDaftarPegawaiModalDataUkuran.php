<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Models\Grup;
use App\Models\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pegawai;
use App\Models\Penempatan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
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

        $this->setRefreshVisible();
    }

    public function builder(): Builder
    {
        return Pegawai::query()->select(['id_pegawai','nama','nrk','nip','no_telp','profile_img','id_jabatan','id_wilayah','id_penempatan','id_grup','aktif'])
                ->orWhere(function($query){
                    foreach($this->list_id_pegawai as $id)
                    $query->orWhere('id_pegawai',$id);
                });
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "nama")
                ->format(function($value, $row){
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-kepegawaian-admin-sektor", ['img' => $row->profile_img, 'id_pegawai' => $row->_id, 'nama'=>$value]);
                })
                ->sortable(
                    fn(Builder $query,string $direction)=> $query->orderBy('nama',$direction)
                )
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama','like','%'.$kata_pencarian.'%')
                )
                ->excludeFromColumnSelect(),
            Column::make('id_pegawai')
                ->hideIf(true),
            Column::make("Nrk", "nrk")
                ->sortable(
                    fn(Builder $query,string $direction)=> $query->orderBy('nrk',$direction)

                )
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nrk','like','%'.$kata_pencarian.'%')
                )
                ->deselected()
                ->collapseOnMobile(),
            Column::make("Nip", "nip")
                ->deselected()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nip','like','%'.$kata_pencarian.'%')
                )
                ->collapseOnMobile(),
            Column::make("Profile img", "profile_img")
                ->hideIf(true),
            Column::make("No telp", "no_telp")
                ->deselected()
                ->searchable(
                    fn(Builder $query, string $kata_pencarian)=> $query->orWhere('no_telp','like','%'.$kata_pencarian.'%')
                )
                ->collapseOnMobile(),
            Column::make("Jabatan", "id_jabatan")
                ->format(function($value){
                    return Jabatan::where('id_jabatan','=',$value)->first()->nama_jabatan;
                })
                ->sortable(
                    fn(Builder $query,string $direction)=> $query->orderBy('id_jabatan',$direction)

                )
                ->collapseOnMobile()
                ->searchable(
                    fn(Builder $query, $kata_pencarian)=>
                    $query->orWhere(function($query) use($kata_pencarian){
                            $ids = Jabatan::where('nama_jabatan','like','%'.$kata_pencarian.'%')->get()->pluck('id_pegawai');
                            foreach($ids as $id)
                                $query->orWhere('id_jabatan',$id);
                        })),
            Column::make("Penempatan", "id_penempatan")
                ->format(function($value){
                    return Penempatan::where('id_pegawai','=',$value)->first()->nama_penempatan;
                })
                ->searchable()
                ->sortable(),
            Column::make("Grup Jaga", "grup")
                ->sortable()
                ->searchable(),
            BooleanColumn::make("Masih Aktif", "aktif")
                ->sortable()
                ->deselected()
                ->collapseOnMobile(),
        ];
    }

    public function tampilTabel($value)
    {
        try{

            $this->nama_apd = $value[0];
            $this->ukuran = $value[1];
            $this->list_id_pegawai = $value[2];
            $this->emitSelf('refreshDatatable');

        }
        catch(Throwable $e)
        {
            $this->nama_apd = "";
            $this->list_id_pegawai =[] ;
        }
    }
}
