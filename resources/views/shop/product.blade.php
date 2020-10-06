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
	<!-- Title Page -->
	@foreach($banner as $item)
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(banneri/{{$item->image}});">
		<h2 class="l-text2 t-center">
			{{$item->name}}
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>
	@endforeach


	@include('layouts.contentpage.page')

					<!-- Product -->
					<div class="row">
						@foreach($product as $item)
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/{{$item->image}}" alt="IMG-PRODUCT" class="img-fluid" style="width: 260px;height: 260px;">

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
									<a href="detail/{{$item->id}}" class="block2-name dis-block s-text3 p-b-5">
										{{$item->name_product}}
									</a>
									<span>Rp.
											<span class="block2-price m-text6 p-r-5">
												{{$item->product_prize}}
											</span>
									</span>
								</div>
							</div>
						</div>
						@endforeach
						
					<!-- Pagination -->
					<!-- <div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div> -->
				</div>
			</div>
		</div>
	</section>
<!-- Container Selection1 -->
	<div id="dropDownSelect2"></div>

	 @auth()
    
     @include('layouts.footers.auth_foot')
    @endauth

    @guest()
     @include('layouts.footers.foot')
    @endguest
</body>
@endsection