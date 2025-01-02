<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        FileMyRTI
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .list-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .navbar-vertical .navbar-brand-img,
    .navbar-vertical .navbar-brand>img {
        max-height: 4rem;
        max-width: 100%;
        width: 51%;
    }
    a {
        cursor: pointer;
    }
    .doctor-profile {
        background: black;
    border-radius: 100%;
    backdrop-filter: invert(1);
    width: 33%;
    }
    .none {
        display:none;
    }
    .btn-group, .btn-group-vertical {
        position: absolute;
        right: 14px;
        top: 3px;
    }
    </style>
</head>

<body class="{{ $class ?? '' }}">

    @guest
    @yield('content')
    @endguest

    @auth
    @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register',
    'recover-password', 'rtl', 'virtual-reality']))
    @yield('content')
    @else
    @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
    <div class="position-absolute w-100 min-height-300 top-0"
        style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    @endif
    @include('layouts.navbars.auth.sidenav')
    <main class="main-content border-radius-lg">
        @yield('content')
    </main>
    @include('components.fixed-plugin')
    @endif
    @endauth
    <script src="{{asset('assets/js/jquery-3.7.1.slim.js')}}"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    





    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    <script src='https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js'></script>
    @stack('js');

    @if(session()->has('success'))
    <script>
        Swal.fire({
  text: "{{session()->get('success')}}",
  icon: "success"
});
        </script>
    @endif
    <script>
    ClassicEditor.create(document.querySelector(".editor"));

     $('.dropify').dropify();


     $('.select-2').select2();

    $(document).on('submit', '.form-submit', function(e) {
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
                window.location.reload();
            },
            error: function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    $('#' + index).parents().eq(1).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });
    })

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        let action = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: action,
                    type: 'delete',
                    success: function(response) {
                        console.log(response, 'response')
                        Swal.fire({
                            title: "Deleted!",
                            text: "Data has been deleted.",
                            icon: "success"
                        });
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error, 'error')
                        Swal.fire({
                            text: error.responseJSON.error,
                            icon: "error"
                        });
                    }
                });

            }
        });
    })

    $(document).on('keyup', '.enable-slug', function(){
        let value = slugify($(this).val());
        $('#slug').val(value);
    });
    function slugify(content) {
        return content.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    }
    </script>
</body>

</html>