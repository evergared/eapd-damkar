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
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TabelDetailRekap extends DataTableComponent
{

    public string $tableName = "Tabel_Detail_Rekap";
    public array $TabelDetailRekap = [];


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

    public array $bulkActions = [
        'panggilModalUbah' => 'Ubah Verifikasi'
    ];

    public $opsi_dropdown_verifikasi = [
        ['value' => '3', 'text'=> 'Verifikasi'],
        ['value' => '4', 'text'=> 'Tolak'],
    ];

    public 
            $model_verifikasi = '',
            $model_komentar = '';

    public $jumlah_data = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id_inputan');
        $this->setBulkActionsEnabled();
        $this->setBulkActionsStatus(true);
        $this->setRefreshVisible();
        
        $this->setConfigurableAreas([
            'before-tools' => 'livewire.komponen.table-loading',
            'toolbar-right-start' => ['livewire.komponen.table-minireminder',['pesan'=>['Gunakan "kolom" jika data terlalu kecil.','Gunakan "Aksi" untuk tindakan massal.']]]
        ]);

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
            ->where('input_apd.verifikasi_status','3')
            ->where('input_apd.id_periode',$this->id_periode_berjalan)
            ->when($this->columnSearch['size'] ?? null, function($query, $size){
                return $query->where('size', 'like', '%'.$size.'%');
            })
            ->when($this->columnSearch['jabatan'] ?? null, function($query, $jabatan){
                return $query->where('jabatan.nama_jabatan', 'like', '%'.$jabatan.'%');
            })
            ->when($this->columnSearch['penempatan'] ?? null, function($query, $penempatan){
                return $query->where('penempatan.nama_penempatan', 'like', '%'.$penempatan.'%');
            })
            ->when($this->columnSearch['no_seri'] ?? null, function($query, $no_seri){
                return $query->where('no_seri', 'like', '%'.$no_seri.'%');
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

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput(null,true);
    }

    public function inisiasiDetail($param)
    {
        $this->jenis_detail = $param[0];
        $this->kondisi_detail = $param[1];
        $this->penempatan_detail = $param[2];
        $this->emitSelf('refreshDatatable');
    }

    public function customView(): string
    {
        return 'livewire.dashboards.admin.periode-berjalan.apd.modal-ubah-verifikasi';
    }
    
    public function filters(): array
    {
        $opsi_verifikasi = ['' => "Semua"];

        $semua_verifikasi = VerifikasiApd::toValues();

        foreach($semua_verifikasi as $verifikasi)
        {
            $label = VerifikasiApd::tryFrom($verifikasi)->label;
            $opsi_verifikasi[$verifikasi] = $label;
        }

        $opsi_kondisi = ['' => "Semua"];

        $semua_kondisi = StatusApd::toValues();

        foreach($semua_kondisi as $kondisi)
        {
            $label = StatusApd::tryFrom($kondisi)->label;
            $opsi_kondisi[$kondisi] = $label;
        }

        return [
            SelectFilter::make('Verifikasi', 'verifikasi_status')
                ->setFilterPillTitle('Verifikasi')
                ->options($opsi_verifikasi)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('verifikasi_status',$value);
                    }
                }),
                SelectFilter::make('Kondisi', 'kondisi')
                ->setFilterPillTitle('Kondisi')
                ->options($opsi_kondisi)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('kondisi',$value);
                    }
                }),
        ];
    }

    #region bulk actions
    public function panggilModalUbah()
    {
        $this->model_verifikasi = "";
        $this->model_komentar = "";
        
        $this->jumlah_data = $this->getSelectedCount();

        if($this->jumlah_data < 1)
        {
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Harap pilih minimal 1 (satu) inputan melalui checkbox di kolom paling kiri.']);
            return;
        }


        $this->dispatchBrowserEvent('byInputanPanggilModalUbah');
    }
    #endregion

    #region modal function
    public function simpanPerubahanVerifikasi()
    {
        $this->validate([
            'model_verifikasi' => 'required'
        ],
        [
            'model_verifikasi.required' => 'Ubah verifikasi terlebih dahulu.'
        ]);

        $berhasil = 0;
        $gagal = 0;

        foreach($this->getSelected() as $selected)
        {
                
            $adc = new ApdDataController;

            $status = $adc->adminVerifikasiInputan($selected,$this->model_verifikasi,$this->model_komentar);

            if($status)
                $berhasil++;
            else
                $gagal++;

        }

        if($berhasil > 0 && $gagal == 0)
            session()->flash('alert-success-modalUbah', 'Berhasil mengubah verifikasi dari semua data.');
        elseif($berhasil > 0 && $gagal > 0)
            session()->flash('alert-warning-modalUbah', ["berhasil" => $berhasil, "gagal"=>$gagal]);
        elseif($berhasil == 0 && $gagal > 0)
            session()->flash('alert-danger-modalUbah', 'Terjadi Kesalahan saat mengubah verifikasi dari semua data.');
        else
            session()->flash('alert-secondary-modalUbah', "Tidak ada perubahan dari tindakan yang dilakukan");

        // $this->emit('hitungCapaian');

    }
    #endregion
}