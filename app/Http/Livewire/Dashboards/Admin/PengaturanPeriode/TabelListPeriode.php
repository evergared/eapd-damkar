<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PeriodeInputApd;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TabelListPeriode extends DataTableComponent
{
    protected $model = PeriodeInputApd::class;
    protected $index = 0;

    protected $listners = [
        "RefreshTabelListPeriode"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_periode');
        $this->setRefreshVisible();
        $this->setAdditionalSelects(['nama_periode', 'tgl_awal', 'tgl_akhir', 'aktif']);
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            // Column::make("No", "")
            //     ->format(fn () => ++$this->index)
            //     ->sortable(),
            Column::make("ID", "id_periode")
                ->deselected()
                ->sortable(),
            Column::make("Nama periode", "nama_periode")
                ->sortable(),
            Column::make("Tgl awal", "tgl_awal")
                ->sortable(),
            Column::make("Tgl akhir", "tgl_akhir")
                ->sortable(),
            BooleanColumn::make('Masa Input Data APD?', "aktif")
                ->sortable(),
            BooleanColumn::make('Masa Kumpul Data Ukuran?', "kumpul_ukuran")
                ->sortable(),
            BooleanColumn::make('Masa Rekapitulasi?', "kumpul_rekap")
                ->sortable(),
            Column::make('Tindakan')
                ->label(function ($row) {
                    return view('livewire.dashboards.admin.pengaturan-periode.kolom-tindakan-tabel-list-periode', ['id' => $row->id_periode, 'aktif' => $row->aktif, 'kumpul_ukuran' => $row->kumpul_ukuran, 'kumpul_rekap'=>$row->kumpul_rekap]);
                })
        ];
    }
    #endregion

    public function RefreshTabelListPeriode()
    {
        $this->emitSelf("refreshDatatable");
    }
}
