<?php

namespace App\Http\Controllers;

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
                $warna = 'orange';
                break;
            case status::rusakBerat():
                $warna = 'danger';
                break;
            case status::hilang():
                $warna = 'dark';
                break;
            case status::belumTerima():
                $warna = 'dark';
                break;
            default:
                $warna = 'secondary';
                break;
        }

        return $warna;
    }
}
