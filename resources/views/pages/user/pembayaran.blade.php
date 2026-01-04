@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card show">
            <div class="card-header bg-primary text-white">
                <h5>Pilih metode pembayaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.checkout.proses') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Metode Pembayaran</label>
                        <select name="metode_bayar" id="" class="form-control">
                            <option value="Cash">Cash (bayar di toko)</option>
                            <option value="ShopeePay">ShopeePay (081256480099)</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn block mt-3">Selesaikan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
@endsection