<a href="{{ url('/blogs') }}">Blogs</a>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>File My RTI</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- endinject -->
  <link rel="stylesheet" href="{{asset('assets/rti/css/loader.css')}}">

  <style>
    .list-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    a {
        cursor: pointer;
    }

    .none {
        display:none;
    }
    .btn-group, .btn-group-vertical {
        position: absolute;
        right: 14px;
        top: 3px;
    }
    .card {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }
    .card-header {
        background: #4b49ac2e;
        padding: 1.75rem 1.25rem;
    }
    .card-header:first-child {
    border-radius: 20px;
}
.card-header h4 {
    margin-top : 11px;
}
.accordian-actions {
    position: absolute;
    right: 15px;
    justify-content: center;
    top: 28%;
    display: flex;
    flex-wrap: nowrap;
}

.accordian-actions a, .accordian-actions button {
    font-size: 1rem !important;

}
.accordion > .card .card-header * {
    font-size: 1.3rem;
    font-weight: 500 !important;

}
span.permission-list {
    background: #1a3e5c;
    color: white;
    padding: 10px;
    border-radius: 10px;
}
.cke_browser_webkit {
    width: 100% !important;
}
.permission-list-section {
    display: flex;
    flex-wrap: wrap;
}
.permission-list-section .permission-list {
    margin : 5px;
}
.breadcrumb {
    border : unset;
}
.hide {
    display:none;
}
.fields-row .card-body {
    height: 500px;
    overflow: auto;
}
tr.text-danger-light {
    background: #ff00001f;
}
@media (min-width: 992px) {
    .modal-md{
        max-width: 42%;
    }
}
    </style>
    
    <title>@yield('title')</title>
    <!-- Add CSS links here, e.g., Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbars.auth.topnav')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('layouts.navbars.auth.setting')

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
        @include('layouts.navbars.auth.sidenav')
      <!-- partial -->
      <div class="main-panel">

          <div class="content-wrapper">
          <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
    @yield('breadcrumbs')
</ol>
</nav>

        @yield('content')
          </div>

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <div class="loading loader" style="display:none;"><span>Please Wait ...</span>&#8230;</div>

  <!-- plugins:js -->
  <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/js/template.js')}}"></script>
  <script src="{{asset('assets/js/settings.js')}}"></script>
  <script src="{{asset('assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="{{asset('assets/js/dashboard.js')}}"></script> -->
  <!-- <script src="{{asset('assets/js/Chart.roundedBarCharts.js')}}"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    
    
    



<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<input value="{{$_GET['daterange'] ?? '01/01/2023 - '.Carbon\Carbon::now()->addDay()->format('m/d/Y')}}" id="date-range-date" hidden>


<script>
if($('.daterange').length > 0) {
    $('.daterange').daterangepicker();
    // $( '.daterange' ).daterangepicker({
    //   startDate: '01-01-2023',
    //   endDate: '{{Carbon\Carbon::now()->format("m-d-Y")}}'
    // });
    setRangeData();
    function setRangeData() {
        console.log($('#date-range-date').val())
      const range = $('#date-range-date').val().split(' - ');
        if (range.length === 2) {
          const startDate = range[0];
          const endDate = range[1];
          $('.daterange').data('daterangepicker').setStartDate(startDate);
          $('.daterange').data('daterangepicker').setEndDate(endDate);
        }
    }
}



 $(document).on('click', '.dropify-clear', function(){
      
        let id = $(this).parents().eq(0).find('input').attr('id');
        let value = $('#'+id+"_preview").val();
        $('#'+id+"_preview").val('');
    })
    $(document).ready(function() {
    updateArray = [];
    myList = $('#sortable_product');
    $(() => {
		myList.sortable({
			stop: function(event, ui) {
				updateArray = $("#sortable_product").sortable("toArray", { attribute: 'productID' });
				$('#array').html(updateArray.join(', '));
        $('#update_array').val(JSON.stringify(updateArray))

			}
		});
		updateArray = $("#sortable_product").sortable("toArray", { attribute: 'productID' });

		myList.disableSelection();
     });




 })

