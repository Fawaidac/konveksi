<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::OrderByDesc('id')->with('kategori')->get();
        $kategori = Kategori::get();
        $color = Color::get();
        return view('dashboard.produk', compact('produk', 'kategori', 'color'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'color' => 'required|array',
            'color.*' => 'exists:color,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.required' => 'Anda harus mengunggah gambar.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus dalam format JPEG, PNG, JPG, atau GIF.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);


        $fileNameImage = time() . '.' . $request->image->extension();
        $request->image->move(public_path('foto/product/'), $fileNameImage);

        $produk = Produk::create([
            'kategori_id' => $validatedData['kategori_id'],
            'nama' => $validatedData['nama'],
            'image' => $fileNameImage,
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
        ]);

        foreach ($validatedData['color'] as $colorId) {
            $produk->detail()->create([
                'color_id' => $colorId
            ]);
        }

        return redirect()->route('produk')->with('message', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'color' => 'required|array',
            'color.*' => 'exists:color,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus dalam format JPEG, PNG, JPG, atau GIF.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('image')) {
            $deleteimage = $produk->image;
            if ($deleteimage) {
                File::delete(public_path('foto/product') . '/' . $deleteimage);
            }

            $fileNameImage = time() . '.' . $request->image->extension();
            $request->image->move(public_path('foto/product/'), $fileNameImage);
            $validatedData['image'] = $fileNameImage;
        }

        $produk->update($validatedData);

        $produk->detail()->delete();

        foreach ($validatedData['color'] as $colorId) {
            $produk->detail()->create([
                'color_id' => $colorId
            ]);
        }

        return redirect()->route('produk')->with('message', 'Produk berhasil diupdate.');
    }


    public function delete($id)
    {
        $produk = Produk::findOrFail($id);
        $deleteimage = Produk::where('id', $id)->first();
        File::delete(public_path('foto/product') . '/' . $deleteimage->image);
        $produk->delete();
        return redirect()->route('produk')->with('message', 'Data berhasil dihapus.');
    }

    public function getProductById($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);

        return view('landing.item-produk', compact('produk'));
    }
}
