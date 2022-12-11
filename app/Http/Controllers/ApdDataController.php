<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eapd\ApdList;

class ApdDataController extends Controller
{

    public static $jumlahBatasUploadGambar = 3;

    public function muatContohDaftarInputApd(): array
    {
        // digunakan untuk contoh
        return [
            ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']],
            ['id_jenis' => 'H002', 'opsi_apd' => ['H-fir-0001']],
            ['id_jenis' => 'G001', 'opsi_apd' => ['G-glo-0000', 'G-glo-0001', 'G-alt-0000']],
            ['id_jenis' => 'G002', 'opsi_apd' => ['G-alt-0001', 'G-alt-0002']],
            ['id_jenis' => 'T001', 'opsi_apd' => ['T-fir-0000', 'T-pol-0000']],
            ['id_jenis' => 'T002', 'opsi_apd' => ['T-yoh-0000', 'T-pol-0001']],
            ['id_jenis' => 'B001', 'opsi_apd' => ['B-yoh-0000', 'B-ari-0000']],
            ['id_jenis' => 'B002', 'opsi_apd' => ['B-ari-0001']],
            ['id_jenis' => 'A001', 'opsi_apd' => ['B-dar-0000']],
            ['id_jenis' => 'A002', 'opsi_apd' => ['B-ari-0000']],
            ['id_jenis' => 'A003', 'opsi_apd' => ['B-tho-0000']],
            ['id_jenis' => 'A004', 'opsi_apd' => ['B-uni-0000']],
        ];
    }

    public function muatSatuContohDaftarInputApd(): array
    {
        return ['id_jenis' => 'H001', 'opsi_apd' => ['H-bro-0000', 'H-fir-0000', 'H-bro-0001']];
    }

    public function bangunItemModalInputApd(array $opsi_apd): array
    {
        $array = [];

        foreach ($opsi_apd as $apd) {
            $id_apd = $apd;

            error_log('id apd : ' . $id_apd);
            $model = ApdList::where('id_apd', '=', $id_apd)->first();

            $nama_apd = $model->nama_apd;
            $merk_apd = $model->merk_apd;
            $size_apd = $model->size->opsi;
            $kondisi_apd = $model->kondisi->opsi;
            $gambar_apd = $model->image;

            // gambar apd harus berupa array untuk mempermudah pengecekan
            if (is_null($gambar_apd)) {
                $gambar_apd = [];
            } else if (str_contains($gambar_apd, '||')) {
                $gambar_apd = explode('||', $gambar_apd);
            } else {
                $gambar = $gambar_apd;
                $gambar_apd = [$gambar];
            }

            array_push($array, [
                'id_apd' => $id_apd,
                'nama_apd' => $nama_apd,
                'merk_apd' => $merk_apd,
                'size_apd' => $size_apd,
                'kondisi_apd' => $kondisi_apd,
                'gambar_apd' => $gambar_apd
            ]);
        }

        return $array;
    }

    /**
     * @todo Fungsi untuk ambil id periode
     * @body Buat fungsi untuk ambil id periode di db untuk data periode saat insert data input apd
     */
    public function ambilIdPeriodeInput($tanggal)
    {
        // where tanggal awal < $tanggal < tanggal akhir -> value('id')
    }
}
