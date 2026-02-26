@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Services</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
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
                                        <select  name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach(App\Models\ServiceCategory::list(false) as $item)
                                                        <option value="{{$item->id ?? ''}}" {{isset($_GET['category_id']) && $_GET['category_id'] == $item->id ? 'selected' : ''}}>{{$item->name ?? ''}}</option>
                                                @endforeach
                                        </select>
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
            <div class="card-header  list-header">
                <h4>Service</h4>
                @if(auth()->user()->can('Create Service'))
                <a href="{{route('services.create')}}" class="btn btn-primary float-end">Add Service</a>
                @endif
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div>
                                            <img src="{{ asset($item->icon) }}" class="avatar me-3"
                                                alt="image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">{{$item->slug->slug ?? ''}}</td>
                                <td class="align-middle text-sm">{{$item->category->name ?? ''}}</td>

                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="align-middle text-end">
                                    
                               
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    @if(auth()->user()->can('Manage Service Template'))
                                    <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary" href="{{route('service-template.index',$item->id)}}">Template</a>
                                    @endif
                                    <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                    href="{{route('frontend.service',[$item->category->slug->slug ?? '', $item->slug->slug ?? ''])}}" target="blank">View</a>
                                    @if(auth()->user()->can('Edit Service'))
                                    <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                    href="{{route('service-field.index',$item->id)}}">Fields</a>

                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('services.edit', $item->id)}}">Edit</a>
                                    @endif
                                    @if(auth()->user()->can('Delete Service'))
                                        <a href="{{route('services.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
                                    @endif
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
</div>
@endsection