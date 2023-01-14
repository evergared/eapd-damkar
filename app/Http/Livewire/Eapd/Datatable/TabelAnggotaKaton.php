<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Http\Controllers\ApdDataController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Eapd\Pegawai;
use App\Enum\VerifikasiApd as verif;

class TabelAnggotaKaton extends DataTableComponent
{
    // protected $model = Pegawai::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchEnabled();
        // $this->setDebugEnabled();
    }

    public function builder(): Builder
    {
        $grup = Auth::user()->data->id_grup;
        return Pegawai::query()->where('id_penempatan', 'like', Auth::user()->data->sektor.'%')->where('id_grup', '=', $grup);
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'id_pegawai' => $row->id]);
                }),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("id")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make("Nip", "nip")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make("Progress")
            /**
             * Dari rappasoft :
             * $row mendapatkan data dari baris
             * $col mendapatkan data dari kolom
             * $value mendapatkan data dari hasil query untuk cell ini
             */
                ->label(function ($row) {
                    
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id;

                    // dapatkan jabatan dari id_pegawai 
                    $id_jabatan = Pegawai::where('id', '=', $id_pegawai)->first()->id_jabatan;

                    // set periode input
                    $tw = 1; //<-- ini untuk contoh dan test
                    // $tw = $adc->ambilIdPeriodeInput();  //<--- gunakan ini jika periode input sudah dimasukkan dengan benar di database

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai);

                    // muat apa saja inputan yang telah diverifikasi
                    $inputanTervalidasi = $adc->muatInputanPegawai($tw, $id_pegawai, verif::terverifikasi()->value);

                    // hitung jumlah maksimal yang harus diinput oleh pegawai
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item yang telah diinput oleh si pegawai
                    $terinput = (is_null($inputan))? 0 : count($inputan);

                    // hitung berapa item yang telah divalidasi oleh admin
                    $tervalidasi = (is_null($inputanTervalidasi)) ? 0 : count($inputanTervalidasi);

                    // muat tampilan untuk kolom
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-progress-tabel-anggota-katon",

                    // tembak data-data tersebut ke tampilan
                    ['id_pegawai' => $id_pegawai, 'periode' => $tw, 'max' => $maks, 'min' => 0, 'valueInput' => $terinput, 'valueValid' => $tervalidasi]);
                })
                ->secondaryHeader(function () {
                    return 'Klik batang dibawah untuk melihat progress anggota.';
                })
        ];
    }
}
