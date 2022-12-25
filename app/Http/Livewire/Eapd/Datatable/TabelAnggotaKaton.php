<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Http\Controllers\ApdDataController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Eapd\Pegawai;
use App\Http\Controllers\FileController;
use App\Models\Eapd\InputApd;
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
        $penempatan = Auth::user()->data->id_penempatan;
        $grup = Auth::user()->data->id_grup;
        return Pegawai::query()->where('id_penempatan', '=', $penempatan)->where('id_grup', '=', $grup);
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-foto-tabel-anggota-katon", ['img' => $value, 'nrk' => $row->nrk]);
                }),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("Nrk", "nrk")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make("Nip", "nip")
                ->sortable()
                ->searchable()
                ->hideIf(true),
            Column::make("Progress")
                ->label(function ($row) {
                    $adc = new ApdDataController;
                    $nrk = $row->nrk;
                    $id_jabatan = Pegawai::where('nrk', '=', $nrk)->first()->id_jabatan;
                    $tw = 1; //<-- ini untuk contoh dan test
                    // $tw = $adc->ambilIdPeriodeInput();
                    $maks = count($adc->muatListInputApdDariTemplate($tw, $id_jabatan));
                    $terinput = count($adc->muatInputanPegawai($tw, $nrk));
                    $tervalidasi = count($adc->muatInputanPegawai($tw, $nrk, verif::terverifikasi()->value));

                    return view("eapd.livewire.kolom-tambahan-datatable.kolom-progress-tabel-anggota-katon", ['nrk' => $nrk, 'periode' => $tw, 'max' => $maks, 'min' => 0, 'valueInput' => $terinput, 'valueValid' => $tervalidasi]);
                })
                ->secondaryHeader(function () {
                    return 'Klik batang dibawah untuk melihat progress anggota.';
                })
        ];
    }
}