</script>
  <!-- End custom js for this page-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
  <!-- <script src='https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js'></script> -->
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
      $(document).on('change', '.upload-image', function () {
        let _this = $(this);
         let uploadedFile = document.getElementById($(this).attr('id')).files[0];
         var form_data = new FormData();
         form_data.append("file", uploadedFile);
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            url: "{{route('upload-images')}}",
            method: "POST",
            data: form_data,
            cache : false,
            processData: false,
            contentType: false,
            dataType : 'json',
            success : function(response){
                console.log('upload-image', response)
            //   _this.parents().eq(0).find('.image-collection').show();
            //   _this.parents().eq(0).find('.img-preview').attr('src', response.da ta);
              _this.parents().eq(1).find('.image-input').val(response.data);
              _this.parents().eq(2).find('.preview').attr('href', response.preview_path).removeClass('hide');

            //   console.log(_this.parents().eq(1).find('.image-input').attr('class'))
            },
            error : function(error) {}
         });
      });
      $(document).on('click', '.dropify-clear',function(e){
            e.preventDefault();
            $(this).parents().eq(2).find('.image-input').val(null);

        });

   </script>
    <script>


$(document).ready(function() {
  $(".editor").each(function(_, ckeditor) {
    CKEDITOR.replace(ckeditor, {
    allowedContent: true
  });
  });

});


     $('.dropify').dropify();
     
     $('.dropify').each(function(){
        let src = $(this).attr('data-default-file');
        $(this).parents().eq(2).find('label img').remove();
        $(this).parents().eq(2).find('label').append(`<img width="40" src="${src}" target="blank" class="preview-img">`)
    })
    $('.dropify').on('change', function(event) {
        var input = event.target;
        let preview =  $(this).parents().eq(2).find('label');
        $(this).parents().eq(2).find('label img').remove();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // console.log(e.target.result)
                $('#preview').attr('src', e.target.result);
                preview.append(`<img width="40" src="${e.target.result}" target="blank" class="preview-img">`)
            }

            reader.readAsDataURL(input.files[0]);
        }
    });


     $('.select-2').select2();

    $(document).on('submit', '.form-submit', function(e) {
        e.preventDefault();
        $('.form-error-list').remove();
        var _this = $(this);
        _this.find('button').attr('disabled', true);
        var data = new FormData($(this)[0]);
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        $('.loader').show();
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
                    index = index.replaceAll('.', '_')
                    console.log(value, index)
                    $('#' + index).parents().eq(1).append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
                });
                _this.find('button').attr('disabled', false);
                $('html,body').animate({ scrollTop: $('.form-error-list').offset().top -200}, 500);

                $('.loader').hide();
            }
        });
    })
    
     $(document).on('submit', '.form-submition', function(e) {
        e.preventDefault();
        $('.form-error-list').remove();
        var _this = $(this);
        _this.find('button').attr('disabled', true);
        var data = new FormData($(this)[0]);
        var action = $(this).attr('action');
        var method = $(this).attr('method');
        $('.loader').show();
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
                    index = index.replaceAll('.', '_')
                    console.log(value, index)
                    _this.find('.' + index).parents().eq(1).append(
                        `<span class="text-danger form-error-list">${Array.isArray(value) ? value[0] ?? '' :  value}</span>`)
                });
                $('html,body').animate({ scrollTop: $('.form-error-list').offset().top -200}, 500);
                _this.find('button').attr('disabled', false);
                $('.loader').hide();
            }
        });
    })
     $(document).on('click', '.delete-lawyer', function(e) {
        e.preventDefault();
        let action = $(this).attr('data-href');
        let rti = $(this).attr('data-rti')
        Swal.fire({
            // title: "Are you sure?",
            text: rti+ " RTI are assigned to this laywer if your want to delete this lawyer you have to re-assigned these rti to other lawyer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            // confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href =  action;

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
                            text: error.responseJSON.error ??  error.responseJSON.message,
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
    <script>

        $(document).on('change', '#our_blogs_all_multiple', function(){
            let target = $(this).attr('data-target');
            let lable = $('#'+target).attr('data-lable');
            if($(this).val() == 'yes') {
                $('#'+target).attr('multiple', true).attr('name', lable+"[]")
            }
            else {
                $('#'+target).attr('multiple', false).attr('name', lable)
            }
        });

        $(document).on('click', '.page-link', function(e){
            e.preventDefault();
            let href = $(this).attr('href');
            let data = $('.card-body form').serialize();
            href = href+"&"+data;
            window.location.href = href;
        })
        </script>
        
        <div class="container">
        @yield('content')
    </div>
        
        
</body>

</html>
