<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanBarang\Apd;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdKondisi;
use App\Models\ApdList;
use App\Models\ApdNoSeri;
use App\Models\ApdSize;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class FormApd extends Component
{

    use WithFileUploads;

    public
        $model_id_apd = null,
        $model_id_jenis = null,
        $model_nama_apd = null,
        $model_merk_apd = null,
        $model_size_apd = null,
        $model_kondisi_apd = null,
        $model_image_apd = null,
        $model_image_apd_old = null,
        $model_no_seri_apd = false,
        $model_no_seri_strict_apd = false,
        $model_no_seri_list_apd = null,
        $model_referensi_apd = null,
        $model_sumber_referensi_apd = null;
    
    public $editing = false;

    public
        $opsi_dropdown_jenis = [],
        $opsi_dropdown_size = [],
        $opsi_dropdown_kondisi = [];

    protected $listeners = [
        "editApd",
        "buatApd"
    ];

#region Livewire Lifecycle
    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-barang.apd.form-apd');
    }
    public function mount()
    {
        $list_jenis = ApdJenis::all();
        $list_size = ApdSize::all();
        $list_kondisi = ApdKondisi::all();

        foreach($list_jenis as $jenis)
        {
            array_push($this->opsi_dropdown_jenis,[
                'value' => $jenis->id_jenis,
                'text' => $jenis->nama_jenis
            ]);
        }

        foreach($list_size as $size)
        {
            array_push($this->opsi_dropdown_size,[
                'value' => $size->id_size,
                'text' => $size->nama_size
            ]);
        }

        foreach($list_kondisi as $kondisi)
        {
            array_push($this->opsi_dropdown_kondisi,[
                'value' => $kondisi->id_kondisi,
                'text' => $kondisi->nama_kondisi
            ]);
        }
    }

    public function updated($property)
    {
        $this->validateOnly(
            $property,
            [
                'model_image_apd.*' => ['image', 'size:256'], //5120 //256
                'model_image_apd' => ['max:3'] //5120 //256
            ],
            [
                'model_image_apd.*.image' => 'File harus berupa gambar.',
                'model_image_apd.*.size' => 'Ukuran melebihi batas maksimal (5 Mb).',
                // 'model_image_apd.image' => 'File harus berupa gambar.',
                'model_image_apd.max' => 'Jumlah file terlalu banyak (maks :max).',
                // 'model_image_apd.required' => 'Gambar belum dimasukan.'
            ]
        );
    }
#endregion

#region wire:change
    public function changedNoSeriCheckbox()
    {
        if(!$this->model_no_seri_apd)
            $this->model_no_seri_strict_apd = false;
    }
#endregion

#region Listeners FUNction
    public function buatApd()
    {
        $this->editing = false;
        $this->model_id_apd = null;
        $this->model_id_jenis = "";
        $this->model_nama_apd = null;
        $this->model_merk_apd = null;
        $this->model_size_apd = "";
        $this->model_kondisi_apd = "";
        $this->model_image_apd = null;
        $this->model_no_seri_apd = false;
        $this->model_no_seri_strict_apd = false;
        $this->model_no_seri_list_apd = null;
        $this->model_referensi_apd = null;
        $this->model_sumber_referensi_apd = null;
        $this->dispatchBrowserEvent('kendali-ke-form-apd');
    }

    public function editApd($id)
    {
        try{

            $apd = ApdList::find($id);
            if(is_null($apd))
                throw new Exception('Tidak ditemukan apd dengan id '.$id);

            $this->model_id_apd = $id;
            
            $this->inisiasiForm();

            $this->dispatchBrowserEvent('kendali-ke-form-apd');
        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Form APD @ Pengaturan Barang APD Dashboards Admin error ref('.$time.') : Kesalahan saat inisiasi form untuk edit data apd '.$e);
            Log::error('Form APD @ Pengaturan Barang APD Dashboards Admin error ref('.$time.') : Kesalahan saat inisiasi form untuk edit data apd '.$e);
            session()->flash('alert-danger-apd','Kesalahan saat inisiasi form untuk mengedit barang APD. ref ('.$time.')');
        }   
    }
