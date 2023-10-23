<?php

namespace App\Http\Livewire\Dashboards\Admin\PermintaanUbahData;

use App\Models\Pegawai;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class ModalKolomPegawai extends Component
{

    public  $nrk,
        $nip,
        $img,
        $nama,
        $pos,
        $grup,
        $telp,
        $email,
        $error_time = '';

    protected $listeners = [

        'panggilModalProfil' => 'panggilModal'

    ];

    public function render()
    {
        return view('livewire.dashboards.admin.permintaan-ubah-data.modal-kolom-pegawai');
    }

    public function panggilModal($value)
    {
        error_log('modal profil dipanggil');
        $this->inisiasiModal($value);
        $this->dispatchBrowserEvent('panggilModal',['id' => 'modal-kolom-pegawai']);
    }

    public function inisiasiModal($value)
    {
        try
        {
            $pegawai = Pegawai::where('id_pegawai', '=', $value)->first();

            if(is_null($pegawai))
            {
                throw new Exception("tidak ditemukan pegawai dengan id ".$value);
            }

            $this->nrk = $pegawai->nrk;
            $this->nip = $pegawai->nip;
            $this->nama = $pegawai->nama;
            $this->telp = $pegawai->no_telp;
            $this->email = $pegawai->email;
            $grup = $pegawai->grup;
            $this->img = $pegawai->profile_img;
            $this->pos = $pegawai->penempatan->nama_penempatan;

            switch($grup)
            {
                case 'A' : $this->grup = 'Grup Ambon';break;
                case 'B' : $this->grup = 'Grup Bandung';break;
                case 'C' : $this->grup = 'Grup Cepu';break;
                case '-' : $this->grup = 'Non Grup (Staff/Satgas)';break;
                default : $this->grup = "Belum Di Assign";break;
            }
        }
        catch(Throwable $e)
        {
            $this->nrk = "-";
            $this->nip = "-";
            $this->nama = "-";
            $this->img = "-";
            $this->pos = "-";
            $this->telp = "-";
            $this->email = "-";
            $this->grup = "-";
            $this->error_time = now();
            error_log('Modal kolom profil - Tabel Anggota Pegawai @ Dashboards Progress Apd Pegawai error '.$this->error_time.' : Kesalahan saat memuat data profil '.$e);
            Log::error('Modal kolom profil - Tabel Anggota Pegawai @ Dashboards Progress Apd Pegawai error '.$this->error_time.' : Kesalahan saat memuat data profil '.$e);
            session()->flash('alert-danger', 'Terjadi kesalahan saat memuat data profil pegawai. ref ('.$this->error_time.')');
        }
        
    }
}