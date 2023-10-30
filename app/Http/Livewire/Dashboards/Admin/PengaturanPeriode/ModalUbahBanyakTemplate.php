<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Models\Jabatan;
use Livewire\Component;

class ModalUbahBanyakTemplate extends Component
{
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
                    $this->card_multi_template_inputan_apd_listJabatan[$index] = ["id_jabatan" => $id_jabatan, "nama_jabatan" => $nama_jabatan];
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
                    $this->card_multi_template_inputan_apd_listJenisApd[$index] = ["id_jenis" => $id_jenis, "nama_jenis" => $nama_jenis];
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
                    $this->card_multi_template_inputan_apd_listApd[$index] = ["id_apd" => $id_apd, "nama_apd" => $nama_apd];
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
        $this->modal_ubah_multi_inputan_apd_mode = "jabatan";
        $this->emit("TabelJabatanTemplateMultiTerima", $this->card_multi_template_inputan_apd_listJabatan);
    }

    public function CardMultiTemplateTambahJenisApd()
    {
        $this->modal_ubah_multi_inputan_apd_mode = "jenis_apd";
        $this->emit("TabelJenisApdTemplateMultiTerima", $this->card_multi_template_inputan_apd_listJenisApd);
    }

    public function CardMultiTemplateTambahApd()
    {
        $this->modal_ubah_multi_inputan_apd_mode = "opsi_apd";
        $this->emit("TabelApdTemplateMultiGantiParameter", $this->card_multi_template_inputan_apd_listJenisApd);
        //$this->emit("TabelApdTemplateMultiTerima",$this->card_multi_template_inputan_apd_listApd);
    }

    public function CardMultiTemplateHapusJabatan($index)
    {
        try {
            unset($this->card_multi_template_inputan_apd_listJabatan[$index]);
            array_values($this->card_multi_template_inputan_apd_listJabatan);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus jabatan dari list " . $e);
        }
    }

    public function CardMultiTemplateHapusJenisApd($index)
    {
        try {
            unset($this->card_multi_template_inputan_apd_listJenisApd[$index]);
            array_values($this->card_multi_template_inputan_apd_listJenisApd);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus jenis apd dari list " . $e);
        }
    }

    public function CardMultiTemplateHapusApd($index)
    {
        try {
            unset($this->card_multi_template_inputan_apd_listApd[$index]);
            array_values($this->card_multi_template_inputan_apd_listApd);
        } catch (Throwable $e) {
            error_log("Card Multi Template Inputan Apd : Gagal dalam menghapus opsi apd dari list " . $e);
        }
    }

    public function CardMultiTemplateSimpan()
    {
        if (count($this->card_multi_template_inputan_apd_listApd) > 0 && count($this->card_multi_template_inputan_apd_listJenisApd) > 0 && count($this->card_multi_template_inputan_apd_listJabatan) > 0) {
            try {
                $pic = new PeriodeInputController;
                $data = [];
                $jumlah_data_tabel = count($this->tabel_template_data_original);
                $jumlah_data_sekarang = 0;

                foreach ($this->card_multi_template_inputan_apd_listJabatan as $jabatan) {
                    foreach ($this->card_multi_template_inputan_apd_listJenisApd as $jenis) {
                        foreach ($this->card_multi_template_inputan_apd_listApd as $apd) {
                            array_push($data, ["id_jabatan" => $jabatan["id_jabatan"], "id_jenis" => $jenis["id_jenis"], "id_apd" => $apd["id_apd"]]);
                        }
                    }
                }

                $processed_data = $pic->bangunDataTabelTemplateDariDataset($data);
                if (count($this->tabel_template_data_original) > 0)
                    $jumlah_data_tabel += 1;
                $jumlah_data_sekarang = 0;
                foreach ($processed_data as $p) {
                    $this->tabel_template_data_original[$jumlah_data_tabel + $jumlah_data_sekarang] = [
                        "index" => $jumlah_data_tabel + $jumlah_data_sekarang + 1,
                        "jabatan" => $p["jabatan"],
                        "jenis_apd" => $p["jenis_apd"],
                        "opsi_apd" => $p["opsi_apd"]
                    ];
                    $jumlah_data_sekarang++;
                }
                $this->RefreshTabelTemplate();
                session()->flash("card_template_multi_success", "Berhasil menambahkan data!");
            } catch (Throwable $e) {
                session()->flash("card_template_multi_danger", "Gagal menambahkan data!");
                error_log("Card Multi Template Inputan Apd : Gagal dalam menambahkan data secara seragam " . $e);
            }
        }
    }
}
