@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                  <form action="">
                            <div class="row">
                                    <div class="col-md-3">
                                            <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{$_GET['name'] ?? ''}}">
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
                <a href="{{route('service-template.create', $service->id)}}" class="btn btn-primary float-end">Add Template</a>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Create Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Preview
                                </th>
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
                                       
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->template_name}}</h6>
                                        </div>
                                    </div>
                                </td>
                              
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="text-center">
                                    <a href="">View</a>
                                </td>
                                <td class="align-middle text-center">
                                   
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('service-template.edit', [$service->id, $item->id])}}">Edit</a>
                                        <a href="{{route('service-template.destroy', [$service->id, $item->id])}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
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