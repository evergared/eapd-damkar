<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Enum\VerifikasiApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\InputApd;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class ModalDetailProgressSudin extends Component
{

    // value general
    public 
        $nama_pegawai = "",
        $id_pegawai = "",
        $id_periode = "",
        $list_inputan_pegawai = [],
        $temp_verifikasi_inputan = [],
        $cache_verifikasi_inputan = [];

    // untuk cek berhasil/tidak perubahan yang dilakukan
    public
        $ada_verifikasi_yang_berubah = false, 
        $verifikasi_yang_berubah = array('berhasil' => ['fj','nn'], 'gagal' => ['fj','nn']),
        $verifikasi_yang_berhasil_diubah = array(),
        $verifikasi_yang_gagal_diubah = array();

    // untuk tampilan gambar di card detail inputan
    public
        $gambar_terpilih = null, 
        $nama_apd_detail = "",
        $gambar_apd_template = null,
        $data_detail_inputan = null;

    // untuk data profil
    public 
        $profil_tampil = false,
        $profil_penempatan = "",
        $profil_nip = "",
        $profil_nrk = "",
        $profil_grup = "",
        $profil_foto = "";

    public $listeners = [
        'ModalProgressSudin'
    ];

    #region livewire lifecycle
    public function render()
    {
        return view('eapd.livewire.modal.modal-detail-progress-sudin');
    }
    #endregion

    #region event handler
    public function ModalProgressSudin($value)
    {
        error_log('detail inputan sudin '.$value);
        try
        {
            $this->id_pegawai = $value;
            $this->nama_pegawai = Pegawai::find($this->id_pegawai)->nama;

            $adc = new ApdDataController;
            $this->id_periode = $adc->ambilIdPeriodeInput();
            $this->list_inputan_pegawai = $adc->muatInputanPegawai($this->id_periode,$this->id_pegawai);
            $this->temp_verifikasi_inputan = [];
            $this->cache_verifikasi_inputan = [];
            $this->verifikasi_yang_berubah = array('berhasil' => [], 'gagal' => []);
            $this->ada_verifikasi_yang_berubah = false;
            foreach($this->list_inputan_pegawai as $item)
            {
                $n = array('id_jenis' => $item['id_jenis'], 'verifikasi' => $item['enum_verifikasi'],"komentar" => "");
                array_push($this->temp_verifikasi_inputan,$n
                );
            }
            $this->cache_verifikasi_inputan = $this->temp_verifikasi_inputan;
        }
        catch(Throwable $e)
        {
            error_log('gagal memuat data untuk detail inputan pegawai '.$e);
            $this->id_pegawai = "";
            $this->nama_pegawai = "-";
            session()->flash('error_fetch_data','Gagal memuat data untuk detail inputan pegawai.');
        }
    }
    #endregion

    #region click handler
    public function simpan()
    {
        // pengecekan inputan mana saja yang berubah verifikasinya
        $index = [];
        foreach($this->temp_verifikasi_inputan as $i => $inputan)
        {
            // jika verifikasi tidak kosong dan verifikasi berbeda dengan data sebelumnya
            if(($inputan['verifikasi'] != "" && $inputan['verifikasi'] != $this->cache_verifikasi_inputan[$i]['verifikasi']) || 
               ($inputan['komentar'] != "" && $inputan['komentar'] != $this->cache_verifikasi_inputan[$i]['komentar']) )
                // masukan urutan data tsb ke daftar index
                array_push($index,$i);
        }

        // melakukan perubahan verifikasi terhadap inputan yang berubah
        $adc = new ApdDataController;
        $jumlah_gagal = 0;
        $jumlah_berhasil = 0;
        $this->verifikasi_yang_berubah = array('berhasil' => [], 'gagal' => []);
        $this->verifikasi_yang_berhasil_diubah = array();
        $this->verifikasi_yang_gagal_diubah = array();
        foreach($index as $i)
        {
            try{

                $inputan = InputApd::where('id_pegawai','=',$this->id_pegawai)->where('id_periode','=',$this->id_periode)->where('id_jenis','=',$this->list_inputan_pegawai[$i]['id_jenis'])->get()->first();
                
                if($this->temp_verifikasi_inputan[$i]['verifikasi'] != "" && $this->temp_verifikasi_inputan[$i]['verifikasi'] != $this->cache_verifikasi_inputan[$i]['verifikasi'])
                    $inputan->verifikasi_status = VerifikasiApd::tryFrom($this->temp_verifikasi_inputan[$i]['verifikasi'])->value;

                if($this->temp_verifikasi_inputan[$i]['komentar'] != "" && $this->temp_verifikasi_inputan[$i]['komentar'] != $this->cache_verifikasi_inputan[$i]['komentar'])    
                    $inputan->komentar_verifikator = $this->temp_verifikasi_inputan[$i]['komentar'];

                $inputan->verifikasi_oleh = Auth::user()->id;

                $inputan->save();
                $jumlah_berhasil++;
                array_push($this->verifikasi_yang_berhasil_diubah,ApdJenis::find($inputan->id_jenis)->nama_jenis);
            }
            catch(Throwable $e)
            {
                error_log('gagal menyimpan data pada index '.$i.' dengan data sebagai berikut :');
                error_log('error : '.$e);
                // error_log(implode('|',$this->list_inputan_pegawai[$i]));
                $jumlah_gagal++;
                array_push($this->verifikasi_yang_gagal_diubah,ApdJenis::find($$this->list_inputan_pegawai[$i]['id_jenis'])->nama_jenis);
            }
        }

        // mengeluarkan pesan untuk proses perubahan inputan yang telah dilakukan
        if($jumlah_berhasil > 0 && $jumlah_gagal > 0)
        {
            $this->ModalProgressSudin($this->id_pegawai);
            $this->emit('refreshDataLayout');
            session()->flash('mixed_simpan_data',['success'=>$jumlah_berhasil,'fail'=>$jumlah_gagal]);
        }
        elseif($jumlah_berhasil > 0)
        {
            $this->ModalProgressSudin($this->id_pegawai);
            $this->emit('refreshDataLayout');
            session()->flash('success_simpan_data',$jumlah_berhasil);
        }
        elseif($jumlah_gagal > 0)
        {
            session()->flash('fail_simpan_data',$jumlah_gagal);
        }
        else
        {
            session()->flash('none_simpan_data','Tidak ada yang berubah, pastikan validasi telah dipilih dengan benar (Validasi/Tolak).'.'\n'.'Jika hal ini sering terjadi, harap hubungi admin.');
        }
    }

    public function lihatDetail($value)
    {
        error_log('start lihat detil '.$value);
        $id_jenis = $value;
        $this->gambar_apd_template = null;

        try{
            $this->nama_apd_detail = ApdJenis::find($id_jenis)->nama_jenis;
            $adc = new ApdDataController;
            $this->data_detail_inputan = $adc->muatSatuInputanPegawai($id_jenis,$this->id_periode,$this->id_pegawai);
            $this->gambar_apd_template = $adc->siapkanGambarTemplateBesertaPathnya(ApdList::find($this->data_detail_inputan['id_apd'])->image,$id_jenis,$this->data_detail_inputan['id_apd']);
            $this->dispatchBrowserEvent('cardLihatDetail');
        }
        catch(Throwable $e)
        {
            $this->nama_apd_detail = "-";
            $this->data_detail_inputan = null;
            $this->gambar_apd_template = null;
            error_log('error lihat detail '.$e);
        }
    }

    public function satuFoto($index, $index_gbr)
    {
        $this->gambar_terpilih = null;
        try{

            $inputan = $this->list_inputan_pegawai[$index];
            if($index_gbr < 0)
                $this->gambar_terpilih = $inputan['gambar_apd'];
            else
                $this->gambar_terpilih = $inputan['gambar_apd'][$index_gbr];

            $this->dispatchBrowserEvent('cardLihatFoto');
        

        }
        catch(Throwable $e)
        {

        }
    }

    public function semuaFoto($index)
    {
        $this->gambar_terpilih = null;
        try{

            $this->gambar_terpilih = $this->list_inputan_pegawai[$index]['gambar_apd'];
            $this->dispatchBrowserEvent('cardLihatFoto');

        }
        catch(Throwable $e)
        {

        }
    }

    public function profil()
    {
        $this->profil_tampil = false;
        $this->profil_penempatan = "";
        $this->profil_nip = "";
        $this->profil_nrk = "";
        $this->profil_grup = "";
        $this->profil_foto = "";
        try{
            $fc = new FileController;
            $pegawai = Pegawai::find($this->id_pegawai);
            $this->profil_penempatan = Penempatan::find($pegawai->id_penempatan)->nama_penempatan;
            $this->profil_nip = $pegawai->nip;
            $this->profil_nrk = $pegawai->nrk;
            $this->profil_grup = Grup::where("id_grup",'=',$pegawai->id_grup)->first()->nama_grup;
            $this->profil_foto = ($pegawai->profile_img)? $fc::$avatarUploadBasePath.$fc->prosesNamaFileAvatarUpload($this->id_pegawai) : $fc::$avatarPlaceholder;
            $this->profil_tampil = true;
            $this->dispatchBrowserEvent('cardProfil');

        }
        catch(Throwable $e)
        {
            error_log('gagal tampil profil '.$e);
        }
    }
    #endregion

}
