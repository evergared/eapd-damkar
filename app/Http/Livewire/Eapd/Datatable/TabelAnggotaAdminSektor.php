<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Mongodb\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use Jenssegers\MongoDB\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TabelAnggotaAdminSektor extends DataTableComponent
{

    public $kompi = "*";

    // protected $model = Pegawai::class;  //<-- dipakai saat tidak ada query spesifik untuk dipanggil

    public function configure(): void
    {
        $this->setPrimaryKey('_id');
        $this->setSearchEnabled();
        $this->setAdditionalSelects(['nama','id_jabatan']);
    }
    
    public function builder(): Builder
    {
        return Pegawai::query()

        // panggil relasi dengan tabel jabatan dan penempatan
        ->with(['jabatan','penempatan'])

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
        // ->where('aktif','=',1)

        // berdasarkan grup
        ->where('id_grup','=',$this->kompi);
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'id_pegawai' => $row->_id]);
                }),
            Column::make("_id")
                ->sortable()
                ->hideIf(true),
            Column::make("id_jabatan")
                ->sortable()
                ->hideIf(true),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("Jabatan",'id_jabatan')
                ->format(function($value){
                    return Jabatan::where('_id','=',$value)->first()->nama_jabatan;
                })
                ->sortable(),
            Column::make("Penempatan", "nama_penempatan")
                // ->format(function($value){
                //     return Penempatan::where('_id','=',$value)->first()->nama_penempatan;
                // })
                ->sortable(),
            Column::make("Inputan")
                ->label(function($row){
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->_id;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = 1; //<-- ini untuk contoh dan test
                    // $tw = $adc->ambilIdPeriodeInput();  //<--- gunakan ini jika periode input sudah dimasukkan dengan benar di database

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);


                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-progress-tabel-anggota-admin',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'caption' => 'Inputan', 'warna' => 'success'
                    ]);
                }),
                Column::make("Validasi")
                ->label(function($row){
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = 1; //<-- ini untuk contoh dan test
                    // $tw = $adc->ambilIdPeriodeInput();  //<--- gunakan ini jika periode input sudah dimasukkan dengan benar di database

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai,3);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);

                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-progress-tabel-anggota-admin',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'caption' => 'Validasi', 'warna' => 'info'
                    ]);
                }),
                Column::make("")
                ->label(function($row){

                    $adc = new ApdDataController;

                    $tw = $adc->ambilIdPeriodeInput();

                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-show-detail-tabel-anggota-admin',[
                        'id_pegawai' => $row->id, 'periode' => $tw
                    ]);
                })
        ];
    }
}
