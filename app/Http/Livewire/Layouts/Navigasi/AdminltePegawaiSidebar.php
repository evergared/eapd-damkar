<?php

namespace App\Http\Livewire\Layouts\Navigasi;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\InputApdTemplate;
use App\Models\PeriodeInputApd;
use App\Models\UkuranPegawai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class AdminltePegawaiSidebar extends Component
{
    public $notif_ukuranku_belum_isi = 0;

    public $notif_apdku_belum_isi = 0;

    public $notif_apdku_ditolak = 0;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $this->cekApdku();
        $this->cekUkuranku();
        return view('livewire.layouts.navigasi.adminlte-pegawai-sidebar');
    }

    public function cekUkuranku()
    {
        try{

            $this->notif_ukuranku_belum_isi = 0;

            // cek periode yang membuka pengumpulan data ukuran
            $periode = PeriodeInputApd::where('kumpul_ukuran', true)->first();

            if(is_null($periode))
            {
                $this->notif_ukuranku_belum_isi = 0;
                return;
            }

            // ambil apa saja ukuran yang perlu diisi
            $adc = new ApdDataController;

            $template = $adc->muatListInputApdDariTemplate($periode->id_periode, Auth::user()->data->id_jabatan);

            // ambil semua ukuran yang pernah diisi oleh pegawai
            $ukuran_pegawai = UkuranPegawai::where('id_pegawai', Auth::user()->data->id_pegawai)->first();

            $ukuran_terisi = [];

            if(!is_null($ukuran_pegawai))
                $ukuran_terisi = $ukuran_pegawai->list_ukuran;
            
            
            // cek apakah ukuran yang diminta pernah diisi oleh pegawai
            foreach($template as $t)
            {
                $id_jenis = $t['id_jenis'];

                $target_apd = $t['opsi_apd'][0];

                $target_size = ApdList::where('id_apd',$target_apd)->get()->first()->size;

                // jika apd tersebut tidak memiliki ukuran, skip
                if(is_null($target_size))
                    continue;

                $index = array_search($id_jenis, array_column($ukuran_terisi, "id_jenis"));

                if(is_bool($index) && $index==false)
                    $this->notif_ukuranku_belum_isi++;
            }


        }
        catch(Throwable $e)
        {
            error_log("Sidebar Pegawai Error : kesalahan saat melakukan pengecekan ukuranku ".$e);
            $this->notif_ukuranku_belum_isi = 0;
        }
    }

    public function cekApdku()
    {
        try{

            $this->notif_apdku_belum_isi = 0;
            $this->notif_apdku_ditolak = 0;

            // cek periode yang aktif
            $periode = PeriodeInputApd::where('aktif', true)->first();

            if(is_null($periode))
            {
                $this->notif_apdku_belum_isi = 0;
                $this->notif_apdku_ditolak = 0;
                return;
            }

            // ambil apa saja apd yang perlu diisi
            $adc = new ApdDataController;

            $template = $adc->muatListInputApdDariTemplate($periode->id_periode, Auth::user()->data->id_jabatan);

            // ambil semua yang telah diinput oleh user
            $inputan_pegawai = InputApd::where('id_periode',$periode->id_periode)
                                ->where('id_pegawai',Auth::user()->data->id_pegawai)
                                ->get();
            
            $inputan_terisi = [];

            if(is_null($inputan_pegawai))
                $inputan_terisi = $inputan_pegawai;

            // cek apakah apd yang diminta sudah diinput oleh pegawai
            foreach($template as $t)
            {
                
            }
        }
        catch(Throwable $e)
        {

        }
    }
}
