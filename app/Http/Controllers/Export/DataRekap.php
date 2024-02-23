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
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataRekap implements FromArray, WithColumnFormatting,WithHeadings,ShouldAutoSize,WithStyles
{
    use Exportable;

    public $kueri;

    public function __construct($kueri)
    {
        

        $this->kueri = $kueri->get(['pegawai.id_pegawai', 'pegawai.nrk', 'pegawai.nip', 'pegawai.nama', 'input_apd.keterangan_jenis_apd_template','input_apd.no_seri','input_apd.image', 'input_apd.kondisi', 'penempatan.nama_penempatan', 'jabatan.nama_jabatan', 'pegawai.id_jabatan']);
        
    }

    public function array(): array
    {
        $col = [];
        $fc = new FileController;
        // $this->headings();
        error_log('start pengulangan array');
        foreach($this->kueri as $i => $q)
        {
            $no = $i+1;
            $nrk = $q->nrk;
            $nip = $q->nip;
            $nama = $q->nama;
            $jenis = $q->keterangan_jenis_apd_template;
            $gambar = new Drawing();
            $gambar->setName($jenis.' '.$nama);
            $gambar->setDescription('Gambar APD '.$jenis);
            // $gambar->setPath(public_path($fc::$apdUploadBasePath . '/'. $q->image));
            $gambar = public_path($fc::$apdUploadBasePath . '/'. $q->image);
            $keterangan = $q->kondisi;
            $penempatan = $q->nama_penempatan;
            $jabatan = $q->nama_jabatan;
            $no_seri = $q->no_seri;

            $col[] = [$no,$nrk,$nip,$nama,$jabatan,$jenis,$no_seri,$gambar,$keterangan,$penempatan];
        }
        return $col;
    }

    public function columnFormats(): array
    {
        return [
            "B" => NumberFormat::FORMAT_NUMBER,
            "C" => NumberFormat::FORMAT_NUMBER,

        ];
    }

    public function headings(): array
    {
        return [
            ["Suku Dinas Penanggulangan Kebakaran dan Penyelamatan"],
            ["Laporan Data APD Dengan Status Baik"],
            [],
            ["No","NRK", "NIP", "Nama","Jabatan", "Jenis APD","No Seri","Gambar", "Keterangan", "Penempatan"]
    ];
    }

    public function styles(Worksheet $sheet)
    {
        // gabungkan 2 baris pertama untuk title
        $sheet->mergeCells("A1:J1");
        $sheet->mergeCells("A2:J2");

        // center 2 baris pertama
        $sheet->getStyle('A1:J1')->getAlignment()
        ->setVertical(Alignment::VERTICAL_CENTER)
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A2:J2')->getAlignment()
        ->setVertical(Alignment::VERTICAL_CENTER)
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // untuk border
        $border = [
            'borders' => [
                'bottom' => ['borderStyle' => 'thin'],
                'top' => ['borderStyle' => 'thin'],
                'right' => ['borderStyle' => 'thin'],
                'left' => ['borderStyle' => 'thin'],
            ],
        ];

        // pengaturan font untuk title
        $title = [
            'font'=>['name'=>'arial','bold' => true,'size'=>16]
        ];

        // pengaturan font untuk heading
        $heading = [
            'font'=>['name'=>'arial','bold' => true],
            'alignment'=>['horizontal'=>'center','vertical'=>'center']
        ];

        // terapkan
        $sheet->getStyle('A1:J1')->applyFromArray($title,false);
        $sheet->getStyle('A2:J2')->applyFromArray($title,false);
        $sheet->getStyle('A4:J4')->applyFromArray($heading,false);
        $sheet->getStyle('A4:J'.(4+count($this->kueri)))->applyFromArray($border,false);
        
    }

}
