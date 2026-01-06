<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('pages.user.keranjang', compact('keranjang'));
    }

    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$id])) {
            $keranjang[$id]['quantity']++;
        } else {
            $keranjang[$id] = [
                "name" => $produk->nama_produk,
                "quantity" => 1,
                "price" => $produk->harga,
                "image" => $produk->gambar
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Bucket ' . $produk->nama_produk . ' berhasil masuk keranjang!');
    }

    public function checkout() {
        $keranjang = session()->get('keranjang', []);
        if(empty($keranjang)) return redirect()->route('user.dashboard');
    }
}
