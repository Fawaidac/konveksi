<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function index_user()
    {
        return view('dashboard.user.home');
    }

    public function pesanan_user()
    {

        $idUser = Auth::user()->id;
        $pesanan = Pesanan::with(['user', 'color', 'produk'])
            ->where('user_id', $idUser)
            ->orderByDesc('id')
            ->get();

        return view('dashboard.user.pesanan', compact('pesanan'));
    }
}
