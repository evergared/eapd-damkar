<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdItemController;
use App\Http\Controllers\FileController;
use App\Invoice;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class DataRekap implements FromArray
{
    use Exportable;

    public $kueri = null;

    public function __construct($kueri)
    {
        $col = [];
        $fc = new FileController;
        foreach($kueri as $q)
        {
            $nrk = $q->nrk;
            $nip = $q->nip;
            $nama = $q->nama;
            $jenis = $q->keterangan_jenis_apd_template;
            $gambar = public_path($fc::$apdUploadBasePath . '/'. $q->image);
            $keterangan = $q->kondisi;
            $penempatan = $q->penempatan;

            $col[] = [$nrk,$nip,$nama,$jenis,$gambar,$keterangan,$penempatan];
        }

        $this->kueri = $col;
    }

    public function array(): array
    {
        $col = [];
        $fc = new FileController;
        foreach($this->kueri as $q)
        {
            $nrk = $q->nrk;
            $nip = $q->nip;
            $nama = $q->nama;
            $jenis = $q->keterangan_jenis_apd_template;
            $gambar = public_path($fc::$apdUploadBasePath . '/'. $q->image);
            $keterangan = $q->kondisi;
            $penempatan = $q->penempatan;

            $col[] = [$nrk,$nip,$nama,$jenis,$gambar,$keterangan,$penempatan];
        }
        return $col;
    }

    public function headings(): array
    {
        return ["NRK", "NIP", "Nama", "Jenis APD","Gambar", "Keterangan", "Penempatan"];
    }
}
