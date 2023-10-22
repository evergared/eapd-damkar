<?php

namespace App\Http\Livewire\Dashboards\Admin\PeriodeBerjalan\Apd;

use App\Http\Controllers\ApdDataController;
use App\Models\ApdList;
use App\Models\InputApd;
use App\Models\Pegawai;
use App\Models\Penempatan;
use App\Models\Wilayah;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{
    public
        $opsi_dropdown_wilayah = [],
        $opsi_dropdown_penempatan = [],
        $opsi_dropdown_verifikasi = [
            ['value' => '3', 'text'=> 'Verifikasi'],
            ['value' => '4', 'text'=> 'Tolak'],
        ];
    
    public
        $model_dropdown_wilayah = '',
        $model_dropdown_penempatan = '';
    
    public
        $error_time_page = null,
        $error_time_alert = null,
        $error_time_capaian = null,
        $error_time_keberadaan = null,
        $error_time_detail_by_personil = null,
        $error_time_kerusakan = null;
    
    public
        $value_max_capaian = 0,
        $value_terinput_capaian = 0,
        $value_terverif_capaian = 0;

    public
        $value_keberadaan_ada = 0,
        $value_keberadaan_belum = 0,
        $value_keberadaan_hilang = 0;

    public
        $value_kerusakan_baik = 0,
        $value_kerusakan_ringan = 0,
        $value_kerusakan_sedang = 0,
        $value_kerusakan_berat = 0;
    
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

    protected $listeners =[
        'detailByPersonil',
        // ketika komponen lain refresh secara global
        'refreshComponent' => '$refresh',

        // ketika komponen lain hanya meminta sidebar yang di refresh
        // 'refreshPage' => '$refresh'
    ];


#region Livewire lifecycle
    public function render()
    {
        $this->hitungCapaian();
        $this->hitungRangkumanKeberadaan();
        $this->hitungRangkumanKerusakan();
        return view('livewire.dashboards.admin.periode-berjalan.apd.page')->layout("livewire.layouts.adminlte-dashboard", ["page_title" => "Inputan APD Saat ini"]);
    }

    public function mount()
    {
        $this->error_time_page = null;
        try{

            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];

            $fetch_wilayah = null;
            $fetch_penempatan = null;

            $target_penempatan = Auth::user()->id_penempatan;
            $tipe_admin = Auth::user()->tipe;

            if( $tipe_admin == "Admin Dinas")
            {
                $fetch_wilayah = Wilayah::all();
            }
            elseif($tipe_admin == "Admin Sudin")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Subcc")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Pusdik")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Lab")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Bidops")
            {
                $fetch_penempatan = Penempatan::where('id_wilayah', Auth::user()->penempatan->id_wilayah)->all();
            }
            elseif($tipe_admin == "Admin Sektor")
            {
                $fetch_penempatan = Penempatan::where('id_penempatan','like',$target_penempatan.'%')->all();
            }
            else
            {
                throw new Exception("Tidak ada kondisi yang sesuai dengan tipe admin untuk akun dengan id ".Auth::user()->id);
            }

            if(!is_null($fetch_wilayah))
                foreach($fetch_wilayah as $f)
                {
                    array_push($this->opsi_dropdown_wilayah,[
                        "value" => $f->id_wilayah, "text" => $f->nama_wilayah
                    ]);
                }

            if(!is_null($fetch_penempatan))
                foreach($fetch_penempatan as $f)
                {
                    array_push($this->opsi_dropdown_penempatan,[
                        "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                    ]);
                }

        }
        catch(Throwable $e)
        {
            $this->error_time_page = now();
            $this->opsi_dropdown_wilayah = [];
            $this->opsi_dropdown_penempatan = [];
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_page.') : Kesalahan saat inisiasi '.$e);
        }
    }
#endregion

#region penghitungan rangkuman
public function hitungCapaian()
{
        $this->error_time_capaian = null;
        $this->value_max_capaian = 0;
        $this->value_terinput_capaian = 0;
        $this->value_terverif_capaian = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
            $list_pegawai = Pegawai::where('id_penempatan','like',$this->model_dropdown_penempatan.'%')->get()->all();

            $adc = new ApdDataController;

            foreach($list_pegawai as $pegawai)
            {
                $maks = 0;
                $terinput = 0;
                $terverif = 0;
                $adc->hitungCapaianInputPegawai($pegawai->id_pegawai,$maks,$terinput,null);
                $adc->hitungCapaianInputPegawai($pegawai->id_pegawai,$maks,$terverif,null,3);

                $this->value_max_capaian += $maks;
                $this->value_terinput_capaian += $terinput;
                $this->value_terverif_capaian += $terverif;
            }

            error_log('value max '.$this->value_max_capaian);

        }
        catch(Throwable $e)
        {
            $this->error_time_capaian = now();
            $this->value_max_capaian = 0;
            $this->value_terinput_capaian = 0;
            $this->value_terverif_capaian = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_capaian.') : Kesalahan saat hitung capaian '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_capaian.') : Kesalahan saat hitung capaian '.$e);
        }
}

