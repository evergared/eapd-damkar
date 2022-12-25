<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Http\Controllers\ApdDataController;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\PeriodeInputApd;
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

    protected $listeners = [
        'panggilModalKolomProgress' => 'inisiasiModal'
    ];

    public function render()
    {
        return view('eapd.livewire.modal.modal-kolom-progress-tabel-anggota-katon');
    }

    public function inisiasiModal($data)
    {
        try {
            // ambil data dari event
            $nrk = $data[0];
            $periode = $data[1];

            // ambil nama pegawai
            $this->nama_pegawai = Pegawai::where('nrk', '=', $nrk)->first()->nama;

            // ambil nama periode input
            $this->nama_periode = PeriodeInputApd::where('id', '=', $periode)->first()->nama_periode;

            // ambil id jabatan si pengupload
            $id_jabatan = Pegawai::where('nrk', '=', $nrk)->first()->id_jabatan;

            $adc = new ApdDataController;
            $this->list_inputan = $adc->muatInputanPegawai($periode, $nrk);
        } catch (Throwable $e) {
            error_log('Gagal inisiasi modal kolom progress tabel anggota katon ' . $e);
            $this->nama_pegawai = "Pegawai";
            $this->nama_periode = "Periode Input -";
            $this->parameter_inputan = "";
            $this->list_inputan = [];
            $this->gambar_terpilih = [];
        }
    }
}
