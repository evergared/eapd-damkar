<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Ukuran;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\UkuranPegawai;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{
    public 
    $value_inputan_semua_anggota = 0,
    $max_inputan_semua_anggota = 0;

    public
        $error_time_capaian = null,
        $error_time_detail = null;

    public 
        $periode = null,
        $id_pegawai = null,
        $nama_pegawai = "";

    public 
        $detail_progress_ukuran = null,
        $detail_butuh_isi_ukuran = 0,
        $detail_jumlah_ukuran_terisi = 0;

    protected $listeners = [
        "lihatDetail"
    ];

    public function render()
    {
        $this->kalkulasiCapaian();
        return view('livewire.dashboards.pegawai.progress.ukuran.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Progress Input Ukuran Anggota']);
    }

    public function kalkulasiCapaian()
    {
        try{

            $this->error_time_capaian = null;
            $this->periode = null;

            $this->value_inputan_semua_anggota = 0;
            $this->max_inputan_semua_anggota = 0;

            $list_pegawai = [];

            $adc = new ApdDataController;
            $pic = new PeriodeInputController;
            $user = Auth::user()->data;
            $this->periode = $pic->ambilIdPeriodeUkuran();

            // query semua pegawai terkait
            $pegawai = Pegawai::query()->where('aktif',true);

            if($user->isPengendali())
            {
                // dirinya dan semua anggota regunya
                array_push($list_pegawai, $user->toArray());

                $pegawai = $pegawai->where('penanggung_jawab',$user->id_pegawai)->get()->toArray();
            }
            else if($user->isKasie())
            {
                // dirinya dan semua anggota sektornya, termasuk satgas
                $sektor = $user->id_penempatan; // ganti jika perlu

                $pegawai = $pegawai->where('id_penempatan','like',$sektor.'%')->get()->toArray();
            }
            else if($user->isKasudin())
            {
                // dirinya dan semua anggota sudinnya, termasuk para staff dan bengkel
                $sudin = $user->id_penempatan; // ganti jika perlu
                $pegawai = $pegawai->where('id_penempatan','like',$sudin.'%')->get()->toArray();
            }
            else if($user->isKadis())
            {
                // dirinya dan semua anggota pemadam di 5 wilayah termasuk staff dsb.
                $pegawai = $pegawai->get()->toArray();
            }
            else
            {
                // fallback jika error/tidak terjaring if
                throw new Exception('Kesalahan saat menghitung capaian. Tidak ditemukan kondisi yang sesuai pada if else untuk id pegawai '.$user->id_pegawai);
            }

            // iterasi untuk list pegawai
            foreach($pegawai as $p)
            {
                array_push($list_pegawai, $p);
            }

            if(is_null($list_pegawai))
                return;

            // hitung capaian
            foreach($list_pegawai as $pegawai)
            {
                // ambil ukuran dari database
                $list_ukuran = UkuranPegawai::where('id_pegawai',$pegawai['id_pegawai'])->first();
                if(is_null($list_ukuran))
                    $ukuran_pegawai = [];
                else
                    $ukuran_pegawai = $list_ukuran->list_ukuran;

                $template = $adc->muatListInputApdDariTemplate($this->periode, $pegawai['id_jabatan']);

                $butuh_input = 0;
                $terinput = 0;

                foreach($template as $t)
                {
                    // inisiasi
                    $id_jenis = $t['id_jenis'];

                    $target_apd = $t['opsi_apd'][0];

                    $target_size = ApdList::where('id_apd',$target_apd)->get()->first()->size;
                    // jika apd tersebut tidak memiliki ukuran, skip
                    if(is_null($target_size))
                        continue;
                    
                    $butuh_input++;

                    $index = array_search($id_jenis, array_column($ukuran_pegawai, "id_jenis"));

                    if(is_bool($index) && $index==false)
                    {
                        continue;
                    }
                    
                    $terinput++;
                    
                }

                $this->max_inputan_semua_anggota += $butuh_input;
                $this->value_inputan_semua_anggota += $terinput;
            }

            error_log("butuh input semua nya : ".$this->max_inputan_semua_anggota);
            error_log("terinput semua nya : ".$this->value_inputan_semua_anggota);

        }
        catch(Throwable $e)
        {
            $this->error_time_capaian = now();
            $this->value_inputan_semua_anggota = 0;
            $this->max_inputan_semua_anggota = 0;
            $this->periode = null;
            error_log('Page @ Dashboard Progress Ukuran Anggota Pegawai error ref ('.$this->error_time_capaian.')'.$e);
            Log::error('Page @ Dashboard Progress Ukuran Anggota Pegawai error ref ('.$this->error_time_capaian.')'.$e);
        }
    }

    public function lihatDetail($value)
    {
        try{
            // inisiasi
            $this->error_time_detail = null;
            $this->detail_progress_ukuran = null;
            $this->detail_butuh_isi_ukuran = 0;
            $this->detail_jumlah_ukuran_terisi = 0;
            $this->nama_pegawai = "";

            // cek pegawai
            $this->id_pegawai = $value;
            $pegawai = Pegawai::where('id_pegawai', $this->id_pegawai)->first();

            if(is_null($pegawai))
                throw new Exception('Pegawai dengan id '.$this->id_pegawai.' tidak ditemukan.');
            
            $this->nama_pegawai = $pegawai->nama;
            $jabatan = $pegawai->id_jabatan;

            // ambil ukuran dari database
            $list_ukuran = UkuranPegawai::where('id_pegawai',$this->id_pegawai)->first();

            if(is_null($list_ukuran))
            {
                session()->flash('alert-warning',$this->nama_pegawai.' belum menginput ukuran yang diminta pada periode ini.');
                return;
            }
            
            $ukuran_pegawai = $list_ukuran->list_ukuran;

            // ambil template apa saja yang harus diinput
            $adc = new ApdDataController;
            $template = $adc->muatListInputApdDariTemplate($this->id_pegawai, $jabatan);

            // iterasi untuk mengisi detail ukuran
            $this->detail_progress_ukuran = [];

            foreach($template as $t)
            {
                // inisiasi
                $id_jenis = $t['id_jenis'];

                $target_apd = $t['opsi_apd'][0];

                $target_size = ApdList::where('id_apd',$target_apd)->get()->first()->size;

                // jika apd tersebut tidak memiliki ukuran, skip
                if(is_null($target_size))
                    continue;
                
                // jika jenis tidak ditemukan, skip
                $jenis = ApdJenis::where('id_jenis',$id_jenis)->first();
                if(is_null($jenis))
                    continue;
                
                $nama_jenis = $jenis->nama_jenis;
                $this->detail_butuh_isi_ukuran++;

                $index = array_search($id_jenis, array_column($ukuran_pegawai, "id_jenis"));

                if(is_bool($index) && $index==false)
                {
                    array_push($this->detail_progress_ukuran, ["jenis" => $nama_jenis, "value"=> "-"]);
                }
                else
                {
                    $value = $ukuran_pegawai[$index]["value"];
                    array_push($this->detail_progress_ukuran,["jenis" => $nama_jenis, "value" => $value]);
                    $this->detail_jumlah_ukuran_terisi++;
                }
                
            }

            $this->dispatchBrowserEvent('tabel-ke-detail');

        }
        catch(Throwable $e)
        {
            $this->error_time_detail = now();
            $this->id_pegawai = null;
            $this->nama_pegawai = "";
            $this->detail_progress_ukuran = null;
            $this->detail_butuh_isi_ukuran = 0;
            $this->detail_jumlah_ukuran_terisi = 0;
            error_log('Page @ Dashboard Progress Ukuran Anggota Pegawai error ref ('.$this->error_time_detail.')'.$e);
            Log::error('Page @ Dashboard Progress Ukuran Anggota Pegawai error ref ('.$this->error_time_detail.')'.$e);
        }
    }
        
}