public function hitungRangkumanKeberadaan()
{
        $this->error_time_keberadaan = null;
        $this->value_keberadaan_ada = 0;
        $this->value_keberadaan_belum = 0;
        $this->value_keberadaan_hilang = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
                $list_pegawai = Pegawai::where('id_penempatan','like',$this->model_dropdown_penempatan.'%')->get()->all();

                $adc = new ApdDataController;

                foreach($list_pegawai as $pegawai)
                {
                    $this->value_keberadaan_ada += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai);
                    $this->value_keberadaan_belum += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'belumTerima');
                    $this->value_keberadaan_hilang += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'hilang');
                }

        }
        catch(Throwable $e)
        {
            $this->error_time_keberadaan = now();
            $this->value_keberadaan_ada = 0;
            $this->value_keberadaan_belum = 0;
            $this->value_keberadaan_hilang = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_keberadaan.') : Kesalahan saat hitung keberadaan '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_keberadaan.') : Kesalahan saat hitung keberadaan '.$e);
        }
}

public function hitungRangkumanKerusakan()
{
        $this->error_time_kerusakan = null;
        $this->value_kerusakan_baik = 0;
        $this->value_kerusakan_ringan = 0;
        $this->value_kerusakan_sedang = 0;
        $this->value_kerusakan_berat = 0;

        try{

            if($this->model_dropdown_penempatan == "")
                return;
            
                $list_pegawai = Pegawai::where('id_penempatan','like',$this->model_dropdown_penempatan.'%')->get()->all();

                $adc = new ApdDataController;

                foreach($list_pegawai as $pegawai)
                {
                    $this->value_kerusakan_baik += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'baik');
                    $this->value_kerusakan_ringan += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'rusakRingan');
                    $this->value_kerusakan_sedang += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'rusakSedang');
                    $this->value_kerusakan_berat += $adc->hitungInputanBerdasarkanStatus($pegawai->id_pegawai,null,'rusakBerat');
                }

        }
        catch(Throwable $e)
        {
            $this->error_time_kerusakan = now();
            $this->value_kerusakan_baik = 0;
            $this->value_kerusakan_ringan = 0;
            $this->value_kerusakan_sedang = 0;
            $this->value_kerusakan_berat = 0;
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_kerusakan.') : Kesalahan saat hitung keberadaan '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_kerusakan.') : Kesalahan saat hitung keberadaan '.$e);
        }
}
#endregion

#region wire:change
    public function changeDropdownWilayah()
    {
        $this->error_time_alert = null;
        try{
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_penempatan = '';

            $fetch_penempatan = Penempatan::where('id_wilayah',$this->model_dropdown_wilayah)->get()->all();

            if(!is_null($fetch_penempatan))
                foreach($fetch_penempatan as $f)
                {
                    array_push($this->opsi_dropdown_penempatan,[
                        "value" => $f->id_penempatan, "text" => $f->nama_penempatan
                    ]);
                }
        }
        catch(Throwable $e)
        {
            $this->error_time_alert = now();
            $this->opsi_dropdown_penempatan = [];
            $this->model_dropdown_wilayah = '';
            $this->model_dropdown_penempatan = '';
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_alert.') : Kesalahan saat wire change dropdown wilayah '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat memproses wilayah ref : '.$this->error_time_alert]);
        }
    }

    public function changeDropdownPenempatan()
    {
        error_log('dropdown changed');
        $this->emit('tabelGantiPenempatan',$this->model_dropdown_penempatan);
        $this->hitungCapaian();
        $this->hitungRangkumanKeberadaan();
        $this->hitungRangkumanKerusakan();
    }
#endregion

#region tindakan tabel
    public function detailByPersonil($target_pegawai)
    {
        $this->error_time_detail_by_personil = null;
        try{
            
            $this->detail_by_personil_id_pegawai = $target_pegawai;
            $this->detail_by_personil_nama_pegawai = Pegawai::find($this->detail_by_personil_id_pegawai)->nama;
            $this->detail_by_personil_penempatan_pegawai = Pegawai::find($this->detail_by_personil_id_pegawai)->penempatan->nama_penempatan;

            $adc = new ApdDataController;
            $this->detail_by_personil_data_inputan = $adc->muatInputanPegawai(null, $this->detail_by_personil_id_pegawai);

            $this->dispatchBrowserEvent('kendali-ke-detail');
        }
        catch(Throwable $e)
        {
            $this->error_time_detail_by_personil = now();
            $this->detail_by_personil_id_pegawai = '';
            $this->detail_by_personil_nama_pegawai = '';
            $this->detail_by_personil_penempatan_pegawai = '';
            $this->detail_by_personil_data_inputan = [];
            
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail : '.$this->error_time_detail_by_personil]);
        }
    }
#endregion

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
