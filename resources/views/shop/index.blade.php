@extends('layouts.front')

@section('content')
<body class="animsition">
	@auth()
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
     @include('layouts.headers.auth-head')
	@endauth

	@guest()
	 @include('layouts.headers.head')
	@endauth()
	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				@foreach($banner as $item)
				<div class="item-slick1 item1-slick1" style="background-image: url(banneri/{{$item->image}});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							{{$item->name}}
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							{{$item->content}}
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="{{route('shop-hal.index')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>
				@endforeach


			</div>
		</div>
	</section>

	<!-- Banner -->
	<section class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			
	
			<div class="row">

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					@foreach($imagecat as $item)
					<div class="block1 hov-img-zoom pos-relative m-b-30">

						<img src="imagescat/{{$item->image}}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Jacket
							</a>
						</div>
						
					</div>
					@endforeach

					<!-- block1 -->
					@foreach($imagetwo as $item)
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="imagescat/{{$item->image}}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Shirt
							</a>
						</div>
					</div>
					@endforeach
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					@foreach($imagethree as $item)
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="imagescat/{{$item->image}}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Shoes
							</a>
						</div>
					</div>
					@endforeach

					<!-- block1 -->
					@foreach($imagefive as $item)
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="imagescat/{{$item->image}}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Footerwear
							</a>
						</div>
					</div>
					@endforeach
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					@foreach($imagefour as $item)
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="imagescat/{{$item->image}}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Bags
							</a>
						</div>
					</div>
					@endforeach
					<!-- block2 -->
					<div class="block2 wrap-pic-w pos-relative m-b-30">
						<img src="shop/images/icons/bg-01.jpg" alt="IMG">

						<div class="block2-content sizefull ab-t-l flex-col-c-m">
							<h4 class="m-text4 t-center w-size3 p-b-8">
								Sign up
							</h4>

							<p class="t-center w-size4">
								Be the frist to know about the latest fashion news and get exclu-sive offers
							</p>

							<div class="w-size2 p-t-25">
								<!-- Button -->
								<a href="{{route('register')}}" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
									Sign Up
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- New Product -->
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Featured Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($productAll as $pro)
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="images/{{$pro->image}}" alt="IMG-PRODUCT" style="width: 260px;height: 260px;">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="detail/{{$pro->id}}" class="block2-name dis-block s-text3 p-b-5">
									{{$pro->name_product}}
								</a>

								<span class="block2-price m-text6 p-r-5">
									{{$pro->product_prize}}
								</span>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>

		</div>
	</section>

	<!-- Banner2 -->
	<!-- <section class="banner2 bg5 p-t-55 p-b-55">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="hov-img-zoom pos-relative">
						<img src="shop/images/banner-08.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15">
							<span class="m-text9 p-t-45 fs-20-sm">
								The Beauty
							</span>

							<h3 class="l-text1 fs-35-sm">
								Lookbook
							</h3>

							<a href="#" class="s-text4 hov2 p-t-20 ">
								View Collection
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-6 m-l-r-auto p-t-15 p-b-15">
					<div class="bgwhite hov-img-zoom pos-relative p-b-20per-ssm">
						<img src="shop/images/shop-item-09.jpg" alt="IMG-BANNER">

						<div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
							<div class="t-center">
								<a href="product-detail.html" class="dis-block s-text3 p-b-5">
									Gafas sol Hawkers one
								</a>

								<span class="block2-oldprice m-text7 p-r-5">
									$29.50
								</span>

								<span class="block2-newprice m-text8">
									$15.90
								</span>
							</div>

							<div class="flex-c-m p-t-44 p-t-30-xl">
								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 days">
										69
									</span>

									<span class="s-text5">
										days
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 hours">
										04
									</span>

									<span class="s-text5">
										hrs
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 minutes">
										32
									</span>

									<span class="s-text5">
										mins
									</span>
								</div>

								<div class="flex-col-c-m size3 bo1 m-l-5 m-r-5">
									<span class="m-text10 p-b-1 seconds">
										05
									</span>

									<span class="s-text5">
										secs
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->


	<!-- Blog -->
	

	<!-- Instagram -->
	

	<!-- Shipping -->
	<!-- <section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free Delivery Worldwide
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					30 Days Return
				</h4>

				<span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
			</div>
		</div>
	</section> -->

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	@auth()
	
     @include('layouts.footers.auth_foot')
	@endauth

	@guest()
	 @include('layouts.footers.foot')
	@endauth()

@endsection