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
        .form_tab_item .title {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .hide {
            display: none;
        }
    </style>
</head>

<body>
    @include('frontend.navbar')
    <main>

        @yield('content')

        @include('frontend.partials.login-register')

    </main>
    <div class="success_toast_msg ">  
            <div class="toast_content">
              <div class="toast_img_wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M18.2396 23.2926L22.5431 27.8399L30.7196 19.1999M39.3596 23.9999C39.3596 32.483 32.4828 39.3599 23.9996 39.3599C15.5166 39.3599 8.63965 32.483 8.63965 23.9999C8.63965 15.5168 15.5166 8.63989 23.9996 8.63989C32.4828 8.63989 39.3596 15.5168 39.3596 23.9999Z" stroke="#0e9e32" stroke-width="2.88"/>
                </svg>
              </div>
              <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2 success-message">Your changes has been saved</span>
              </div>
            </div>
          </div>

    @include('frontend.footer')
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/rti/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/rti/js/custom-script.js')}}"></script>
    @stack('js')
    <script>

        $(document).on('submit', '.authentication', function(e){
            e.preventDefault();
        let _this = $(this);
        $('.form-error-list').remove();
        var data = $(this).serialize();
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
            type: 'post', // For jQuery < 1.9
            dataType : 'json',
            success: function(response) {
                  if(response.status == 'success') {
                    window.location.reload();
                  }
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    _this.find('input[name='+index+']').parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });
        });

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
                $('.success-message').html(response.message);
                $('.success_toast_msg').addClass('active');

                setTimeout(() => {
                    $('.success_toast_msg').removeClass('active');
                }, 2000);

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