@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Keranjang Belanja</h3>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>BUCKET</th>
                    <th>HARGA</th>
                    <th>JUMLAH</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @if (session('keranjang'))
                    @foreach (session('keranjang') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>Rp {{ number_format($details['price'], 0, ',', '.')}}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4" class="text-center">Keranjang masih kosong.</td></tr>
                @endif
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
            <a href="{{ route('user.checkout') }}" class="btn btn-success">Lanjut ke pembayaran</a>
        </div>
    </div>
@endsection