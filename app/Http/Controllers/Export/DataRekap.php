<?php

namespace App\Http\Controllers\Export;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class DataRekap implements FromQuery
{
    use Exportable;

    public $kueri = null;

    public function __construct($kueri)
    {
        $this->kueri = $kueri;
    }

    public function query()
    {
        if (!is_null($this->kueri))
            return $this->kueri;
    }

    public function collection()
    {
        return $this->kueri;
    }

    public function headings(): array
    {
        return ["id_pegawai", "NRK", "NIP", "Nama", "Keterangan", "Penempatan"];
    }
}
