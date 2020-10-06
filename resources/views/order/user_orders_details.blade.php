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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="theway/css/custom.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
     @include('layouts.headers.auth-head')
@endauth
@guest()
@include('layouts.headers.head')
@endguest
<section id="do_action">
     <div class="all-tittle-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Order Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                         <li class="breadcrumb-item"><a href="/orders">Order</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-box-main">
        <div class="container">
            <div class="heading" align="center">

                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                             <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Price</th>
                                <th>Product Qty</th>
                                
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails->orders as $pro)
                        <tr>
                        <td>{{$pro->product_code}}</td>
                        <td>{{$pro->product_name}}</td>
                        <td>{{$pro->product_size}}</td>
                        <td>{{$pro->product_color}}</td>
                        <td>{{$pro->product_price}}</td>
                        <td>{{$pro->product_qty}}</td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</section>
@endsection
  <!-- ALL JS FILES -->
    <script src="theway/js/jquery-3.2.1.min.js"></script>
    <script src="theway/js/popper.min.js"></script>
    <script src="theway/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="theway/js/jquery.superslides.min.js"></script>
    <script src="theway/js/bootstrap-select.js"></script>
    <script src="theway/js/inewsticker.js"></script>
    <script src="theway/js/bootsnav.js."></script>
    <script src="theway/js/images-loded.min.js"></script>
    <script src="theway/js/isotope.min.js"></script>
    <script src="theway/js/owl.carousel.min.js"></script>
    <script src="theway/js/baguetteBox.min.js"></script>
    <script src="theway/js/form-validator.min.js"></script>
    <script src="theway/js/contact-form-script.js"></script>
    <script src="theway/js/custom.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>