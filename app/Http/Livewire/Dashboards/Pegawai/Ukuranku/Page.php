<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Ukuranku;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\Pegawai;
use App\Models\PeriodeInputApd;
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
    public $cache_ukuranTerisi = [];

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
            error_log('Dashboard Ukuranku Pegawai Error : Kesalahan saat mengambil data user '.$e);
        }
        
    }

    public function siapkanTemplate()
    {
        try{

            $adc = new ApdDataController;
            if(!is_null($template = $adc->muatListInputApdDariTemplate(1, Auth::user()->data->id_jabatan)))
            {
                $i = 0;
                foreach($template as  $t)
                {
                    // ambil jenis dan apd pertama dalam template tsb untuk dijadikan patokan opsi memilih ukuran

                    $id_jenis = $t['id_jenis'];

                    $target_apd = $t['opsi_apd'][0];

                    $target_size = ApdList::where('id_apd',$target_apd)->get()->first()->size;

                    // jika apd tersebut tidak memiliki ukuran, skip
                    if(is_null($target_size))
                        continue;

                    $this->listKebutuhanUkuran[$i] = [
                        "id_jenis" => $id_jenis,
                        "nama_jenis" => ApdJenis::find($id_jenis)->nama_jenis,
                        "opsi" => $target_size->opsi
                    ];

                    $this->ukuranTerisi[$i] = '';
                    $this->cache_ukuranTerisi[$i] = '';
                    $i++;
                }
            }

        }
        catch(Throwable $e)
        {
            error_log('Dashboard Ukuranku Pegawai Error : Kesalahan saat menyiapkan template '.$e);
        }
    }

    public function sesuaikanDataDenganTemplate()
    {
        try{
            error_log('sesuaikan dengan template');
            foreach($this->ukuranPegawai as $ukuran)
            {
                $index = array_search($ukuran['id_jenis'], array_column($this->listKebutuhanUkuran, "id_jenis"));
                error_log("index ".$index);
                if($index)
                {
                    $this->ukuranTerisi[$index] = $ukuran['ukuran'];
                    $this->cache_ukuranTerisi[$index] = $ukuran['ukuran'];
                }
            }

        }
        catch(Throwable $e)
        {
            error_log('Dashboard Ukuranku Pegawai Error : Kesalahan saat menyesuaikan data dengan template '.$e);
        }
    }

    public function simpan()
    {
        error_log('simpan kepanggil');
        try{
            // siapkan data
            $id_pegawai = Auth::user()->data->id_pegawai;
            $terakhir_diisi = Carbon::now('Asia/Jakarta')->toDateTimeString();
            $ukuran = UkuranPegawai::where("id_pegawai" , $id_pegawai)->first();
            
            // iterasi jika isian terisi, maka masukan ke database
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

            if(is_null($ukuran))
            {
                UkuranPegawai::create([
                    "id_pegawai" => $id_pegawai,
                    "terakhir_diisi" => $terakhir_diisi,
                    "list_ukuran" => $this->ukuranPegawai
                ]);
            }
            else
            {
                $ukuran->update([
                    "terakhir_diisi" => $terakhir_diisi,
                    "list_ukuran" => $this->ukuranPegawai
                ]);
            }
            session()->flash('form-success', 'Data ukuran berhasil diubah.');
            $this->inisiasi();
        }
        catch(Throwable $e)
        {
            session()->flash('form-fail', 'Data ukuran gagal diubah.');
            error_log('Dashboard Ukuranku Pegawai Error : Kesalahan saat menyimpan '.$e);
        }
    }

    public function resetForm()
    {
        $this->cache_ukuranTerisi = $this->ukuranTerisi;
    }
}
