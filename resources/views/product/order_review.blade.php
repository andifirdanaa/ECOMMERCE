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
<body class="animsition">

    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
     @include('layouts.headers.auth-head')
    @endauth
   <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing Details</h3>
                        </div>
                        
                
                        <div class="col-mb-3">
                            <label for="firstName"> {{$userDetails->name}} </label>                                 
                        </div>
                          
                            <div class="mb-3">
                                <label for="address">{{$userDetails->address}}</label>
                            </div>
                             <div class="mb-3">
                                <label for="address">{{$userDetails->province}}</label>
                            </div>
                           <div class="mb-3">
                                <label for="username"> {{$userDetails->city}}</label>
                              
                            </div>
                            <div class="col-mb-3">
                                    <label for="country">{{$userDetails->country}}</label>
    
                            </div>
                            <div class="col-mb-3">
                                    <label for="state">{{$userDetails->state}}</label>
                            </div>
                              <div class="mb-3">
                                <label for="username">{{$userDetails->pincode}}</label>
                            </div>
                             <div class="mb-3">
                                <label for="username">{{$userDetails->mobile}}</label>
                            </div>
                           
                            <hr class="mb-4">
                           
                           
                           
                       
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Details</h3>
                                </div>
                                <!-- <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">$20.00</span> </div>
                                </div> -->
                           
                            <div class="col-mb-3">
                                <label for="firstName">  {{$shippingDetails->name}}</label>
                            </div>
                          
                            <div class="mb-3">
                                <label for="address">{{$shippingDetails->address}}</label>
                               
                            </div>
                            <div class="mb-3">
                                <label for="username"> {{$shippingDetails->province}}</label>
                            </div>
                           
                           <div class="mb-3">
                                <label for="username"> {{$shippingDetails->city}}</label>
                            </div>
                           
                            <div class="col-mb-3">
                                <label for="country"> {{$shippingDetails->country}}</label>
                            </div>
                            <div class="col-mb-3">
                                <label for="state">{{$shippingDetails->state}}</label>
                            </div>
                            <div class="mb-3">
                                <label for="username">{{$shippingDetails->pincode}}</label>
                            </div>
                             <div class="mb-3">
                                <label for="username">{{$shippingDetails->mobile}}</label>
                            </div>
                    </div>
                </div>
            </div>
                       
                       <!--  <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> $ 440 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 40 </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> $ 10 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold"> $ 2 </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> $ 388 </div>
                                </div>
                                <hr> </div>
                        </div> -->
                    </div>
           
                </div>
            </div>
        </div>

        <div class="container">
             @if(Session::has('flash_message_error'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                    <strong>{{ session('flash_message_error') }}</strong>
                                    </div>
                                    @endif
                                    @if(Session::has('flash_message_success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                    <strong>{{ session('flash_message_success') }}</strong>
                                    </div>
                                    @endif
            <!-- Cart item -->
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4 p-l-70">Quantity</th>
                            <th class="column-5">Total</th>
                        </tr>
                        <?php $total_amount = 0; ?>
                        @foreach($userCart as $cart)
                        <tr class="table-row">
                            <td class="column-1">
                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                    <img src="{{asset('images/'.$cart->image)}}" alt="IMG-PRODUCT">
                                </div>
                            </td>
                            <td class="column-2">{{$cart->product_name}}
                                <p>Code : {{$cart->product_code}}</p>
                                <p>size : {{$cart->size}}</p>
                            </td>
                            <td class="column-3">
                                <?php $product_price = App\Product::getProductPrice($cart->product_id,$cart->size); ?>
                                {{$product_price}}
                            </td>
                            <td class="column-4" style="text-align: center;">
                                   {{$cart->quantity}}
                            </td>
                            <td class="column-5">{{$product_price*$cart->quantity}}</td>
                        </tr>
                        <?php $total_amount = $total_amount + ($product_price*$cart->quantity); ?>
                        @endforeach
                    </table>
                </div>
            </div>

            

            <!-- Total -->
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <h5 class="m-text20 p-b-24">
                    Totals Detail
                </h5>

                <!--  -->
               
                <div class="flex-w flex-sb-m p-b-12">
                     
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>

                    <span class="m-text21 w-size20 w-full-sm">
                        Rp. {{$total_amount}}
                    </span>
                </div>
                 <div class="flex-w flex-sb-m p-b-12">
                     
                    <span class="s-text18 w-size19 w-full-sm">
                        Shipping Cost (+):
                    </span>

                    <span class="m-text21 w-size20 w-full-sm">
                        Rp. {{Session::get('shippingCharges')}}
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
            
                    <span class="s-text18 w-size19 w-full-sm">
                        Coupon Discount (-):
                    </span>

                    <span class="m-text21 w-size20 w-full-sm">
                       @if(!empty(Session::get('CouponAmount')))
                           Rp. {{Session::get('CouponAmount')}}
                        @else
                            Rp. 0
                        @endif
                    </span>
                </div>
         
                <!--  -->
                <!--  <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">
                        Delivery :
                    </span>

                    <span class="m-text21 w-size20 w-full-sm">
                        Rp. {{$delivery= 25000}}
                    </span>
                </div> -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">
                        Grand Total:
                    </span>

                    <span class="m-text21 w-size20 w-full-sm">
                        Rp. {{$grand_total = $total_amount + Session::get('shippingCharges') - Session::get('CouponAmount')}}
                    </span>
                </div>
            
                <form name="paymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post">{{csrf_field()}}
                     <input type="hidden" name="grand_total" value="{{$grand_total}}">
                            <div class="d-block my-3">
                                <span class="m-text21 w-size20 w-full-sm">Payment:</span>
                                <div class="custom-control custom-radio">
                                    <input id="bank" name="payment_method" type="radio" class="custom-control-input" value="BANK" required>
                                    <label class="custom-control-label" for="bank">Bank Transfer</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="cod" name="payment_method" type="radio" class="custom-control-input" value="COD" required>
                                    <label class="custom-control-label" for="cod">COD</label>
                                </div>
                            <div class="flex-w flex-sb-m p-t-26 p-b-30">
                                <div class="size15 trans-0-4">
                                <!-- Button -->
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
                                    Order
                                </button>
                                </div>
                            </div>
                            </div>
                </form>
          
            </div>
        </div>
@endsection
 <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <!-- <script src="theway/js/jquery-3.2.1.min.js"></script>
    <script src="theway/js/popper.min.js"></script>
    <script src="theway/js/bootstrap.min.js"></script> -->
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
   
   