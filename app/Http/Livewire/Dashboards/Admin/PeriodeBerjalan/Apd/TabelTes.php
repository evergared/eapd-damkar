<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Models\Admin;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pegawai;

class TabelTes extends DataTableComponent
{

    public string $tableName = "Tabel_Tes";
    public array $TabelTes = [];

    public array $bulkActions = [
        'cobas' => 'Test Bulk Action'
    ];

    protected $model = Admin::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setQueryStringDisabled();
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Id admin", "id")
                ->sortable(),
            Column::make('nama akun', "nama_akun")
                ->sortable()
           
        ];
    }

        #region bulk actions
        public function cobas()
        {
            error_log('bulk actions : '.$this->getSelectedCount());
            return;
        }
        #endregion
}
