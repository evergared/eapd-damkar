<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Ukuran;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdList;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApd;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\UkuranPegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TabelProgressUkuranAnggota extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id_pegawai');
    }

    public function builder(): Builder
    {
        $pegawai =  Pegawai::query()
                    ->join('input_apd_template','pegawai.id_jabatan','=','input_apd_template.id_jabatan')
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
                    return view("livewire.dashboards.pegawai.progress.ukuran.kolom-foto-tabel-progress-ukuran-anggota", ['img' => $value, 'id_pegawai' => $row->id_pegawai]);
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
            Column::make("Inputan")
                ->label(function($row){
                    

                    // hitung jumlah maksimal inputan
                    $maks = 0;

                    // hitung berapa item inputan
                    $value = 0;

                    $adc = new ApdDataController;
                    $pic = new PeriodeInputController;

                    // ambil ukuran dari database
                    $list_ukuran = UkuranPegawai::where('id_pegawai',$row->id_pegawai)->first();
                    $periode = $pic->ambilIdPeriodeUkuran();
                    if(is_null($list_ukuran))
                        $ukuran_pegawai = [];
                    else
                        $ukuran_pegawai = $list_ukuran->list_ukuran;

                    $template = $adc->muatListInputApdDariTemplate($periode, $row->id_jabatan);

                    foreach($template as $t)
                    {
                        // inisiasi
                        $id_jenis = $t['id_jenis'];

                        $target_apd = $t['opsi_apd'][0];

                        $target_size = ApdList::where('id_apd',$target_apd)->get()->first()->size;
                        // jika apd tersebut tidak memiliki ukuran, skip
                        if(is_null($target_size))
                            continue;
                        
                        $maks++;

                        $index = array_search($id_jenis, array_column($ukuran_pegawai, "id_jenis"));

                        if(is_bool($index) && $index==false)
                        {
                            continue;
                        }
                        
                        $value++;
                        
                    }

                    return view('livewire.dashboards.pegawai.progress.ukuran.kolom-progress-tabel-anggota',[
                        'id_pegawai' => $row->id_pegawai, 'maks' => $maks, 'value'=>$value, 'caption' => 'Inputan', 'warna' => 'success'
                    ]);
                }),
                Column::make("")
                ->label(function($row){

                    return view('livewire.dashboards.pegawai.progress.ukuran.kolom-show-detail-tabel-anggota',[
                        'id_pegawai' => $row->id_pegawai
                    ]);
                })
        ];
    }
}
