<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    function laporan() {
        return view('dashboard.laporan.pengiriman', [
            'title' => 'Laporan Pengiriman',
            'pengirimans' => Pengiriman::with(['purchase_order', 'transportir'])->get()
        ]);
    }
}
