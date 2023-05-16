<?php

namespace App\Http\Livewire\Eapd\Layout;

use Livewire\Component;

class LayoutPengaturanBarang extends Component
{
    // variabel card detail jenis
    public
        $detail_jenis_edit_mode = false, 
        $detail_jenis_id = "",
        $detail_jenis_nama = "",
        $detail_jenis_keterangan = "",
        $detail_jenis_id_cache = "",
        $detail_jenis_nama_cache = "",
        $detail_jenis_keterangan_cache = "";
    
    //variabel card detail barang
    public
        $detail_barang_edit_mode = false, 
        $detail_barang_id = "",
        $detail_barang_nama = "",
        $detail_barang_merk = "",
        $detail_barang_jenis = "",
        $detail_barang_ukuran = "",
        $detail_barang_kerusakan = "",
        $detail_barang_gambar = [],
        $detail_barang_keterangan = "",
        $detail_barang_id_cache = "",
        $detail_barang_nama_cache = "",
        $detail_barang_merk_cache = "",
        $detail_barang_jenis_cache = "",
        $detail_barang_ukuran_cache = "",
        $detail_barang_kerusakan_cache = "",
        $detail_barang_gambar_cache = [],
        $detail_barang_keterangan_cache = "";
    
    // variabel card detail ukuran
    public
        $detail_ukuran_edit_mode = false, 
        $detail_ukuran_id = "",
        $detail_ukuran_nama = "",
        $detail_ukuran_opsi = [],
        $detail_ukuran_keterangan = "",
        $detail_ukuran_new_value = "",
        $detail_ukuran_new_text = "",
        $detail_ukuran_id_cache = "",
        $detail_ukuran_nama_cache = "",
        $detail_ukuran_opsi_cache = [],
        $detail_ukuran_keterangan_cache = "";

    // variabel card detail kerusakan
    public
        $detail_kerusakan_edit_mode = false, 
        $detail_kerusakan_id = "",
        $detail_kerusakan_nama = "",
        $detail_kerusakan_text_baik = "",
        $detail_kerusakan_text_rusak_ringan = "",
        $detail_kerusakan_text_rusak_sedang = "",
        $detail_kerusakan_text_rusak_berat = "",
        $detail_kerusakan_keterangan = "",
        $detail_kerusakan_id_cache = "",
        $detail_kerusakan_nama_cache = "",
        $detail_kerusakan_text_baik_cache = "",
        $detail_kerusakan_text_rusak_ringan_cache = "",
        $detail_kerusakan_text_rusak_sedang_cache = "",
        $detail_kerusakan_text_rusak_berat_cache = "",
        $detail_kerusakan_keterangan_cache = "";


    #region Livewire Function
    public function render()
    {
        return view('eapd.livewire.layout.layout-pengaturan-barang');
    }
    #endregion

    
}
