<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\FileController;
use App\Enum\VerifikasiApd as verif;
use App\Models\Eapd\ApdJenis;
use App\Models\Eapd\ApdList;
use Illuminate\Support\Facades\Auth;
use App\Models\Eapd\InputApd;
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
        $size_apd,
        $kondisi_apd,
        $gambar_apd_template = null;


    // untuk diisi oleh user
    public  $id_apd_user = '',
        $nama_apd_user = '',
        $size_apd_user = '',
        $kondisi_apd_user = '',
        $gambar_apd_user,
        $komentar_apd_user;

    // didapat dari db
    public  $gambar_apd = [],
        $komentar_verif_user,
        $status_verif_user = 1,
        $label_verif_user = "Proses Input";

    // untuk cache
    public $id_apd_cache,
        $size_apd_cache,
        $kondisi_apd_cache,
        $komentar_apd_cache;

    // path gambar
    public $pathGbr = "storage";

    // path untuk tes 
    public $mock = "storage/img/apd/placeholder";

    //temp
    public $opsi_apd;


    protected $listeners = [
        'modalInputApdPegawai'
    ];

    public function render()
    {
        error_log('rendered');
        // $this->status_verif_user = verif::tryFrom(1)->value;
        // $this->label_verif_user = verif::tryFrom(1)->label;
        return view('eapd.livewire.modal.modal-input-apd-pegawai-hal-apdku');
    }

    /**
     * @param Array $value Item dari list templateInputApd, memiliki id_jenis dan opsi_apd
     */
    public function modalInputApdPegawai($value)
    {
        $adc = new ApdDataController;

        // untuk tes, load satu jenis apd dan apd-apd opsi nya
        $tes = $adc->muatSatuContohDaftarInputApd();

        $this->id_jenis = $tes['id_jenis'];
        $this->opsi_apd = $tes['opsi_apd'];
        $this->data_apd = $adc->bangunItemModalInputApd($tes['opsi_apd']);
        $this->nama_jenis = ApdJenis::where('id_jenis', '=', $this->id_jenis)->value('nama_jenis');

        $this->hidrasiListApd();
        $this->ambilDataUser();
        $this->hidrasiDataOpsi();
        $this->refreshGambarTemplate();

        // untuk cek data
        // return dd($this->data_apd);
    }

    public function updatingIdApdUser()
    {
        // untuk cek terpanggil atau tidak
        //error_log('id_apd_user updated');

        $this->kosongkanDataInput();
        $this->hidrasiListApd();
        $this->hidrasiDataOpsi();
        $this->refreshGambarTemplate();

        error_log('id_apd_user : ' . $this->id_apd_user);
        error_log('list gambar template : ' . implode('||', $this->gambar_apd_template));
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

    public function ubahKeWarnaBootstrap(int $item): string
    {
        $warna = '';

        error_log('valeu : ' . $item);

        switch ($item) {
            case 1:
                $warna = 'secondary';
                break;
            case 2:
                $warna = 'info';
                break;
            case 3:
                $warna = 'success';
                break;
            case 4:
                $warna = 'danger';
                break;
            case 5:
                $warna = 'warning';
                break;
            default:
                $warna = 'secondary';
                break;
        }

        return $warna;
    }

    public function refreshGambarTemplate()
    {
        $this->gambar_apd_template = array();

        try {

            $this->gambar_apd_template = explode('||', ApdList::where('id_apd', '=', $this->id_apd_user)->value('image'));
            // dd($this->gambar_apd_template);
        } catch (Throwable $e) {

            error_log('Gagal mengambil gambar template apd untuk id jenis "' . $this->id_jenis . '" dengan id apd "' . $this->id_apd_user . '". ' . $e);
            report('Gagal mengambil gambar template apd untuk id jenis "' . $this->id_jenis . '" dengan id apd "' . $this->id_apd_user . '". ' . $e);
            session()->flash('gambar_apd_template_error', 'Gagal memuat gambar template apd.');
        }
    }

    public function refreshGambarUser()
    {
        $this->gambar_apd = array();

        try {
            $this->gambar_apd = explode('||', InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $this->id_jenis)->value('image'));
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
        $this->list_apd = [];
        foreach ($this->opsi_apd as $opsi) {
            array_push($this->list_apd, ['id_apd' => $opsi, 'nama_apd' => ApdList::where('id_apd', '=', $opsi)->value('nama_apd')]);
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

        $this->pathGbr = "storage/" . $fc->buatPathFileApdUpload(Auth::user()->nrk, $this->id_jenis);
    }

    public function ambilDataUser()
    {
        if ($inputan_user = InputApd::where('nrk', '=', Auth::user()->nrk)->where('id_jenis', '=', $this->id_jenis)->first()) {
        } else {
            return;
        }

        $this->id_apd_user = $inputan_user->id_apd;
        $this->size_apd_user = $inputan_user->size;
        $this->kondisi_apd_user = $inputan_user->kondisi;
        $this->komentar_apd_user = $inputan_user->komentar_pengupload;
        $this->komentar_verif_user = $inputan_user->komentar_verifikator;
        $this->status_verif_user = verif::tryFrom($inputan_user->verifikasi_status)->value;
        $this->label_verif_user = verif::tryFrom($inputan_user->verifikasi_status)->label;

        $this->nama_apd_user = ApdList::where('id_apd', '=', $this->id_apd_cache)->value('nama_apd');

        $this->sesuaikanPathGambar();
        $this->refreshGambarUser();


        // return dd(verif::tryFrom($inputan_user->verifikasi_status));

        // $this->hidrasiDataOpsi();
    }

    public function simpan()
    {
        // error_log('simpan');
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
        // return dd($this->gambar_apd_user);

        try {


            $fc = new FileController;

            $adc = new ApdDataController;
            $apd = new InputApd;

            $nrk = Auth::user()->nrk;

            $apd->nrk = $nrk;
            $apd->id_jenis = $this->id_jenis;
            $apd->id_apd = $this->id_apd_user;
            $apd->size = $this->size_apd_user;
            $apd->kondisi = $this->kondisi_apd_user;
            $apd->komentar_pengupload = $this->komentar_apd_user;

            /**
             * @todo ambil id dari fungsi pada kelas ApdDataController
             */
            $apd->id_periode = '1';

            /**
             * @todo buat enum untuk status verifikasi
             */
            $apd->verifikasi_status = verif::verifikasi();

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

                    $gbr_temp = $fc->prosesNamaFileApdUpload($nrk, $this->id_apd_user, 'jpg', $i);

                    $this->gambar_apd_user[$i]->storeAs(
                        $fc->buatPathFileApdUpload($nrk, $this->id_jenis),
                        $gbr_temp
                    );

                    array_push($list_gbr, $gbr_temp);
                }
            } else {

                error_log('isi : ' . $this->gambar_apd_user[0]);

                $gbr_temp = $fc->prosesNamaFileApdUpload($nrk, $this->id_apd_user, 'jpg', 0);

                $this->gambar_apd_user[0]->storeAs(
                    $fc->buatPathFileApdUpload($nrk, $this->id_jenis),
                    $gbr_temp
                );

                array_push($list_gbr, $gbr_temp);
            }


            $gbr = implode("||", $list_gbr);

            $apd->image = $gbr;
            $apd->verifikasi_status = verif::verifikasi();

            $apd->save();

            session()->flash('success', 'Data Apd berhasil diinput.');

            $this->ambilDataUser();
            $this->gambar_apd_user = null;
        } catch (Throwable $e) {
            error_log('gagal simpan data input apd  ' . $e);
            report('gagal simpan data input apd  ' . $e);
            session()->flash('fail', 'Data Apd gagal diinput. (internal error, cek log)');
        }
    }
}