#endregion

    public function inisiasiForm()
    {
        
            $apd = ApdList::find($this->model_id_apd);
        
            $this->model_no_seri_list_apd = null;

            // inisiasi model lain
            $adc = new ApdDataController;
            $this->editing = true;
            $this->model_id_jenis = $apd->id_jenis;
            $this->model_nama_apd = $apd->nama_apd;
            $this->model_merk_apd = $apd->merk;
            $this->model_size_apd = $apd->id_size;
            $this->model_kondisi_apd = $apd->id_kondisi;
            $this->model_image_apd = null;
            $this->model_image_apd_old = $adc->siapkanGambarTemplateBesertaPathnya($apd->image,$apd->id_jenis,$apd->id_apd);
            $this->model_no_seri_apd = $apd->input_no_seri;
            $this->model_no_seri_strict_apd = $apd->strict_no_seri;
            $this->model_referensi_apd = $apd->id_referensi;
            $this->model_sumber_referensi_apd = $apd->sumber_id_referensi;
            
            // inisiasi model textarea no seri
            if($this->model_no_seri_strict_apd)
            {
                $no_seri = ApdNoSeri::where('id_apd',$this->model_id_apd)->first();
                if(!is_null($no_seri))
                {
                    $list_no_seri = $no_seri->list_no_seri;
                    $list_no_seri = explode('|',$list_no_seri);
                    foreach($list_no_seri as $i => $no)
                    {
                        if($i != 0)
                            $this->model_no_seri_list_apd+= '\n';
                        $this->model_no_seri_list_apd += $no;
                    }
                }
            }
    }

    public function simpan()
    {
        $this->validate(
            [
                'model_id_jenis' => 'required',
                'model_nama_apd' => 'required',
                // 'model_size_apd' => 'required',
                'model_kondisi_apd' => 'required',
            ],
            [
                'model_id_jenis.required' => 'Jenis APD perlu dipilih.',
                // 'model_size_apd.required' => 'Tipe opsi ukuran APD perlu dipilih.',
                'model_kondisi_apd.required' => 'Tipe opsi kondisi APD perlu dipilih.',
                'model_nama_apd.required' => 'Nama APD perlu diinput.',
            ]
        );
        try{
                $fc = new FileController;
                $adc = new ApdDataController;

                if(!$this->editing)
                {
                    $this->model_id_apd = $this->model_id_jenis . '_' . substr($this->model_merk_apd,0,3) . '_0001';
                    $test = ApdList::find($this->model_id_apd);
                    if(!is_null($test))
                    {
                        $i = 0;
                        while(!is_null($test))
                        {
                            $this->model_id_apd = $this->model_id_jenis . '_' . substr($this->model_merk_apd,0,3) . '_' . sprintf("%04d",$i);
                            $test = ApdList::find($this->model_id_apd);
                            $i++;
                        }
                    }

                    $apd = new ApdList;
                    $apd->id_apd = $this->model_id_apd;
                }
                else
                {
                    $apd = ApdList::find($this->model_id_apd);
                    if(is_null($apd))
                        throw new Exception("Tidak dapat menemukan apd dengan id ".$this->model_id_apd);
                }
        
                $gambar = '';
                if($this->model_image_apd)
                {
                    $list_gbr = [];

                    //upload banyak
                    if(count($this->model_image_apd) > 1)
                    {
                        // cek ada berapa gambar yang diupload
                        // jika melebihi batas, sesuaikan dengan nilai batas
                        $jumlah_gambar = 0;

                        if(count($this->model_image_apd) < $adc::$jumlahBatasUploadGambar)
                            $jumlah_gambar = count($this->model_image_apd);
                        else
                            $jumlah_gambar = $adc::$jumlahBatasUploadGambar;

                        // proses gambar terupload ke folder masing-masing
                        for ($i = 0; $i < $jumlah_gambar; $i++) {

                            $gbr_temp = $fc->prosesNamaFileApdItem($this->model_id_apd, null, $i);

                            $this->model_image_apd[$i]->storeAs(
                                $fc->buatPathFileApdItem($this->model_id_jenis,$this->model_id_apd),
                                $gbr_temp
                            );

                            array_push($list_gbr, $gbr_temp);
                        }
                    }
                    // upload 1
                    else
                    {

                        $gbr_temp = $fc->prosesNamaFileApdItem($this->model_id_apd);

                        $this->model_image_apd[0]->storeAs(
                            $fc->buatPathFileApdItem($this->model_id_jenis,$this->model_id_apd),
                            $gbr_temp
                        );

                        array_push($list_gbr, $gbr_temp);

                    }

                    $gambar = implode("||",$list_gbr);
                }

                $apd->nama_apd = $this->model_nama_apd;
                $apd->id_jenis = $this->model_id_jenis;
                $apd->merk = $this->model_merk_apd;
                $apd->id_size = ($this->model_size_apd == '')? null : $this->model_size_apd;
                $apd->id_kondisi = $this->model_kondisi_apd;
                $apd->input_no_seri = $this->model_no_seri_apd;
                $apd->strict_no_seri = $this->model_no_seri_strict_apd;
                $apd->id_referensi = $this->model_referensi_apd;
                $apd->sumber_id_referensi = $this->model_sumber_referensi_apd;
                $apd->image = $gambar;

                $apd->save();
                session()->flash('alert-success-form-apd','Berhasil menyimpan data.');

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Form APD @ Pengaturan Barang APD Dashboards Admin error ref('.$time.') : Kesalahan saat menyimpan data barang apd '.$e);
            Log::error('Form APD @ Pengaturan Barang APD Dashboards Admin error ref('.$time.') : Kesalahan saat menyimpan data barang apd '.$e);
            session()->flash('alert-danger-form-apd','Kesalahan saat menyimpan data. ref ('.$time.')');
        }
    }
}
