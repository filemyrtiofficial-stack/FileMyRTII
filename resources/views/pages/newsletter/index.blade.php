@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Newletter'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
                <div class="card-body">
                      <form action="">
                                <div class="row">
                                        <div class="col-md-3">
                                                <input type="text" name="email" class="form-control" placeholder="Search By Email" value="{{$_GET['email'] ?? ''}}">
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
                <h4>Newletter</h4>
                {{-- <a href="{{route('testimonials.create')}}" class="btn btn-primary float-end">Add Testimonial</a> --}}
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                {{-- <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->email}}</h6>
                                        </div>
                                    </div>
                                </td>
                                

                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
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