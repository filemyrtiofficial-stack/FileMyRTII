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
    <style>
        .testimonial_img_wrap img {
            border-radius :50%;
        }
    </style>
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
    <script>
        $(document).on('submit', '.form-submit', function(e) {
        e.preventDefault();
        let _this = $(this);
        $('.form-error-list').remove();
        var data = new FormData($(this)[0]);
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: action,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: method, // For jQuery < 1.9
            success: function(response) {
                    _this.find('input').val(null);
                  
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    $('#' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });
    });
    $(document).on('submit', '.contctus-form-submit', function(e) {
        e.preventDefault();
        $('.form-error-list').remove();
        var data = new FormData($(this)[0]);
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: action,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: method, // For jQuery < 1.9
            success: function(response) {
            if(response.redirect) {
                window.location.href = response.redirect;
            }
            else {

                window.location.reload();
            }
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    index = index.replaceAll('.', '_')
                    $('#contact_' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });
    });

    </script>
</body>


</html>