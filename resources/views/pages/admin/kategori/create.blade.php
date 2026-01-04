@extends('layouts.app')

@section('content')
    <h3>Buat Kategori</h3>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="" placeholder="Masukkan nama kategori">
        </div>
        <button type="submit" class="tombol">Submit</button>
    </form>
@endsection