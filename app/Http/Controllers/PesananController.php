<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Http\Requests\StorePesananRequest;
use App\Http\Requests\UpdatePesananRequest;
use App\Models\BahanBaku;
use App\Models\DetailPesanan;
use App\Models\TransaksiKeluar;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

            // Cek apakah sudah ada record di transaksi keluar dengan pesanan_id dan bahan_baku_id
            $transaksiKeluar = TransaksiKeluar::where('pesanan_id', $pesanan->id)
                ->where('bahan_baku_id', $bahanBakuId)
                ->first();

            if ($transaksiKeluar) {
                // Jika ada, update qty
                $transaksiKeluar->update([
                    'qty' => $qty,
                ]);
            } else {
                // Jika tidak ada, buat record baru
                TransaksiKeluar::create([
                    'pesanan_id' => $pesanan->id,
                    'bahan_baku_id' => $bahanBakuId,
                    'qty' => $qty,
                ]);
            }

            // Perbarui qty bahan baku
            $bahanBaku->update([
                'qty' => $bahanBaku->qty - $qty,
            ]);

            // Cek apakah sudah ada record dengan pesanan_id dan bahan_baku_id di detail pesanan
            $detailPesanan = DetailPesanan::where('pesanan_id', $pesanan->id)
                ->where('bahan_baku_id', $bahanBakuId)
                ->first();

            if ($detailPesanan) {
                // Jika ada, update qty (jika diperlukan) atau tindakan lain yang diperlukan
                $detailPesanan->update([
                    'qty' => $qty, // Misalkan kita ingin mengupdate qty, sesuaikan dengan logika yang diinginkan
                ]);
            } else {
                // Jika tidak ada, buat record baru
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'bahan_baku_id' => $bahanBakuId,
                    // 'qty' => $qty, // Pastikan menambahkan field qty jika diperlukan
                ]);
            }
        }

        return redirect()->route('pesanan')->with('message', 'Data berhasil diupdate');
    }



    public function cetakNota($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Generate PDF nota
        $pdf = FacadePdf::loadView('dashboard.nota-pdf', compact('pesanan'));
        $pdf->setPaper(array(0, 0, 250, 500), 'portrait');

        // Save PDF nota to public directory
        $pdfPath = public_path('nota/nota_' . $pesanan->id . '.pdf');
        $pdf->save($pdfPath);

        // Generate QR Code
        $url = route('pesanan-nota', $id);
        $qrCodePath = public_path('nota/qrcodes/' . $pesanan->id . '.png');
        // $renderer = new ImageRenderer(
        //     new RendererStyle(400),
        //     new ImagickImageBackEnd()
        // );
        // $writer = new Writer($renderer);
        // $writer->writeFile($url, $qrCodePath);
        QrCode::format('png')->size(400)->generate($url, $qrCodePath);
        // Update pesanan with QR Code path
        $pesanan->update([
            'nota' => 'nota_' . $pesanan->id . '.pdf',
            'qr_code' => 'qrcodes/' . $pesanan->id . '.png',
        ]);

        return redirect()->route('pesanan')->with('message', 'Nota telah berhasil dibuat');
    }
}
