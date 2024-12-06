@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Hospital Profile'])

<div id="alert">
    @include('components.alert')
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="{{asset(($data->hospitalPrimaryImage->image ?? ''))}}" alt=" Image
                    placeholder" class="card-img-top">
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
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">22</span>
                                    <span class="text-sm opacity-8">Total Doctors</span>
                                </div>
                                <div class="d-grid text-center mx-4">
                                    <span class="text-lg font-weight-bolder">10</span>
                                    <span class="text-sm opacity-8">Photos</span>
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
                            <i class="ni business_briefcase-24 mr-2"></i>{{$data->address}} {{$data->city}}
                            {{$data->state}} {{$data->country}} {{$data->pincode}}
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
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=info"
                                            class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-app"></i>
                                            <span class="ms-2">Basic Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=times"
                                            class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center">
                                            <i class="ni ni-app"></i>
                                            <span class="ms-2">Times</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=contact-person"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-email-83"></i>
                                            <span class="ms-2">Contact Person</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=doctors"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center ">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span class="ms-2">Doctors</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=gallery"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span class="ms-2">Gallery</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=speciality"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span class="ms-2">Speciality</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('hospitals.show', $data->id)}}?tab=ambulance"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                            data-bs-toggle="tab">
                                            <i class="ni ni-settings-gear-65"></i>
                                            <span class="ms-2">Ambulance</span>
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
                                <input class="form-control" value="{{$data->contact_nos}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email Id</label>
                                <input class="form-control" value="{{$data->email_id}}" disabled>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Latitude</label>
                                <input class="form-control" value="{{$data->latitude}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Longitude</label>
                                <input class="form-control" value="{{$data->longitude}}" disabled>
                            </div>
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
                    <div class="table-reponsive">
                        <table class="table">
                            <thead>
                                <th>Day</th>
                                <th>Opening Time</th>
                                <th>Closing Time</th>
                                <th></th>
                            </thead>
                            <tbody id="time-list">
                                @if(isset($data) && count($data->hospitalTimes) > 0)
                                @foreach($data->hospitalTimes as $item)
                                <tr>
                                    <td>
                                        <input name="daya[]" class="form-control" value="{{$item->day}}" disabled>

                                    </td>
                                    <th>
                                        <input type="time" name="opening_time[]" class="form-control"
                                            value="{{$item->opening_time}}" disabled>
                                    </th>
                                    <th>
                                        <input type="time" name="closing_time[]" class="form-control"
                                            value="{{$item->closing_time}}" disabled>
                                    </th>

                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            @elseif(isset($request['tab']) && $request['tab'] == 'contact-person')

            <div class="card mt-3">

                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Contact Person</p>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Contact No.</th>
                            </thead>
                            <tbody id="contact-list">
                                @if(isset($data) && count($data->hospitalContactPerson) > 0)
                                @foreach($data->hospitalContactPerson as $item)
                                <tr>
                                    <td>
                                        <input name="contact_person_name[]" class="form-control" value="{{$item->name}}"
                                            disabled>
                                    </td>
                                    <th>
                                        <input type="text" name="contact_no[]" class="form-control"
                                            value="{{$item->contact}}" disabled>
                                    </th>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            @elseif(isset($request['tab']) && $request['tab'] == 'ambulance')

                <div class="card mt-3">

                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Ambulance</p>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-reponsive">
                            <table class="table">
                                <thead>
                                    <th>AMbulance No.</th>
                                    <th>Name</th>
                                    <th>Contact No.</th>
                                </thead>
                                <tbody id="contact-list">
                                    @if(isset($data) && count($data->ambulances) > 0)
                                    @foreach($data->ambulances as $item)
                                    <tr>
                                    <td>
                                            <input name="contact_person_name[]" class="form-control" value="{{$item->ambulance_no}}"
                                                disabled>
                                        </td>
                                        <td>
                                            <input name="contact_person_name[]" class="form-control" value="{{$item->contact_person}}"
                                                disabled>
                                        </td>
                                        <th>
                                            <input type="text" name="contact_no[]" class="form-control"
                                                value="{{$item->contact_no}}" disabled>
                                        </th>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

            @elseif(isset($request['tab']) && $request['tab'] == 'doctors')
            @elseif(isset($request['tab']) && $request['tab'] == 'gallery')
            <div class=" mt-3">
                <div class="row">
                    @foreach($data->hospitalGalleryImage as $img)
                        <div class="col-md-3 card m-2">
                            <div class="card-body">
                                <img src="{{asset($img->image)}}" alt="" class="w-100">
                            </div>
                        </div>
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