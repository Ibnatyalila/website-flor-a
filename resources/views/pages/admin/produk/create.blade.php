@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Bucket</h1>
        </div>

        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Produk -->
            <div class="form-group mb-3">
                <label for="">Nama Bucket</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" id="" placeholder="Masukkan nama bucket">
            </div>
            <!-- Kategori -->
            <div class="form-group mb-3">
                <label for="">Nama Bucket</label>
                <select name="kategori_id" id="" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ ucfirst($k->nama_kategori) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Deskripsi -->
            <div class="form-group mb-3">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" id="" class="form-control" rows="3" placeholder="Masukkan deskripsi">{{ old('deskripsi') }}</textarea>
            </div>
            <!-- Stok -->
            <div class="form-group mb-3">
                <label for="">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" min="0">
            </div>
            <!-- Harga -->
            <div class="form-group mb-3">
                <label for="">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" min="0">
            </div>
            <!-- Gambar -->
            <div class="form-group mb-3">
                <label for="">Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
@endsection