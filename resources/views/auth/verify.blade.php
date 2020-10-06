@extends('layouts.front', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.head')

    <section class="cart bgwhite p-t-70 p-b-100">
        <div  class="container">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h1>{{ __('Verify Your Email Address') }}</h1>
                        </div>
                       <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            @if (Route::has('verification.resend'))
                                {{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                </section>
            
@endsection
