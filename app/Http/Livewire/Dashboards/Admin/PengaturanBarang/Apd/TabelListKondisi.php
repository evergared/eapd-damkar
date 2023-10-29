<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ApdKondisi;
use App\Models\ApdList;
use Illuminate\Support\Facades\Log;
use Throwable;

class TabelListKondisi extends DataTableComponent
{
    protected $model = ApdKondisi::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id_kondisi');
    }

    public function columns(): array
    {
        return [
            Column::make("Id kondisi", "id_kondisi")
                ->sortable(),
            Column::make("Nama kondisi", "nama_kondisi")
                ->sortable(),
            Column::make("Opsi", "opsi")
            ->format(function($value){
                return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-opsi-kondisi',['data'=>$value]);
            }),
            Column::make("Jumlah Item APD")
                ->secondaryHeader(function(){
                    return "Berapa banyak APD unik yang menggunakan opsi kondisi ini.";
                })
                ->label(function($row){
                    return ApdList::where('id_kondisi',$row->id_kondisi)->get()->count();
                }),
            Column::make('Tindakan')
                ->label(function($row){
                    $item = ApdList::where('id_kondisi',$row->id_kondisi)->get()->count();
                    return view('livewire.dashboards.admin.pengaturan-barang.apd.kolom-tindakan-tabel-kondisi',["flag" => $item > 0, "id" => $row->id_Kondisi]);
                })
        ];
    }

    public function hapusKondisi($id)
    {
        try{

            $Kondisi = ApdKondisi::find($id);
            $Kondisi->delete();
            session()->flash('alert-success-kondisi','Kondisi APD berhasil dihapus.');

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Pengaturan Kondisi barang @ dashboard admin error : kesalahan saat mencoba menghapus opsi kondisi dengan id '.$id.' ref : '.$time.' '.$e);
            Log::error('Pengaturan Kondisi barang @ dashboard admin error : kesalahan saat mencoba menghapus opsi kondisi dengan id '.$id.' ref : '.$time.' '.$e);
            session()->flash('alert-danger-kondisi',"Terjadi kesalahan saat menghapus Kondisi barang! ref : ".$time);
        }
    }

}
