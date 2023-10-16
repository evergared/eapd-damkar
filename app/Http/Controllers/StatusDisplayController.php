<?php

namespace App\Http\Controllers;

use App\Enum\KeberadaanApd as keberadaan;
use App\Enum\StatusApd as status;

/**
 * Untuk men-konvert data status untuk ditampilkan melalui bootstrap
 */
class StatusDisplayController extends Controller
{

    public function ubahVerifikasiApdKeWarnaBootstrap(int $item): string
    {
        $warna = '';

        switch ($item) {
            case 1:
                $warna = 'secondary';
                break;
            case 2:
                $warna = 'success';
                break;
            case 3:
                $warna = 'info';
                break;
            case 4:
                $warna = 'danger';
                break;
            case 5:
                $warna = 'warning';
                break;
            default:
                $warna = 'secondary';
                break;
        }

        return $warna;
    }

    public function ubahKondisiApdKeWarnaBootstrap($item): string
    {
        $warna = '';

        if($item)
            $status = status::tryFrom($item);
        else
            $status = "";

        switch ($status) {
            case status::baik():
                $warna = 'success';
                break;
            case status::rusakRingan():
                $warna = 'warning';
                break;
            case status::rusakSedang():
                $warna = 'warning';
                break;
            case status::rusakBerat():
                $warna = 'warning';
                break;
            case status::hilang():
                $warna = 'danger';
                break;
            case status::belumTerima():
                $warna = 'danger';
                break;
            default:
                $warna = 'secondary';
                break;
        }

        return $warna;
    }

    public function ubahKeberadaanApdKeWarnaBootstrap($item):string
    {
        $warna = "";

        $status = status::tryFrom($item);

        switch($status){
            case status::baik() :
                $warna = "info";
                break;
            case status::rusakRingan() :
                $warna = "info";
                break;
            case status::rusakSedang() :
                $warna = "info";
                break;
            case status::rusakBerat():
                $warna = "info";
                break;
            case status::belumTerima() :
                $warna = "orange";
                break;
            case status::hilang() :
                $warna = "danger";
                break;
            default :
                $warna = "secondary";
                break;
        }

        return $warna;
    }
}
