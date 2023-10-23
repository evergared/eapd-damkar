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

class KendaliProgress extends Component
{
    public
        $opsi_dropdown_wilayah = [],
        $opsi_dropdown_penempatan = [];
    
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
        $pegawai_terakhir = '';

    protected $listeners =[
            'detailByPersonil',
            // ketika komponen lain refresh secara global
            'refreshComponent' => '$refresh',

            'hitungCapaian'
    
            // ketika komponen lain hanya meminta sidebar yang di refresh
            // 'refreshPage' => '$refresh'
        ];

    #region Livewire
    public function render()
    {
        $this->hitungCapaian();
        $this->hitungRangkumanKeberadaan();
        $this->hitungRangkumanKerusakan();
        return view('livewire.dashboards.admin.periode-berjalan.apd.kendali-progress');
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
            
            $id_pegawai = $target_pegawai;
            $nama_pegawai = Pegawai::find($id_pegawai)->nama;
            $penempatan_pegawai = Pegawai::find($id_pegawai)->penempatan->nama_penempatan;

            $adc = new ApdDataController;
            $data_inputan = $adc->muatInputanPegawai(null, $id_pegawai);

            $paket = [
                'id' => $id_pegawai,
                'nama' => $nama_pegawai,
                'penempatan' => $penempatan_pegawai,
                'data_inputan' =>$data_inputan
            ];

            $this->pegawai_terakhir = $nama_pegawai;

            $this->emit('paketUntukDetailProgress', $paket);
            $this->dispatchBrowserEvent('progress-kendali-ke-detail');
        }
        catch(Throwable $e)
        {
            $this->error_time_detail_by_personil = now();
            
            error_log('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            Log::error('Page @ Dashboard Progress APD Admin ref ('.$this->error_time_detail_by_personil.') : Kesalahan saat melihat detail by personil '.$e);
            $this->dispatchBrowserEvent('jsAlert',['pesan' => 'Kesalahan saat melihat detail : '.$this->error_time_detail_by_personil]);
        }
    }
#endregion
}
