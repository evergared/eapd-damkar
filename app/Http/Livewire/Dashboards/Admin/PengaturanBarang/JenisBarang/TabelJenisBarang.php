<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\JenisBarang;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdJenis;
use App\Models\ApdList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Throwable;

class TabelJenisBarang extends DataTableComponent
{
    

    public function configure(): void
    {
        $this->setPrimaryKey('id_jenis');
    }

    public function builder(): Builder
    {
        return ApdJenis::query();
    }

    public function columns(): array
    {
        return [

            Column::make("Id jenis", "id_jenis")
                ->sortable(),
            Column::make("Nama jenis", "nama_jenis")
                ->sortable(),
            Column::make("Jumlah Item APD",null)
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang berjenis ini.";
                })
                ->label(function($row){
                    return ApdList::where('id_jenis',$row->id_jenis)->get()->count();
                }),
            Column::make('Tindakan',null)
                ->label(function($row){
                    $item = ApdList::where('id_jenis',$row->id_jenis)->get()->count();

                    return view('livewire.dashboards.admin.pengaturan-barang.jenis-barang.kolom-tindakan',["flag" => $item > 0, "id" => $row->id_jenis]);
                })
        ];
    }

    public function hapusJenis($id)
    {
        try{

            $jenis = ApdJenis::find($id);
            $jenis->delete();
            session()->flash('alert-success','Jenis APD berhasil dihapus.');

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Pengaturan Jenis barang @ dashboard admin error : kesalahan saat mencoba menghapus barang dengan id '.$id.' ref : '.$time.' '.$e);
            Log::error('Pengaturan Jenis barang @ dashboard admin error : kesalahan saat mencoba menghapus barang dengan id '.$id.' ref : '.$time.' '.$e);
            session()->flash('alert-danger',"Terjadi kesalahan saat menghapus jenis barang! ref : ".$time);
        }
    }
}
