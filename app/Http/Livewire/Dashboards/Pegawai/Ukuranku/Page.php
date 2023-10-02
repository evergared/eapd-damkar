<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Ukuranku;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\Pegawai;
use App\Models\UkuranPegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class Page extends Component
{

    // tanggal terakhir di update
    public $tanggal = "Belum pernah mengisi..";

    // ukuran yang telah diisi oleh pegawai
    public $ukuranPegawai = [];

    // ukuran yang harus diisi oleh pegawai
    public $listKebutuhanUkuran = [];

    // untuk menampung value saat user mulai mengisi
    public $ukuranTerisi = [];

    protected $listeners = ['inisiasiFormUkuran'=>'inisiasi'];

    public function render()
    {
        return view('livewire.dashboards.pegawai.ukuranku.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Ukuranku']);
    }

    public function mount()
    {
        $this->inisiasi();
    }

    public function inisiasi()
    {
        $this->siapkanTemplate();
        $this->ambilDataUser();
        $this->sesuaikanDataDenganTemplate();
    }

    public function ambilDataUser()
    {
        try
        {
            // ambil inputan terdahulu
            if(!is_null($inputan = Pegawai::find(Auth::user()->id_pegawai)->ukuran))
            {
                $this->tanggal = $inputan['terakhir_diisi'];
                
                $this->ukuranPegawai = $inputan['list_ukuran'];
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

    public function siapkanTemplate()
    {
        try{

            $adc = new ApdDataController;
            if(!is_null($template = $adc->muatListInputApdDariTemplate(1, Auth::user()->data->id_jabatan)))
            {
                foreach($template as $i => $t)
                {
                    // ambil jenis dan apd pertama dalam template tsb untuk dijadikan patokan opsi memilih ukuran

                    $id_jenis = $t['id_jenis'];

                    $target_apd = $t['opsi'][0];

                    $target_size = ApdList::find($target_apd)->opsi;

                    $this->listKebutuhanUkuran[$i] = [
                        "id_jenis" => $id_jenis,
                        "nama_jenis" => ApdJenis::find($id_jenis)->nama_jenis,
                        "opsi" => $target_size
                    ];

                    $this->ukuranTerisi[$i] = '';
                }
            }

        }
        catch(Throwable $e)
        {

        }
    }

    public function sesuaikanDataDenganTemplate()
    {
        try{

            foreach($this->ukuranPegawai as $ukuran)
            {
                $index = array_search($ukuran['id_jenis'], array_column($this->listKebutuhanUkuran, "id_jenis"));

                if($index)
                {
                    $this->ukuranTerisi[$index] = $ukuran['ukuran'];
                }
            }

        }
        catch(Throwable $e)
        {

        }
    }

    public function simpan()
    {
        try{
            // iterasi jika isian terisi, maka masukan ke database
            $ukuran = UkuranPegawai::find(Auth::user()->id_pegawai);

            foreach($this->listKebutuhanUkuran as $i => $data)
            {
                // cek apakah inputan kosong
                if($this->ukuranTerisi[$i] != '')
                {
                    // cek apakah user pernah mengisi jenis tsb
                    $index = array_search($data['id_jenis'], array_column($this->ukuranPegawai, 'id_jenis'));

                    if($index)
                    {
                        // ubah value yang sudah terisi
                        $this->ukuranPegawai[$index]['value'] = $this->ukuranTerisi[$i];
                    }
                    else
                    {
                        // tambahkan ke ukuran pegawai
                        $length = count($this->ukuranPegawai);

                        $this->ukuranPegawai[$length] = [
                            "id_jenis" => $data['id_jenis'],
                            "value" => $this->ukuranTerisi[$i]
                        ];
                    }
                }
            }

            $ukuran->terakhir_diisi = Carbon::now('Asia/Jakarta')->toDateTimeString();
            $ukuran->list_ukuran = $this->ukuranPegawai;
            $ukuran->save();
            session()->flash('form-success', 'Data ukuran berhasil diubah.');
            $this->inisiasi();
        }
        catch(Throwable $e)
        {
            session()->flash('form-fail', 'Data ukuran gagal diubah.');
            error_log('Dashboard Ukuranku Pegawai Error : Kesalahan saat menyimpan '.$e);
        }
        
        
    }
}
