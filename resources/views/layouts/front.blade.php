<!DOCTYPE html>
<html lang="en">
<head>
	<title>Market Place</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('shop/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/noui/nouislider.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/vendor/lightbox2/css/lightbox.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('shop/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('shop/css/main.css')}}">

<!--===============================================================================================-->
</head>
<body class="animsition">
	  @yield('content')
	

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/bootstrap/js/popper.js') }}"></script>
	<script type="text/javascript" src="{{ asset('shop/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/select2/select2.min.js') }}"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/daterangepicker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('shop/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/slick/slick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('shop/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/lightbox2/js/lightbox.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/sweetalert/sweetalert.min.js') }}"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('shop/vendor/noui/nouislider.min.js') }}"></script>
	<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 50, 200 ],
	        connect: true,
	        range: {
	            'min': 50,
	            'max': 200
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
	</script>
	
<!--===============================================================================================-->
	

	<!--===============================================================================================-->
	<script src="{{asset('shop/js/main.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#expiry_date" ).datepicker();
  } );
  </script>


</body>
</html>