@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Doctor Profile'])

<div id="alert">
    @include('components.alert')
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-profile">
              
                <!-- <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                                class="ni ni-collection"></i></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                                class="ni ni-email-83"></i></a>
                    </div>
                </div> -->
                <div class="card-body ">
                <div class="text-center">
                    <img src="{{asset(($data->profile ?? ''))}}" alt=" Image placeholder" class="doctor-profile">
                </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">{{count($data->doctorHospitals)}}</span>
                                    <span class="text-sm opacity-8">Total Hospitals</span>
                                </div>
                                
                                <!-- <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">89</span>
                                    <span class="text-sm opacity-8">Comments</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h5>
                            {{$data->name}}
                        </h5>
                        <!-- <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$data->name}}
                        </div> -->
                        <div class="h6 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>{{$data->fullAddress()}}
                        </div>
                        <!-- <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row gx-4">


                        <div class="col-12 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{route('doctors.show', $data->id)}}?tab=info"
                                            class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-app"></i>
                                            <span class="ms-2">Basic Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('doctors.show', $data->id)}}?tab=times"
                                            class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center">
                                            <i class="ni ni-app"></i>
                                            <span class="ms-2">Hospital & Times</span>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{route('doctors.show', $data->id)}}?tab=speciality"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span class="ms-2">Speciality</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!isset($request['tab']) || (isset($request['tab']) && $request['tab'] == 'info'))
            <div class="card mt-3">

                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Basic Details</p>
                        <!-- <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" value="{{$data->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Contact No.</label>
                                <input class="form-control" value="{{$data->contact_no}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email Id</label>
                                <input class="form-control" value="{{$data->email_id}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Consultation Fee</label>
                                <input class="form-control" value="{{$data->fee}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Qualification</label>
                                <input class="form-control" value="{{$data->qualification}}" disabled>
                            </div>
                        </div>

                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Address Information</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <input class="form-control" value="{{$data->address}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <input class="form-control" value="{{$data->city}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">State</label>
                                <input class="form-control" value="{{$data->state}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Country</label>
                                <input class="form-control" value="{{$data->country}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Pincode</label>
                                <input class="form-control" value="{{$data->pincode}}" disabled>
                            </div>
                        </div>


                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">About</p>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $data->about!!}
                        </div>
                     
                    </div>

                </div>
            </div>
            @elseif(isset($request['tab']) && $request['tab'] == 'times')
            <div class="card mt-3">

                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Timing Details</p>

                    </div>
                </div>
                <div class="card-body">
                    @foreach($data->doctorHospitals as $hospital)
                        @if($hospital->hospital)
                            <h5>Hospital : {{$hospital->hospital->name ?? ''}} ({{$hospital->hospital->fullAddress()}})</h5>
                            <div class="table-reponsive">
                                <table class="table">
                                    <thead>
                                        <th>Day</th>
                                        <th>Opening Time</th>
                                        <th>Closing Time</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="time-list">
                                        @if(!empty($hospital->times))
                                        @foreach(json_decode($hospital->times, true) as $item)
                                        <tr>
                                        <td>
                                        <input name="day[]" class="form-control" value="{{$item['day']}}" disabled>

                                    </td>
                                    <th>
                                        <input type="time" name="opening_time[]" class="form-control"
                                            value="{{$item['start_time']}}" disabled>
                                    </th>
                                    <th>
                                        <input type="time" name="closing_time[]" class="form-control"
                                            value="{{$item['end_time']}}" disabled>
                                    </th>

                                        </tr>
                                        @endforeach
                                        @endif


                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
           
            @elseif(isset($request['tab']) && $request['tab'] == 'speciality')
            <div class="card mt-3">
            <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Specialities</p>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                               
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data->specialities as $item)

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
                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                               
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @endif


        </div>

    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection