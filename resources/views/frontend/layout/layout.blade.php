<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
     <link rel="icon" type="image/x-icon" href="{{asset('assets/rti/images/fevicon.ico')}}">
    @yield('meta')
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('structured_data')

    <link rel="stylesheet" href="{{asset('assets/rti/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/rti/css/loader.css')}}">
    <!--<link rel="stylesheet" href="{{asset('assets/rti/css/boostrap.css')}}">-->

    @stack('style')

    <style>
    .preview-button {
            padding: 5px 10px;
    color: white;
    background: #078ff4e8;
    border-radius: 5px;
    }
    /*.v_scroll {*/
    /*        overflow-x: hidden;*/
    /*}*/
   .badge-danger {
            color:red !important;
        }
        .badge-success {
            color:green !important;
        }
        .lawyer-request-status {
            font-size : 12px;
        }
     @font-face {
        font-family: 'Zeyada';
        src: url('{{ asset("assets/rti/fonts/Zeyada-Regular.ttf") }}') format('truetype');
        /*font-family: 'greatvibes';*/
        /*src: url('{{ asset("assets/rti/fonts/greatvibes-regular.ttf") }}') format('truetype');*/

        font-weight: normal;
        font-style: normal;
    }
    
      .signature-preview {
            font-family: 'Zeyada', cursive; 
        /*font-family: "greatvibes", "cursive";*/
         font-size : 30px;
         color : #0b57d0;
         font-weight: 100;
    }
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
            z-index: 3;
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
            font-weight: 400;
            font-size: 16px;
        }
        .preview-btn {
            position: absolute;
    background: #0000008a;
    top: 0px;
    width: 100%;
    height: 100%;
    text-align: center;
    align-content: center;
    color: white;
        }
        .add-pio-address-btn {
            color: var(--theme-btn-color);
        }

        @font-face {
        font-family: 'DancingScript';
            src: url('{{ storage_path("fonts/dancing_script.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
    }
    .signature span {
        font-family: "DancingScript", "cursive";
    }
    .show-password-section {
        color:white;
    }
    .show-password-section label {
        margin-left : 2px;
    }
    .show-pwd-forgot-pwd {
        display: flex;
    justify-content: space-between;
    }
    .mb-1-2 {
        margin-bottom: 1.2rem;
    }

    .info_requested span {
    font-size: 12px;
    }
    #mail-area .theme-btn {
        pointer-events: none;
    }

 .more-info-card-message {
        color: red;
        font-weight : 800;
        margin-top: 15px;
        font-size: 1.2rem;

    }
    .case_list {
        margin-top: 24px;
    }
    tr.text-danger-light {
    background: #ff00001f;
}
.draft-rti-btn {
    text-align : center;
    padding-top : 10px;
}
.text-danger {
    color: #F00;
}
.track-my-rti-note {
    text-align: right;
}
.track-my-rti-note a {
        color: var(--theme-btn-color);
}
.w-100 {
    width: 100% !important;
}
.mt-3 {
    margin-top: 1.5rem;
}
@media (min-width: 992px) {
    .menu > li.mobile_menu {
        max-height: 100%;
    }
}
 
   </style>
    
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TVD7JRWZ');</script>
<!-- End Google Tag Manager -->



<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVD7JRWZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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

    <div class="loading loader" style="display:none;"><span>Please Wait ...</span>&#8230;</div>

    <!-- <div class="loader" style="display:none">
        <div>
        <span>Please Wait...</span>
        </div>
    </div> -->
    @include('frontend.footer')
    
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/rti/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/rti/js/custom-script1.js')}}"></script>
       <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-71X4LQT5G7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-71X4LQT5G7');
