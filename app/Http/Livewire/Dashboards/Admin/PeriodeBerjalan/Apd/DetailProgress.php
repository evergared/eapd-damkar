<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\PeriodeInputApd;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class DetailProgress extends Component
{

    public
        $opsi_dropdown_verifikasi = [
            ['value' => '3', 'text'=> 'Verifikasi'],
            ['value' => '4', 'text'=> 'Tolak'],
        ];

    public
        $detail_by_personil_id_pegawai = '',
        $detail_by_personil_nama_pegawai = '',
        $detail_by_personil_penempatan_pegawai = '',
        $detail_by_personil_data_inputan = [],
        $detail_by_personil_entry_detail = null,
        $detail_by_personil_entry_nama_apd = '';

    public
        $gambar_apd_template = null,
        $gambar_terpilih = null;

    public
        $path_gambar = 'storage/';

    public
        $admin_action_verifikasi = "",
        $admin_action_komentar = "";

    public
        $error_time_page = null,
        $error_time_alert = null,
        $error_time_capaian = null,
        $error_time_keberadaan = null,
        $error_time_detail_by_personil = null,
        $error_time_kerusakan = null;
    
    public
        $id_periode_berjalan = null,
        $nama_periode_berjalan = null;

    
        protected $listeners =[
            'paketUntukDetailProgress' => 'terimaPaket',
        ];


    #region Livewire
    public function render()
    {
        return view('livewire.dashboards.admin.periode-berjalan.apd.detail-progress');
    }

    public function mount()
    {

        $pic = new PeriodeInputController;

        $this->id_periode_berjalan = $pic->ambilIdPeriodeInput(null,true);
        $this->nama_periode_berjalan = PeriodeInputApd::find($this->id_periode_berjalan)->nama_periode;
        
    }
    #endregion

    public function terimaPaket($paket)
    {       
            $this->detail_by_personil_id_pegawai = $paket['id'];
            $this->detail_by_personil_nama_pegawai = $paket['nama'];
            $this->detail_by_personil_penempatan_pegawai = $paket['penempatan'];

            $this->detail_by_personil_data_inputan = $paket['data_inputan'];
    }



#region detail by personil
    public function detailByPersonilLihatDetail($value)
    {
        try{
            $this->error_time_alert = null;
            $this->admin_action_komentar = '';
            $this->admin_action_verifikasi = '';
            $this->detail_by_personil_entry_detail = null;
            if(array_key_exists($value,$this->detail_by_personil_data_inputan))
            {
                $this->detail_by_personil_entry_detail = $this->detail_by_personil_data_inputan[$value];
                $this->detail_by_personil_entry_nama_apd = $this->detail_by_personil_entry_detail['nama_jenis'];

                $apd = ApdList::where('id_apd', $this->detail_by_personil_entry_detail['id_apd'])->first();
                if(!is_null($apd))
                {
                    $adc = new ApdDataController;
                    $this->gambar_apd_template = $adc->siapkanGambarTemplateBesertaPathnya($apd->image, $this->detail_by_personil_entry_detail['id_jenis'], $this->detail_by_personil_entry_detail['id_apd']);
                }
            }

            $this->dispatchBrowserEvent('list-inputan-ke-detail-inputan');
        }
        catch(Throwable $e)
        {
            $this->detail_by_personil_entry_detail = null;
            $this->gambar_apd_template = null;
            $this->detail_by_personil_entry_nama_apd = null;
            $this->error_time_alert = now();

            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat melihat detail by personil '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat melihat detail by personil '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail : '.$this->error_time_alert]);
        }
    }

    public function detailByPersonilModalSimpan()
    {

        $this->validate([
            'admin_action_verifikasi' => 'required'
        ],
        [
            'admin_action_verifikasi.required' => 'Ubah verifikasi terlebih dahulu.'
        ]);

        try{
            $this->error_time_alert = null;

            $id_target_inputan = $this->detail_by_personil_entry_detail['id_inputan'];

            $adc = new ApdDataController;

            if(!$adc->adminVerifikasiInputan($id_target_inputan,$this->admin_action_verifikasi, $this->admin_action_komentar))
                throw new Exception("Tidak ditemukan inputan dengan id ".$id_target_inputan);

            $this->detail_by_personil_data_inputan = $adc->muatInputanPegawai(null, $this->detail_by_personil_id_pegawai);
            $index = array_search($id_target_inputan, array_column($this->detail_by_personil_data_inputan,'id_inputan'));

            if(is_bool($index) && $index == false)
            {
                $this->emit('jsAlert', 'Kembali ke tabel inputan untuk me-refresh data.');
                return;
            }

            $this->detail_by_personil_entry_detail = $this->detail_by_personil_data_inputan[$index];
            $this->admin_action_komentar = '';
            $this->admin_action_verifikasi = '';
            session()->flash('alert-success-detailByPersonil', 'Berhasil menyimpan data verifikasi inputan.');

        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat menyimpan verifikasi '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat menyimpan verifikasi '.$e);
            session()->flash('alert-danger-detailByPersonil', 'Kesalahan saat menyimpan. ref : '.$this->error_time_alert);
        }
    }

#endregion

}
