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
    public $tanggal = "Belum pernah mengisi..";

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

    public function mount()
    {
        $this->ambilDataUser();
    }

    public function ambilDataUser()
    {
        try
        {
            // ambil inputan terdahulu
            if(!is_null($inputan = Pegawai::find(Auth::user()->id)->ukuran))
            {
                $this->tanggal = $inputan['tanggal'];
                $this->ukuranFireJacket = $inputan['Fire_Jacket'];
                $this->ukuranFireBoots = $inputan['Fire_Boots'];
                $this->ukuranRescueBoots = $inputan['Rescue_Boots'];
                $this->ukuranWaterRescueBoots = $inputan['Water_Rescue_Boots'];
                $this->ukuranJumpsuit = $inputan['Jumpsuit'];
                $this->ukuranFireGloves = $inputan['Fire_Gloves'];
                $this->ukuranRescueGloves = $inputan['Rescue_Gloves'];
            }
            else
            {
                error_log('hit field ukuran tidak ada');
            }
                error_log('pengetesan selesai');
        }
        catch(Throwable $e)
        {

        }
        
    }

    public function simpan()
    {
        try{
            // iterasi jika isian terisi, maka masukan ke database
            $pegawai = Pegawai::find(Auth::user()->id);

            $inputan = [
                'tanggal' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'Fire_Jacket' => $this->ukuranFireJacket,
                'Jumpsuit' => $this->ukuranJumpsuit,
                'Fire_Gloves' => $this->ukuranFireGloves,
                'Rescue_Gloves' => $this->ukuranRescueGloves,
                'Fire_Boots' => $this->ukuranFireBoots,
                'Rescue_Boots' => $this->ukuranRescueBoots,
                'Water_Rescue_Boots' => $this->ukuranWaterRescueBoots,
            ];

            $pegawai->ukuran = $inputan;
            $pegawai->save();
            session()->flash('form-success', 'Data ukuran berhasil diubah.');
            $this->ambilDataUser();
        }
        catch(Throwable $e)
        {
            session()->flash('form-fail', 'Data ukuran gagal diubah.');
            error_log('gagal dalam menyimpan data ukuran');
        }
        
        
    }
}
