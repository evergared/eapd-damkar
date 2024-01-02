<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApdTemplate;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class TabelTemplate extends DataTableComponent
{

    public $id_periode_terpilih = null;

    protected $listeners = [
        'inisiasiTabelTemplate' => 'inisiasi'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id_template')
            ->setRefreshVisible();

            $this->setTdAttributes(function(){
                return [
                    'class' => 'align-middle'
                ];
            });
    }

    public function builder(): Builder
    {
        $query = InputApdTemplate::where('input_apd_template.id_periode','Ladidadidadi ini hanya dummy');

        if(!is_null($this->id_periode_terpilih))
            $query = InputApdTemplate::query()->where('periode_input_apd.id_periode',$this->id_periode_terpilih);

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id template", "id_template")
                ->sortable()
                ->hideIf(true),
            Column::make("Jabatan", "jabatan.nama_jabatan")
                ->sortable(),
            Column::make("Periode", "periode.nama_periode")
                ->sortable(),
            Column::make("Template", "template")
                ->format(function($value){
                    
                    $pic = new PeriodeInputController;

                    return view('livewire.dashboards.admin.pengaturan-periode.kolom-template-tabel-template',['data'=>$pic->muatTemplateUntukKolomDatatable($value)]);
                }),
            Column::make("Tindakan")
                ->label(function($row){
                    return view('livewire.dashboards.admin.pengaturan-periode.kolom-tindakan-tabel-template',['id' => $row->id_template]);
                })
        ];
    }

    public function inisiasi($id_periode)
    {
        $this->id_periode_terpilih = $id_periode;
        error_log('inisiasi tabel template untuk '.$id_periode);
        $this->emitSelf('refreshDatatable');
        
    }

    public function edit($id_template)
    {
        try{

            

        }
        catch(Throwable $e)
        {
            error_log($e);
        }
    }

    public function hapus($id_template)
    {
        try{

        }
        catch(Throwable $e)
        {
            error_log($e);
            
        }
    }
}
