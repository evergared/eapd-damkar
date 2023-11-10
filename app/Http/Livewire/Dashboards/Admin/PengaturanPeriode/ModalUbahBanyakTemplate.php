<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Http\Controllers\PeriodeInputController;
use App\Models\ApdJenis;
use App\Models\ApdList;
use App\Models\Jabatan;
use Livewire\Component;
use Throwable;

class ModalUbahBanyakTemplate extends Component
{

    public $list_jabatan = [],
        $list_jenis_apd = [],
        $list_apd = [];

    public $mode = '';

    public function render()
    {
        return view('livewire.dashboards.admin.pengaturan-periode.modal-ubah-banyak-template');
    }

    public function CardMultiTemplateTerimaJabatan($value)
    {
        try {
            $sukses = 0;
            $gagal = 0;
            $jumlah = count($value);
            foreach ($value as $index => $val) {
                try {
                    $id_jabatan = $val;
                    $nama_jabatan = Jabatan::find($id_jabatan)->nama_jabatan;
                    $this->list_jabatan[$index] = ["id_jabatan" => $id_jabatan, "nama_jabatan" => $nama_jabatan];
                    $sukses++;
                } catch (Throwable $e) {
                    $gagal++;
                }
            }

            // pesan untuk status
            // sukses semua
            if ($sukses > 0)
                session()->flash("card_template_multi_hasil_sukses", ["jumlah" => $jumlah, "sukses" => $sukses, "tipe" => "Jabatan"]);
            // sukses sebagian
            elseif ($sukses > 0 && $gagal > 0)
                session()->flash("card_template_multi_hasil_multi", ["jumlah" => $jumlah, "sukses" => $sukses, "gagal" => $gagal, "tipe" => "Jabatan"]);
            // gagal semua
            elseif ($gagal > 0)
                session()->flash("card_template_multi_hasil_gagal", ["jumlah" => $jumlah, "gagal" => $gagal, "tipe" => "Jabatan"]);
            // tidak ada perubahan
            elseif ($sukses == 0 && $gagal == 0)
                session()->flash("card_template_multi_hasil_none", "Tidak ada perubahan yang terjadi");
        } catch (Throwable $e) {
            session()->flash("card_template_multi_danger", "Terjadi kesalahan saat memproses permintaan!");
            error_log("Card Multi Termplate Inputan Apd : Gagal dalam menerima jabatan terpilih " . $e);
        }
    }

    public function CardMultiTemplateTerimaJenisApd($value)
    {
        try {
            $sukses = 0;
            $gagal = 0;
            $jumlah = count($value);
            foreach ($value as $index => $val) {
                try {
                    $id_jenis = $val;
                    $nama_jenis = ApdJenis::find($id_jenis)->nama_jenis;
                    $this->list_jenis_apd[$index] = ["id_jenis" => $id_jenis, "nama_jenis" => $nama_jenis];
                    $sukses++;
                } catch (Throwable $e) {
                    $gagal++;
                }
            }

            // pesan untuk status
            // sukses semua
            if ($sukses > 0)
                session()->flash("card_template_multi_hasil_sukses", ["jumlah" => $jumlah, "sukses" => $sukses, "tipe" => "Jenis APD"]);
            // sukses sebagian
            elseif ($sukses > 0 && $gagal > 0)
                session()->flash("card_template_multi_hasil_multi", ["jumlah" => $jumlah, "sukses" => $sukses, "gagal" => $gagal, "tipe" => "Jenis APD"]);
            // gagal semua
            elseif ($gagal > 0)
                session()->flash("card_template_multi_hasil_gagal", ["jumlah" => $jumlah, "gagal" => $gagal, "tipe" => "Jenis APD"]);
            // tidak ada perubahan
            elseif ($sukses == 0 && $gagal == 0)
                session()->flash("card_template_multi_hasil_none", "Tidak ada perubahan yang terjadi");
        } catch (Throwable $e) {
            session()->flash("card_template_multi_danger", "Terjadi kesalahan saat memproses permintaan!");
            error_log("Card Multi Termplate Inputan Apd : Gagal dalam menerima jenis apd terpilih " . $e);
        }
    }

