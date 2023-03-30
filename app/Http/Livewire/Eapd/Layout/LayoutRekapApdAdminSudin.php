<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdRekapController;
use App\Http\Controllers\FileController;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class LayoutRekapApdAdminSudin extends Component
{
    public
        $id_periode = "",
        $nama_periode = "",
        $data_rekap_apd = [];

    public
        $detail_gambar = "",
        $id_detail_pegawai = "";

    public
        $profil_nama = "",
        $profil_penempatan = "",
        $profil_nip = "",
        $profil_nrk = "",
        $profil_grup = "",
        $profil_foto = "";

    protected $listeners = [
        'lihatGambarRekapSudin' => 'lihatGambar',
        'lihatDetailPegawaiRekapSudin'=>'lihatDetailPegawai'
    ];

    public function render()
    {
        return view('eapd.livewire.layout.layout-rekap-apd-admin-sudin');
    }

    public function mount()
    {
        try{
            $adc = new ApdDataController;
            $this->id_periode = $adc->ambilIdPeriodeInput();
            $this->nama_periode = PeriodeInputApd::find($this->id_periode)->nama_periode;
            $this->muatDataRekap();
        }
        catch(Throwable $e)
        {
            error_log("gagal memuat ".$e);
        }
    }

    public function detailRekap($value)
    {
        try{
            error_log($value[0]);
            $sudin = Auth::user()->data->wilayah->id;
            $this->emit('tampilTabel',[$sudin,$this->id_periode,$value[0],$value[1],$value[2]]);
            // $this->emit('tampilTabel');

            $this->dispatchBrowserEvent('showDetailRekapApdAdminSudin');

        }
        catch(Throwable $e)
        {

        }
    }

    public function muatDataRekap()
    {
        try{

            $apr = new ApdRekapController;
            $this->data_rekap_apd = $apr->bangunDataTabelRekapApdSudin();
        }
        catch(Throwable $e)
        {
            error_log('gagal memuat data rekap () '.$e);
        }
    }



    public function lihatGambar($value)
    {
        try{
            $this->detail_gambar = $value;
            $this->dispatchBrowserEvent('showLihatGambar');
        }
        catch(Throwable $e)
        {
            $this->detail_gambar = "";
            error_log('gagal melihat gambar rekap '.$e);
        }
    }

    public function lihatDetailPegawai($value)
    {
        try{
            $fc = new FileController;
            $this->id_detail_pegawai = $value;
            $pegawai = Pegawai::find($this->id_detail_pegawai);
            $this->profil_nama = $pegawai->nama;
            $this->profil_penempatan = $pegawai->penempatan->nama_penempatan;
            $this->profil_nip = $pegawai->nip;
            $this->profil_nrk = $pegawai->nrk;
            $this->profil_grup = $pegawai->grup->nama_grup;
            $this->profil_foto = ($pegawai->profile_img)? $fc::$avatarUploadBasePath.$fc->prosesNamaFileAvatarUpload($this->id_pegawai) : $fc::$avatarPlaceholder;
            $this->dispatchBrowserEvent('showDetailProfil');

        }
        catch(Throwable $e)
        {
            $this->id_detail_pegawai = "";
            $this->profil_nama = "";
            $this->profil_penempatan = "";
            $this->profil_nip = "";
            $this->profil_nrk = "";
            $this->profil_grup = "";
            $this->profil_foto = "";
            error_log('gagal melihat detail pegawai '.$e);
        }
    }
}
