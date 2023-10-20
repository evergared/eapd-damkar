<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApd;
use Illuminate\Database\Eloquent\Builder;

class TabelTerinputByInputan extends DataTableComponent
{

    public array $bulkActions = [
        'test' => 'Test Bulk Action'
    ];

    #region rappasoft methods
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        
    }

    public function builder(): Builder
    {
        $query = InputApd::query()
                    ->join('pegawai','input_apd.id_pegawai','=','pegawai.id_pegawai')
                    ->join('periode_input_apd', 'input_apd.id_periode','=','periode_input_apd.id_periode');
        
        return $query;
                    
    }

    public function columns(): array
    {
        return [
            Column::make("Id inputan", "id_inputan")
                ->sortable()
                ->hideIf(true),
            Column::make("Id pegawai", "id_pegawai")
                ->sortable()
                ->hideIf(true),
            Column::make("Id periode", "id_periode")
                ->sortable()
                ->hideIf(true),
            Column::make("Id jenis", "id_jenis")
                ->sortable()
                ->hideIf(true),
            Column::make("Id apd", "id_apd")
                ->sortable()
                ->hideIf(true),
            Column::make('Nama Pegawai', 'pegawai.nama')
                ->sortable()
                ->searchable(),
            Column::make("Size", "size")
                ->sortable()
                ->searchable(),
            Column::make("Kondisi", "kondisi")
                ->sortable()
                ->searchable(),
            Column::make("No seri", "no_seri")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->format(function($value, $row){
                    $adc = new ApdDataController;
                    $image = $adc->siapkanGambarInputanBesertaPathnya($value,$row->id_pegawai,$row->id_jenis,$row->id_periode);
                    return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-image-tabel-by-inputan',['image'=>$image, 'path_gambar'=>'storage/','index'=>$row->id_inputan]);
                }),
            Column::make("Komentar pengupload", "komentar_pengupload")
                ->sortable()
                ->searchable(),
            Column::make("Data diupdate", "data_diupdate")
                ->sortable()
                ->searchable(),
            Column::make("Verifikasi oleh", "verifikasi_oleh")
                ->sortable()
                ->searchable(),
            Column::make("Jabatan verifikator", "jabatan_verifikator")
                ->sortable()
                ->searchable(),
            Column::make("Verifikasi status", "verifikasi_status")
                ->sortable()
                ->searchable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->sortable()
                ->searchable(),
            
        ];
    }

    public function bulkActions(): array
    {
        return [
            'test' => 'Mencoba Bulk Actions'
        ];
    }
    
    #endregion

    #region bulk actions
    public function test()
    {
        error_log('bulk actions');
        return;
    }
    #endregion
}
