<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
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

    public function pengiriman_user()
    {
        $idUser = Auth::user()->id;
        $pengiriman = Pengiriman::with('pesanan')
            ->whereHas('pesanan', function ($query) use ($idUser) {
                $query->where('user_id', $idUser);
            })
            ->get();
        return view('dashboard.user.pengiriman', compact('pengiriman'));
    }

    public function update_pengiriman_user($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $pengiriman->update([
            'status' => 'sampai'
        ]);

        return redirect()->back()->with('message', 'Paket telah diterima');
    }
}
