@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Service category</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Category Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                  <form action="" id="search-form">
                            <div class="row">
                                    <div class="col-md-3">
                                            <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{$_GET['name'] ?? ''}}">
                                    </div>
                                    <div class="col-md-3">
                                            <select  name="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach(commonStatus() as $key =>  $value)
                                                            <option value="{{$key}}" {{isset($_GET['status']) && $_GET['status'] == $key ? 'selected' : ''}}>{{$value['name'] ?? ''}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                    <div class="col-12">
                                            <button class="btn btn-sm btn-primary float-right">Filter</button>
                                    </div>
                            </div>
                  </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Service Category</h4>
                @if(auth()->user()->can('Create Service category'))
                <a href="{{route('service-category.create')}}" class="btn btn-primary float-end">Add
                Service Category</a>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                    @if(auth()->user()->can('Edit Service category') || auth()->user()->can('Delete Service category') )
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                                    @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit Service category') || auth()->user()->can('Delete Service category') )
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        @if(auth()->user()->can('Edit Service category'))
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('service-category.edit', $item->id)}}">Edit</a>
                                        @endif
                                        @if(auth()->user()->can('Delete Service category'))
                                        <a href="{{route('service-category.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
                                        @endif
                                    </div>
                                </td>
                                @endif
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
</div>
@endsection