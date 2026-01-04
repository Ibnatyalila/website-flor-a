@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Bucket</h1>
            <a href="{{ route('admin.produk.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i>Tambah</a>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">GAMBAR</th>
                                    <th scope="col">NAMA BUCKET</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">STOK</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col" width="20%">AKSI</th>
                                </tr>
                            </thead>
                            @if (count($produks) < 1)
                                <tbody>
                                    <tr>
                                        <td colspan="8">
                                            <p class="pt-3 text-center">Tidak ada data</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    @foreach ($produks as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="rounded" width="150px">
                                        </td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                        <td>{{ $item->deskripsi ?? '-' }}</td>
                                        <td class="text-center">{{ $item->stok }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <a href="{{ route('admin.produk.edit', $item->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-eraser"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $produks->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

<style>
    .pagination {
        margin: 0;
    }
    .pagination .page-link {
        color: #4e73df;
        border: 1px solid #dddfeb;
        padding: 0.5rem 0.75rem;
        margin: 0 0.15rem;
        border-radius: 0.35rem;
        transition: all 0.3s ease;
    }
    .pagination .page-link:hover {
        background-color: #4e73df;
        color: white;
        border-color: #4e73df;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .pagination .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(78, 115, 223, 0.4);
    }
    .pagination .page-item.disabled .page-link {
        color: #858796;
        background-color: #f8f9fc;
        border-color: #dddfeb;
    }
</style>
@endsection