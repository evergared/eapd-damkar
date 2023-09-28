<?php

namespace App\Http\Livewire\Eapd\Layout;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdKondisi;
use App\Models\ApdList;
use App\Models\ApdSize;
use App\Models\InputApd;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class LayoutPengaturanBarang extends Component
{

    use WithFileUploads;

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
        $detail_barang_gambar_upload = [],
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
        $detail_ukuran_id_cache = "",
        $detail_ukuran_nama_cache = "",
        $detail_ukuran_opsi_cache = [],
        $detail_ukuran_keterangan_cache = "";

    // variabel card detail kerusakan
    public
        $detail_kerusakan_edit_mode = false, 
        $detail_kerusakan_edit_id = false, 
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
        "TabelPengaturanBarangApdHapus" => "CardDetailBarangHapusBarang",

        // card detail ukuran
        "TabelPengaturanUkuranApdDetail" => "CardDetailUkuranEditUkuran",
        "TabelPengaturanUkuranApdHapus" => "CardDetailUkuranHapusUkuran",

        // card detail kerusakan
        "TabelPengaturanKerusakanApdDetail" => "CardDetailKerusakanEditKerusakan",
        "TabelPengaturanKerusakanApdHapus" => "CardDetailKerusakanHapusKerusakan",

        // modal untuk gambar apd
        "TampilSatuGambarApd" => "ModalTampilGambarApdTampilSatuGambar",
        "TampilPreviewGambarApd"

    ];


    #region Livewire Function
    public function render()
    {
        return view('eapd.livewire.layout.layout-pengaturan-barang');
    }

    public function updated($property)
    {
        $this->validateOnly($property,
        [
            "detail_barang_gambar_upload.*" => ["image", "size:256"],
            "detail_barang_gambar_upload" => ["max:3"]
        ],
        [
            "detail_barang_gambar_upload.*.image" => "File harus berupa gambar.",
            "detail_barang_gambar_upload.*.size" => "Ukuran file melebihi batas maksimal. (maks 5 Mb)",
            "detail_barang_gambar_upload.max" => "Jumlah file terlalu banyak. (maks :max)"
        ]
        );
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
        $this->dispatchBrowserEvent("card_detail_jenis_tampil");
    }

    public function CardDetailJenisEditJenis($id)
    {
        try{

            $jenis = ApdJenis::find($id);

            $this->detail_jenis_edit_mode = true;
            $this->detail_jenis_edit_id = false;
            $this->detail_jenis_id = $this->detail_jenis_id_cache = $jenis->_id;
            $this->detail_jenis_nama = $this->detail_jenis_nama_cache = $jenis->nama_jenis;
            $this->detail_jenis_keterangan = $this->detail_jenis_keterangan_cache = $jenis->keterangan;
            $this->dispatchBrowserEvent("card_detail_jenis_tampil");

        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_jenis_danger","Gagal mengambil data jenis apd untuk di edit!");
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

    public function CardDetailJenisHapusJenis($id)
    {
        try{

            $jenis = ApdList::find($id);

            if(ApdList::where("id_jenis",$id)->get()->count()>1)
            {
                session()->flash("pengaturan_jenis_danger","Ada APD dengan kategori / jenis apd \"".$jenis->nama_jenis."\"! Ganti terlebih dahulu sebelum menghapus ketegor / jenis apd \"".$jenis->nama_jenis."\"");
                return;
            }

            $pic = new PeriodeInputController;
            $pic->sesuaikanTemplatePascaHapusJenisApd($id);

            $jenis->delete();
            InputApd::where("id_jenis",$id)->delete();
            session()->flash("pengaturan_jenis_success","Berhasil menghapus jenis APD!");

        }
        catch(Throwable $e)
        {
            session()->flash("detail_jenis_danger","Gagal menghapus data jenis apd!");
            error_log("Card Detail Jenis : Gagal dalam menghapus data jenis ".$e);
            report("Card Detail Jenis : Gagal dalam menghapus data jenis ".$e);
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
            {
                $jenis = new ApdJenis();
                if(ApdJenis::where("_id",$this->detail_jenis_id)->exists())
                {
                    session()->flash("detail_jenis_danger","Kategori/Jenis APD dengan id tersebut sudah ada!");
                    return;
                }
            }
            
            if($this->detail_jenis_id != $this->detail_jenis_id_cache)
                $jenis->_id = $this->detail_jenis_id;
            
            $jenis->nama_jenis = $this->detail_jenis_nama;
            $jenis->keterangan = $this->detail_jenis_keterangan;

            $jenis->save();
            
            session()->flash("detail_jenis_success","Berhasil menyimpan data jenis apd!");
        }
        catch(Throwable $e)
        {
            session()->flash("detail_jenis_danger","Gagal menyimpan data jenis apd!");
            error_log("Card Detail Jenis : Gagal dalam menyimpan data jenis ".$e);
            report("Card Detail Jenis : Gagal dalam menyimpan data jenis ".$e);
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
        $this->detail_barang_gambar = $this->detail_barang_gambar_cache = $this->detail_barang_gambar_upload = [];
        $this->CardDetailBarangMuatOpsi();
        $this->dispatchBrowserEvent("card_detail_barang_tampil");
    }

    public function CardDetailBarangHapusBarang($id)
    {
        try{

            $apd = ApdList::find($id);
            $apd->delete();

        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_barang_danger","Gagal menghapus apd!");
            error_log("Card Detail Barang : Gagal menghapus apd ".$e);
            report("Card Detail Barang : Gagal menghapus apd ".$e);
        }
    }

    public function CardDetailBarangEditBarang($id)
    {
        try{
            $this->CardDetailBarangMuatOpsi();
            $this->detail_barang_edit_mode = true;
            $this->detail_barang_edit_id = false;

            $barang = ApdList::find($id);
            $this->detail_barang_id = $this->detail_barang_id_cache = $barang->_id;
            $this->detail_barang_jenis = $this->detail_barang_jenis_cache = $barang->id_jenis;
            $this->detail_barang_kerusakan = $this->detail_barang_kerusakan_cache = $barang->id_kondisi;
            $this->detail_barang_ukuran = $this->detail_barang_ukuran_cache = $barang->id_size;
            $this->detail_barang_merk = $this->detail_barang_merk_cache = $barang->merk;
            $this->detail_barang_keterangan = $this->detail_barang_keterangan_cache = $barang->keterangan;
            $this->detail_barang_nama = $this->detail_barang_nama_cache = $barang->nama_apd;
            $fc = new FileController;
            $adc = new ApdDataController;
            $gambar = explode('||',$barang->image);
            if(is_array($gambar))
            {
                $this->detail_barang_gambar = $this->detail_barang_gambar_cache = [];
                foreach($gambar as $i => $gbr)
                {
                    $this->detail_barang_gambar[$i] = $this->detail_barang_gambar_cache[$i] = $adc->siapkanGambarTemplateBesertaPathnya($gbr,$this->detail_barang_jenis,$this->detail_barang_id);
                }
            }
            else
                $this->detail_barang_gambar = $this->detail_barang_gambar_cache = $adc->siapkanGambarTemplateBesertaPathnya($gambar,$this->detail_barang_jenis,$this->detail_barang_id);
                
            $this->dispatchBrowserEvent("card_detail_barang_tampil");
        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_barang_danger","Gagal mengambil data barang untuk di edit!");
            error_log("Card Detail Barang : Gagal mengambil data barang untuk edit ".$e);
            report("Card Detail Barang : Gagal mengambil data barang untuk edit ".$e);
        }
    }

    public function CardDetailBarangMuatOpsi()
    {
        try{
            // jenis
            $this->detail_barang_opsi_jenis = [];
            $semua_jenis = ApdJenis::all(["id","nama_jenis"]);
            foreach($semua_jenis as $i => $item)
                $this->detail_barang_opsi_jenis[$i] = [ "value" => $item->_id, "text" => $item->nama_jenis ];

            // ukuran
            $this->detail_barang_opsi_ukuran = [];
            $semua_ukuran = ApdSize::all(["id","nama_size"]);
            foreach($semua_ukuran as $i => $item)
                $this->detail_barang_opsi_ukuran[$i] = [ "value" => $item->_id, "text" => $item->nama_size ];

            // kerusakan
            $this->detail_barang_opsi_kerusakan = [];
            $semua_kerusakan = ApdKondisi::all(["id","nama_kondisi"]);
            foreach($semua_kerusakan as $i => $item)
                $this->detail_barang_opsi_kerusakan[$i] = [ "value" => $item->_id, "text" => $item->nama_kondisi ];
        }
        catch(Throwable $e)
        {
            error_log("Card Detail Barang : Gagal memuat opsi ".$e);
        }
    }

    public function CardDetailBarangGenerateId()
    {
        if($this->detail_barang_edit_mode)
            return;

        if($this->detail_barang_jenis == "" || strlen($this->detail_barang_merk) < 3)
        {
            $this->detail_barang_id = "";
            return;
        }

        $base_id = substr($this->detail_barang_jenis,0,4)."-".substr($this->detail_barang_merk,0,3)."-";
        $id = "";
        $i = 0;
        while($id == "")
        {
            $target = $base_id.str_pad($i,4,"0",STR_PAD_LEFT);
            if(!ApdList::where("_id",$target)->exists())
                $id = $target;
            $i++;
        }
        $this->detail_barang_id = $id;
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

    public function CardDetailBarangSimpan()
    {
        try{

            if($this->detail_barang_edit_mode)
                $apd = ApdList::find($this->detail_barang_id_cache);
            else
            {
                if(ApdList::where("_id",$this->detail_barang_id)->exists())
                {
                    session()->flash("detail_barang_danger","Barang dengan id tersebut sudah ada!");
                    return;
                }
                $apd = new ApdList;
            }

            if($this->detail_barang_id != $this->detail_barang_id_cache)
                $apd->_id = $this->detail_barang_id;
            
            $apd->nama_apd = $this->detail_barang_nama;
            $apd->id_jenis = $this->detail_barang_jenis;
            $apd->id_kondisi = $this->detail_barang_kerusakan;
            $apd->id_size = $this->detail_barang_ukuran;
            $apd->merk = $this->detail_barang_merk;
            $apd->keterangan = $this->detail_barang_keterangan;

            $fc = new FileController;
            $adc = new ApdDataController;

            $uploaded = [];

            if($this->detail_barang_gambar_upload)
            {
                $jumlah = count($this->detail_barang_gambar_upload);
                if($jumlah > $adc::$jumlahBatasUploadGambar)
                    $jumlah = $adc::$jumlahBatasUploadGambar;
                
                for($i = 0; $i<$jumlah;$i++)
                {
                    $path = $fc->buatPathFileApdItem($this->detail_barang_jenis, $this->detail_barang_id);
                    $filename = $fc->prosesNamaFileApdItem($this->detail_barang_id,'jpg',$i);

                    $this->detail_barang_gambar_upload[$i]->storeAs($path,$filename);
                    array_push($uploaded,$filename);
                }
                $apd->image = implode("||",$uploaded);
            }

            $apd->save();
            session()->flash("detail_barang_success","Barhasil menyimpan data barang!");
            $this->detail_barang_gambar_upload = [];

        }
        catch(Throwable $e)
        {
            session()->flash("detail_barang_danger","Gagal menyimpan data barang!");
            error_log("Card Detail Ukuran : Gagal dalam menyimpan data barang ".$e);
            report("Card Detail Ukuran : Gagal dalam menyimpan data barang ".$e);
        }
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
        $this->dispatchBrowserEvent("card_detail_ukuran_tampil");
    }

    public function CardDetailUkuranHapusUkuran($id)
    {
        try{

            $ukuran = ApdSize::find($id);

            if(!$ukuran->boleh_dihapus)
            {
                session()->flash("pengaturan_ukuran_danger","Opsi ukuran \"".$ukuran->nama_size."\" tidak boleh dihapus!");
                return;
            }

            if(ApdList::where('id_size',$id)->get()->count()>1)
            {
                session()->flash("pengaturan_ukuran_danger","Ada APD dengan kategori ukuran \"".$ukuran->nama_size."\"! Ganti terlebih dahulu sebelum menghapus opsi ukuran \"".$ukuran->nama_size."\".");
                return;
            }

            $ukuran->delete();
            session()->flash("pengaturan_ukuran_success","Data opsi ukuran berhasil dihapus!");

        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_ukuran_danger","Gagal menghapus opsi ukuran!");
            error_log("Card Detail Ukuran : Gagal dalam menghapus opsi ukuran ".$e);
            report("Card Detail Ukuran : Gagal dalam menghapus opsi ukuran ".$e);
        }
    }

    public function CardDetailUkuranEditUkuran($id_opsi_ukuran)
    {
        try{

            $ukuran = ApdSize::find($id_opsi_ukuran);
            $this->detail_ukuran_edit_mode = true;
            $this->detail_ukuran_edit_id = false;
            $this->detail_ukuran_id = $this->detail_ukuran_id_cache = $ukuran->_id;
            $this->detail_ukuran_nama  = $this->detail_ukuran_nama_cache = $ukuran->nama_size;
            $this->detail_ukuran_keterangan = $this->detail_ukuran_keterangan_cache = $ukuran->keterangan;
            $this->detail_ukuran_opsi = $this->detail_ukuran_opsi_cache = $ukuran->opsi;

            $this->dispatchBrowserEvent("card_detail_ukuran_tampil");

        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_ukuran_danger","Gagal mengambil data opsi ukuran untuk di edit!");
            error_log("Card Detail Ukuran : Gagal dalam mengambil data ukuran untuk diedit ".$e);
            report("Card Detail Ukuran : Gagal dalam mengambil data ukuran untuk diedit ".$e);
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
            session()->flash("detail_ukuran_danger","Gagal menghapus opsi!");
            error_log("Card Detail Ukuran : Gagal dalam menghapus opsi ukuran pada index ".$index." ".$e);
            report("Card Detail Ukuran : Gagal dalam menghapus opsi ukuran pada index ".$index." ".$e);
        }
    }

    public function CardDetailUkuranTambahOpsiUkuran()
    {
        try{

            array_push($this->detail_ukuran_opsi, $this->detail_ukuran_new_value);
            $this->detail_ukuran_new_value = "";

        }
        catch(Throwable $e)
        {
            session()->flash("detail_ukuran_danger","Gagal menambahkan opsi!");
            error_log("Card Detail Ukuran : Gagal dalam menambah opsi ukuran ".$e);
            report("Card Detail Ukuran : Gagal dalam menambah opsi ukuran ".$e);
        }
    }

    public function CardDetailUkuranSimpan()
    {
        try{

            if($this->detail_ukuran_edit_mode)
                $ukuran = ApdSize::find($this->detail_ukuran_id_cache);
            else
            {
                $ukuran = new ApdSize();
                $ukuran->boleh_dihapus = true;
                if(ApdSize::where("_id",$this->detail_ukuran_id)->exists())
                {
                    session()->flash("detail_ukuran_danger","Opsi ukuran dengan id tersebut sudah ada!");
                    return;
                }
            }

            if($this->detail_ukuran_id != $this->detail_ukuran_id_cache)
                $ukuran->_id = $this->detail_ukuran_id;
            
            $ukuran->nama_size = $this->detail_ukuran_nama;
            $ukuran->opsi = $this->detail_ukuran_opsi;
            $ukuran->keterangan = $this->detail_ukuran_keterangan;

            $ukuran->save();

            session()->flash("detail_ukuran_success","Data opsi ukuran berhasil disimpan!");

        }
        catch(Throwable $e)
        {
            session()->flash("detail_ukuran_danger","Data opsi ukuran gagal disimpan!");
            error_log("Card Detail Ukuran : Gagal menyimpan data opsi ukuran ".$e);
            report("Card Detail Ukuran : Gagal menyimpan data opsi ukuran ".$e);
        }
    }

    public function CardDetailUkuranReset()
    {
        $this->detail_ukuran_edit_id = false;
        $this->detail_ukuran_id = $this->detail_ukuran_id_cache;
        $this->detail_ukuran_nama  = $this->detail_ukuran_nama_cache;
        $this->detail_ukuran_keterangan = $this->detail_ukuran_keterangan_cache;
        $this->detail_ukuran_opsi = $this->detail_ukuran_opsi_cache;
    }
    #endregion

    #region card detail kerusakan
    public function CardDetailKerusakanTambahKerusakanBaru()
    {
        $this->detail_kerusakan_edit_mode = false;
        $this->detail_kerusakan_edit_id = false;
        $this->detail_kerusakan_id = "";
        $this->detail_kerusakan_nama = "";
        $this->detail_kerusakan_text_baik = "";
        $this->detail_kerusakan_text_rusak_ringan = "";
        $this->detail_kerusakan_text_rusak_sedang = "";
        $this->detail_kerusakan_text_rusak_berat = "";
        $this->detail_kerusakan_keterangan = "";
        $this->detail_kerusakan_id_cache = "";
        $this->detail_kerusakan_nama_cache = "";
        $this->detail_kerusakan_text_baik_cache = "";
        $this->detail_kerusakan_text_rusak_ringan_cache = "";
        $this->detail_kerusakan_text_rusak_sedang_cache = "";
        $this->detail_kerusakan_text_rusak_berat_cache = "";
        $this->detail_kerusakan_keterangan_cache = "";
        
        $this->dispatchBrowserEvent("card_detail_kerusakan_tampil");
    }

    public function CardDetailKerusakanEditKerusakan($id)
    {
        try{
            $kerusakan = ApdKondisi::find($id);

            $baik = "";
            $rusakRingan = "";
            $rusakSedang = "";
            $rusakBerat = "";

            foreach($kerusakan->opsi as $kondisi)
            {
                switch($kondisi["value"])
                {
                    case "baik": $baik = $kondisi["text"];break;
                    case "rusak ringan": $rusakRingan = $kondisi["text"];break;
                    case "rusak sedang": $rusakSedang = $kondisi["text"];break;
                    case "rusak berat": $rusakBerat = $kondisi["text"];break;
                }
            }

            $this->detail_kerusakan_edit_mode = true;
            $this->detail_kerusakan_edit_id = false;
            $this->detail_kerusakan_id = $this->detail_kerusakan_id_cache = $kerusakan->_id;
            $this->detail_kerusakan_nama = $this->detail_kerusakan_nama_cache = $kerusakan->nama_kondisi;
            $this->detail_kerusakan_text_baik = $this->detail_kerusakan_text_baik_cache = $baik;
            $this->detail_kerusakan_text_rusak_ringan = $this->detail_kerusakan_text_rusak_ringan_cache = $rusakRingan;
            $this->detail_kerusakan_text_rusak_sedang = $this->detail_kerusakan_text_rusak_sedang_cache = $rusakSedang;
            $this->detail_kerusakan_text_rusak_berat = $this->detail_kerusakan_text_rusak_berat_cache = $rusakBerat;
            $this->detail_kerusakan_keterangan = $this->detail_kerusakan_keterangan_cache = $kerusakan->keterangan;

            $this->dispatchBrowserEvent("card_detail_kerusakan_tampil");
        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_kerusakan_danger","Gagal mengambil data opsi kerusakan untuk di edit!");
            error_log("Card Detail Kerusakan : Gagal mengambil data opsi kerusakan untuk di edit ".$e);
            report("Card Detail Kerusakan : Gagal mengambil data opsi kerusakan untuk di edit ".$e);
        }
    }

    public function CardDetailKerusakanHapusKerusakan($id)
    {
        try{

            $kerusakan = ApdKondisi::find($id);

            if(!$kerusakan->boleh_dihapus)
            {
                session()->flash("pengaturan_kerusakan_danger","Opsi kerusakan \"".$kerusakan->nama_kondisi."\" tidak boleh dihapus!");
                return;
            }

            if(ApdList::where('id_kondisi',$id)->get()->count()>1)
            {
                session()->flash("pengaturan_kerusakan_danger","Ada APD dengan kategori kerusakan \"".$kerusakan->nama_kondisi."\"! Ganti terlebih dahulu sebelum menghapus opsi kerusakan \"".$kerusakan->nama_kondisi."\".");
                return;
            }

            $kerusakan->delete();
            session()->flash("pengaturan_kerusakan_success","Data opsi kerusakan berhasil dihapus!");

        }
        catch(Throwable $e)
        {
            session()->flash("pengaturan_kerusakan_danger","Data opsi kerusakan gagal dihapus!");
            error_log("Card Detail Kerusakan : Gagal menghapus data opsi kerusakan ".$e);
            report("Card Detail Kerusakan : Gagal menghapus data opsi kerusakan ".$e);
        }
    }

    public function CardDetailKerusakanReset()
    {
        $this->detail_kerusakan_edit_id = false;
        $this->detail_kerusakan_id = $this->detail_kerusakan_id_cache;
        $this->detail_kerusakan_nama = $this->detail_kerusakan_nama_cache;
        $this->detail_kerusakan_text_baik = $this->detail_kerusakan_text_baik_cache;
        $this->detail_kerusakan_text_rusak_ringan = $this->detail_kerusakan_text_rusak_ringan_cache;
        $this->detail_kerusakan_text_rusak_sedang = $this->detail_kerusakan_text_rusak_sedang_cache;
        $this->detail_kerusakan_text_rusak_berat = $this->detail_kerusakan_text_rusak_berat_cache;
        $this->detail_kerusakan_keterangan = $this->detail_kerusakan_keterangan_cache;
    }

    public function CardDetailKerusakanSimpan()
    {
        try{

            if($this->detail_kerusakan_edit_mode)
                $kerusakan = ApdKondisi::find($this->detail_kerusakan_id_cache);
            else
            {
                $kerusakan = new ApdKondisi();
                $kerusakan->boleh_dihapus = true;
                if(ApdKondisi::where("_id",$this->detail_kerusakan_id)->exists())
                {
                    session()->flash("detail_kerusakan_danger","Opsi kerusakan dengan id tersebut sudah ada!");
                    return;
                }
            }

            $list_kerusakan = [];
            array_push($list_kerusakan,["text" => ($this->detail_kerusakan_text_baik == "")? "Baik" : $this->detail_kerusakan_text_baik, "value" => "baik"]);
            array_push($list_kerusakan,["text" => ($this->detail_kerusakan_text_rusak_ringan == "")? "Rusak Ringan" : $this->detail_kerusakan_text_rusak_ringan, "value" => "rusak ringan"]);
            array_push($list_kerusakan,["text" => ($this->detail_kerusakan_text_rusak_sedang == "")? "Rusak Sedang" : $this->detail_kerusakan_text_rusak_sedang, "value" => "rusak sedang"]);
            array_push($list_kerusakan,["text" => ($this->detail_kerusakan_text_rusak_berat == "")? "Rusak Berat" : $this->detail_kerusakan_text_rusak_berat, "value" => "rusak berat"]);

            if($this->detail_kerusakan_id != $this->detail_kerusakan_id_cache)
                $kerusakan->_id = $this->detail_kerusakan_id;
            
            $kerusakan->nama_kondisi = $this->detail_kerusakan_nama;
            $kerusakan->keterangan = $this->detail_kerusakan_keterangan;
            $kerusakan->opsi = $list_kerusakan;

            $kerusakan->save();

            session()->flash("detail_kerusakan_success","Data opsi kerusakan berhasil disimpan!");
                
        }
        catch(Throwable $e)
        {
            session()->flash("detail_kerusakan_danger","Data opsi kerusakan gagal disimpan!");
            error_log("Card Detail Kerusakan : Gagal menyimpan data opsi kerusakan ".$e);
            report("Card Detail Kerusakan : Gagal menyimpan data opsi kerusakan ".$e);
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
