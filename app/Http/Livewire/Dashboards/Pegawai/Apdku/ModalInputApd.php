<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Apdku;

use App\Http\Controllers\FileController;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalInputApd extends Component
{
    use WithFileUploads;

    // untuk menampung data dari template
    public 
        $template_id_apd = "",
        $template_nama_apd = "",
        $template_data_apd = [], 
        $template_opsi_apd = [],
        $template_gambar_apd = [],
        $template_size_apd = [],
        $template_kondisi_apd = [];
    
    // untuk dropdown keberadaan apd
    public $opsi_keberadaan = [
        ['value'=> 'ada', 'text' => 'Sudah Terima dan Ada'],
        ['value'=> 'hilang', 'text' => 'Sudah Terima Tapi Hilang'],
        ['value'=> 'belum terima', 'text' => 'APD Belum Diterima'],
    ];

    // untuk diisi oleh user saat ini
    public  $id_apd_user = '',
            $nama_apd_user = '',
            $size_apd_user = '',
            $kondisi_apd_user = '',
            $gambar_apd_user = [],
            $komentar_apd_user ="",
            $status_keberadaan_apd_user = "";
    
    // data dari tabel input_apd
    public  $gambar_apd_user_prev = [],
            $komentar_verifikator = "",
            $status_verifikasi = 1, // default value jika user belum pernah input
            $label_verifikasi = "Proses Input"; // default value jika user belum pernah input

    // cache untuk reset value ke kondisi sebelumnya
    public  $cache_id_apd_user = '',
            $cache_size_apd_user = '',
            $cache_kondisi_apd_user = '',
            $cache_komentar_apd_user = '';
    
    // utk mempermudah pemanggilan di blade.php
    public $placeholder_path = '';

    protected $listeners = [
        'inisiasiModalInput'
    ];

    #region Livewire Lifecycle
    public function render()
    {
        return view('livewire.dashboards.pegawai.apdku.modal-input-apd');
    }

    public function updated($property)
    {
        $this->validateOnly(
            $property,
            [
                'gambar_apd_user.*' => ['image', 'size:256'], //5120 //256
                'gambar_apd_user' => ['max:3'] //5120 //256
            ],
            [
                'gambar_apd_user.*.image' => 'File harus berupa gambar.',
                'gambar_apd_user.*.size' => 'Ukuran melebihi batas maksimal (5 Mb).',
                // 'gambar_apd_user.image' => 'File harus berupa gambar.',
                'gambar_apd_user.max' => 'Jumlah file terlalu banyak (maks :max).',
                'gambar_apd_user.required' => 'Gambar belum dimasukan.'
            ]
        );
    }
    #endregion

    public function inisiasiModalInput($value)
    {
        $fc = new FileController;
        $this->placeholder_path = $fc::$apdPlaceholderBasePath;

        $this->template_id_apd = $value;
    }

    #region Wire:change Function

    #endregion

    #region Button Function

    #endregion

}
