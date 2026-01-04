<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);
        if(empty($keranjang)) {
            return redirect()->route('user.dashboard')->with('error', 'Keranjang kamu masih kosong!');
        }

        return view('pages.user.pembayaran', compact('keranjang'));
    }

    public function proses(Request $request)
    {
        //Validasi input metode pembayaran
        $request->validate([
            'metode_bayar' => 'required'
        ]);

        $keranjang = session()->get('keranjang');

        //Hitung total harga
        $total = 0;
        foreach($keranjang as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        //Simpan data ke tabel order
        Order::create([
            'user_id' => Auth::id(),
            'metode_bayar' => $request->metode_bayar,
            'total_harga' => $total,
        ]);

        //Setelah berhasil dipesan, hapus keranjang
        session()->forget('keranjang');

        return redirect()->route('user.dashboard')->with('success', 'Pesanan berhasil!');
    }

    public function indexAdmin()
    {
        $orders = \App\Models\Order::with('user')->latest()->get();
        
        return view('pages.admin.pesanan.index', compact('orders'));
    }
}
