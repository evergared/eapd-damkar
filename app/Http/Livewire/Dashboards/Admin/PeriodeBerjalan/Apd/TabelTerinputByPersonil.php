<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\Jabatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TabelTerinputByPersonil extends DataTableComponent
{
    public string $tableName = "Tabel_Terinput_By_Personil";
    public array $Tabel_Terinput_By_Personil = [];

    public
        $penempatan_terpilih = "",
        $wilayah_terpilih = "";
    
    protected $listeners = [
        "tabelGantiPenempatan" => "gantiPenempatan",
        'sharePeriodeBerjalan' => 'terimaPeriodeBerjalan',
        'test'
    ];

    public $feedback_pencarian = "";

    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;


    #region Rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_pegawai');

        $this->setRefreshVisible();

        $this->setConfigurableAreas([
            'before-tools' => 'livewire.komponen.table-loading',

        ]);

        $this->setTableAttributes([
            'class' => "table-head-fixed",
        ]);

        $this->setTdAttributes(function(){
            return [
                'class' => 'align-middle'
            ];
        });

        // $this->setDebugEnabled();

        $this->setQueryStringDisabled();
        $this->setColumnSelectStatus(false);

    }

    public function builder(): Builder
    {
        
        $pegawai = Pegawai::query()->where('id_pegawai','kosong cuma untuk dummy');
        
        if($this->penempatan_terpilih != '' || $this->wilayah_terpilih != '')
        {
            try{

                $pegawai =  Pegawai::query()
                        ->distinct()
                        // ->join('input_apd','input_apd.id_pegawai','=','pegawai.id_pegawai')
                        ->join('penempatan','pegawai.id_penempatan','=','penempatan.id_penempatan')
                        ->where('pegawai.aktif',true)
                        ->where('pegawai.kalkulasi',true);
                if($this->wilayah_terpilih != 'semua')
                {
                    if($this->penempatan_terpilih != 'semua')
                    {

                        $pegawai = $pegawai->where('pegawai.id_penempatan','like',$this->penempatan_terpilih.'%')
                                ->where('penempatan.id_wilayah',$this->wilayah_terpilih);
                    }
                        
                }
                $pegawai = $pegawai;
                // ->where('pegawai.id_penempatan','like',$this->penempatan_terpilih.'%')
                // ->where('input_apd.id_periode',$this->id_periode_berjalan);

            }
            catch(Throwable $e)
            {

            }

            
                        
        }
            
            return $pegawai;
    }

    public function columns(): array
    {
        return [
            Column::make("Foto", 'profile_img')
                ->format(function ($value, $row) {
                    return view("livewire.dashboards.pegawai.data.apd.kolom-foto-tabel-data-apd-anggota", ['img' => $value, 'id_pegawai' => $row->id_pegawai]);
                }),
            Column::make("id_pegawai")
                ->sortable()
                ->hideIf(true),
            Column::make("id_jabatan")
                ->sortable()
                ->hideIf(true),
            Column::make("NRK / ID PJLP", "nrk")
                ->sortable()
                ->searchable(function (Builder $query, $pencarian){
                    $query->orWhere('nrk','like','%'.$pencarian.'%');
                }),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(function (Builder $query, $pencarian){
                    $query->orWhere('nama','like','%'.$pencarian.'%');
                }),
            Column::make("Jabatan",'id_jabatan')
                ->format(function($value){
                    return Jabatan::where('id_jabatan','=',$value)->first()->nama_jabatan;
                })
                ->searchable( function($query,$search){
                    $ids = Jabatan::where('nama_jabatan','like','%'.$search.'%')->get()->pluck('id_jabatan');
                    foreach($ids as $id)
                        $query->orWhere('pegawai.id_jabatan',$id);
                })
                ->sortable(),
            Column::make("Penempatan", "id_penempatan")
                ->format(function($value){
                    return Penempatan::where('id_penempatan','=',$value)->first()->nama_penempatan;
                })
                ->searchable(function($query,$search){
                    $ids = Penempatan::where('nama_penempatan','like','%'.$search.'%')->get()->pluck('id_penempatan');
                    foreach($ids as $id)
                        $query->orWhere('pegawai.id_penempatan',$id);
                })
                ->sortable(),
            Column::make("Terinput")
                ->label(function($row){
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id_pegawai;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = null; //<-- ini untuk contoh dan test

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);


                    return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-data-tabel-by-personil',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'tipe' => 'Terinput', 'warna' => 'success'
                    ]);
                }),
                Column::make("Terverifikasi")
                ->label(function($row){
                    // panggil ApdDataController
                    $adc = new ApdDataController;

                    // ambil id_pegawai dari baris
                    $id_pegawai = $row->id_pegawai;

                    // dapatkan jabatan 
                    $id_jabatan = $row->id_jabatan;

                    // set periode input
                    $tw = null; //<-- ini untuk contoh dan test

                    // muat template inputan untuk jabatan tertentu
                    $templateInputan = $adc->muatListInputApdDariTemplate($tw, $id_jabatan);

                    // muat apa saja yang telah diinput oleh si pegawai
                    $inputan = $adc->muatInputanPegawai($tw, $id_pegawai, 3);

                    // hitung jumlah maksimal inputan
                    $maks = (is_null($templateInputan))? 0 : count($templateInputan);

                    // hitung berapa item inputan
                    $value = (is_null($inputan))? 0 : count($inputan);


                    return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-data-tabel-by-personil',[
                        'id_pegawai' => $id_pegawai, 'maks' => $maks, 'value'=>$value, 'tipe' => 'Terverifikasi', 'warna' => 'info'
                    ]);
                }),
                Column::make("")
                ->label(function($row){

                    $adc = new ApdDataController;

                    $tw = $adc->ambilIdPeriodeInput();

                    return view('livewire.dashboards.admin.periode-berjalan.apd.kolom-show-detail-tabel-by-personil',[
                        'id_pegawai' => $row->id_pegawai, 'periode' => $tw
                    ]);
                })
        ];
    }
    #endregion

    public function gantiPenempatan($value)
    {
        try{
            $this->penempatan_terpilih = $value[1];
            $this->wilayah_terpilih = $value[0];
        }
        catch(Throwable $e)
        {
            $this->penempatan_terpilih = "";
            $this->wilayah_terpilih = "";
        }        
        error_log('ganti penempatan ke trigger');
        
        $this->emitSelf('refreshDatatable');
    }

    public function mount()
    {
        $pic = new PeriodeInputController;

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput(null,true);
    }
}
