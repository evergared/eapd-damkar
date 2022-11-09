<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Controller yang mengatur upload dan pemanggilan file gambar yang ada di database
 */
class FileController extends Controller
{

    /**
     * TODO :
     * - path dasar apd laporan sewaktu-waktu
     * - path dasar item supply
     * - proses nama apd laporan sewaktu-waktu
     * - proses nama item supply
     * - proses untuk pemindahan foto apd lama saat laporan sewaktu-waktu di approve
     * - path dasar untuk penyimpanan foto lama tersebut
     * - proses untuk mitigasi server over capacity? menggunakan aws s3 bucket utk menyimpan foto stlh rekap atau lgsg hapus dg cron job / manual?
     */

    /**
     * Daftar isi : 
     * - $apdUploadBasePath
     * - $apdItemBasePath
     * - $avatarUploadBasePath
     * - prosesNamaFileApdUpload()
     * - prosesNamaFileApdItem()
     * - prosesNamaFileAvatarUpload()
     */


    /**
     * Path dasar penyimpanan gambar apd yang diinput oleh user
     */
    public $apdUploadBasePath = 'img/apd/input';

    /**
     * Path dasar penyimpanan gambar apd oleh admin
     */
    public $apdItemBasePath = 'img/apd/item';

    /**
     * Path dasar penyimpanan gambar foto profil yang diupload oleh user
     */
    public $avatarUploadBasePath = 'img/avatar/user';

    /**
     * Mengganti nama file gambar dari foto apd yang diupload user
     * 
     * @return String nama file baru untuk di simpan di database
     */
    public function prosesNamaFileApdUpload($nrk, $id_item = 'item', $tipe_file = 'jpg', $urutan = null)
    {
        try {
            if (is_null($urutan))
                return $nrk . '_' . $id_item . '.' . $tipe_file;
            else
                return $nrk . '_' . $id_item . '_' . $urutan . '.' . $tipe_file;
        } catch (Throwable $e) {
            Log::error('Gagal memproses nama file apd upload, ' . $e);
            return;
        }
    }

    /**
     * Mengganti nama file gambar dari foto profil yang diupload user
     * 
     * @return String nama file baru untuk di simpan di database
     */
    public function prosesNamaFileAvatarUpload($nrk, $tipe_file = 'jpg')
    {
        try {
            return $nrk . '_ava' . '.' . $tipe_file;
        } catch (Throwable $e) {
            Log::error('Gagal memproses nama file avatar upload, ' . $e);
            return;
        }
    }
}
