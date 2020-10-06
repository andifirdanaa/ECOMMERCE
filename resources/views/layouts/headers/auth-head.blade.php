<?php 
use App\http\Controllers\Controller;
use App\Product; 
$cartCount = Product::cartCount();
?>

<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<span class="topbar-child1">
					
				</span>

				<div class="topbar-child2">
					<span class="topbar-email">
						
					</span>

					<!-- <div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>USD</option>
							<option>EUR</option>
						</select>
					</div> -->
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="{{ asset('argon/img/Mark.png') }}" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="/">Home</a>
								
							</li>

							<li>
								<a href="{{route('shop-hal.index')}}">Shop</a>
							</li>

							<li class="sale-noti">
								<a href="product.html">Sale</a>
							</li>

							<li>
								<a href="about.html">About</a>
							</li>

							
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<ul class="navbar-nav align-items-center d-none d-md-flex">
			            <li class="nav-item dropdown">
			                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                    <div class="media align-items-center">
			                        <span class="avatar avatar-sm rounded-circle">
			                            <img src="{{ asset('shop/images/icons/icon-header-01.png')}}" class="header-icon1"  data-toggle="dropdown" alt="ICON">
			                        </span>
			                        <div class="media-body ml-2 d-none d-lg-block">
			                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
			                        </div>
			                    </div>
			                </a>
			                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
			                	<a class="dropdown-item" href="{{route('profile.edit')}}">Account</a>
			                	<a class="dropdown-item" href="{{url('orders')}}">Detail Order</a>
           
			                    <div class="dropdown-divider"></div>
			                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
			                    document.getElementById('logout-form').submit();">
			                        <i class="ni ni-user-run"></i>
			                        <span>{{ __('Logout') }}</span>
			                    </a>
			                      
			                </div>
			            </li>
			        </ul>
				

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<a href="{{url('cart')}}"><img src="{{ asset('shop/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON"></a>
						<span class="header-icons-noti">{{$cartCount}}</span>
						
						<!-- Header cart noti -->
					<!-- 	<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{ asset('shop/images/item-cart-01.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

							
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn"> -->
									<!-- Button -->
									<!-- <a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn"> -->
									<!-- Button -->
								<!-- 	<a href="{{url('checkout')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div> -->
					</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="{{ asset('shop/images/icons/logo.png')}}"alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<div class="dropdown">
					
						<img src="{{ asset('shop/images/icons/icon-header-01.png')}}" class="header-icon1"  data-toggle="dropdown" alt="ICON">
					
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					    <a class="dropdown-item" href="{{route('login')}}">Login</a>
					    <a class="dropdown-item" href="{{route('register')}}">Register</a>
					  </div>
					</div>



					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="{{ asset('shop/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{ asset('shop/images/item-cart-01.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

								

								
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								
							</span>

						<!-- 	<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div> -->
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="/">Home</a>
						
					</li>

					<li class="item-menu-mobile">
						<a href="shop-hal">Shop</a>
					</li>

					<li class="item-menu-mobile">
						<a href="product.html">Sale</a>
					</li>

					<li class="item-menu-mobile">
						<a href="cart.html">Features</a>
					</li>

					<li class="item-menu-mobile">
						<a href="blog.html">Blog</a>
					</li>

					<li class="item-menu-mobile">
						<a href="about.html">About</a>
					</li>

					<li class="item-menu-mobile">
						<a href="contact.html">Contact</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>