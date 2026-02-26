@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Mail Template</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Mail Template'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                  <form action="" id="search-form">
                            <div class="row">
                                    <div class="col-md-3">
                                            <input type="text" name="search" class="form-control" placeholder="Search By Name/Subject" value="{{$_GET['search'] ?? ''}}">
                                    </div>
                      
                                    
                                    <div class="col-12">
                                            <button class="btn btn-sm btn-primary float-right">Filter</button>

                                    </div>
                            </div>
                  </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mailTemplatePopup">
 Add New
</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
             
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <h6 class="mb-0 text-sm">{{ stringLimit($item->name, 20) }}</h6>

                                </td>
                                <td>
                                    <h6 class="mb-0 text-sm">{{ stringLimit($item->subject, 20) }}</h6>

                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                               
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary" href="{{route('customers.index')}}?operation=send-mail&mail_template={{encryptString($item->id)}}">Send Mail</a>
                                            <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary ml-2"
                                            data-toggle="modal" data-target="#mailTemplatePopup-{{$item->id}}">Edit</a>
                                        <!-- <a href="#"
                                        class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary ml-2" disabled>Delete</a>
                                        -->
                                    </div>
                                </td>
                              
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $list->links('pagination::bootstrap-4') }}
        </div>
        @include('pages.customers.mail-template.popup')
        @foreach($list as $item)
            @include('pages.customers.mail-template.edit-popup')

        @endforeach
</div>
@endsection
