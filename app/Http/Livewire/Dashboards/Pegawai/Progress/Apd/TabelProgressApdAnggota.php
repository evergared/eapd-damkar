<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApd;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Penempatan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TabelProgressApdAnggota extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id_pegawai');
    }

    public function builder(): Builder
    {
        $pegawai =  Pegawai::query()->where('aktif',true);

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
                    return view("livewire.dashboards.pegawai.progress.apd.kolom-foto-tabel-progress-apd-anggota", ['img' => $value, 'id_pegawai' => $row->id_pegawai]);
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
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id_pegawai;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = null; //<-- ini untuk contoh dan test

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);


                    return view('livewire.dashboards.pegawai.progress.apd.kolom-progress-tabel-anggota',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'caption' => 'Inputan', 'warna' => 'success'
                    ]);
                }),
                Column::make("Validasi")
                ->label(function($row){
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id_pegawai;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = null; //<-- ini untuk contoh dan test

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai,3);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);

                    return view('livewire.dashboards.pegawai.progress.apd.kolom-progress-tabel-anggota',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'caption' => 'Validasi', 'warna' => 'info'
                    ]);
                }),
                Column::make("")
                ->label(function($row){

                    $adc = new ApdDataController;

                    $tw = $adc->ambilIdPeriodeInput();

                    return view('livewire.dashboards.pegawai.progress.apd.kolom-show-detail-tabel-anggota',[
                        'id_pegawai' => $row->id_pegawai, 'periode' => $tw
                    ]);
                })
        ];
    }
}
