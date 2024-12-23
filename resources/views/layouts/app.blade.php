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
    </style>
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
        @yield('content')
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer>  -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

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

<script>
 

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
        </script>
</body>

</html>

