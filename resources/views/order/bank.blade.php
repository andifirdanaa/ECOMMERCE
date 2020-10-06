@extends('layouts.front')
<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Market Place</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="theway/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="theway/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="theway/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="theway/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="theway/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="theway/css/custom.css">

@section('content')
 @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
     @include('layouts.headers.auth-head')
    @endauth
@guest
    @include('layouts.headers.head')
 @endguest
  <div class="cart-box-main">
        <div class="container">
            <div class="row">
				
              <div class="">
                            <h1>Thank You</h1>
                        </div>
                        

                <div class="card-body">
			                    Thanks For you order. Nomer order anda adalah {{Session::get('order_id')}} Silakan transfer sesuai dengan nominal yang tertera pada order detail ada Rp. {{Session::get('grand_total')}} ke BCA : 08976559 a/n JEMS.
			                    Jika sudah transfer silakan klik link ini untuk konfirmasi pembayaran.
                </div>
		</div>	
	</div>
</div>

@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');

?>