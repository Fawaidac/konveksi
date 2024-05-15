<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Http\Requests\StorePesananRequest;
use App\Http\Requests\UpdatePesananRequest;
use App\Models\BahanBaku;
use App\Models\DetailPesanan;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;


class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::with(['user', 'color', 'produk'])->orderByDesc('id')->get();
        $bahan = BahanBaku::all();
        return view('dashboard.pemesanan', compact('pesanan', 'bahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable',
            'status_pembayaran' => 'nullable',
            'bahan_baku_id.*' => 'nullable|exists:bahan_baku,id',
            'qty.*' => 'nullable|numeric|min:1'
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'status' => $request->status,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        $bahanBakuIds = $request->input('bahan_baku_id', []);
        $qtys = $request->input('qty', []);

        foreach ($bahanBakuIds as $index => $bahanBakuId) {
            $qty = $qtys[$index];
            $bahanBaku = BahanBaku::findOrFail($bahanBakuId);

            // Cek jika qty tidak cukup
            if ($bahanBaku->qty < $qty) {
                return redirect()->route('pesanan')->with('error', 'Jumlah bahan baku tidak mencukupi untuk bahan baku ID: ' . $bahanBakuId);
            }

            // Lakukan transaksi dan pembaruan qty
            TransaksiKeluar::create([
                'bahan_baku_id' => $bahanBakuId,
                'qty' => $qty,
            ]);

            $bahanBaku->update([
                'qty' => $bahanBaku->qty - $qty,
            ]);

            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'bahan_baku_id' => $bahanBakuId,
            ]);
        }

        return redirect()->route('pesanan')->with('message', 'Data berhasil di update');
    }
}