</script>

    @stack('js')
    @if(!auth()->guard('customers')->check())
        @if(isset($_GET['t']) && $_GET['t'] == 'signin')
        <script>
            $('.login-modal').click();
        </script>
        @endif
    @endif
  
    <script>
        
     
        function imagevaladition(files, type = null){
            var allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];

            if(type == "image/*") {
             allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

            }
            console.log(allowedTypes, 'allowedTypes', type)

                let maxFiles = 5;
                let maxSize = 5431 * 1024 * 1024; // 3MB
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
                            errorMessage = "Each file must be smaller than 5MB.";
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
                    else if(response.form == 'upload-rti') {
                       console.log(response)
                       $('.success_toast_msg').addClass('active').find('.success-message').html(response.message);

                        $('.upload_rti_wrap').find('.upload_area').hide();
                        $('.upload_rti_wrap').parents().eq(0).find('.form_action    ').hide();
                        _this.find('button').attr('disabled', false);
                        $('.loader').hide();
                        $('html,body').animate({ scrollTop: $('.lawyer_db_section').offset().top - 100 }, 1000);
                        $('.track-mti-tab').removeClass('hide');
                        setTimeout(() => {
                                $('.success_toast_msg').removeClass('active');
                            }, 2000);

                    }
                    else if(response.redirect) {
                        $('.loader').hide();
                        if($('.lawyer_db_section').length > 0) {

                            $('html,body').animate({ scrollTop: $('.lawyer_db_section').offset().top }, 1000);
                        }
                        window.location.href = response.redirect;
                    }
                     else if(response.set_column) {
                            $('.success_toast_msg').addClass('active').find('.success-message').html(response.message);
                            $('#'+response.set_column).val(response.value);
                            $('#pio-popup').removeClass('active');
                            $('#pio_address').val("");
                            _this.find('button').attr('disabled', false);
                            $('.loader').hide();
                            setTimeout(() => {
                                $('.success_toast_msg').removeClass('active');
                            }, 2000);
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
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? Array.isArray(value) ? value[0] ?? '' :  value :  value}</span>`);
                    _this.find('textarea[name='+index+']').parents().eq(0).append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
                        console.log(_this.find('textarea[name='+index+']').length)
                        
                        if( _this.find('textarea[name='+index+']').length > 0) {
                            if($('.v_scroll').length > 0) {
                                
                                 $('.v_scroll').animate({
                                    scrollTop: $('textarea[name='+index+']').offset().top
                                }, 1000);
                            }
                        }
                         if( _this.find('input[name='+index+']').length > 0) {
                              if($('.v_scroll').length > 0) {
                                   $('.v_scroll').animate({
                                        scrollTop: $('input[name='+index+']').offset().top
                                    }, 1000);
                              }
                        }
                        });
                   
              
                _this.find('button').attr('disabled', false);
                $('.loader').hide();
                  if($('.lawyer_db_section').length > 0) {

                    $('html,body').animate({ scrollTop: $('.lawyer_db_section').offset().top }, 1000);
                }

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
                    _this.find('#' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
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
                    console.log(value, value.length)

                    if(index == "g-recaptcha-response") {
                         $('#captcha-error').append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`) 
                    }
                    else {
                        
                    index = index.replaceAll('.', '_')
                    $('#contact_' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
                    }
                    
                    // index = index.replaceAll('.', '_')
                    // $('#contact_' + index).parents().eq(0).append(
                    //     `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
                })
            }
        });
    });

    $(document).on('change', '.show-password', function(){
        if($(this).is(":checked")) {
            $(this).closest("form").find(".password").attr('type', 'text');
        }
        else {
            $(this).closest("form").find(".password").attr('type', 'password');

        }

    })
    </script>
    <script>
        $('.rti_tab_slider').on('afterChange', function(event, slick, currentSlide, nextSlide){

            let target = $('#sevice_tab-'+currentSlide).find('a').attr('data-id');
            $('#sevice_tab-'+currentSlide).find('a').addClass('active');
             $('#sevice_tab-'+currentSlide).siblings().find('a').removeClass('active');
             $('#'+target).addClass('tab-active').siblings().removeClass('tab-active');
            
        }).trigger('afterChange');
    </script>
    
    
    
    
    <script>
        if($('.blog_post_list').length > 0) {
            $(document).ready(function() {
              var blogSchema = {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "mainEntityOfPage": {
                  "@type": "WebPage",
                  "@id": window.location.href
                },
                "headline": $('.breadcrumb_heading .title').text(),
                "description": $('#short_description').text(),
                "image": $('#thumbnail-image').val(),
                "author": {
                  "@type": "Person",
                  "name": $('#blog-author-name').text()
                },
                "publisher": {
                  "@type": "Organization",
                  "name": "FileMyRTI",
                  "logo": {
                    "@type": "ImageObject",
                    "url": $('.header_logo img').attr('src')
                  }
                },
                "datePublished": $('#publish_date').val(),
                "dateModified": $('#updated_at').val()
              };
            
              $('<script>', {
                type: 'application/ld+json',
                text: JSON.stringify(blogSchema)
              }).appendTo('head'); // or use $('body') if needed
            });
        
        }

</script>


</body>


</html>
