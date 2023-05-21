<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\FileController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdKondisi;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\ApdSize;
use Livewire\Component;
use Throwable;

class LayoutPengaturanBarang extends Component
{
    // variabel card detail jenis
    public
        $detail_jenis_edit_mode = false, 
        $detail_jenis_edit_id = false, 
        $detail_jenis_id = "",
        $detail_jenis_nama = "",
        $detail_jenis_keterangan = "",
        $detail_jenis_id_cache = "",
        $detail_jenis_nama_cache = "",
        $detail_jenis_keterangan_cache = "";
    
    //variabel card detail barang
    public
        $detail_barang_edit_mode = false, 
        $detail_barang_edit_id = false, 
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
        $detail_barang_keterangan_cache = "",
        $detail_barang_opsi_jenis = [],
        $detail_barang_opsi_ukuran = [],
        $detail_barang_opsi_kerusakan = [];
    
    // variabel card detail ukuran
    public
        $detail_ukuran_edit_mode = false, 
        $detail_ukuran_edit_id = false, 
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

    // modal tampil gambar apd
    public $modal_tampil_gambar_apd_gambar_preview = "";

    protected $listeners = [

        // card detail jenis
        "TabelPengaturanJenisApdDetail" => "CardDetailJenisEditJenis",

        // card detail barang
        "TabelPengaturanBarangApdDetail" => "CardDetailBarangEditBarang",

        // modal untuk gambar apd
        "TampilSatuGambarApd" => "ModalTampilGambarApdTampilSatuGambar",
        "TampilPreviewGambarApd"

    ];


    #region Livewire Function
    public function render()
    {
        return view('eapd.livewire.layout.layout-pengaturan-barang');
    }
    #endregion

    #region card detail jenis
    public function CardDetailJenisTambahJenisBaru()
    {
        $this->detail_jenis_edit_mode = false;
        $this->detail_jenis_edit_id = false;
        $this->detail_jenis_id = "";
        $this->detail_jenis_nama = "";
        $this->detail_jenis_keterangan = "";
        $this->detail_jenis_id_cache = "";
        $this->detail_jenis_nama_cache = "";
        $this->detail_jenis_keterangan_cache = "";
    }

    public function CardDetailJenisEditJenis($id)
    {
        try{

            $jenis = ApdJenis::find($id);

            $this->detail_jenis_edit_mode = true;
            $this->detail_jenis_edit_id = false;
            $this->detail_jenis_id = $this->detail_jenis_id_cache = $jenis->id;
            $this->detail_jenis_nama = $this->detail_jenis_nama_cache = $jenis->nama_jenis;
            $this->detail_jenis_keterangan = $this->detail_jenis_keterangan_cache = $jenis->keterangan;

        }
        catch(Throwable $e)
        {

            error_log("Card Detail Jenis : Gagal saat mengedit jenis ".$e);
            $this->detail_jenis_edit_mode = true;
            $this->detail_jenis_edit_id = false;
            $this->detail_jenis_id = "";
            $this->detail_jenis_nama = "";
            $this->detail_jenis_keterangan = "";
            $this->detail_jenis_id_cache = "";
            $this->detail_jenis_nama_cache = "";
            $this->detail_jenis_keterangan_cache = "";

        }
    }

    public function CardDetailJenisReset()
    {
        $this->detail_jenis_edit_id = false;
        $this->detail_jenis_id = "";
        $this->detail_jenis_nama = "";
        $this->detail_jenis_keterangan = "";
        $this->detail_jenis_id_cache = "";
        $this->detail_jenis_nama_cache = "";
        $this->detail_jenis_keterangan_cache = "";
    }

    public function CardDetailJenisSimpan()
    {
        try{
            if($this->detail_jenis_edit_mode)
                $jenis = ApdJenis::find($this->detail_jenis_id_cache);
            else
                $jenis = new ApdJenis();
            
            if($this->detail_jenis_id != "")
                $jenis->id = $this->detail_jenis_id;
            
            $jenis->nama_jenis = $this->detail_jenis_nama;
            $jenis->keterangan = $this->detail_jenis_keterangan;

            $jenis->save();
            
        }
        catch(Throwable $e)
        {
            error_log("Card Detail Jenis : Gagal dalam menyimpan data jenis ".$e);
        }
    }
    #endregion

    #region card detail barang
    public function CardDetailBarangTambahBarangBaru()
    {
        $this->detail_barang_edit_mode = false;
        $this->detail_barang_edit_id = false; 
        $this->detail_barang_id = $this->detail_barang_id_cache = "";
        $this->detail_barang_jenis = $this->detail_barang_jenis_cache = "";
        $this->detail_barang_kerusakan = $this->detail_barang_kerusakan_cache = "";
        $this->detail_barang_ukuran = $this->detail_barang_ukuran_cache = "";
        $this->detail_barang_merk = $this->detail_barang_merk_cache = "";
        $this->detail_barang_keterangan = $this->detail_barang_keterangan_cache = "";
        $this->detail_barang_nama = $this->detail_barang_nama_cache = "";
        $this->detail_barang_gambar = $this->detail_barang_gambar_cache = [];
        $this->CardDetailBarangMuatOpsi();
    }

