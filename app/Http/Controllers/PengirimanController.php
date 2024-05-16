<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::OrderByDesc('id')->get();
        $pesanan = Pesanan::with(['color', 'user', 'produk'])
            ->where('status_pembayaran', 'lunas')
            ->where('status', 'selesai')
            ->get();
        return view('dashboard.pengiriman', compact('pengiriman', 'pesanan'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'pesanan_id' => 'required',
            'status' => 'required',
            'tanggal_pengiriman' => 'required',
            'estimasi' => 'required',
            'tanggal_tiba' => 'required',
        ]);

        Pengiriman::create($validateData);

        return redirect()->route('pengiriman')->with('message', 'Data berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $validateData = $request->validate([
            'status' => 'required',
            'tanggal_pengiriman' => 'required|date',
            'estimasi' => 'required',
            'tanggal_tiba' => 'required|date',
        ]);

        $pengiriman->update($validateData);

        return redirect()->route('pengiriman')->with('message', 'Data berhasil diupdate');
    }
}
