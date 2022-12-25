<?php

namespace App\Http\Controllers;

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

    public function ubahKondisiApdKeWarnaBootstrap(string $item, string $tipe = 'umum'): string
    {
        $warna = '';

        switch ($item) {
            case 'baik':
                $warna = 'success';
                break;
            case 'rusak ringan':
                $warna = 'warning';
                break;
            case 'rusak sedang':
                $warna = 'warning';
                break;
            case 'rusak berat':
                $warna = 'danger';
                break;
            default:
                $warna = 'secondary';
                break;
        }

        return $warna;
    }
}
