<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdJenis;
use App\Models\ApdKondisi;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdList;
use App\Models\ApdSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Throwable;

class TabelListApd extends DataTableComponent
{
    protected $model = ApdList::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_apd');
        $this->setTableAttributes([
            'class' => "table-head-fixed",
        ]);

        $this->setTdAttributes(function(){
            return [
                'class' => 'align-middle'
            ];
        });

        $this->setRefreshTime(4000);
        
        $this->setConfigurableAreas([
            'before-tools' => ['livewire.komponen.table-loading',['detik' => 4]],
        ]);

    }

    public function columns(): array
    {
        return [

            Column::make("Id apd", "id_apd")
                ->sortable()
                ->hideIf(true),
            Column::make("Id jenis", "id_jenis")
                ->sortable()
                ->hideIf(true),
            Column::make("Nama apd", "nama_apd")
                ->sortable()
                ->searchable(),
            Column::make("Jenis", "jenis.nama_jenis")
                ->sortable()
                ->secondaryHeaderFilter('jenis'),
            Column::make("Merk", "merk")
                ->sortable(),
            Column::make("Tipe size", "size.nama_size")
                ->sortable()
                ->secondaryHeaderFilter('size'),
            Column::make("Tipe kondisi", "kondisi.nama_kondisi")
                ->sortable()
                ->secondaryHeaderFilter('kondisi'),
            BooleanColumn::make("Input no seri?", "input_no_seri")
                ->secondaryHeader(function(){
                    return "Apakah pegawai perlu menginput no seri apd saat menginput data?";
                })
                ->sortable(),
            // BooleanColumn::make("No Seri strict?", "strict_no_seri")
            //     ->secondaryHeader(function(){
            //         return "Apakah nomer seri tsb bersifat mengikat?";
            //     })
            //     ->sortable(),
            Column::make("Nomer Referensi", "id_referensi")
                ->secondaryHeader(function(){
                    return "Nomer DPA atau nomer referensi lainnya yang disediakan saat pengadaan.";
                })
                ->sortable(),
            Column::make("Sumber Nomer Referensi", "sumber_id_referensi")
                ->secondaryHeader(function(){
                    return "Pihak yang menyediakan nomer referensi tersebut";
                })
                ->sortable(),
            Column::make("Gambar", "image")
                ->format(function($value, $row){
                    $adc = new ApdDataController;
                    $image = $adc->siapkanGambarTemplateBesertaPathnya($value,$row->id_jenis,$row->id_apd);
                    return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-image-tabel-apd',['image'=>$image, 'path_gambar'=>'storage/','index'=>$row->id_apd]);
                }),
            Column::make('Tindakan')
                ->label(function($row){
                    return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-tindakan-tabel-apd',['id'=>$row->id_apd]);
                })
        ];
    }

    public function filters(): array
    {

        $opsi_jenis = ['' => "Semua"];

        $semua_jenis = ApdJenis::all();

        foreach($semua_jenis as $jenis)
        {
            $label = $jenis->nama_jenis;
            $opsi_jenis[$jenis->id_jenis] = $label;
        }

        $opsi_size = ['' => "Semua"];

        $semua_size = ApdSize::all();

        foreach($semua_size as $size)
        {
            $label = $size->nama_size;
            $opsi_size[$size->id_size] = $label;
        }

        $opsi_kondisi = ['' => "Semua"];

        $semua_kondisi = ApdKondisi::all();

        foreach($semua_kondisi as $kondisi)
        {
            $label = $kondisi->nama_kondisi;
            $opsi_kondisi[$kondisi->id_kondisi] = $label;
        }

        $opsi_no_seri = [
            '' => 'Semua',
            1 => "Perlu",
            0 => "Tidak"
        ];

        $opsi_strict = [
            '' => 'Semua',
            1 => "Ya",
            0 => "Tidak"
        ];


        return [
            SelectFilter::make('Jenis APD', 'jenis')
                ->setFilterPillTitle('Jenis APD')
                ->options($opsi_jenis)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('apd_list.id_jenis',$value);
                    }
                }),
            SelectFilter::make('Tipe Size', 'size')
                ->setFilterPillTitle('Tipe Size')
                ->options($opsi_size)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('apd_list.id_size',$value);
                    }
                }),
            SelectFilter::make('Tipe kondisi', 'kondisi')
                ->setFilterPillTitle('Tipe Kondisi')
                ->options($opsi_kondisi)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('apd_list.id_kondisi',$value);
                    }
                }),
            SelectFilter::make('Input No Seri?', 'input_no_seri')
                ->setFilterPillTitle('Input No Seri?')
                ->options($opsi_no_seri)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('apd_list.input_no_seri',$value);
                    }
                }),
            SelectFilter::make('No Seri Strict?', 'seri_strict')
                ->setFilterPillTitle('No Seri Strict?')
                ->options($opsi_strict)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('apd_list.strict_no_seri',$value);
                    }
                }),
            TextFilter::make('Merk', 'merk')
                ->setFilterPillTitle('Merk')
                ->filter(function(Builder $q, string $val){
                    if($val != '')
                        $q->where('merk','like','%'.$val.'%');
                }),
            TextFilter::make('No Referensi dari Penyedia', 'ref')
                ->setFilterPillTitle('No Referensi dari Penyedia')
                ->filter(function(Builder $q, string $val){
                    if($val != '')
                        $q->where('id_referensi','like','%'.$val.'%');
                }),
            TextFilter::make('Penyedia No Referensi', 'ref_source')
                ->setFilterPillTitle('Penyedia No Referensi')
                ->filter(function(Builder $q, string $val){
                    if($val != '')
                        $q->where('sumber_id_referensi','like','%'.$val.'%');
                })
                
        ];
    }

    public function hapusApd($id)
    {
        try{

            $Size = ApdList::find($id);
            $Size->delete();
            session()->flash('alert-success-apd','Barang APD berhasil dihapus.');

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Pengaturan APD @ dashboard admin error : kesalahan saat mencoba menghapus apd dengan id '.$id.' ref : '.$time.' '.$e);
            Log::error('Pengaturan APD @ dashboard admin error : kesalahan saat mencoba menghapus apd dengan id '.$id.' ref : '.$time.' '.$e);
            session()->flash('alert-danger-apd',"Terjadi kesalahan saat menghapus APD! ref : ".$time);
        }
    }
}
