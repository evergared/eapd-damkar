<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Enum\VerifikasiApd as verif;
use Livewire\Component;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\PeriodeInputApd;
use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\ApdList;
use App\Models\Eapd\InputApd;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LayoutShowDetailTabelAnggotaAdmin extends Component
{

    public  
        $id_pegawai = "",
        $periode = "";

    // data normal untuk ditampilkan secara biasa
    public
        $nama_pegawai = "Pegawai",
        $nama_periode = "Periode Input Tidak Diketahui",
        $parameter_inputan = "Tidak ada data yang ditampilkan";

    // data array untuk ditampilkan menggunakan foreach
    public
        $list_inputan = [],
        $opsi_verifikasi = [];

    // boolean sebagai pengganti flag array kosong
    public
        $list_inputan_terisi = false;

    // untuk menampilkan satu gambar saja
    public $gambar = "";

    // untuk menampilkan nama dari jenis apd yang dipilih
    public $nama_terpilih = "";

    // data untuk lihat detail

    // data detail inputan user
    public 
        $detail_gambar_user =[],
        $detail_id_jenis_apd = "",
        $detail_nama_jenis_apd = "",
        $detail_id_apd = "",
        $detail_nama_apd = "",
        $detail_status_verifikasi = "",
        $detail_warna_verifikasi = "",
        $detail_status_kerusakan = "",
        $detail_warna_kerusakan = "",
        $detail_komentar_pengupload = "",
        $detail_nrk_verifikator = "",
        $detail_nama_verifikator = "",
        $detail_jabatan_verifikator = "",
        $detail_komentar_verifikator = "";

    // data detail template
    public $gambar_template_apd = [];

    // urutan data yang dipilih dari list inputan
    // in case melakukan reload hanya untuk item tersebut
    public $urutan_detail_item = -1;

    // data verifikasi admin
    public 
            $admin_verifikasi = "",
            $admin_komentar = "";

    protected $listeners = [

        'satuGambar',
        'showDetail' => 'inisiasiLayout',
        'lihatDetail'

    ];

    public function render()
    {
        return view('eapd.livewire.layout.layout-show-detail-tabel-anggota-admin');
    }

    public function inisiasiLayout($data)
    {
        try
        {
            // ambil data dari event
            $this->id_pegawai = $data[0];
            $this->periode = $data[1];


            // ambil nama pegawai
            $this->nama_pegawai = Pegawai::where('id', '=', $this->id_pegawai)->first()->nama;

            // ambil nama periode input
            $this->nama_periode = PeriodeInputApd::where('id', '=', $this->periode)->first()->nama_periode;

            // ambil id jabatan si pengupload
            $id_jabatan = Pegawai::where('id', '=', $this->id_pegawai)->first()->id_jabatan;

            // panggil ApdDataController
            $adc = new ApdDataController;

            // isi apa saja yang telah diinput oleh user
            $this->list_inputan = $adc->muatInputanPegawai($this->periode, $this->id_pegawai);

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
            $maks = count($adc->muatListInputApdDariTemplate($this->periode,$id_jabatan));

            // nilai parameter inputan saat ini
            $val = count($this->list_inputan);

            // buat parameter inputan dari nilai saat ini dan nilai maksimal inputan
            $this->parameter_inputan = ($val !=0)? 'Terinput '.$val . ' dari '.$maks.' item.':'';

            array_push($this->opsi_verifikasi, [
                'value' => 3,
                'label' => 'Validasi Data'
            ]);
            array_push($this->opsi_verifikasi, [
                'value' => 4,
                'label' => 'Tolak Data'
            ]);            

            

            $this->dispatchBrowserEvent('jsShowDetail');
        }
        catch(Throwable $e)
        {
            error_log('gagal inisiasi layout show detail');
            $this->nama_pegawai = "Pegawai";
            $this->nama_periode = "Periode Input -";
            $this->parameter_inputan = "";
            $this->list_inputan = [];
            $this->dispatchBrowserEvent('jsShowDetail');

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
            $this->dispatchBrowserEvent('kolapseShow',['id'=>$id_collapse]);
        }
        catch(Throwable $e)
        {
            error_log('gagal menampilkan satu foto di modal kolom progress tabel anggota katon '.$e);
        }
    }

    public function lihatDetail($data)
    {
        try
        {
            $this->kosongkanDataInput();

            $this->urutan_detail_item = $data;
            $inputan = $this->list_inputan[$data];

            $this->muatDataDariArrayInputan($inputan);

            $this->dispatchBrowserEvent('kolapseHide',['id'=>'preview-foto-apd-anggota']);
            $this->dispatchBrowserEvent('kolapseShow',['id'=>'detail-inputan']);
            
        }
        catch (Throwable $e)
        {
            error_log('error lihat detail '.$e);
        }
    }

    public function simpanDataValidasi()
    {
        $this->validate([
            'admin_verifikasi' => 'required'
        ],
        [
            'admin_verifikasi.required' => 'Data ini perlu untuk dipilih (validasi/tolak).'
        ]);

        try
        {
            $input = InputApd::where('id_pegawai','=',$this->id_pegawai)
                    ->where('id_jenis','=',$this->detail_id_jenis_apd)
                    ->where('id_apd','=',$this->detail_id_apd)
                    ->where('id_periode','=',$this->periode)
                    ->first();


                
            $input->verifikasi_oleh = Auth::user()->userid;
            $input->verifikasi_status = verif::tryFrom($this->admin_verifikasi);
            $input->komentar_verifikator = $this->admin_komentar;

            $input->save();
                    
            // $input->update([
            //     'verifikasi_oleh'=> Auth::user()->userid,
            //     'verifikasi_status'=>$this->admin_verifikasi,
            //     'komentar_verifikator'=>$this->admin_komentar
            // ]);


            $adc = new ApdDataController;

            $this->muatDataDariArrayInputan($adc->muatSatuInputanPegawai($this->detail_id_jenis_apd,$this->detail_id_apd,$this->periode,$this->id_pegawai));
            
            // isi apa saja yang telah diinput oleh user
            $this->list_inputan = $adc->muatInputanPegawai($this->periode, $this->id_pegawai);

            session()->flash('success_simpan_data','Perubahan validasi berhasil dilakukan.');
        }
        catch(Throwable $e)
        {
            error_log('Gagal simpan data validasi '.$e);
            report('Gagal simpan data validasi '.$e);
            session()->flash('fail_simpan_data','Kesalahan dalam menyimpan data validasi.');

        }
    }

    function muatDataDariArrayInputan(array $inputan)
    {
        try
        {

            $this->detail_gambar_user = $inputan['gambar_apd'];
            $this->detail_id_apd = $inputan['id_apd'];
            $this->detail_nama_apd = ApdList::where('id_apd','=',$this->detail_id_apd)->first()->nama_apd;
            $this->detail_id_jenis_apd = $inputan['id_jenis'];
            $this->detail_nama_jenis_apd = $inputan['nama_jenis'];
            $this->detail_status_kerusakan = $inputan['status_kerusakan'];
            $this->detail_status_verifikasi = $inputan['status_verifikasi'];
            $this->detail_warna_kerusakan = $inputan['warna_kerusakan'];
            $this->detail_warna_verifikasi = $inputan['warna_verifikasi'];
            $this->detail_komentar_pengupload = $inputan['komentar_pengupload'];
            $this->detail_nrk_verifikator = $inputan['nrk_verifikator'];
            $this->detail_komentar_verifikator = $inputan['komentar_verifikator'];

            $verifikator = Pegawai::where('nrk','=',$this->detail_nrk_verifikator)->first();
            $this->detail_nama_verifikator = (is_null($verifikator))? '' : $verifikator->nama;
            $this->detail_jabatan_verifikator = (is_null($verifikator))?  '' :'('.$verifikator->jabatan->nama_jabatan.' '.$verifikator->penempatan->nama_penempatan.')';

            $adc = new ApdDataController;

            $this->gambar_template_apd = $adc->siapkanGambarTemplateBesertaPathnya(ApdList::where('id_apd','=',$this->detail_id_apd)->first()->image,$this->detail_id_jenis_apd,$this->detail_id_apd);
            
        }
        catch (Throwable $e)
        {

        }
    }

    function kosongkanDataInput()
    {
        $this->detail_gambar_user =[];
        $this->detail_id_jenis_apd = "";
        $this->detail_nama_jenis_apd = "";
        $this->detail_id_apd = "";
        $this->detail_nama_apd = "";
        $this->detail_status_verifikasi = "";
        $this->detail_warna_verifikasi = "";
        $this->detail_status_kerusakan = "";
        $this->detail_warna_kerusakan = "";
        $this->detail_komentar_pengupload = "";
        $this->detail_nrk_verifikator = "";
        $this->detail_nama_verifikator = "";
        $this->detail_jabatan_verifikator = "";
        $this->detail_komentar_verifikator = "";

        $this->admin_verifikasi = "";
        $this->admin_komentar = "";
    }
}
