<?php

namespace App\Http\Livewire\Eapd\Form;

use App\Http\Controllers\ApdUkuranController;
use App\Models\Eapd\Mongodb\Pegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class Ukuran extends Component
{

    // tanggal terakhir di update
    public $tanggal = "";

    // ukuran untuk isian user
    public 
            $ukuranFireJacket = "",
            $ukuranJumpsuit = "",
            $ukuranFireGloves = "",
            $ukuranRescueGloves = "",
            $ukuranFireBoots = "",
            $ukuranRescueBoots = "",
            $ukuranWaterRescueBoots = "";

    // opsi ukuran untuk select
    public 
            $opsiFireJacket = ['S','M','L','XL','XXL','XXXL'],
            $opsiJumpsuit = ['S','M','L','XL','XXL','XXXL'],
            $opsiFireGloves = ['S','M','L','XL'],
            $opsiRescueGloves = ['S','M','L','XL'],
            $opsiFireBoots = ['36','37','38','39','40','41','42','43','44','45'],
            $opsiRescueBoots = ['36','37','38','39','40','41','42','43','44','45'],
            $opsiWaterRescueBoots = ['36','37','38','39','40','41','42','43','44','45'];

    protected $listeners = ['inisiasiFormUkuran'=>'inisiasi'];

    public function render()
    {
        return view('eapd.livewire.form.ukuran');
    }

    public function inisiasi()
    {
        // ambil inputan terdahulu
        if(!is_null($inputan = Pegawai::find(Auth::user()->id)->ukuran))
        {
            $this->tanggal = $inputan['tanggal'];
            $this->ukuranFireJacket = $inputan['FireJacket'];
            $this->ukuranFireBoots = $inputan['FireBoots'];
            $this->ukuranRescueBoots = $inputan['RescueBoots'];
            $this->ukuranWaterRescueBoots = $inputan['WaterRescueBoots'];
            $this->ukuranJumpsuit = $inputan['Jumpsuit'];
            $this->ukuranFireGloves = $inputan['FireGlove'];
            $this->ukuranRescueGloves = $inputan['RescueGlove'];
        }
        else
        {
            error_log('hit field ukuran tidak ada');
        }
            error_log('pengetesan selesai');
    }

    public function simpan()
    {
        try{
            // iterasi jika isian terisi, maka masukan ke database
            $pegawai = Pegawai::find(Auth::user()->id);

            $inputan = [
                'tanggal' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'FireJacket' => $this->ukuranFireJacket,
                'Jumpsuit' => $this->ukuranJumpsuit,
                'FireGlove' => $this->ukuranFireGloves,
                'RescueGlove' => $this->ukuranRescueGloves,
                'FireBoots' => $this->ukuranFireBoots,
                'RescueBoots' => $this->ukuranRescueBoots,
                'WaterRescueBoots' => $this->ukuranWaterRescueBoots,
            ];

            $pegawai->ukuran = $inputan;
            $pegawai->save();
        }
        catch(Throwable $e)
        {
            error_log('gagal dalam menyimpan data ukuran');
        }
        
        
    }
}
