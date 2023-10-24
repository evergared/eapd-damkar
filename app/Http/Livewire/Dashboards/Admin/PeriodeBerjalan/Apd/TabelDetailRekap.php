<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Http\Controllers\StatusDisplayController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\InputApd;
use App\Models\PeriodeInputApd;
use Illuminate\Database\Eloquent\Builder;

class TabelDetailRekap extends DataTableComponent
{

    public string $tableName = "Tabel_Detail_Rekap";
    public array $TabelDetailRekap = [];

    protected $model = InputApd::class;

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;
    
    public
        $penempatan_detail = null,
        $kondisi_detail = null,
        $jenis_detail = null;

    protected $listeners = [
        'sharePeriodeBerjalan' => 'terimaPeriodeBerjalan',
        'tabelGantiDetailRekap' => 'inisiasiDetail'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshVisible();
    }

    public function builder(): Builder
    {
        $query = InputApd::where('id_inputan','saya lapar');

        if(!is_null($this->jenis_detail))
        {
            $query = InputApd::query()
            ->join('pegawai','input_apd.id_pegawai','=','pegawai.id_pegawai')
            ->join('jabatan','pegawai.id_jabatan','=','jabatan.id_jabatan')
            ->join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')
            ->join('periode_input_apd', 'input_apd.id_periode','=','periode_input_apd.id_periode')
            ->where('pegawai.aktif',true)
            ->where('pegawai.id_penempatan','like',$this->penempatan_detail.'%')
            ->where('input_apd.id_jenis',$this->jenis_detail)
            ->where('input_apd.kondisi',$this->kondisi_detail)
            ->where('input_apd.id_periode',$this->id_periode_berjalan);

        }

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
            Column::make('Jabatan', 'pegawai.jabatan.nama_jabatan')
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'jabatan']);
                }),
            Column::make('Penempatan', 'pegawai.penempatan.nama_penempatan')
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
                    return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-badge-tabel-by-inputan',['warna'=>$warna, 'text'=>$text]);
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
            ->format(function($value){
                $sdc = new StatusDisplayController;

                $enum = VerifikasiApd::tryFrom($value);
                if(is_null($enum))
                    $text = "-";
                else
                    $text = $enum->label;

                $warna = $sdc->ubahVerifikasiApdKeWarnaBootstrap($enum->value);
                return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-badge-tabel-by-inputan',['warna'=>$warna, 'text'=>$text]);
            })
                ->secondaryHeaderFilter('verifikasi_status')
                ->sortable(),
            Column::make("Komentar verifikator", "komentar_verifikator")
                ->sortable()
                ->searchable(),
        ];
    }

    public function mount()
    {
        $pic = new PeriodeInputController;

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput();
    }

    public function inisiasiDetail($param)
    {
        $this->jenis_detail = $param[0];
        $this->kondisi_detail = $param[1];
        $this->penempatan_detail = $param[2];
        $this->emitSelf('refreshDatatable');
    }
}
