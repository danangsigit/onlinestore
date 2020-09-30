@extends('layouts.ecommerce')

@section('title')
    <title>Keranjang Belanja - Dw Ecommerce</title>
@endsection

@section('content')
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Keranjang Belanja</h2>
					<div class="page_link">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('ecommerce.list_cart') }}">Cart</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="cart_area">
		<div class="container">
			<div class="cart_inner">                  
				<div class="table-responsive">
        @if(count($carts)==0)
          <div class="col-md-12">
            <h3 class="text-center">Tidak ada belanjaan</h3>
          </div>
        @else
        @include('ecommerce.module.cart')
        @endif
				</div>
			</div>
		</div>
	</section>
@endsection