<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Livewire\Component;
use Throwable;

class ModalKolomProgressTabelAnggotaKaton extends Component
{

    // data normal untuk ditampilkan secara biasa di modal
    public
        $nama_pegawai = "Pegawai",
        $nama_periode = "Periode Input Tidak Diketahui",
        $parameter_inputan = "Tidak ada data yang ditampilkan";

    // data array untuk ditampilkan menggunakan foreach
    public
        $list_inputan = [],
        $gambar_terpilih = [];

    // boolean sebagai pengganti flag array kosong
    public
        $list_inputan_terisi = false,
        $gambar_terpilih_terisi = false;

    // untuk menampilkan satu gambar saja
    public $gambar = "";

    // untuk menampilkan nama dari jenis apd yang dipilih
    public $nama_terpilih = "";

    protected $listeners = [
        'panggilModalKolomProgress' => 'inisiasiModal',
        'satuFoto',
        'semuaFoto'
    ];

    public function render()
    {
        return view('eapd.livewire.modal.modal-kolom-progress-tabel-anggota-katon');
    }

    public function inisiasiModal($data)
    {
        try {
            // ambil data dari event
            $id = $data[0];
            $periode = $data[1];

            // ambil nama pegawai
            $this->nama_pegawai = Pegawai::where('id', '=', $id)->first()->nama;

            // ambil nama periode input
            $this->nama_periode = PeriodeInputApd::where('id', '=', $periode)->first()->nama_periode;

            // ambil id jabatan si pengupload
            $id_jabatan = Pegawai::where('id', '=', $id)->first()->id_jabatan;

            // panggil ApdDataController
            $adc = new ApdDataController;

            // isi apa saja yang telah diinput oleh user
            $this->list_inputan = $adc->muatInputanPegawai($periode, $id);

            // sesuaikan flagnya
            if(is_array($this->list_inputan))
            {
                if($this->list_inputan != [])
                    $this->list_inputan_terisi = true;
                else
                    $this->list_inputan_terisi = false;
            }
            else
                $this->list_inputan_terisi = false;

            // buat nilai maksimal dari inputan yang harus diinput oleh pegawai
            $maks = count($adc->muatListInputApdDariTemplate($periode,$id_jabatan));

            // nilai parameter inputan saat ini
            $val = count($this->list_inputan);

            // buat parameter inputan dari nilai saat ini dan nilai maksimal inputan
            $this->parameter_inputan = ($val !=0)? 'Terinput '.$val . ' dari '.$maks.' item.':'';
        } 
        catch (Throwable $e) {
            error_log('Gagal inisiasi modal kolom progress tabel anggota katon ' . $e);
            $this->nama_pegawai = "Pegawai";
            $this->nama_periode = "Periode Input -";
            $this->parameter_inputan = "";
            $this->list_inputan = [];
            $this->gambar_terpilih = [];
        }
    }

    public function satuFoto($id_collapse, $index_inputan, $index_gambar)
    {
        try
        {

            // jika gambar yang telah diinput hanya satu
            if($index_gambar < 0)
            {
                // ambil data gambar as is
                $inputan_terpilih = $this->list_inputan[$index_inputan];
                $this->gambar = $inputan_terpilih['gambar_apd'];
            }
            // jika gambar yang telah diinput ada banyak
            else
            {
                // ambil data gambar berdasarkan indexnya di array gambar_apd
                $inputan_terpilih = $this->list_inputan[$index_inputan];
                $this->gambar = $inputan_terpilih['gambar_apd'][$index_gambar];
            }

            // trigger event bernama 'kolapse' di javascript
            $this->dispatchBrowserEvent('kolapse',['id'=>$id_collapse]);
        }
        catch(Throwable $e)
        {
            error_log('gagal menampilkan satu foto di modal kolom progress tabel anggota katon '.$e);
        }
    }

    public function semuaFoto($id_collapse,$index_inputan)
    {
        try
        {
            $inputan_terpilih = $this->list_inputan[$index_inputan];
            if(is_array($inputan_terpilih['gambar_apd']) || $inputan_terpilih != "")
            {
                $this->gambar_terpilih = $inputan_terpilih['gambar_apd'];
                $this->nama_terpilih = $inputan_terpilih['nama_jenis'];
                $this->gambar_terpilih_terisi = true;
            }
            else
            {
                $this->gambar_terpilih = [];
                $this->nama_terpilih = "";
                $this->gambar_terpilih_terisi = false;
            }

            $this->dispatchBrowserEvent('kolapse',['id'=>$id_collapse]);

        }
        catch(throwable $e)
        {
            error_log('gagal menampilkan semua foto di modal kolom progress tabel anggota katon '.$e);

        }
    }
}
