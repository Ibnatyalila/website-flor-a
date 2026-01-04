<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('pages.admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('pages.admin.kategori.create');
    }

    public function store(Request $request)
    {
        //Validasi
        $validatedData = $request->validate([
            'nama_kategori' => ['required', 'max:255'],
        ]);

        //Simpan data
        Kategori::create($validatedData);

        return redirect()->route('admin.kategori.index');
    }

    public function show(Kategori $kategori)
    {
        return view('pages.admin.kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('pages.admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        //Validasi
        $validatedData = $request->validate([
            'nama_kategori' => ['required', 'max:255'],
        ]);

        //Update data
        $kategori->update($validatedData);

        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil dihapus!');
    }
    
}
