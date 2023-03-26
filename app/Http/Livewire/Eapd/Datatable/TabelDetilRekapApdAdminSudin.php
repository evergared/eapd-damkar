<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Eapd\Mongodb\InputApd;
use App\Models\Eapd\Mongodb\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class TabelDetilRekapApdAdminSudin extends DataTableComponent
{

    public 
        $tabel_ditampilkan = false,
        $kondisi_atau_keberadaan = "",
        $status_yang_dicari = "";

    public 
        $sudin = "",
        $id_jenis = "",
        $id_periode = "";

    protected $listeners = [
        'tampilTabel'
    ];

    #region Method/Function buatan sendiri
    public function tampilTabel($value)
    {
        $this->tabel_ditampilkan = false;
        try{

            $this->sudin = $value[0];
            $this->id_jenis = $value[1];
            $this->id_periode = $value[2];
            $this->kondisi_atau_keberadaan = $value[3];
            $this->status_yang_dicari = $value[4];
            $this->tabel_ditampilkan = true;

        }
        catch(Throwable $e)
        {
            $this->tabel_ditampilkan = false;
            $this->sudin = "";
            $this->id_jenis = "";
            $this->id_periode = "";
            $this->kondisi_atau_keberadaan = "";
            $this->status_yang_dicari = "";
        }
    }
    #endregion

    #region Method/Function dari rappasoft laravel livewire tables
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        $base = InputApd::query();

        $table_query = $base->where('id_jenis','=',$this->id_jenis)->where('id_periode','=',$this->id_periode)
                        ->where($this->kondisi_atau_keberadaan,'=',$this->status_yang_dicari)
                        ->filter(function($value,$key){
                            $pegawai = Pegawai::find($value['id_pegawai']);
                            return $pegawai->id_wilayah == $this->sudin;
                        });
        return ($this->tabel_ditampilkan)? $table_query : $base;
    }

    public function columns(): array
    {
        return [
            Column::make(" id", "_id")
                ->sortable(),
            Column::make("Id pegawai", "id_pegawai")
                ->sortable(),
            Column::make("Id apd", "id_apd")
                ->sortable(),
            Column::make("Size", "size")
                ->sortable(),
            Column::make("Status barang", "status_barang")
                ->sortable(),
            Column::make("Kondisi", "kondisi")
                ->sortable(),
            Column::make("Image", "image")
                ->sortable(),
            Column::make("Keterangan", "keterangan")
                ->sortable(),
            Column::make("Id periode", "id_periode")
                ->sortable(),
            Column::make("Verifikasi oleh", "verifikasi_oleh")
                ->sortable(),
            Column::make("Verifikasi status", "verifikasi_status")
                ->sortable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
    #endregion
}
