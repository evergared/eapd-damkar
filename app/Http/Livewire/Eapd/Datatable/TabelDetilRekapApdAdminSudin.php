<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Enum\KeberadaanApd;
use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\StatusDisplayController;
use App\Models\Eapd\Mongodb\ApdList;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\InputApd;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Jenssegers\Mongodb\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
// use Illuminate\Database\Eloquent\Builder;
use Throwable;

class TabelDetilRekapApdAdminSudin extends DataTableComponent
{

    public 
        $kondisi_atau_keberadaan = "",
        $status_yang_dicari = "";

    public 
        $sudin = "0",
        $id_jenis = "",
        $id_periode = "";

    protected $index = 0;

    protected $listeners = [
        'tampilTabel'
    ];

    #region Method/Function buatan sendiri
    public function tampilTabel($value)
    {
        try{
            $this->sudin = $value[0];
            $this->id_periode = $value[1];
            $this->id_jenis = $value[2];
            $this->kondisi_atau_keberadaan = $value[3];
            $this->status_yang_dicari = $value[4];
            $this->emitSelf('refreshDatatable');
        }
        catch(Throwable $e)
        {
            error_log('gagal menampilkan tabel '.$e);
            $this->sudin = "0";
            $this->id_jenis = "";
            $this->id_periode = "";
            $this->kondisi_atau_keberadaan = "";
            $this->status_yang_dicari = "";
            $this->emitSelf('refreshDatatable');
        }
    }
    #endregion

    #region Method/Function dari rappasoft laravel livewire tables
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshVisible();
        $this->setOfflineIndicatorEnabled();
        // $this->setSearchDisabled();
        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex){
            return ["class" => "text-center align-middle"];
        });
        $this->setAdditionalSelects(['id_pegawai','id_apd','id_periode','size','keberadaan','kondisi','komentar_pengupload','verifikasi_oleh','verifikasi_status','komentar_verifikator','image']);
    }

    public function builder(): Builder
    {
        return InputApd::query()
            ->with('pegawai',function($query){
                $query->where('id_wilayah','=',$this->sudin);
            })
            ->when($this->id_periode ?? null, fn($query) => $query->where('id_periode','=',$this->id_periode))
            ->when($this->id_jenis ?? null, fn($query) => $query->where('id_jenis','=',$this->id_jenis))
            ->when($this->kondisi_atau_keberadaan ?? null, function($query){
                if($this->kondisi_atau_keberadaan == "kondisi" || $this->kondisi_atau_keberadaan == "keberadaan")
                    $query->where($this->kondisi_atau_keberadaan,'=',$this->status_yang_dicari);
            });
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;
        $sdc = new StatusDisplayController;
        $adc = new ApdDataController;

        return [
            Column::make("No")
                ->format(fn() => ++$this->index)
                ->sortable(),
            Column::make("Nama Pegawai", "id_pegawai")
                ->format(function($value){
                    return Pegawai::find($value)->nama;
                })
                ->searchable(function(Builder $q, $kata_pencarian){
                    $q->orWhere(function($query) use($kata_pencarian){
                        // error_log('kata_pencarian : '.$kata_pencarian);
                        $ids = Pegawai::where('nama','like',$kata_pencarian.'%')->get()->pluck('id');
                        // error_log('potential id : '.$ids);
                        foreach($ids as $id)
                            $query->orWhere('id_pegawai','=',$id);
                    });
                })
                ->sortable(),
            Column::make("Penempatan", "id_pegawai")
                ->format(function($value){
                    return Pegawai::find($value)->penempatan->nama_penempatan;
                })
                ->sortable(),
            Column::make("Nama Apd", "id_apd")
                ->format(function($value){
                    return ApdList::find($value)->nama_apd;
                })
                ->deselected()
                ->sortable(),
            Column::make("Size", "size")
                ->sortable(),
            Column::make("Keberadaan", "keberadaan")
                ->format(function($value) use($sdc){
                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-status',['warna' => $sdc->ubahKeberadaanApdKeWarnaBootstrap($value), 'label' => KeberadaanApd::tryFrom($value)->label]);
                })
                ->sortable(),
            Column::make("Kondisi", "kondisi")
                ->format(function($value) use($sdc){
                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-status',['warna' => $sdc->ubahKondisiApdKeWarnaBootstrap($value), 'label' => StatusApd::tryFrom($value)->label]);
                })
                ->sortable(),
            Column::make("Verifikasi status", "verifikasi_status")
                ->format(function($value) use($sdc){
                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-status',['warna' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($value), 'label' => VerifikasiApd::tryFrom($value)->label]);
                })
                ->sortable(),
            Column::make("Foto yang Diupload", "image")
                ->format(function($value,$row) use($adc){
                    $gambar = $adc->siapkanGambarInputanBesertaPathnya($value,$row->id_pegawai,$this->id_jenis,$this->id_periode);
                    return view('eapd.livewire.kolom-tambahan-datatable.kolom-gambar-apd',['gambar_apd' => $gambar]);
                })
                ->sortable(),
            Column::make("Catatan Pengupload", "komentar_pengupload")
                ->deselected()
                ->sortable(),
            Column::make("Periode Input", "id_periode")
                ->format(fn($value) => PeriodeInputApd::find($value)->nama_periode)
                ->deselected()
                ->sortable(),
            Column::make("Verifikasi oleh", "verifikasi_oleh")
                ->deselected()
                ->sortable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->deselected()
                ->sortable(),
            Column::make("Data Diupdate", "data_diupdate")
                ->sortable(),
            
        ];
    }

    public function filters():array
    {
        return [
            // SelectFilter::make("Penempatan")
            // ->setFilterPillTitle('Penempatan di ')
            // ->options(function(Builder $b))
        ];
    }
    #endregion
}
