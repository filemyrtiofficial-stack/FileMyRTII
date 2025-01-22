@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
                <div class="card-body">
                      <form action="">
                                <div class="row">
                                        <div class="col-md-3">
                                                <input type="text" name="search" class="form-control" placeholder="Search By Email/Name/contact no." value="{{$_GET['search'] ?? ''}}">
                                        </div>
                                        <div class="col-md-3">
                                        <select  name="service_id" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach(App\Models\Service::list(false) as $item)
                                                        <option value="{{$item->id ?? ''}}" {{isset($_GET['service_id']) && $_GET['service_id'] == $item->id ? 'selected' : ''}}>{{$item->name ?? ''}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select  name="lawyer_id" class="form-control">
                                                <option value="">Select Lawyer</option>
                                                @foreach(App\Models\Lawyer::list(false) as $item)
                                                        <option value="{{$item->id ?? ''}}" {{isset($_GET['lawyer_id']) && $_GET['lawyer_id'] == $item->id ? 'selected' : ''}}>{{$item->first_name ?? ''}} {{$item->last_name ?? ''}}</option>
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
                <h4>RTI Applications</h4>
                {{-- <a href="{{route('testimonials.create')}}" class="btn btn-primary float-end">Add Testimonial</a> --}}
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Name   </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                                </th>
                               
                                
                                
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number   </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Application No   </th>
                              
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Service Name   </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Service Category </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Payment Status </th>
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
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->first_name}} {{$item->last_name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->email}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->phone_number}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->application_no}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->service->name ?? ($item->service_id == 0 ? "Custom Request" : '')}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->serviceCategory->name ?? ''}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->payment_status ?? ''}}</h6>
                                        </div>
                                    </div>
                                </td>

                                  <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{applicationStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                   
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('rtiapplication.view', $item->id)}}">View</a>
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