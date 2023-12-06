<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Progress\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\Pegawai;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class Page extends Component
{

    public 
        $value_inputan_semua_anggota = 0,
        $max_inputan_semua_anggota = 0,
        $value_tervalidasi_semua_anggota = 0;
    
    public
        $error_time = null;

    public $periode = null;

    public function render()
    {
        $this->kalkulasiCapaian();
        return view('livewire.dashboards.pegawai.progress.apd.page')->layout('livewire.layouts.adminlte-dashboard',['page_title' => 'Progress Input APD Anggota']);
    }

    public function kalkulasiCapaian()
    {
        try{

            $this->error_time = null;
            $this->periode = null;

            $this->value_inputan_semua_anggota = 0;
            $this->max_inputan_semua_anggota = 0;
            $this->value_tervalidasi_semua_anggota = 0;

            $list_pegawai = [];

            $adc = new ApdDataController;
            $pic = new PeriodeInputController;
            $user = Auth::user()->data;
            $this->periode = $pic->ambilIdPeriodeInput();

            // query semua pegawai terkait
            $pegawai = Pegawai::query()->where('aktif',true)->where('kalkulasi',true);

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
                // apa saja yang harus diinput
                $this->max_inputan_semua_anggota += count($adc->muatListInputApdDariTemplate($this->periode, $pegawai['id_jabatan']));
                
                // terinput tapi belum di verifikasi
                $this->value_inputan_semua_anggota += count($adc->muatInputanPegawai($this->periode, $pegawai['id_pegawai'], 2));

                // terinput dan telah di verifikasi
                $this->value_tervalidasi_semua_anggota += count($adc->muatInputanPegawai($this->periode, $pegawai['id_pegawai'], 3));
            }

        }
        catch(Throwable $e)
        {
            $this->error_time = now();
            $this->value_inputan_semua_anggota = 0;
            $this->max_inputan_semua_anggota = 0;
            $this->value_tervalidasi_semua_anggota = 0;
            $this->periode = null;
            Log::error('Page @ Dashboard Progress Apd Anggota Pegawai error ref ('.$this->error_time.')'.$e);
        }
        

    }
}
