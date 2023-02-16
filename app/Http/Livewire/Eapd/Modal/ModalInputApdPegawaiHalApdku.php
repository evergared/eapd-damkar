<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Enum\KeberadaanApd;
use App\Enum\StatusApd;
use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Enum\VerifikasiApd as verif;
use App\Http\Controllers\StatusDisplayController;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use Illuminate\Support\Facades\Auth;
use App\Models\Eapd\Mongodb\InputApd;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class ModalInputApdPegawaiHalApdku extends Component
{

    use WithFileUploads;


    // data untuk list dari template
    public  $id_jenis,
        $nama_jenis,
        $data_apd,
        $list_apd,
        $opsi_apd,
        $size_apd,
        $kondisi_apd,
        $gambar_apd_template = [],
        $opsi_keberadaan = [
            ['value'=> 'ada', 'text' => 'Sudah Terima dan Ada'],
            ['value'=> 'hilang', 'text' => 'Sudah Terima Tapi Hilang'],
            ['value'=> 'belum', 'text' => 'APD Belum Diterima'],
        ];


    // untuk diisi oleh user
    public  $id_apd_user = '',
        $nama_apd_user = '',
        $size_apd_user = '',
        $kondisi_apd_user = '',
        $gambar_apd_user = [],
        $komentar_apd_user ="",
        $status_keberadaan_apd_user = "";

    // didapat dari db
    public  $gambar_apd = [],
        $komentar_verif_user = "",
        $status_verif_user = 1,
        $label_verif_user = "Proses Input";

    // untuk cache
    public $id_apd_cache,
        $size_apd_cache,
        $kondisi_apd_cache,
        $komentar_apd_cache;

    // path gambar
    public $pathGbr = "storage";

    // path untuk placeholder 
    public $mock = "storage/img/apd/placeholder";

    /**
     * dalam php sulit untuk mengetahui dengan pasti
     * hasil komparasi array kosong,
     * karena [] = 1 jika kita compare dengan if.
     * maka dari itu berikut boolean untuk membantu
     * dalam logic if else untuk array kosong.
     */
    public $userTelahMemilih = false,
        $telahDiverifAdmin = false, //belum dipakai
        $adaGambarTemplate = false,
        $adaGambarUser = false;


    protected $listeners = [
        'modalInputApdPegawai'
    ];

    public function render()
    {
        // untuk cek render. Lihat terminal
        // error_log('komponen rendered');
        // error_log('id_apd_user saat render : ' . $this->id_apd_user);


        return view('eapd.livewire.modal.modal-input-apd-pegawai-hal-apdku');
    }

    /**
     * @param string $value Item dari list templateInputApd, memiliki id_jenis dan opsi_apd
     */
    public function modalInputApdPegawai($value)
    {
        $this->userTelahMemilih = false;
        $this->adaGambarTemplate = false;
        $this->id_apd_user = "";
        $this->komentar_apd_user = "";
        $this->komentar_verif_user = "";

        $this->id_jenis = null;
        $this->nama_jenis = null;
        $this->data_apd = null;
        $this->list_apd = null;
        $this->size_apd = null;
        $this->kondisi_apd = null;
        $this->gambar_apd_template = null;
        $this->status_keberadaan_apd_user = "";
        $this->telahDiverifAdmin = false;
        $this->gambar_apd_user = [];

        $adc = new ApdDataController;

        // untuk tes, load satu jenis apd dan apd-apd opsi nya
        // $tes = $adc->muatSatuContohDaftarInputApd();
        $tes = $adc->muatOpsiApd($value);

        $this->id_jenis = $tes['id_jenis'];
        $this->opsi_apd = $tes['opsi_apd'];
        $this->data_apd = $adc->bangunItemModalInputApd($tes['opsi_apd']);
        $this->nama_jenis = ApdJenis::where('_id', '=', $this->id_jenis)->value('nama_jenis');


        $this->hidrasiListApd();

        $this->ambilDataUser();
        $this->hidrasiDataOpsi();
        $this->id_apd_user = $this->id_apd_cache = $this->opsi_apd[0];
        $this->userTelahMemilih = true;
        $this->refreshGambarTemplate();

        error_log('Gambar : ');
        // dd($this->gambar_apd);

        // untuk cek data
        // return dd($this->data_apd);
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

    public function selectModelApdDirubah()
    {
        try {
            sleep(1);
            $this->userTelahMemilih = true;
            $this->perbaruiDataModal();
        } catch (Throwable $e) {
        }
    }

    public function perbaruiDataModal()
    {
        // untuk cek terpanggil atau tidak
        error_log('id_apd_user updated');

        $this->kosongkanDataInput();
        $this->hidrasiListApd();
        $this->hidrasiDataOpsi();
        $this->refreshGambarTemplate();

        error_log('id_apd_user : ' . $this->id_apd_user);
        error_log('list gambar template : ' . implode('||', $this->gambar_apd_template));
    }

    public function ubahKeWarnaBootstrap(int $item): string
    {

        $sdc = new StatusDisplayController;
        return $sdc->ubahVerifikasiApdKeWarnaBootstrap($item);
    }

    public function refreshGambarTemplate()
    {
        $this->gambar_apd_template = array();

        try {
            $gbr = ApdList::where('_id', '=', $this->id_apd_user)->value('image');
            $this->adaGambarTemplate = $gbr == "" ? false : true;
            $this->gambar_apd_template = explode('||', $gbr);
            // dd($this->gambar_apd_template);
        } catch (Throwable $e) {

            error_log('Gagal mengambil gambar template apd untuk id jenis "' . $this->id_jenis . '" dengan id apd "' . $this->id_apd_user . '". ' . $e);
            report('Gagal mengambil gambar template apd untuk id jenis "' . $this->id_jenis . '" dengan id apd "' . $this->id_apd_user . '". ' . $e);
            session()->flash('gambar_apd_template_error', 'Gagal memuat gambar template apd.');
        }
    }

    public function refreshGambarUser()
    {
        $this->gambar_apd = [];

        try {
            $gbr = InputApd::where('id_pegawai', '=', Auth::user()->id)->where('id_jenis', '=', $this->id_jenis)->value('image');
            $this->adaGambarUser = $gbr == "" ? false : true;
            $this->gambar_apd = explode('||', $gbr);
        } catch (Throwable $e) {

            error_log('Gagal mengambil gambar apd user untuk id jenis "' . $this->id_jenis .  '". ' . $e);
            report('Gagal mengambil gambar apd user untuk id jenis "' . $this->id_jenis . '". ' . $e);
            session()->flash('gambar_apd_user_error', 'Gagal memuat gambar apd inputan user.');
        }
    }

    public function kosongkanDataInput()
    {
        // size
        $this->size_apd_user = "";
        // kondisi
        $this->kondisi_apd_user = "";
        // komentar
        $this->komentar_apd_user = "";

        // gambar
        $this->gambar_apd_user = null;
    }

    public function hidrasiListApd()
    {
        try {
            $this->list_apd = [];
            foreach ($this->opsi_apd as $opsi) {
                // $apd = "";
                // $apd->id_apd = $opsi;
                // $apd->nama_apd = ApdList::where('id_apd', '=', $opsi)->value('nama_apd');
                // array_push($this->list_apd, $apd);
                array_push($this->list_apd, ['id_apd' => $opsi, 'nama_apd' => ApdList::where('_id', '=', $opsi)->value('nama_apd')]);
            }
        } catch (Throwable $e) {
            // error_log('Gagal melakukan hidrasi list apd untuk id jenis "' . $this->id_jenis .  $e);
            // report('Gagal melakukan hidrasi list apd untuk id jenis "' . $this->id_jenis .  $e);
            session()->flash('fail', 'Kesalahan dalam pengambilan data model apd.');
        }
    }

    public function hidrasiDataOpsi()
    {
        $this->size_apd = $this->data_apd[array_search($this->id_apd_user, $this->data_apd, true)]['size_apd'];

        // $this->gambar_apd_template = $this->data_apd[array_search($this->id_apd_user, $this->data_apd)]['gambar_apd'];

        $this->kondisi_apd = $this->data_apd[array_search($this->id_apd_user, $this->data_apd, true)]['kondisi_apd'];
        // return dd($this->kondisi_apd);
    }

    public function sesuaikanPathGambar()
    {
        $fc = new FileController;
        $adc = new ApdDataController;
        // $periode = $adc->ambilIdPeriodeInput();
        $periode = 1;
        $this->pathGbr = "storage/" . $fc->buatPathFileApdUpload(Auth::user()->id, $this->id_jenis, $periode);
    }

    public function ambilDataUser()
    {
        try {
            if ($inputan_user = InputApd::where('id_pegawai', '=', Auth::user()->id)->where('id_jenis', '=', $this->id_jenis)->first()) {
            } else {
                $this->status_verif_user = verif::input()->value;
                $this->label_verif_user = verif::input()->label;
                $this->size_apd_user = "";
                $this->kondisi_apd_user = "";
                $this->gambar_apd = [];
                return;
            }

            $this->id_apd_user = $inputan_user->id_apd;
            $this->size_apd_user = $inputan_user->size;
            $this->kondisi_apd_user = $inputan_user->kondisi;
            $this->komentar_apd_user = $inputan_user->komentar_pengupload;
            $this->komentar_verif_user = $inputan_user->komentar_verifikator;
            $this->status_verif_user = verif::tryFrom($inputan_user->verifikasi_status)->value;
            $this->label_verif_user = verif::tryFrom($inputan_user->verifikasi_status)->label;
            $this->status_keberadaan_apd_user = KeberadaanApd::tryFrom($inputan_user->keberadaan)->value;

            if($this->status_verif_user == verif::terverifikasi()->value)
            {
                $this->telahDiverifAdmin = true;
            }

            $this->nama_apd_user = ApdList::where('_id', '=', $this->id_apd_cache)->value('nama_apd');

            $this->sesuaikanPathGambar();
            $this->refreshGambarUser();

            $this->userTelahMemilih = true;

            // return dd(verif::tryFrom($inputan_user->verifikasi_status));

            // $this->hidrasiDataOpsi();
        } catch (Throwable $e) {
            error_log('Gagal mengambil data user untuk id jenis "' . $this->id_jenis . '" dan id user "' . Auth::user()->id . '"' .  $e);
            report('Gagal mengambil data user untuk id jenis "' . $this->id_jenis . '" dan id user "' . Auth::user()->id . '"' .  $e);
            session()->flash('fail', 'Kesalahan dalam pengambilan data inputan pengguna.');
        }
    }

    public function simpan()
    {
        
        if($this->status_keberadaan_apd_user == "ada")
        {
            $this->validate(
                [
                    'id_apd_user' => 'required'
                ],
                [
                    'id_apd_user.required' => 'Harap pilih model APD'
                ]
            );

            if (!is_null($this->size_apd)) {
                $this->validate(
                    [
                        'size_apd_user' => 'required'
                    ],
                    [
                        'size_apd_user.required' => 'Harap pilih ukuran APD'
                    ]
                );
            }

            if (!is_null($this->kondisi_apd)) {
                $this->validate(
                    [
                        'kondisi_apd_user' => 'required'
                    ],
                    [
                        'kondisi_apd_user.required' => 'Harap pilih jenis kondisi APD'
                    ]
                );
            }

            $this->validate(
                [
                    'gambar_apd_user' => 'required'
                ],
                [
                    'gambar_apd_user.required' => 'Harap upload gambar APD'
                ]
            );
        }

        

        try {

            $fc = new FileController;

            $adc = new ApdDataController;

            $id_pegawai = Auth::user()->id;

            /**
             * @todo ambil id dari fungsi pada kelas ApdDataController
             */
            $periode = $adc->ambilIdPeriodeInput();

            if($apd = InputApd::where('id_pegawai','=',$id_pegawai)->where('id_jenis','=',$this->id_jenis)->where('id_periode','=',$periode)->first())
            {}
            else
            {
                $apd = new InputApd;
                $apd->id_pegawai = $id_pegawai;
                $apd->id_jenis = $this->id_jenis;
                $apd->id_periode = $periode;
                $apd->verifikasi_status = verif::verifikasi()->value;
            }
                        


            if($this->status_keberadaan_apd_user != "ada")
            {
                if($this->status_keberadaan_apd_user == "belum")
                {
                    $apd->keberadaan = KeberadaanApd::belumTerima()->value;
                    $apd->kondisi = StatusApd::belumTerima()->value;
                }
                
                if($this->status_keberadaan_apd_user == "hilang")
                {
                    $apd->keberadaan = KeberadaanApd::hilang()->value;
                    $apd->kondisi = StatusApd::hilang()->value;
                }

                $apd->save();
                session()->flash('success', 'Data Apd berhasil diinput.');
                $this->ambilDataUser();
                $this->id_apd_user = $this->id_apd_cache = $this->opsi_apd[0];
                $this->userTelahMemilih = true;
                $this->emit('LayoutDaftarInputApdHalApdku');
                $this->emit('refreshStatbox');
                return;
            }

            $apd->id_apd = $this->id_apd_user;
            $apd->size = $this->size_apd_user;
            $apd->kondisi = $this->kondisi_apd_user;
            $apd->komentar_pengupload = $this->komentar_apd_user;
            $apd->keberadaan = KeberadaanApd::ada()->value;


            $list_gbr = [];

            if (count($this->gambar_apd_user) > 1) {
                error_log('hit apd lebih dr 1');
                $batas_jumlah = 0;
                if (count($this->gambar_apd_user) < $adc::$jumlahBatasUploadGambar) {
                    error_log('hit apd kurang dr jumlah batas up');

                    $batas_jumlah = count($this->gambar_apd_user);
                } else {
                    error_log('hit apd sesuai jumlah batas up');

                    $batas_jumlah = $adc::$jumlahBatasUploadGambar;
                }

                error_log('pengulangan');
                for ($i = 0; $i < $batas_jumlah; $i++) {

                    error_log('isi : ' . $this->gambar_apd_user[$i]);

                    $gbr_temp = $fc->prosesNamaFileApdUpload($id_pegawai, $this->id_apd_user, 'jpg', $i);

                    $this->gambar_apd_user[$i]->storeAs(
                        $fc->buatPathFileApdUpload($id_pegawai, $this->id_jenis, $periode),
                        $gbr_temp
                    );

                    array_push($list_gbr, $gbr_temp);
                }
            } else {

                error_log('isi : ' . $this->gambar_apd_user[0]);

                $gbr_temp = $fc->prosesNamaFileApdUpload($id_pegawai, $this->id_apd_user, 'jpg', 0);

                $this->gambar_apd_user[0]->storeAs(
                    $fc->buatPathFileApdUpload($id_pegawai, $this->id_jenis, $periode),
                    $gbr_temp
                );

                array_push($list_gbr, $gbr_temp);
            }


            $gbr = implode("||", $list_gbr);

            // if(!is_null($gbr))
            // {
            //     inputApd
            // }

            $apd->image = "";
            $apd->image = $gbr;

            $apd->save();

            session()->flash('success', 'Data Apd berhasil diinput.');

            $this->gambar_apd = [];

            $this->ambilDataUser();
            $this->gambar_apd_user = null;

            $this->id_apd_user = $this->id_apd_cache = $this->opsi_apd[0];
            $this->userTelahMemilih = true;

            $this->emit('LayoutDaftarInputApdHalApdku');
            $this->emit('refreshStatbox');
            $this->dispatchBrowserEvent('pilihFilterSemua');
        } catch (Throwable $e) {
            error_log('gagal simpan data input apd untuk user "' . Auth::user()->id . '"  ' . $e);
            report('gagal simpan data input apd untuk user "' . Auth::user()->id . '"  ' . $e);
            session()->flash('fail', 'Data Apd gagal diinput. (internal error, cek log)');
        }
    }
}
