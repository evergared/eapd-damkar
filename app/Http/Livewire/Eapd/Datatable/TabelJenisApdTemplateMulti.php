<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Models\ApdJenis;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

// use Illuminate\Database\Eloquent\Builder;

class TabelJenisApdTemplateMulti extends DataTableComponent
{

    public string $tableName = "Tabel_Jenis_Apd_Template_Multi";
    public array $Tabel_Jenis_Apd_Template_Multi = [];

    protected $model = ApdJenis::class;


    protected $listeners = [
        "TabelJenisApdTemplateMultiPilih" => "AmbilTerpilih",
        "TabelJenisApdTemplateMultiTerima" => "TerimaYangSudahTerpilih"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_jenis');
        $this->setAdditionalSelects(['id_jenis','nama_jenis']);
        $this->setBulkActionsEnabled();
        $this->setSelectAllDisabled();
        $this->setSelectAllStatus(false);
    }

    public function bulkActions(): array
    {
        return [
            "AmbilTerpilih" => "Pilih"
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("ID Jenis", "id_jenis")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('id_jenis','like','%'.$kata_pencarian.'%')),
            Column::make("Nama Jenis Apd", "nama_jenis")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_Jenis','like','%'.$kata_pencarian.'%')),
        ];
    }
    #endregion

    public function TerimaYangSudahTerpilih($value)
    {
        try{
            error_log("terima yang sudah terpilih value count ".count($value));
            $terpilih = [];
            foreach($value as $val)
            {
                array_push($terpilih,$val["id_jenis"]);
            }
            $this->setSelected($terpilih);
        }
        catch(Throwable $e)
        {
            error_log("Tabel Jenis Apd Template Multi : Gagal menerima Jenis Apd yang sudah terpilih ".$e);
        }
    }

    public function AmbilTerpilih()
    {
        error_log("Terpilih : ".$this->getSelectedCount());


        $this->emitUp('CardMultiTemplateTerimaJenisApd',$this->getSelected());
        $this->clearSelected();
    }

}
