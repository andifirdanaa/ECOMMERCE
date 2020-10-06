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
     @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif

    <!-- Product Detail -->
    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                   <div class="slick3">
                        <div class="item-slick3" data-thumb="{{asset('images/'.$productDetail->image)}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('images/'.$productDetail->image)}}" alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset('images/'.$productDetail->image)}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('images/'.$productDetail->image)}}" alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset('images/'.$productDetail->image)}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('images/'.$productDetail->image)}}" alt="IMG-PRODUCT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <form name="addtocartForm" id="addtocartForm" action="/add-cart" method="post"> {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{$productDetail->id}}">
                <input type="hidden" name="product_name" value="{{$productDetail->name_product}}">
                <input type="hidden" name="product_code" value="{{$productDetail->id_product}}">
                <input type="hidden" name="product_color" value="{{$productDetail->product_color}}">
                <input type="hidden" name="price" id="price" value="{{$productDetail->product_prize}}">
                <h4 class="product-detail-name m-text16 p-b-13">
                   {{$productDetail->name_product}}
                </h4>

                <span class="m-text17" id="getPrice" >
                    Rp.{{$productDetail->product_prize}}
                </span>

                <p class="s-text8 p-t-10">
                    Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
                </p>

                <!--  -->
                <div class="p-t-33 p-b-60">
                    <div class="flex-m flex-w p-b-10">
                        <div class="s-text15 w-size15 t-center" id="getPrice">
                            Size
                        </div>

                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                            <select class="selection-2" id="selSize" name="size">
                                <option value="">Choose an option</option>
                                @foreach($productDetail->attributes as $sizes)
                                <option value="{{$productDetail->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                 <!--    <div class="flex-m flex-w">
                        <div class="s-text15 w-size15 t-center">
                            Color
                        </div>

                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                            <select class="selection-2" name="color">
                                <option>Choose an option</option>
                                <option>Gray</option>
                                <option>Red</option>
                                <option>Black</option>
                                <option>Blue</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="1">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                               @if($total_stock>0)
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" id="cartButton";>
                                    Add to Cart
                                </button>
                                 @endif
                            </div>
                            <p><b>Avalaibility :</b><span id="Availability">@if($total_stock>0) In Stock @else Out of Stock @endif</span></p>
                        </div>
                    </div>
                </div>

                <!-- <div class="p-b-45">
                    <span class="s-text8 m-r-35">SKU: MUG-01</span>
                    <span class="s-text8">Categories: Mug, Design</span>
                </div> -->

                <!--  -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Description
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            {{$productDetail->product_description}}
                        </p>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Relate Product -->
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
             <?php $count=1; ?>
            @foreach($relatedProducts->chunk(3) as $chunk)
            <div class="wrap-slick2">
                <div <?php if($count==1){ ?> class="slick2" <?php } else{ ?>  <?php } ?>>
                @foreach($chunk as $item)
                    <div class="item-slick2 p-l-15 p-r-15" >
                       
                        <!-- Block2 -->
                        <div  class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                <img src="{{asset('images/'.$item->image)}}" style=" width: 270px;height: 260px;">

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
                                <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                   {{$item->name_product}}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
                                    Rp.{{$item->product_prize}}
                                </span>
                            </div>
                        </div>
                   
                    </div>
                     @endforeach 

                </div>
            </div>
            <?php $count++; ?>
            @endforeach
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
