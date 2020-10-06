@extends('layouts.front')

@section('content')
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
     @include('layouts.headers.auth-head')
    @endauth

    @guest()
     @include('layouts.headers.head')
    @endauth()
<!-- Title Page -->
	@foreach($banner as $item)
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/banneri/{{$item->image}});">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>
	@endforeach
	

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
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
							<th class="column-5">Action</th>
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
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size14">
									
									 <a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}"> <i class="fs-12 fa fa-plus" aria-hidden="true" ></i></a>
								
									<input class="size8 m-text18 t-center num-product" type="text" name="quantity" value="{{$cart->quantity}}">

									  @if($cart->quantity>1)
									<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}"> <i class="fs-12 fa fa-minus" aria-hidden="true"></i></a>
									@endif
								</div>
							</td>
							<td class="column-5">{{$product_price*$cart->quantity}}</td>
							<td class="text-right">
                                            <div class="fr">

                                            <a  class="cart_quantity_delete" 
                                              href="{{url('cart/delete-product/'.$cart->id)}}" class="btn btn-danger btn-mini deleteRecord" onclick="confirm('{{ __("Are you sure you want to delete this field?") }}') ? this.parentElement.submit() : ''"><i class="fa fa-times"></i></a>
                                          </div>
                            </td>
						</tr>
						<?php $total_amount = $total_amount + ($product_price*$cart->quantity); ?>
						@endforeach
					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<form action="{{url('/cart/apply-coupon')}}" method="post"> {{csrf_field()}}
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon_code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
							Apply coupon
						</button>
					</div>
				</div>
				 </form>

				<!-- <div class="size10 trans-0-4 m-t-10 m-b-10"> -->
					<!-- Button -->
					<!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div> -->
			</div>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				<!--  -->
				@if(!empty(Session::get('CouponAmount')))
				<div class="flex-w flex-sb-m p-b-12">
					 
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp. <?php echo $total_amount; ?>
					</span>
				</div>
				<div class="flex-w flex-sb-m p-b-12">
			
					<span class="s-text18 w-size19 w-full-sm">
						Coupon Discount:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp. <?php echo Session::get('CouponAmount'); ?>
					</span>
				</div>

				<!--  -->
				<!-- <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Shipping:
					</span>

					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							There are no shipping methods available. Please double check your address, or contact us if you need any help.
						</p>

						<span class="s-text19">
							Calculate Shipping
						</span>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="country">
								<option>Select a country...</option>
								<option>US</option>
								<option>UK</option>
								<option>Japan</option>
							</select>
						</div>

						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
						</div> -->

						<!-- <div class="size14 trans-0-4 m-b-10"> -->
							<!-- Button -->
							<!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Update Totals
							</button>
						</div>
					</div>
				</div> -->

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp. <?php echo $total_amount - Session::get('CouponAmount'); ?>
					</span>
				</div>
				@else
				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp. <?php echo $total_amount; ?>
					</span>
				</div>
				@endif

			<form action="{{url('checkout')}}">
				<div class="size15 trans-0-4">
					<!-- Button -->
					
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
						Proceed to Checkout
					</button>
				</div>
			</form>
			</div>
		</div>
	</section>
	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>
 @auth()
    
     @include('layouts.footers.auth_foot')
    @endauth

    @guest()
     @include('layouts.footers.foot')
    @endguest
@endsection