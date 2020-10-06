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

<section id="do_action">
	 <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
			                <th>Order ID</th>
			                <th>Ordered Products</th>
			                <th>Payment Method</th>
			                <th>Grand Total</th>
			                <th>Created On</th>
			            </tr>
			        </thead>
			        <tbody>
			            @foreach($orders as $order)
			            <tr>
			            <td>{{$order->id}}</td>
			                <td>
			                @foreach($order->orders as $pro)
			                <a href="{{url('/orders/'.$order->id)}}">
			                    {{$pro->product_code}}
			                    ({{$pro->product_qty}})
			                </a><br>
			                    @endforeach
			                  
			                </td>
			                <td>{{$order->payment_method}}</td>
			                <td>{{$order->grand_total}}</td>
			                <td>{{$order->created_at}}</td>
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