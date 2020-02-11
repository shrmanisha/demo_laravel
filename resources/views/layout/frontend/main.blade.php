<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title','Blog Laravel')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{asset('/assets/frontend/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/frontend/css/swiper.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/frontend/css/ionicons.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

</head>

<body>

    @include('layout.frontend.partial.header')

    @yield('content')

    @include('layout.frontend.partial.footer')


    <!-- SCIPTS -->
    {{-- bootsrap --}}
    <script src="{{asset('/assets/frontend/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('/assets/frontend/js/bootstrap.js')}}"></script>

    {{-- tether --}}
    <script src="{{asset('/assets/frontend/js/tether.js')}}"></script>

    {{-- swiper --}}
    <script src="{{asset('/assets/frontend/js/swiper.js')}}"></script>

    <script src="{{asset('/assets/frontend/js/scripts.js')}}"></script>
    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{$error}}','Error',{
                    colseButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
    </script>
</body>

</html>
