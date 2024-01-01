<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Builder;

class TabelUbahSatuTemplateJabatan extends DataTableComponent
{
    protected   $terpilih = false,
                $id = "";


    protected $listeners = [
        "RefreshTabelSatu" => "refreshTabel"
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        $query = Jabatan::query();

        if($this->terpilih)
        {
            $query = $query;
        }
        else
            $query = $query->where('id_jabatan','test dummy untuk tabel kosong');

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Id jabatan", "id_jabatan")
                ->sortable(),
            Column::make("Nama jabatan", "nama_jabatan")
                ->sortable(),
            Column::make("Keterangan", "keterangan")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function refreshTabel($args)
    {
        $this->terpilih = $args['mode'] == 'jabatan';
        $this->id = $args['id'];
        $this->emitSelf('refreshDatatable');
    }

    public function pilih($val)
    {
        $this->emit('ubahSatuValue',['mode' => 'jabatan', 'value'=>$val]);
        $this->dispatchBrowserEvent('tutupModalSatuTemplate');
    }
}
