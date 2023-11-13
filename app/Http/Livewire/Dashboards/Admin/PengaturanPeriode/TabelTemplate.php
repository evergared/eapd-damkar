<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApdTemplate;
use Illuminate\Database\Eloquent\Builder;

class TabelTemplate extends DataTableComponent
{

    public $id_periode_terpilih = null;

    protected $listeners = [
        'inisiasiTabelTemplate' => 'inisiasi'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id_template');
    }

    public function builder(): Builder
    {
        $query = InputApdTemplate::where('id_periode','Ladidadidadi ini hanya dummy');

        if(!is_null($this->id_periode_terpilih))
            $query = InputApdTemplate::query()->where('id_periode',$this->id_periode_terpilih);

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id template", "id_template")
                ->sortable()
                ->hideIf(true),
            Column::make("Jabatan", "jabatan.id_jabatan")
                ->sortable(),
            Column::make("Periode", "periode.id_periode")
                ->sortable(),
            Column::make("Template", "template")
                ->sortable()
        ];
    }

    public function inisiasi($id_periode)
    {
        $this->id_periode_terpilih = $id_periode;
        $this->emitSelf('refreshDatatable');
        
    }
}
