<?php

namespace App\Http\Livewire\Dashboards\Admin\PermintaanUbahData;

use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Http\Controllers\StatusDisplayController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApdReupload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TabelListPermintaan extends DataTableComponent
{

    public $periode_terpilih = '';

    public $columnSearch = [
        'size' => [],
        'jabatan' => [],
        'penempatan' => [],
        'no_seri' => []
    ];

    protected $listeners = [
        "tabelGantiPeriode" => "gantiPeriode"
    ];

    public function mount()
    {
        $pic = new PeriodeInputController;
        $this->periode_terpilih = $pic->ambilIdPeriodeInput();
        $this->emitSelf('refreshDatatable');

    }

#region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_reupload');
        $this->setRefreshVisible();
        $this->setTableAttributes([
            'class' => "table-head-fixed text-nowrap",
        ]);

        $this->setTdAttributes(function(){
            return [
                'class' => 'align-middle'
            ];
        });
    }

    public function builder(): Builder
    {
        $query = InputApdReupload::where('input_apd_reupload.size','Sangat Besar, Besar Sekali, Sampai-sampai tidak ketemu');

        $penempatan_terpilih = Auth::user()->id_penempatan;

        if($this->periode_terpilih != '')
        {
            $query = InputApdReupload::query()
                        ->join('input_apd','input_apd_reupload.id_inputan','=','input_apd.id_inputan')
                        // ->join('apd_list','input_apd.id_apd','=','apd_list.id_apd')
                        // ->join('apd_jenis','input_apd.id_jenis','=','apd_jenis.id_jenis')
                        ->join('pegawai','input_apd.id_pegawai','=','pegawai.id_pegawai')
                        ->join('jabatan','pegawai.id_jabatan','=','jabatan.id_jabatan')
                        ->join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')
                        // ->join('periode_input_apd', 'input_apd.id_periode','=','periode_input_apd.id_periode');
                        ->where('pegawai.aktif',true)
                        ->where('pegawai.kalkulasi',true)
                        ->where('pegawai.id_penempatan','like',$penempatan_terpilih.'%')
                        ->where('input_apd.id_periode',$this->periode_terpilih)
                        ->where('input_apd_reupload.selesai',false)
                        ->when($this->columnSearch['size'] ?? null, function($query, $size){
                            return $query->where('input_apd_reupload.size', 'like', '%'.$size.'%');
                        })
                        ->when($this->columnSearch['jabatan'] ?? null, function($query, $jabatan){
                            return $query->where('jabatan.nama_jabatan', 'like', '%'.$jabatan.'%');
                        })
                        ->when($this->columnSearch['penempatan'] ?? null, function($query, $penempatan){
                            return $query->where('penempatan.nama_penempatan', 'like', '%'.$penempatan.'%');
                        })
                        ->when($this->columnSearch['no_seri'] ?? null, function($query, $no_seri){
                            return $query->where('input_apd_reupload.no_seri', 'like', '%'.$no_seri.'%');
                        });
        }


        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id inputan", "id_inputan")
                ->sortable()
                ->hideIf(true),
            Column::make("Id pegawai", "inputan.pegawai.id_pegawai")
                ->sortable()
                ->hideIf(true),
            Column::make("Id apd", "id_apd")
                ->sortable()                
                ->hideIf(true),
            Column::make("Foto", 'inputan.pegawai.profile_img')
            ->format(function ($value, $row) {
                return view("livewire.dashboards.admin.permintaan-ubah-data.kolom-pegawai", ['img' => $value, 'id_pegawai' => $row->inputan->pegawai->id_pegawai]);
            }),
            Column::make("Pegawai",'inputan.pegawai.nama')
                ->sortable()
                ->searchable(),
            Column::make('Jabatan', 'inputan.pegawai.jabatan.nama_jabatan')
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'jabatan']);
                }),
            Column::make('Penempatan', 'inputan.pegawai.penempatan.nama_penempatan')
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'penempatan']);
                }),
            Column::make("Size", "size")
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'size']);
                }),
            Column::make("Kondisi", "kondisi")
                ->format(function($value){
                    $sdc = new StatusDisplayController;

                    $enum = StatusApd::tryFrom($value);
                    if(is_null($enum))
                        $text = "-";
                    else
                        $text = $enum->label;

                    $warna = $sdc->ubahKondisiApdKeWarnaBootstrap($enum);
                    return view('livewire.dashboards.admin.permintaan-ubah-data.kolom-badge',['warna'=>$warna, 'text'=>$text]);
                })
                ->sortable()
                ->secondaryHeaderFilter('kondisi'),
            Column::make("No seri", "no_seri")
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'no_seri']);
                }),
            Column::make("Image", "image")
                ->format(function($value, $row){
                    $adc = new ApdDataController;
                    $image = $adc->siapkanGambarInputanBesertaPathnya($value,$row->inputan->id_pegawai,$row->inputan->id_jenis,$row->inputan->id_periode,true);
                    return view('livewire.dashboards.admin.permintaan-ubah-data.kolom-image',['image'=>$image, 'path_gambar'=>'storage/','index'=>$row->id_inputan]);
                }),
            Column::make("Komentar pengupload", "komentar_pengupload")
                ->sortable(),
            Column::make("Data diupdate", "data_diupdate")
                ->sortable(),
            Column::make("")
                ->label(function($row){
                    return view('livewire.dashboards.admin.permintaan-ubah-data.kolom-show-detail',[
                        'id_inputan' => $row->id_inputan,
                    ]);
                })
        ];
    }

    public function filters(): array
    {
        $opsi_kondisi = ['' => "Semua"];

        $semua_kondisi = StatusApd::toValues();

        foreach($semua_kondisi as $kondisi)
        {
            $label = StatusApd::tryFrom($kondisi)->label;
            $opsi_kondisi[$kondisi] = $label;
        }

        return [
                SelectFilter::make('Kondisi', 'kondisi')
                ->setFilterPillTitle('Kondisi')
                ->options($opsi_kondisi)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('input_apd_reupload.kondisi',$value);
                    }
                }),
        ];
    }
#endregion

    public function gantiPeriode($value)
    {
        $this->periode_terpilih = $value;
        $this->emitSelf('refreshDatatable');
    }
}
