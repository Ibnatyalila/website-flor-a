@extends('layouts.app')

@section('content')
<style>
    .cream_box {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }
    .cream_box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .cream_img img {
        width: 100%;
        height: 250px;
        object-fit: cover; /* Biar foto nggak penyet */
        border-radius: 10px;
    }
    .price_text {
        color: #ff5722;
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 15px;
    }
    .strawberry_text {
        font-size: 1.1rem;
        color: #333;
        margin: 10px 0;
        height: 50px; /* Biar sejajar meski nama panjang */
    }
    .cart_bt button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        width: 100%;
        font-weight: bold;
        transition: 0.3s;
    }
    .cart_bt button:hover {
        background-color: #0056b3;
    }
</style>

<!-- Page Heading -->
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div> -->

        <div class="cream_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="cream_taital">Our Featured Buckets</h1>
                  <p class="cream_text">Beautifully curated flower & snack buckets, made to celebrate moments with sweetness and style.</p>
               </div>
            </div>

            @if (session('success'))
               <div class="alert-alert-success alert-dismissible fade show" role="alert">
                  <strong>Added!</strong> Produk berhsil dimasukkan ke keranjang!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            @endif

            <div class="cream_section_2">
               <div class="row">
                  @foreach($produks as $p)
                  <div class="col-md-4 mb-4">
                     <div class="cream_box shadow-sm">
                        <div class="cream_img">
                           @if($p->gambar)
                              <img src="{{ asset('storage/' . $p->gambar) }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;">
                           @else
                              <img src="{{ asset('images/default-bucket.png') }}">
                           @endif
                        </div>
                        <div class="price_text">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        <h6 class="strawberry_text">{{ $p->nama_produk }}</h6>
                        
                        <div class="cart_bt" style="background-color: #007bff; border-radius: 5px; margin-top: 10px;">
                           <form action="{{ route('user.keranjang.add', $p->id) }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-primary btn-block rounded-pill font-weight-bold">
                                    <i class="fas fa-cart-plus mr-2"></i>Tambah ke keranjang
                              </button>
                           </form>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
            <!-- <div class="seemore_bt"><a href="#">See More</a></div> -->
         </div>
      </div>
@endsection