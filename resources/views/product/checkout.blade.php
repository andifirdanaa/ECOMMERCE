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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
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
           <form action="{{url('/checkout')}}" method="POST"> {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Name *</label>
                                    <input type="text" class="form-control" name="billing_name" id="billing_name" placeholder="" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif type="text" placeholder="Billing Name" class="form-control"required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif type="text" placeholder="Billing Address" class="form-control" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>

                           <div class="mb-3">
                                <label for="username">City *</label>
                                <div class="input-group">
                                    <select class="wide w-100" name="billing_city" id="billing_city" >
                                    <option value="Choose..." data-display="Select">Choose...</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->name}}"  @if(!empty($userDetails->city) && $city->name == $userDetails->city) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                    <div class="invalid-feedback" style="width: 100%;"> Please select a valid City </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" name="billing_country" id="billing_country" >
									<option value="Choose..." data-display="Select">Choose...</option>
									@foreach($countries as $country)
									<option value="{{$country->country_name}}"  @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
                                    <div class="invalid-feedback"> Please select a valid country. </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="province">Province *</label>
                                    <select class="wide w-100" name="billing_province" id="billing_province" data-dependent ="billing_city">
                                    <option value="Choose..." data-display="Select">Choose...</option>
                                    @foreach($daftarProvinsi as $id => $name)
                                    <option value="{{$id}}"  @if(!empty($userDetails->province) && $id == $userDetails->province) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                                    <div class="invalid-feedback"> Please select a valid province. </div>
                                </div>
                               <!--  <div class="col-md-5 mb-3">
                                    <label for="province">Province *</label>
                                    <select class="wide w-100" name="province" id="province" data-dependent ="city">
                                    <option value="Choose..." data-display="Select">Choose...</option>
                                    @foreach($daftarProvinsi as $key => $value)
                                    <option value="{{$key}}"  @if(!empty($userDetails->province) && $key == $userDetails->province) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                                    <div class="invalid-feedback"> Please select a valid province. </div>
                                </div> -->
    
                                <div class="col-md-4 mb-3">
                                    <label for="state">State *</label>
                                    <input name="billing_state" id="billing_state" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif type="text" placeholder="Billing State" class="form-control"/>
                                </div>
        
                            </div>
                              <div class="mb-3">
                                <label for="username">Pincode *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="billing_pincode" id="billing_pincode" placeholder="" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif placeholder="Billing Pincode" class="form-control" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="username">Mobile *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="billing_mobile" id="billing_mobile" placeholder=""@if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif type="text" placeholder="Billing Mobile" class="form-control" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="billtoship" value="{{$userDetails->name}}">
                                <label class="custom-control-label" for="billtoship"">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div>
                            <hr class="mb-4">
                           
                           
                           
                       
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
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
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Name *</label>
                                    <input type="text" class="form-control" name="shipping_name" id="shipping_name" placeholder="" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif placeholder="Shipping Name" class="form-control" required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif placeholder="Shipping Address" class="form-control" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                           <div class="mb-3">
                                <label for="username">City *</label>
                                <div class="input-group">
                                     <select class="wide w-100" name="shipping_city" id="shipping_city">
                                    <option value="Choose..." data-display="Select">Choose...</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->name}}"  @if(!empty($shippingDetails->city) && $city->name == $shippingDetails->city) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                   
                                     <div class="invalid-feedback"> Please enter your shipping address. </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" name="shipping_country" id="shipping_country">
									<option value="Choose..." data-display="Select">Choose...</option>
									@foreach($countries as $country)
									<option value="{{$country->country_name}}"  @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>{{$country->country_name}}</option>
									@endforeach
								</select>
                                    <div class="invalid-feedback"> Please select a valid country. </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="province">Province *</label>
                                    <select class="wide w-100" name="shipping_province" id="shipping_province" >
                                    <option value="Choose..." data-display="Select">Choose...</option>
                                    @foreach($daftarProvinsi as $province)
                                    <option value="{{$province}}"  @if(!empty($shippingDetails->province) && $province == $shippingDetails->province) selected @endif>{{$province}}</option>
                                    @endforeach
                                </select>
                                    <div class="invalid-feedback"> Please select a valid province. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State *</label>
                                    <input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif placeholder="Shipping State" class="form-control"/>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="">Courier</label>
                                    <select class="form-control" name="shipping_courier" id="shipping_courier" required>
                                        <option value="">Choose...</option>
                                        @foreach($courier as $cour)
                                        <option>{{$cour}}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('courier') }}</p>
                                </div>
                            </div>
                              <div class="mb-3">
                                <label for="username">Pincode *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="shipping_pincode" id="shipping_pincode" placeholder="" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif placeholder="Shipping Pincode" class="form-control" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="username">Mobile *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="shipping_mobile" id="shipping_mobile" placeholder=""@if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif placeholder="Shipping Mobile" class="form-control" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
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
                        <div class="col-12 d-flex shopping-box"> <button type="submit" class="ml-auto btn hvr-hover">Place Order</button></div>
                    </div>
           
                </div>
            </div>
        </form>
        </div>
    </div>
   
@endsection
 <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

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
