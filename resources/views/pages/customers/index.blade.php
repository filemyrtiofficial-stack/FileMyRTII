@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item active" aria-current="page">Customer</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Customer Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header">
                <a class="btn btn-sm btn-secondary" href="{{route('mail-template.index')}}">Mail Template List</a>
            </div>
            <div class="card-body">
                  <form action="" id="search-form">
                        @if(session()->has('mail-error'))
                        <div class="alert alert-danger" role="alert">
                            {{session()->get('mail-error')}}
                            </div>
                        @elseif(session()->has('mail-success'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('mail-success')}}
                            </div>
                        @endif

                            <div class="row">
                                @if(isset($_GET['operation']))
                                <input type="hidden" id="operation" name="operation" value="{{$_GET['operation'] ?? ''}}">
                                @endif
                                @if(isset($_GET['operation']))
                                <input type="hidden" id="mail_template" name="mail_template" value="{{$_GET['mail_template'] ?? ''}}">
                                @endif
                                    <div class="col-md-3">
                                            <input type="text" name="search" class="form-control" placeholder="Search By Name/Email/Contact Number" value="{{$_GET['search'] ?? ''}}">
                                    </div>
                                   
                                    
                                    <div class="col-12">

                                            <button class="btn btn-sm btn-primary float-right filter-data">Filter</button>
                                            <a href="{{route('customer.export')}}?search={{$_GET['search'] ?? ''}}" class="btn btn-sm btn-secondary float-right">Export</a>

                                    </div>
                            </div>
                  </form>
            </div>
        </div>
        <form action="{{route('send-mail')}}" method="post">
            @csrf
            @if(isset($_GET['operation']))
            <input type="hidden" name="operation" value="{{$_GET['operation'] ?? ''}}">
            @endif
            @if(isset($_GET['operation']))
            <input type="hidden" name="mail_template" value="{{$_GET['mail_template'] ?? ''}}">
            @endif
            <div class="card mb-4">
                <div class="card-header list-header">
                    
                    <h4>Customer</h4>
                @if(isset($_GET['operation']) && $_GET['operation'] == 'send-mail')
                     <div>
                    <button class="btn btn-primary float-end">Send Mail</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mailTemplatePopup">View Mail Template</button>
                    @include('pages.customers.mail-template.mail-popup')    
                    </div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Number
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email ID
                                    </th>
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total RTI</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody id="customer-list">
                               
    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="pagination-list" class="text-center">
        </div>
        <div id="edit-popup">

         
              @include('pages.customers.edit-popup')
        </div>
</div>

@endsection
@push('js')
<script>

   function getUser(page) {
        let data = $('#search-form').serialize()+"&operation=filter&page="+page;
        $.ajax({
            url : '{{route("customers.index")}}',
            data : data,
            dataType : 'json',
            success : function(response) {
                $('#customer-list').append(response.html);
                $('#pagination-list').html(response.pagination);
                $('#edit-popup').html(response.edit_form);
            }
        });
    }
getUser(1);

$(document).on('click', '.go-to-page', function(e){
    e.preventDefault();
    let page = $(this).attr('data-page');
        getUser(page);
});

function getParameterByName(name, url) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
    </script>

<script>
    // When the master checkbox is toggled
    $('#select-all').on('change', function () {
        $('.item-checkbox').prop('checked', this.checked);
    });

    // Optional: Update master checkbox when any item is unchecked/checked
    $('.item-checkbox').on('change', function () {
        if ($('.item-checkbox:checked').length === $('.item-checkbox').length) {
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }
    });
</script>
@endpush