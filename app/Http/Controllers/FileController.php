<?php

namespace App\Http\Controllers;

use App\Models\Eapd\PeriodeInputApd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
    public static $apdUploadBasePath = 'img/apd/input';

    /**
     * Path dasar penyimpanan gambar apd oleh admin
     */
    public static $apdItemBasePath = 'img/apd/item';

    /**
     * Path dasar penyimpanan placeholder apd untuk keperluan tes.
     */
    public static $apdPlaceholderBasePath = 'img/apd/placeholder';

    /**
     * Path dasar penyimpanan gambar foto profil yang diupload oleh user
     */
    public static $avatarUploadBasePath = 'img/avatar/user';

    /**
     * Path dasar penyimpanan gambar untuk keperluan tes
     */
    public static $testUploadBasePath = 'img/tes';

    /**
     * File placeholder untuk avatar / foto profil user
     */
    public static $avatarPlaceholder = 'storage/img/avatar/placeholder/avatar.jpg';

    /**
     * File placeholder untuk tamplate apd, ketika tidak ditemukan file gambar apd
     */
    public static $apdPlaceholder = 'storage/img/apd/apd_no-image.png';

    /**
     * Mengganti nama file gambar dari foto apd yang diupload user
     * 
     * @return String nama file baru untuk di simpan di database
     */
    public function prosesNamaFileApdUpload($id_pegawai, $id_item = 'item', $tipe_file = 'jpg', $urutan = null)
    {
        try {
            if (is_null($urutan))
                return $id_pegawai . '_' . $id_item . '.' . $tipe_file;
            else
                return $id_pegawai . '_' . $id_item . '_' . $urutan . '.' . $tipe_file;
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
    public function prosesNamaFileAvatarUpload($id_pegawai, $tipe_file = 'jpg')
    {
        try {
            return $id_pegawai . '_ava' . '.' . $tipe_file;
        } catch (Throwable $e) {
            Log::error('Gagal memproses nama file avatar upload, ' . $e);
            return;
        }
    }

    public function buatPathFileApdUpload($id_pegawai, $id_jenis, $id_periode)
    {
        $periode = Str::slug(PeriodeInputApd::where('id', '=', $id_periode)->first()->nama_periode);

        return self::$apdUploadBasePath . '/' . $id_pegawai . '/' . $periode . '/' . $id_jenis;
    }

    public function buatPathFileApdItem($id_jenis, $id_apd)
    {
        // return self::$apdItemBasePath . '/' . $id_jenis . '/' . $id_apd;
        return self::$apdPlaceholderBasePath;
    }
}
