<?php

namespace App\Http\Livewire\Eapd\Datatable;

use App\Models\ApdJenis;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdList;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

// use Illuminate\Database\Eloquent\Builder;

class TabelApdTemplateMulti extends DataTableComponent
{

    public string $tableName = "Tabel_Apd_Template_Multi";
    public array $Tabel_Apd_Template_Multi = [];
    public array $parameter_jenis = [];



    protected $listeners = [
        "TabelApdTemplateMultiPilih" => "AmbilTerpilih",
        "TabelApdTemplateMultiTerima" => "TerimaYangSudahTerpilih",
        "TabelApdTemplateMultiGantiParameter" => "GantiParameter"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_apd');
        $this->setAdditionalSelects(['id_apd','nama_apd','id_jenis']);
        $this->setBulkActionsEnabled();
        $this->setSelectAllDisabled();
        $this->setSelectAllStatus(false);

        $this->setRefreshVisible();
    }

    public function builder(): Builder
    {
        $model = ApdList::query();

        if(count($this->parameter_jenis) > 0)
            foreach($this->parameter_jenis as $jenis)
                $model->orWhere('id_jenis',$jenis["id_jenis"]);

        return $model; 
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
            Column::make(" id", "id_apd")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('id_apd','like','%'.$kata_pencarian.'%')),
            Column::make("Jenis Apd", "id_jenis")
                ->format(function($value){
                       return ApdJenis::find($value)->nama_jenis;
                       }),
            Column::make("Nama Apd", "nama_apd")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_Apd','like','%'.$kata_pencarian.'%')),
        ];
    }
    #endregion

    public function GantiParameter($value)
    {
        $this->clearSelected();
        $this->parameter_jenis = $value;
        $this->emitSelf("refreshDatatable");

    }

    public function TerimaYangSudahTerpilih($value)
    {
        try{
            error_log("terima yang sudah terpilih value count ".count($value));
            $terpilih = [];
            foreach($value as $val)
            {
                array_push($terpilih,$val["id_apd"]);
            }
            $this->setSelected($terpilih);
        }
        catch(Throwable $e)
        {
            error_log("Tabel Apd Template Multi : Gagal menerima Apd yang sudah terpilih ".$e);
        }
    }

    public function AmbilTerpilih()
    {
        // $this->emitTo('eapd.layout.layout-pengaturan-periode','CardMultiTemplateTerimaApd',$this->getSelected());
        $this->emitUp('CardMultiTemplateTerimaApd',$this->getSelected());
        $this->clearSelected();
    }

}
