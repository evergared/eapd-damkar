<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\ApdDataController;
use App\Http\Controllers\ApdItemController;
use App\Http\Controllers\FileController;
use App\Invoice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class XlsxTabelDetailRekap implements FromArray, WithColumnFormatting,WithHeadings,ShouldAutoSize,WithStyles,WithDrawings
{
    use Exportable;

    private $kueri;
    private $start = 5;
    private $list_gambar = [];
    private $title = "";

    public function __construct($kueri, $title)
    {
        $this->kueri = $kueri->get(['pegawai.id_pegawai', 'pegawai.nrk', 'pegawai.nip', 'pegawai.nama', 'input_apd.keterangan_jenis_apd_template','input_apd.no_seri','input_apd.image', 'input_apd.kondisi', 'penempatan.nama_penempatan', 'jabatan.nama_jabatan', 'pegawai.id_jabatan']);
        $this->title = $title;
    }

    public function array(): array
    {
        $col = [];
        $fc = new FileController;
        foreach($this->kueri as $i => $q)
        {
            $no = $i+1;
            $nrk = $q->nrk;
            $nama = $q->nama;
            $jenis = $q->keterangan_jenis_apd_template;
            $path = public_path('storage/'.$fc::$apdUploadBasePath .'/' . $q->image);

            if(File::exists($path))
            {
                $gambar = new Drawing();
                $gambar->setName($jenis.' '.$nama);
                $gambar->setDescription('Gambar APD '.$jenis);
                $gambar->setPath($path);
                $gambar->setHeight(90);
                $gambar->setCoordinates('G'.$this->start + $no);

                $this->list_gambar[] = $gambar;
                $gambar = "               ";
            }
            else
            {
                $gambar = "Kesalahan Server : Gagal Mengambil Gambar";
                error_log("Gambar : ".$path);
            }

            
            $keterangan = $q->kondisi;
            $penempatan = $q->nama_penempatan;
            $jabatan = $q->nama_jabatan;
            $no_seri = $q->no_seri;

            $col[] = [$no,$nrk,$nama,$jabatan,$jenis,$no_seri,$gambar,$keterangan,$penempatan];
        }
        return $col;
    }

    public function drawings()
    {
        return $this->list_gambar;
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
        $time = now();
        return [
            ["E-APD Dinas Penanggulangan Kebakaran dan Penyelamatan"],
            [$this->title],
            [],
            ["Dibuat : ".$time],
            ["No","NRK/NPJLP", "Nama","Jabatan", "Jenis APD","No Seri","Gambar", "Keterangan", "Penempatan"]
    ];
    }

    public function styles(Worksheet $sheet)
    {
        // gabungkan 2 baris pertama untuk title
        $sheet->mergeCells("A1:I1");
        $sheet->mergeCells("A2:I2");

        // center 2 baris pertama
        $sheet->getStyle('A1:I1')->getAlignment()
        ->setVertical(Alignment::VERTICAL_CENTER)
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A2:I2')->getAlignment()
        ->setVertical(Alignment::VERTICAL_CENTER)
        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // gabungkan baris ke4 untuk timestamp
        $sheet->mergeCells("A4:D4");


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

        // pengaturan font untuk timestamp
        $timestamp = [
            'font'=>['name'=>'arial','italic' => true, 'size' => 9],
            'alignment'=>['vertical'=>'center']
        ];

        // pengaturan untuk isi tabel
        $content = [
            'alignment'=>['vertical'=>'center'],
            
        ];

        // terapkan
        $sheet->getStyle('A1:I1')->applyFromArray($title,false);
        $sheet->getStyle('A2:I2')->applyFromArray($title,false);
        $sheet->getStyle(4)->applyFromArray($timestamp,false);
        $sheet->getStyle('A'.$this->start.':I'.$this->start)->applyFromArray($heading,false);
        $sheet->getStyle('A'.$this->start.':I'.($this->start+count($this->kueri)))->applyFromArray($border,false);
        $sheet->getStyle('A'.($this->start+1).':I'.($this->start+count($this->kueri)+1))->applyFromArray($content,false);

        // untuk penyesuaian height row terhadap height gambar
        $row_index = $this->start+1;
        foreach($this->kueri as $i => $k)
        {
            $sheet->getRowDimension($row_index + $i)->setRowHeight(90);
        }
    }

}