    public function CardMultiTemplateTerimaApd($value)
    {
        try {
            $sukses = 0;
            $gagal = 0;
            $jumlah = count($value);
            foreach ($value as $index => $val) {
                try {
                    $id_apd = $val;
                    $nama_apd = ApdList::find($id_apd)->nama_apd;
                    $this->list_apd[$index] = ["id_apd" => $id_apd, "nama_apd" => $nama_apd];
                    $sukses++;
                } catch (Throwable $e) {
                    $gagal++;
                }
            }

            // pesan untuk status
            // sukses semua
            if ($sukses > 0)
                session()->flash("card_template_multi_hasil_sukses", ["jumlah" => $jumlah, "sukses" => $sukses, "tipe" => "Barang APD"]);
            // sukses sebagian
            elseif ($sukses > 0 && $gagal > 0)
                session()->flash("card_template_multi_hasil_multi", ["jumlah" => $jumlah, "sukses" => $sukses, "gagal" => $gagal, "tipe" => "Barang APD"]);
            // gagal semua
            elseif ($gagal > 0)
                session()->flash("card_template_multi_hasil_gagal", ["jumlah" => $jumlah, "gagal" => $gagal, "tipe" => "Barang APD"]);
            // tidak ada perubahan
            elseif ($sukses == 0 && $gagal == 0)
                session()->flash("card_template_multi_hasil_none", "Tidak ada perubahan yang terjadi");
        } catch (Throwable $e) {
            session()->flash("card_template_multi_danger", "Terjadi kesalahan saat memproses permintaan!");
            error_log("Card Multi Termplate Inputan Apd : Gagal dalam menerima opsi apd terpilih " . $e);
        }
    }

    public function CardMultiTemplateTambahJabatan()
    {
        $this->mode = "jabatan";
        $this->emit("TabelJabatanTemplateMultiTerima", $this->list_jabatan);
    }

    public function CardMultiTemplateTambahJenisApd()
    {
        $this->mode = "jenis_apd";
        $this->emit("TabelJenisApdTemplateMultiTerima", $this->list_jenis_apd);
    }

    public function CardMultiTemplateTambahApd()
    {
        $this->mode = "opsi_apd";
        $this->emit("TabelApdTemplateMultiGantiParameter", $this->list_jenis_apd);
        //$this->emit("TabelApdTemplateMultiTerima",$this->list_apd);
    }

    public function CardMultiTemplateHapusJabatan($index)
    {
        try {
            unset($this->list_jabatan[$index]);
            array_values($this->list_jabatan);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus jabatan dari list " . $e);
        }
    }

    public function CardMultiTemplateHapusJenisApd($index)
    {
        try {
            unset($this->list_jenis_apd[$index]);
            array_values($this->list_jenis_apd);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus jenis apd dari list " . $e);
        }
    }

    public function CardMultiTemplateHapusApd($index)
    {
        try {
            unset($this->list_apd[$index]);
            array_values($this->list_apd);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus opsi apd dari list " . $e);
        }
    }

    public function CardMultiTemplateSimpan()
    {
        if (count($this->list_apd) > 0 && count($this->list_jenis_apd) > 0 && count($this->list_jabatan) > 0) {
            try {
                // $pic = new PeriodeInputController;
                // $data = [];
                // $jumlah_data_tabel = count($this->tabel_template_data_original);
                // $jumlah_data_sekarang = 0;

                // foreach ($this->list_jabatan as $jabatan) {
                //     foreach ($this->list_jenis_apd as $jenis) {
                //         foreach ($this->list_apd as $apd) {
                //             array_push($data, ["id_jabatan" => $jabatan["id_jabatan"], "id_jenis" => $jenis["id_jenis"], "id_apd" => $apd["id_apd"]]);
                //         }
                //     }
                // }

                // $processed_data = $pic->bangunDataTabelTemplateDariDataset($data);
                // if (count($this->tabel_template_data_original) > 0)
                //     $jumlah_data_tabel += 1;
                // $jumlah_data_sekarang = 0;
                // foreach ($processed_data as $p) {
                //     $this->tabel_template_data_original[$jumlah_data_tabel + $jumlah_data_sekarang] = [
                //         "index" => $jumlah_data_tabel + $jumlah_data_sekarang + 1,
                //         "jabatan" => $p["jabatan"],
                //         "jenis_apd" => $p["jenis_apd"],
                //         "opsi_apd" => $p["opsi_apd"]
                //     ];
                //     $jumlah_data_sekarang++;
                // }
                // $this->RefreshTabelTemplate();
                session()->flash("card_template_multi_success", "Berhasil menambahkan data!");
            } catch (Throwable $e) {
                session()->flash("card_template_multi_danger", "Gagal menambahkan data!");
                error_log("Card Multi Template Inputan Apd : Gagal dalam menambahkan data secara seragam " . $e);
            }
        }
    }
}
