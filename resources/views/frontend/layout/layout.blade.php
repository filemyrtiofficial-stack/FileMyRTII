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
    @stack('style')

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
        .pio-list {
            position: absolute;
            bottom: -80px;
            background: white;
            border: 1px solid #9ac4e2;
            width: 100%;
            z-index: 1;
            list-style: none;
            padding: 0px
        }
        .pio-list li {
            padding: 10px;
            border: 1px solid #9ac4e2;

        }
        .pio-list li:hover {
            background : #9ac4e2;
        }
        .pio-list li a {}

        .relative {
            position: relative;
        }
        .form_item.single {
            width: 100%;
        }
        .form-error-list {
            color: #f00;
            margin-top: 5px;
            display: inline-block;
        }
        .loader {
            position: fixed;
    z-index: 999;
    background: #00000038;
    top: 0px;
    width: 100%;
    height: 100%;
    text-align: center;
        }
    </style>
</head>

<body>
    @include('frontend.navbar')
    <main>

        @yield('content')
        @if(!auth()->guard('customers')->check())
            @include('frontend.partials.login-register')
        @else
            @include('frontend.partials.change-password')
        @endif
        @if(auth()->guard('lawyers')->check())
            @include('lawyer.auth.lawyer-change-password')
        @endif



    </main>
    <div class="success_toast_msg @if(session()->has('success')) active @endif">  
            <div class="toast_content">
              <div class="toast_img_wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M18.2396 23.2926L22.5431 27.8399L30.7196 19.1999M39.3596 23.9999C39.3596 32.483 32.4828 39.3599 23.9996 39.3599C15.5166 39.3599 8.63965 32.483 8.63965 23.9999C8.63965 15.5168 15.5166 8.63989 23.9996 8.63989C32.4828 8.63989 39.3596 15.5168 39.3596 23.9999Z" stroke="#0e9e32" stroke-width="2.88"/>
                </svg>
              </div>
              <div class="message">
                <span class="text text-1">Success</span>
                <span class="text text-2 success-message">@if(session()->has('success')) {{session()->get('success')}} @else Your changes has been saved @endif</span>
              </div>
            </div>
          </div>

          <div class="error_toast_msg @if(session()->has('error')) active @endif">  
            <div class="toast_content">
              <div class="toast_img_wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M18.2396 23.2926L22.5431 27.8399L30.7196 19.1999M39.3596 23.9999C39.3596 32.483 32.4828 39.3599 23.9996 39.3599C15.5166 39.3599 8.63965 32.483 8.63965 23.9999C8.63965 15.5168 15.5166 8.63989 23.9996 8.63989C32.4828 8.63989 39.3596 15.5168 39.3596 23.9999Z" stroke="#0e9e32" stroke-width="2.88"/>
                </svg>
              </div>
              <div class="message">
                <span class="text text-1">Error</span>
                <span class="text text-2 error-message">@if(session()->has('error')) {{session()->get('error')}} @endif</span>
              </div>
            </div>
          </div>

    <!-- <div class="loader" style="display:none">
        <div>
        <span>Please Wait...</span>
        </div>
    </div> -->
    @include('frontend.footer')
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/rti/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/rti/js/custom-script.js')}}"></script>
    @stack('js')
    <script>
        function imagevaladition(files){
                let allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
                let maxFiles = 5;
                let maxSize = 3 * 1024 * 1024; // 3MB
                let errorMessage = "";

                    // Check file count
                    if (files.length > maxFiles) {
                    errorMessage = "You can only upload a maximum of 5 files.";
                } else {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];

                        // Check file type
                        if (!allowedTypes.includes(file.type)) {
                            errorMessage = "Only images (JPG, PNG, WEBP) and PDFs are allowed.";
                            break;
                        }

                        // Check file size
                        if (file.size > maxSize) {
                            errorMessage = "Each file must be smaller than 3MB.";
                            break;
                        }
                    }
                }
                if (errorMessage) {
                    $('.error_toast_msg').addClass('active').find('.error-message').html(errorMessage);
                    setTimeout(function() {
                    $('.error_toast_msg').fadeOut('slow', function() {
                    $(this).removeClass('active').show(); // Reset state after fading out
                    });
                    }, 3000);
                    return false;
                }
             

        }
        closeMessagePopup();
        function closeMessagePopup() {
            setTimeout(() => {
            $('.error_toast_msg').removeClass('active');
            $('.success_toast_msg').removeClass('active');

        }, 2000);
        }

        

        $(document).on('submit', '.authentication', function(e){
            e.preventDefault();
        let _this = $(this);
        $('.form-error-list').remove();
        // var data = $(this).serialize();
        var data = new FormData($(this)[0]);
        $(this).find('button').attr('disabled', true);
        $('.loader').show();

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
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                  if(response.status == 'success') {
                    
                    if(response.tab != undefined) {
                        $('.contact_faq_tab').removeClass('active');
                        $('#'+response.tab).addClass('active');
                        _this.find('button').attr('disabled', false);
                        $('.loader').hide();

                    }
                    else if(response.redirect) {
                        window.location.href = response.redirect;
                    }
                    else if(response.message) {
                        $('.success_toast_msg').addClass('active').find('.success-message').html(response.message);
                        if(response.clean== undefined || response.clean != "false") {

                            _this.find('input').val("");
                        }
                       
                        closeMessagePopup();
                        _this.find('button').attr('disabled', false);
                        $('.loader').hide();

                    }
                    else {

                        window.location.reload();
                    }
                  }
                  else {
                    $('.error_toast_msg').addClass('active').find('.error-message').html(response.message);
                    _this.find('button').attr('disabled', false)

                  }
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    _this.find('input[name='+index+']').parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`);
                    _this.find('textarea[name='+index+']').parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                });
                _this.find('button').attr('disabled', false);
                $('.loader').hide();

            }
        });
        });

        $(document).on('submit', '.form-submit', function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.find('button').attr('disabled', true);

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
                if(response.tab != undefined) {
                    $('.contact_faq_tab').removeClass('active');
                    $('#'+response.tab).addClass('active');

                }
                else {

                    $('.success-message').html(response.message);
                    $('.success_toast_msg').addClass('active');
    
                    closeMessagePopup();
    
                        _this.find('input').val(null);
                }
                _this.find('button').attr('disabled', false);
                  
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    $('#' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                });
                _this.find('button').attr('disabled', false);
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