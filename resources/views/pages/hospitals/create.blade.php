@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Hospital Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-11 mt-lg-0 mt-4">
        <form method="POST"
            action="{{isset($data['id']) ? route('hospitals.update', $data['id']) : route('hospitals.store')}}"
            enctype="multipart/form-data" class="form-submit" method="post">
            @csrf
            @if(isset($data['id']))
            <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Basic Information</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input id="name" name="name" class="form-control" type="text"
                                    placeholder="Hospital Name" value="{{$data['name'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Address</label>
                            <div class="input-group">
                                <input id="address" name="address" class="form-control" type="text"
                                    placeholder="address" value="{{$data['address'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">City</label>
                            <div class="input-group">
                                <input id="city" name="city" class="form-control" type="text" placeholder="city"
                                    value="{{$data['city'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">State</label>
                            <div class="input-group">
                                <input id="state" name="state" class="form-control" type="text" placeholder="state"
                                    value="{{$data['state'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Country</label>
                            <div class="input-group">
                                <input id="country" name="country" class="form-control" type="text"
                                    placeholder="country" value="{{$data['country'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Pincode</label>
                            <div class="input-group">
                                <input id="pincode" name="pincode" class="form-control" type="text"
                                    placeholder="pincode" value="{{$data['pincode'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <select name="status" id="status" class="form-control">
                                    @foreach(commonStatus() as $key => $item)
                                    <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                        selected @endif>
                                        {{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Latitude</label>
                            <div class="input-group">
                                <input id="latitude" name="latitude" class="form-control" type="text"
                                    placeholder="Latitude" value="{{$data['latitude'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Longitude</label>
                            <div class="input-group">
                                <input id="longitude" name="longitude" class="form-control" type="text"
                                    placeholder="Longitude" value="{{$data['longitude'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Contact No.</label>
                            <div class="input-group">
                                <input id="contact_nos" name="contact_nos" class="form-control" type="text"
                                    placeholder="contact_no" value="{{$data['contact_nos'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Email Id</label>
                            <div class="input-group">
                                <input id="email_id" name="email_id" class="form-control" type="text"
                                    placeholder="Emails" value="{{$data['email_id'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Home Service Available</label>
                            <div class="input-group">
                                <select name="home_service" id="home_service" class="form-control">
                                    @foreach(BooleanList() as $key => $item)
                                    <option value="{{$key}}" @if(isset($data['home_service']) && $data['home_service']==$key)
                                        selected @endif>
                                        {{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Primary Image</label>
                            <div class="input-group">
                                <input id="primary_image" name="primary_image" class="form-control dropify" type="file"
                                    placeholder="primary_image" value="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Hospital Time</h5>
                </div>
                <div class="card-body table-reponsive">
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
                                    <select name="day[]" class="form-control" required> 
                                        @foreach(daysList() as $day)
                                        <option value="{{$day}}" @if($item->day == $day) selected @endif>{{$day}}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <th>
                                    <input type="time" name="opening_time[]" class="form-control"
                                        value="{{$item->opening_time}}" required>
                                </th>
                                <th>
                                    <input type="time" name="closing_time[]" class="form-control"
                                        value="{{$item->closing_time}}" required>
                                </th>
                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endforeach
                            @elseif(!isset($data['id']))
                            <tr>
                                <td>
                                    <select name="day[]" class="form-control" required>
                                        @foreach(daysList() as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <th>
                                    <input type="time" name="opening_time[]" class="form-control">
                                </th>
                                <th>
                                    <input type="time" name="closing_time[]" class="form-control">
                                </th>
                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endif

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-secondary add-more-time">Add More Time</button>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Contact People</h5>
                </div>
                <div class="card-body table-reponsive">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Contact No.</th>
                            <th></th>
                        </thead>
                        <tbody id="contact-list">
                            @if(isset($data) && count($data->hospitalContactPerson) > 0)
                            @foreach($data->hospitalContactPerson as $item)
                            <tr>
                                <td>
                                    <input name="contact_person_name[]" class="form-control" value="{{$item->name}}" required>
                                </td>
                                <th>
                                    <input type="text" name="contact_no[]" class="form-control"
                                        value="{{$item->contact}}" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endforeach
                            @elseif(!isset($data['id']))
                            <tr>
                                <td>
                                    <input name="contact_person_name[]" class="form-control" required>
                                </td>
                                <th>
                                    <input type="text" name="contact_no[]" class="form-control" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-secondary add-more-contact">Add More Contact
                        Person</button>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Ambulances</h5>
                </div>
                <div class="card-body table-reponsive">
                    <table class="table">
                        <thead>
                            <th>Ambulance No.</th>
                            <th>Name</th>
                            <th>Contact No.</th>
                            <th></th>
                        </thead>
                        <tbody id="ambulance-list">
                            @if(isset($data) && count($data->ambulances) > 0)
                            @foreach($data->ambulances as $item)
                            <tr>
                                <td>
                                    <input name="ambulance_no[]" class="form-control" value="{{$item->ambulance_no}}" required>
                                </td>
                                <td>
                                    <input name="contact_person_name[]" class="form-control" value="{{$item->contact_person}}" required>
                                </td>
                                <th>
                                    <input type="text" name="contact_no[]" class="form-control"
                                        value="{{$item->contact_no}}" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endforeach
                            @elseif(!isset($data['id']))
                            <tr>
                                <td>
                                    <input name="ambulance_no[]" class="form-control" required>
                                </td>
                                <td>
                                    <input name="ambulance_contact_person_name[]" class="form-control" required>
                                </td>
                                <th>
                                    <input type="text" name="ambulance_contact_no[]" class="form-control" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-secondary add-more-ambulance">Add More Ambulance</button>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Speciality</h5>
                </div>
                <div class="card-body table-reponsive">
                    <div class="col-12 mt-3">
                        <div class="input-group">
                            <select id="specilities" name="specilities[]" multiple class="form-control select-2">
                                @foreach($specialization as $item)
                                <option value="{{$item->id}}" @if(isset($specialization_ids) && in_array($item->id,
                                    $specialization_ids)) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Images</h5>
                </div>
                <div class="card-body table-reponsive">
                    <input type="file" name="galleries[]" class="dropify1" multiple id="galleries">
                </div>
            </div>
            <div class="mt-5 text-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).on('click', '.add-more-ambulance', function(e) {
        $('#ambulance-list').append(`<tr>
         <td>
                                    <input name="ambulance_no[]" class="form-control" required>
                                </td>
                                <td>
                                    <input name="ambulance_contact_person_name[]" class="form-control" required>
                                </td>
                                <th>
                                    <input type="text" name="ambulance_contact_no[]" class="form-control" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>`);
    })
$(document).on('click', '.add-more-contact', function(e) {
    $('#contact-list').append(`<tr>
                                <td>
                                    <input name="contact_person_name[]" class="form-control" required>
                                </td>
                                <th>
                                    <input type="textp" name="contact_no[]" class="form-control" required>
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>`);
})
$(document).on('click', '.add-more-time', function(e) {
    let days_list = '<?php
        $list = "";
        foreach(daysList() as $day) {

            $list .= '<option value="'.$day.'">'.$day.'</option>';
        }
        echo $list;
        ?>';
    $('#time-list').append(`<tr>
                                <td>
                                    <select name="day[]" class="form-control" required>
                                        ${days_list}
                                    </select>
                                </td>
                                <th>
                                    <input type="time" name="opening_time[]" class="form-control" required>
                                </th>
                                <th>
                                    <input type="time" name="closing_time[]" class="form-control" required>
                                </th>
                                <th><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></th>
                            </tr>`);
})
$(document).on('click', '.remove-time-item', function() {
    $(this).parents().eq(1).remove();

})
</script>
@endpush