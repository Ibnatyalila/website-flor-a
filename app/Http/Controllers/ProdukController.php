<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->paginate(5);
        return view('pages.admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.admin.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => ['required', 'max:100'],
            'kategori_id' => ['required'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'max:700'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $path = null;

        if ($request->hasFile('gambar')) {
           $path = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.admin.produk.edit', compact('produk', 'kategori'));
    }
    
    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'nama_produk' => ['required', 'max:100'],
            'kategori_id' => ['required'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'max:700'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        //get product by ID
        $produk = Produk::findOrFail($id);

        //Data yang akan di-update
        $dataUpdate = [
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ];

        //check if image is uploaded
        if ($request->hasFile('gambar')) {
            //Hapus gambar lama
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            //Upload gambar baru
            $path = $request->file('gambar')->store('produk', 'public');
            $dataUpdate['gambar'] = $path;
        }

        //Update produk
        $produk->update($dataUpdate);

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        Storage::delete('public/produk/'. $produk->gambar);
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }

    public function indexUser()
    {
        $produks = \App\Models\Produk::all();
        return view('pages.user.dashboard', compact('produks'));
    }

}
