@extends('layouts.front')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			My-Profile
		</h2>
	</section>

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

                                    
        </div>
    </section>

@endsection