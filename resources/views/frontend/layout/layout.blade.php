<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/rti/css/custom-style.css')}}">
</head>

<body>
    @include('frontend.navbar')
    <main>

        @yield('content')



    </main>


    @include('frontend.footer')
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/rti/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/rti/js/custom-script.js')}}"></script>
    @stack('js')
</body>

</html>