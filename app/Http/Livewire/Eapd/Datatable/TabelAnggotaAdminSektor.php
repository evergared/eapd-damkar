<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\Penempatan;
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
            $q  ->where('pegawai.id_jabatan','=','L001')    // pjlp damkar
                ->orWhere('pegawai.id_jabatan','=','L002')  // ASN damkar
                ->orWhere('pegawai.id_jabatan','=','L003')  // Kepala Regu
                ->orWhere('pegawai.id_jabatan','=','L004')  // Kepala Pleton
                ->orWhere('pegawai.id_jabatan','=','S001');  // Staff Sektor
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
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'id_pegawai' => $row->id]);
                }),
            Column::make("id")
                ->sortable()
                ->hideIf(true),
            Column::make("Nama", "nama")
                ->sortable(),
            Column::make("Jabatan", "id_jabatan")
                ->format(function($value){
                    return Jabatan::where('id_jabatan','=',$value)->first()->nama_jabatan;
                })
                ->sortable(),
            Column::make("Penempatan", "id_penempatan")
                ->format(function($value){
                    return Penempatan::where('id_penempatan','=',$value)->first()->nama_penempatan;
                })
                ->sortable(),
            Column::make("Inputan")
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

                    $tw = 1;
                    // $tw = $adc->ambilIdPeriodeInput();

                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-show-detail-tabel-anggota-admin',[
                        'id_pegawai' => $row->id, 'periode' => $tw
                    ]);
                })
        ];
    }
}
