<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::OrderByDesc('id')->get();
        return view('dashboard.pengiriman', compact('pengiriman'));
    }
}
