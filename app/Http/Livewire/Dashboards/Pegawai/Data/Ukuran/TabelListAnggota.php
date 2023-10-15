<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Data\Ukuran;

use App\Models\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\UkuranPegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TabelListAnggota extends DataTableComponent
{
    protected $model = Pegawai::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        $pegawai =  Pegawai::query()
                        ->join('ukuran_pegawai','pegawai.id_pegawai','=','ukuran_pegawai.id_pegawai')
                        ->where('aktif',true);

            $user = Auth::user()->data;

            if($user->isPengendali())
                {
                    // dirinya dan semua anggota regunya

                    $pegawai = $pegawai->where('penanggung_jawab',$user->id_pegawai)->orWhere('id_pegawai', $user->id_pegawai);
                }
                else if($user->isKasie())
                {
                    // dirinya dan semua anggota sektornya, termasuk satgas
                    $sektor = $user->id_penempatan; // ganti jika perlu

                    $pegawai = $pegawai->where('id_penempatan','like',$sektor.'%');
                }
                else if($user->isKasudin())
                {
                    // dirinya dan semua anggota sudinnya, termasuk para staff dan bengkel
                    $sudin = $user->id_penempatan; // ganti jika perlu
                    $pegawai = $pegawai->where('id_penempatan','like',$sudin.'%');
                }
                else if($user->isKadis())
                {
                    // dirinya dan semua anggota pemadam di 5 wilayah termasuk staff dsb.
                    $pegawai = $pegawai;
                }

                return $pegawai;
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("livewire.dashboards.pegawai.data.ukuran.kolom-foto-tabel-data-apd-anggota", ['img' => $value, 'id_pegawai' => $row->id_pegawai]);
                }),
            Column::make("id_pegawai")
                ->sortable()
                ->hideIf(true),
            Column::make("id_jabatan")
                ->sortable()
                ->hideIf(true),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(function (Builder $query, $pencarian){
                    $query->orWhere('nama','like','%'.$pencarian.'%');
                }),
            Column::make("Jabatan",'id_jabatan')
                ->format(function($value){
                    return Jabatan::where('id_jabatan','=',$value)->first()->nama_jabatan;
                })
                ->searchable( function($query,$search){
                    $ids = Jabatan::where('nama_jabatan','like','%'.$search.'%')->get()->pluck('id_jabatan');
                    foreach($ids as $id)
                        $query->orWhere('id_jabatan',$id);
                })
                ->sortable(),
            Column::make("Penempatan", "id_penempatan")
                ->format(function($value){
                    return Penempatan::where('id_penempatan','=',$value)->first()->nama_penempatan;
                })
                ->searchable(function($query,$search){
                    $ids = Penempatan::where('nama_penempatan','like','%'.$search.'%')->get()->pluck('id_penempatan');
                    foreach($ids as $id)
                        $query->orWhere('id_penempatan',$id);
                })
                ->sortable(),
            Column::make("Terinput")
                ->label(function($row){

                    $terinput = UkuranPegawai::where('id_pegawai',$row->id_pegawai)->first();

                    if(is_null($terinput))
                        $value = 0;
                    else
                        $value = count($terinput->list_ukuran);

                    return view('livewire.dashboards.pegawai.data.ukuran.kolom-data-tabel-anggota',[
                        'value'=>$value,
                    ]);
                }),
                Column::make("")
                ->label(function($row){


                    return view('livewire.dashboards.pegawai.data.ukuran.kolom-show-detail-tabel-anggota',[
                        'id_pegawai' => $row->id_pegawai, 'nama_pegawai' => $row->nama
                    ]);
                })
        ];
    }
}