    public function CardDetailBarangEditBarang($id)
    {
        try{
            $this->CardDetailBarangMuatOpsi();
            $this->detail_barang_edit_mode = true;
            $this->detail_barang_edit_id = false;

            $barang = ApdList::find($id);
            $this->detail_barang_id = $this->detail_barang_id_cache = $barang->id;
            $this->detail_barang_jenis = $this->detail_barang_jenis_cache = $barang->id_jenis;
            $this->detail_barang_kerusakan = $this->detail_barang_kerusakan_cache = $barang->id_kondisi;
            $this->detail_barang_ukuran = $this->detail_barang_ukuran_cache = $barang->id_size;
            $this->detail_barang_merk = $this->detail_barang_merk_cache = $barang->merk;
            $this->detail_barang_keterangan = $this->detail_barang_keterangan_cache = $barang->keterangan;
            $this->detail_barang_nama = $this->detail_barang_nama_cache = $barang->nama_apd;
            $fc = new FileController;
            $gambar = explode('||',$barang->image);
            if(is_array($gambar))
            {
                $this->detail_barang_gambar = $this->detail_barang_gambar_cache = [];
                foreach($gambar as $i => $gbr)
                {
                    $this->detail_barang_gambar[$i] = $this->detail_barang_gambar_cache[$i] = $fc->buatPathFileApdItem($barang->id_jenis,$barang->id) . '/' . $gbr;
                }
            }
            else
                $this->detail_barang_gambar = $this->detail_barang_gambar_cache = $fc->buatPathFileApdItem($barang->id_jenis,$barang->id) . '/' . $gambar;
                
        }
        catch(Throwable $e)
        {
            error_log("Card Detail Barang : Gagal mengambil data barang untuk edit ".$e);
        }
    }

    public function CardDetailBarangMuatOpsi()
    {
        try{
            // jenis
            $this->detail_barang_opsi_jenis = [];
            $semua_jenis = ApdJenis::all(["id","nama_jenis"]);
            foreach($semua_jenis as $i => $item)
                $this->detail_barang_opsi_jenis[$i] = [ "value" => $item->id, "text" => $item->nama_jenis ];

            // ukuran
            $this->detail_barang_opsi_ukuran = [];
            $semua_ukuran = ApdSize::all(["id","nama_size"]);
            foreach($semua_ukuran as $i => $item)
                $this->detail_barang_opsi_ukuran[$i] = [ "value" => $item->id, "text" => $item->nama_size ];

            // kerusakan
            $this->detail_barang_opsi_kerusakan = [];
            $semua_kerusakan = ApdKondisi::all(["id","nama_kondisi"]);
            foreach($semua_kerusakan as $i => $item)
                $this->detail_barang_opsi_kerusakan[$i] = [ "value" => $item->id, "text" => $item->nama_kondisi ];
        }
        catch(Throwable $e)
        {
            error_log("Card Detail Barang : Gagal memuat opsi ".$e);
        }
    }

    public function CardDetailBarangReset()
    {
        $this->detail_barang_edit_id = false; 
        $this->detail_barang_id = $this->detail_barang_id_cache;
        $this->detail_barang_jenis = $this->detail_barang_jenis_cache;
        $this->detail_barang_kerusakan = $this->detail_barang_kerusakan_cache;
        $this->detail_barang_ukuran = $this->detail_barang_ukuran_cache;
        $this->detail_barang_merk = $this->detail_barang_merk_cache;
        $this->detail_barang_keterangan = $this->detail_barang_keterangan_cache;
        $this->detail_barang_nama = $this->detail_barang_nama_cache;
        $this->detail_barang_gambar = $this->detail_barang_gambar_cache;
    }
    #endregion

    #region card detail ukuran
    public function CardDetailUkuranTambahUkuranBaru()
    {
        $this->detail_ukuran_edit_mode = false;
        $this->detail_ukuran_edit_id = false;
        $this->detail_ukuran_id = $this->detail_ukuran_id_cache = "";
        $this->detail_ukuran_nama  = $this->detail_ukuran_nama_cache = "";
        $this->detail_ukuran_keterangan = $this->detail_ukuran_keterangan_cache = "";
        $this->detail_ukuran_opsi = $this->detail_ukuran_opsi_cache = [];
    }

    public function CardDetailUkuranEditUkuran($id_opsi_ukuran)
    {
        try{

            $ukuran = ApdSize::find($id_opsi_ukuran);
            $this->detail_ukuran_id = $this->detail_ukuran_id_cache = $ukuran->id;
            $this->detail_ukuran_nama  = $this->detail_ukuran_nama_cache = $ukuran->nama_size;
            $this->detail_ukuran_keterangan = $this->detail_ukuran_keterangan_cache = $ukuran->keterangan;
            $this->detail_ukuran_opsi = $this->detail_ukuran_opsi_cache = [];

        }
        catch(Throwable $e)
        {

        }
    }

    public function CardDetailUkuranHapusOpsiUkuran($index)
    {
        try{
            unset($this->detail_ukuran_opsi[$index]);
            array_values($this->detail_ukuran_opsi);
        }
        catch(Throwable $e)
        {
            error_log("Card Detail Ukuran : Gagal dalam menghapus opsi ukuran pada index ".$index." ".$e);
        }
    }
    #endregion

    #region modal tampil gambar apd
    public function ModalTampilGambarApdTampilSatuGambar($path_gambar)
    {
        $this->modal_tampil_gambar_apd_gambar_preview = asset($path_gambar);
        $this->dispatchBrowserEvent("showModalTampilGambarApd");

    }
    #endregion
}
