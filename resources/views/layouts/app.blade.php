<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Market Place') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/Market.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <style type="text/css">
            .k{
            #password-meter{display: block;}
            div{width: 300px;}
            input, progress{font-size: 15px; width: 100%;}
        }
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        <script type="text/javascript">
        let password = document.querySelector('#password');
        let passwordMeter = document.querySelector('#password-meter');
        password.addEventListener ("keyup",function(e){
            cekPassword(password.value);
        });
        function cekPassword(password){
            let strength = 0;
            if(password.match(/([a-z])/)){strength += 1;}
            if(password.match(/([A-Z])/)){strength += 1;}
            if(password.match(/([0-9])/)){strength += 1;}
            if(password.length >= 6){ strength += 1; }
            passwordMeter.value = strength * 25;
        }
    </script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#expiry_date" ).datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd'
    });
  });
  </script>

        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>