<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\DetailProduk;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index($id, Request $request)
    {
        $bank = Bank::all();
        $produk = Produk::with('kategori')->findOrFail($id);
        $warna = DetailProduk::where('produk_id', $id)->with('color')->get();
        $ukuran = DetailProduk::where('produk_id', $id)->with('ukuran')->get();
        // $qty = $request->query('qty');
        return view('landing.checkout', compact('produk', 'bank', 'warna', 'ukuran'));
    }

    public function store_pesanan(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'color_id' => 'required',
            'produk_id' => 'required',
            'qty' => 'required',
            'pengiriman' => 'required',
            'grand_total' => 'required',
            'bukti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail_pesanan' => 'required',
            'detail_alamat' => 'required',
        ], [
            'bukti.required' => 'Anda harus mengunggah gambar.',
            'bukti.image' => 'File harus berupa gambar.',
            'bukti.mimes' => 'Gambar harus dalam format JPEG, PNG, JPG, atau GIF.',
            'bukti.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        $fileNameImage = time() . '.' . $request->bukti->extension();
        $request->bukti->move(public_path('foto/bukti/'), $fileNameImage);

        $pesanan = Pesanan::create([
            'user_id' => $request->user_id,
            'color_id' => $request->color_id,
            'produk_id' => $request->produk_id,
            'qty' => $request->qty,
            'grand_total' => $request->grand_total,
            'status' => "menunggu konfirmasi",
            'bukti' => $fileNameImage,
            'pengiriman' => $request->pengiriman,
            'status_pembayaran' => "belum_bayar",
            'detail_pesanan' => $request->detail_pesanan,
            'detail_alamat' => $request->detail_alamat,
        ]);

        return redirect()->route('dashboard-user')->with('message', 'Berhasil melakukan pemesanan.');
    }
}
