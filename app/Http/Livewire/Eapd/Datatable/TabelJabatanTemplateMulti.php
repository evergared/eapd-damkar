<?php

namespace App\Http\Livewire\Eapd\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

// use Illuminate\Database\Eloquent\Builder;

class TabelJabatanTemplateMulti extends DataTableComponent
{

    public string $tableName = "Tabel_Jabatan_Template_Multi";
    public array $Tabel_Jabatan_Template_Multi = [];

    protected $model = Jabatan::class;


    protected $listeners = [
        "TabelJabatanTemplateMultiPilih" => "AmbilTerpilih",
        "TabelJabatanTemplateMultiTerima" => "TerimaYangSudahTerpilih"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_jabatan');
        $this->setAdditionalSelects(['id_jabatan','nama_jabatan']);
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
            Column::make(" id", "id_jabatan")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('id_jabatan','like','%'.$kata_pencarian.'%')),
            Column::make("Nama jabatan", "nama_jabatan")
                ->sortable()
                ->searchable(fn(Builder $query, string $kata_pencarian)=> $query->orWhere('nama_jabatan','like','%'.$kata_pencarian.'%')),
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
                array_push($terpilih,$val["id_jabatan"]);
            }
            $this->setSelected($terpilih);
        }
        catch(Throwable $e)
        {
            error_log("Tabel Jabatan Template Multi : Gagal menerima jabatan yang sudah terpilih ".$e);
        }
    }

    public function AmbilTerpilih()
    {
        error_log("Terpilih : ".$this->getSelectedCount());


        $this->emitUp('CardMultiTemplateTerimaJabatan',$this->getSelected());
        $this->clearSelected();
    }

}
