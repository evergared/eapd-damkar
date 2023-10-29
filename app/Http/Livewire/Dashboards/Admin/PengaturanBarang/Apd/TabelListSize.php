<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use App\Models\ApdList;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdSize;
use Illuminate\Support\Facades\Log;
use Throwable;

class TabelListSize extends DataTableComponent
{
    protected $model = ApdSize::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_size');
        $this->setTableAttributes([
            'class' => "table-head-fixed",
        ]);

        $this->setTdAttributes(function(){
            return [
                'class' => 'align-middle'
            ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Id size", "id_size")
                ->hideIf(true),
            Column::make("Nama size", "nama_size")
                ->sortable(),
            Column::make("Opsi", "opsi")
                ->format(function($value){
                    return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-opsi-size',['data'=>$value]);
                }),
            Column::make("Jumlah Item APD")
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang menggunakan opsi size ini.";
                })
                ->label(function($row){
                    return ApdList::where('id_size',$row->id_size)->get()->count();
                }),
            Column::make('Tindakan')
                ->label(function($row){
                    $item = ApdList::where('id_size',$row->id_size)->get()->count();
                    return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-tindakan-tabel-size',["flag" => $item > 0, "id" => $row->id_size]);
                })
        ];
    }

    public function hapusSize($id)
    {
        try{

            $Size = ApdSize::find($id);
            $Size->delete();
            session()->flash('alert-success-size','Size APD berhasil dihapus.');

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Pengaturan Size barang @ dashboard admin error : kesalahan saat mencoba menghapus opsi ukuran dengan id '.$id.' ref : '.$time.' '.$e);
            Log::error('Pengaturan Size barang @ dashboard admin error : kesalahan saat mencoba menghapus opsi ukuran dengan id '.$id.' ref : '.$time.' '.$e);
            session()->flash('alert-danger-size',"Terjadi kesalahan saat menghapus Size barang! ref : ".$time);
        }
    }
}
