<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showPegawaiDashboard(Request $r)
    {
        return view("dashboard.pegawai");
    }
}
