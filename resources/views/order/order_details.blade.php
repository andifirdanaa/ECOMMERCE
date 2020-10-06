@extends('layouts.app', ['title' => __('Product')])
<link rel="icon" type="image/ico" href="{{asset('hyper/images/backend_img/admin.png')}}" />

<link rel="stylesheet" href="{{asset('hyper/css/backend_css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/matrix-style.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/matrix-media.css')}}" />
<link href="{{asset('hyper/fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('hyper/css/backend_css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
     <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
            
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Oder #{{$orderDetails->id}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{url('view-orders')}}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                <div class="container-fluid">
<hr>
<div class="row-fluid">
        <div class="span6">
                <div class="widget-box">
                <div class="widget-title">
                    <h5>Order Details</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-striped table-bordered">
                    
            <tbody>
                <tr>
                <td class="taskDesc"> Order Date</td>
                <td class="taskStatus">{{$orderDetails->created_at}}</td>
                </tr>
                <tr>
                <td class="taskDesc"> Order Status</td>
                <td class="taskStatus">{{$orderDetails->order_status}}</td>
                </tr>
                <tr>
                <td class="taskDesc"> Order Total</td>
                <td class="taskStatus">Rp. {{$orderDetails->grand_total}}</td>
                </tr>
                <td class="taskDesc"> Shipping Charges</td>
                <td class="taskStatus">Rp. {{$orderDetails->shipping_charges}}</td>
                </tr>
                <tr>
                <td class="taskDesc"> Coupon Code</td>
                <td class="taskStatus">{{$orderDetails->coupon_code}}</td>
                </tr>
                <td class="taskDesc"> Coupon Amount</td>
                <td class="taskStatus">Rp. {{$orderDetails->coupon_amount}}</td>
                </tr>
                <tr>
                <td class="taskDesc"> Payment Method</td>
                <td class="taskStatus">{{$orderDetails->payment_method}}</td>
                </tr>
            </tbody>
                    </table>
                </div>
                </div>
                <div class="widget-box">
                <div class="widget-title">
                    <h5>Billing Address</h5>
                </div>
                <div class="widget-content">
                    {{$userDetails->name}} <br>
                    {{$userDetails->address}} <br>
                    {{$userDetails->city}} <br>
                    {{$userDetails->state}} <br>
                    {{$userDetails->country}} <br>
                    {{$userDetails->pincode}} <br>
                    {{$userDetails->mobile}} <br>

                </div>
                </div>
    </div>
<div class="span6">
        <div class="widget-box">
                <div class="widget-title">
                    <h5>Customer Details</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-striped table-bordered">
                    
            <tbody>
                <tr>
                <td class="taskDesc">Customer Name</td>
                <td class="taskStatus">{{$orderDetails->name}}</td>
                </tr>
                <tr>
                <td class="taskDesc">Customer Email</td>
                <td class="taskStatus">{{$orderDetails->user_email}}</td>
                </tr>
            </tbody>
                    </table>
                </div>
                </div>
        <div class="widget-box">
            <div class="widget-title">
                <h5>Shipping Address Update</h5>
            </div>
            <div class="widget-content">
            <form action="{{url('/admin/update-order-status')}}" method="post"> {{csrf_field()}}
            <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                   <table style="width:100%;">
                    <tr>
                    <td>
                   <select name="order_status" id="order_status"  required="">
                     <option value="New" @if($orderDetails->order_status== "New") selected @endif>
                         New</option>
                     <option value="Pending" @if($orderDetails->order_status== "Pending") selected @endif>
                         Pending</option>
                     <option value="In Process" @if($orderDetails->order_status== "In Process") selected @endif>
                         In Process</option>
                     <option value="Shipped" @if($orderDetails->order_status== "Shipped") selected @endif>
                         Shipped</option>
                     <option value="Delivered" @if($orderDetails->order_status== "Delivered") selected @endif>
                         Delivered</option>
                     <option value="Cancelled" @if($orderDetails->order_status== "Cancelled") selected @endif>
                         Cancelled</option>
                    <option value="Paid" @if($orderDetails->order_status== "Paid") selected @endif>
                            Paid</option>
                   </select>
                    </td>
                    <td>
                   <input type="submit" value="Update Status" class="btn btn-info">
                    </td>
                    </tr>
                   </table>
               </form>
            </div>
        </div>
        <div class="widget-box">
        <div class="widget-title">
            <h5>Shipping Address</h5>
        </div>
        <div class="widget-content">
            {{$orderDetails->name}} <br>
            {{$orderDetails->address}} <br>
            {{$orderDetails->city}} <br>
            {{$orderDetails->state}} <br>
            {{$orderDetails->country}} <br>
            {{$orderDetails->pincode}} <br>
            {{$orderDetails->mobile}} <br>
        </div>
        </div>
</div>
</div>
<hr>
 <div class="row-fluid">
     <h3 align="center">Ordered Products List</h3>
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
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>

@endsection
