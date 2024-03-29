<?php

namespace App\Http\Controllers;

use App\Enum\KeberadaanApd;
use App\Enum\StatusApd;
use App\Enum\VerifikasiApd;
use App\Models\Eapd\Mongodb\ApdJenis;
use App\Models\Eapd\Mongodb\ApdList;
use App\Models\Eapd\Mongodb\InputApd;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use App\Models\Eapd\Mongodb\PeriodeInputApd;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Kontroller yang mengatur penyajian data rekap pegawai
 */
class ApdRekapController extends Controller
{
    /**
     * Untuk membangun data rekapan apd sektor, berupa jumlah berapa data dengan kondisi tertentu
     */
    public function bangunDataTabelRekapApdSektor($id_periode = 1, $sektor = "")
    {
        // error_log('mulai membangun data untuk tabel rekap');
        if($sektor == "")
            // $sektor = Auth::user()->data->sektor;
            $sektor = "1.11";

        if($id_periode == 1)
            $id_periode = PeriodeInputApd::get()->first()->id;
        
        try{
            $data_rekap_apd = collect();

            // pengulangan untuk cek apa saja yang harus diinput oleh pegawai di sektor tersebut
            if($semua_inputan = InputApd::where('id_periode','=',$id_periode)->get())
            {
                $inputan_anggota = $semua_inputan->filter(function($value,$key) use($sektor){
                    $a = Pegawai::where('_id','=',$value['id_pegawai'])->first();
                    $verdict = $a->sektor == $sektor;
                    return $verdict;
                });

                $list_jenis_apd = $inputan_anggota->unique('id_jenis');

                // dd($inputan_anggota);

                // pengulangan untuk ambil rangkuman data berdasarkan list jenis apd yang telah diambil
                foreach($list_jenis_apd as $apd)
                {
                    $nama_jenis_apd = ApdJenis::where('_id','=',$apd->id_jenis)->first()->nama_jenis;

                    $baik = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::baik()->value)->count();
                    $rusak_ringan = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakRingan()->value)->count();
                    $rusak_sedang = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakSedang()->value)->count();
                    $rusak_berat = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('kondisi','=',StatusApd::rusakBerat()->value)->count();
                    $belum_terima = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('keberadaan','=',KeberadaanApd::belumTerima()->value)->count();
                    $hilang = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('keberadaan','=',KeberadaanApd::hilang()->value)->count();
                    $ada = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->where('keberadaan','=',KeberadaanApd::ada()->value)->count();
                    $total = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->count();
                    $distribusi = $inputan_anggota->where('id_jenis','=',$apd->id_jenis)->count();

                    // error_log('jumlah baik : '.$baik);
                    // error_log('jumlah rusak ringan : '.$rusak_ringan);
                    // error_log('jumlah rusak sedang : '.$rusak_sedang);
                    // error_log('jumlah rusak berat : '.$rusak_berat);
                    // error_log('jumlah belum terima : '.$belum_terima);
                    // error_log('jumlah hilang : '.$hilang);
                    // error_log('jumlah ada : '.$ada);
                    // error_log('jumlah total : '.$total);

                    $data_rekap_apd->push([
                        "id_jenis" => $apd->id_jenis,
                        "jenis_apd" => $nama_jenis_apd,
                        "baik" => $baik,
                        "rusak_ringan" => $rusak_ringan,
                        "rusak_sedang" => $rusak_sedang,
                        "rusak_berat" => $rusak_berat,
                        "belum_terima" => $belum_terima,
                        "hilang" => $hilang,
                        "ada" => $ada,
                        "total" => $total,
                        "distribusi" => $distribusi,
                    ]);
                }
            }

            return $data_rekap_apd;

        }
        catch(Throwable $e)
        {
            error_log("gagal membangun data tabel rekap tingkat sektor ".$e);
        }
    }

    /**
     * Untuk membangun data rekapan apd sudin, berupa jumlah berapa data dengan kondisi tertentu
     */
    public function bangunDataTabelRekapApdSudin($id_periode = 1, $sudin = "")
    {
        error_log('mulai membangun data untuk tabel rekap');
        if($sudin == "")
            $sudin = Auth::user()->data->penempatan->id_wilayah;

        if($id_periode == 1)
            $id_periode = PeriodeInputApd::get()->first()->id;
        
        try{
            
            // dapatkan semua sektor yang ada di sudin
            $list_sektor =  Penempatan::where('id_wilayah','=',$sudin)
                            ->where('keterangan','=','sektor')
                            ->pluck('id');

            $data_rekap = collect();
            // pengulangan untuk mengambil rangkuman data inputan tiap sektor
            foreach($list_sektor as $sektor)
            {
                // ambil rangkuman data sektor tersebut
                $data_sektor = $this->bangunDataTabelRekapApdSektor(1,$sektor); // parameter 1 hanya untuk test

                // jika data rekap masih kosong, jadikan data yang baru diambil menjadi data rekap saat ini
                if($data_rekap->isEmpty())
                    $data_rekap = $data_sektor;
                else
                    {
                        foreach($data_sektor as $data)
                        {
                            // jika jenis apd tsb sudah ada di data rekap, maka tambahkan jumlah datanya saja
                            if($data_rekap->contains("id_jenis",$data["id_jenis"]))
                            {
                                $data_yang_sudah_ada = $data_rekap->where("id_jenis",$data["id_jenis"])->first();

                                $data_baru = [
                                    "baik" => $data_yang_sudah_ada["baik"] + $data["baik"],
                                    "rusak_ringan" => $data_yang_sudah_ada["rusak_ringan"] + $data["rusak_ringan"],
                                    "rusak_sedang" => $data_yang_sudah_ada["rusak_sedang"] + $data["rusak_sedang"],
                                    "rusak_berat" => $data_yang_sudah_ada["rusak_berat"] + $data["rusak_berat"],
                                    "belum_terima" => $data_yang_sudah_ada["belum_terima"] + $data["belum_terima"],
                                    "hilang" => $data_yang_sudah_ada["hilang"] + $data["hilang"],
                                    "ada" => $data_yang_sudah_ada["ada"] + $data["ada"],
                                    "total" => $data_yang_sudah_ada["total"] + $data["total"],
                                    "distribusi" => $data_yang_sudah_ada["distribusi"] + $data["distribusi"],
                                ];

                                $data_rekap->where("id_jenis",$data["id_jenis"])->replace($data_baru);

                            }

                            // jika apd tsb belum ada di data rekap, maka tambahkan sebagai entry baru
                            else
                            {
                                $data_rekap->push[$data];
                            }

                        }
                    }

            }

            return $data_rekap;

        }
        catch(Throwable $e)
        {
            error_log("gagal membangun data tabel rekap tingkat sudin ".$e);
        }
    }

    public function bangunListDetailRekapApdSektor($id_jenis, $id_periode = 1, $sektor = "", $target_status = "")
    {

        error_log('data target status '.$target_status);

        if($sektor == "")
            $sektor = Auth::user()->data->sektor;
        
        if($id_periode == 1)
            $id_periode = PeriodeInputApd::get()->first()->id;

        try
        {
            $detail_rekap_apd = collect();

            if($semua_inputan = InputApd::where('id_jenis','=',$id_jenis)->where('id_periode','=',$id_periode)->get())
            {
                error_log('hit semua inputan');
                error_log('mulai filter');
                $inputan_anggota = $semua_inputan->filter(function($value,$key) use($sektor){
                    $a = Pegawai::where('_id','=',$value['id_pegawai'])->first();
                    $verdict = $a->sektor == $sektor;
                    error_log('is a->sektor == sektor : '.$verdict);
                    return $verdict;
                });
                error_log('selesai filter');

                $adc = new ApdDataController;
                $sdc = new StatusDisplayController;

                foreach($inputan_anggota as $inputan)
                {
                    error_log('hit foreach semua inputan anggota');
                    $pegawai = Pegawai::where('_id','=',$inputan->id_pegawai)->first();
                    $nama_jenis_apd = ApdJenis::where('_id','=',$inputan->id_jenis)->first()->nama_jenis;
                    $penempatan = Penempatan::where('_id','=',$pegawai->id_penempatan)->first();
                    $gambar = $adc->siapkanGambarInputanBesertaPathnya($inputan->image,$inputan->id_pegawai,$inputan->id_jenis,$inputan->id_periode);

                    if($target_status != "")
                    {
                        error_log('hit target status not null');

                        if($inputan->kondisi == $target_status)
                        {
                            $detail_rekap_apd->push([
                                'id_jenis' => $inputan->id_jenis,
                                'nama_jenis' => $nama_jenis_apd,
                                'nama_pegawai' => $pegawai->nama,
                                'penempatan' => $penempatan->nama_penempatan,
                                'gambar' => $gambar,
                                'kondisi_status' => StatusApd::tryFrom($inputan->kondisi)->label,
                                'kondisi_warna' => $sdc->ubahKondisiApdKeWarnaBootstrap($inputan->kondisi),
                                'verifikasi_status' => VerifikasiApd::tryFrom($inputan->verifikasi_status)->label,
                                'verifikasi_warna' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($inputan->verifikasi_status),
                                'komentar_pengupload' => $inputan->komentar_pengupload,
                                'komentar_verifikator' => $inputan->komentar_verifikator,
                            ]);
                        }
                    }
                    else
                    {
                        error_log('hit target status null');

                            $detail_rekap_apd->push([
                            'id_jenis' => $inputan->id_jenis,
                            'nama_jenis' => $nama_jenis_apd,
                            'nama_pegawai' => $pegawai->nama,
                            'penempatan' => $penempatan->nama_penempatan,
                            'gambar' => $gambar,
                            'kondisi_status' => StatusApd::tryFrom($inputan->kondisi)->label,
                            'kondisi_warna' => $sdc->ubahKondisiApdKeWarnaBootstrap($inputan->kondisi),
                            'verifikasi_status' => VerifikasiApd::tryFrom($inputan->verifikasi_status)->label,
                            'verifikasi_warna' => $sdc->ubahVerifikasiApdKeWarnaBootstrap($inputan->verifikasi_status),
                            'komentar_pengupload' => $inputan->komentar_pengupload,
                            'komentar_verifikator' => $inputan->komentar_verifikator,
                        ]);
                    }
                }
            }

            return $detail_rekap_apd;

        }
        catch(Throwable $e)
        {
            error_log("gagal membangun data detail rekap tingkat sektor ".$e);
        }
    }
}