@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-fle align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-tags text-primary mr-2"></i>Tambah Kategori
            </h1>
            <a href="route{{ 'admin.kategori.index' }}" class="btn btn-sm btn secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i>Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-primary">Form Kategori</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="" class="font-weight-bold text-dark">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control border-left-primary @error('nama_kategori') is-invalid
                                @enderror" value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori">

                                @error('nama_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary mr-2 px-4 shadow-sm">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>

                                <button class="btn btn-primary px-5 shadow-sm">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection