@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Doctor Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-11 mt-lg-0 mt-4">
        <form method="POST"
            action="{{isset($data['id']) ? route('doctors.update', $data['id']) : route('doctors.store')}}"
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
                                    placeholder="Name" value="{{$data['name'] ?? ''}}">
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
                            <label class="form-label">Contact No.</label>
                            <div class="input-group">
                                <input id="contact_nos" name="contact_no" class="form-control" type="text"
                                    placeholder="contact_no" value="{{$data['contact_no'] ?? ''}}">
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
                            <label class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <input id="dob" name="dob" class="form-control" type="date" value="{{$data['dob'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Consultation Fee</label>
                            <div class="input-group">
                                <input id="fee" name="fee" class="form-control" type="text"  value="{{$data['fee'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Qualification</label>
                            <div class="input-group">
                                <input id="qualification" name="qualification" class="form-control" type="text"
                                    placeholder="Qualification" value="{{$data['qualification'] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">About</label>
                            <div class="input-group">
                                <textarea id="about" name="about" class="form-control">{{$data['about'] ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label class="form-label">Profile Image</label>
                            <div class="input-group">
                                <input id="profile" name="profile" class="form-control dropify" type="file"
                                    placeholder="profile" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header list-header">
                    <h5>Hospital Time</h5>
                </div>
                <div class="card-body table-reponsive">
                    <div class="doctor-hospital">
                        
                        @if(isset($data['id']))
                            @if($data->doctorHospitals)
                                @foreach($data->doctorHospitals as $index => $doctor_hospital) 
                                
                                <div class="hospital_profile">
                                    <div class="row">
                                        <div class="col-md-8">
            
                                            <select name="hospital[]" class="select2 form-control">
                                                @foreach($hospitals as $hospital)
                                                    <option value="{{$hospital->id}}" @if($doctor_hospital->hospital_id == $hospital->id) selected @endif>{{$hospital->name}} ({{$hospital->fullAddress()}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-sm btn-secondary add-more-time" data-index="{{$index}}">Add More Time</button>
                                            <button type="button" class="btn btn-sm btn-danger remove-hospital" >Remove Hospital</button>

                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th></th>
                                        </thead>
                                        <tbody class="time-list">
                                            @if(!empty($doctor_hospital->times))
                                                @foreach(json_decode($doctor_hospital->times, true) as $time)
                                                    <tr>
                                                        <td>
                                                            <select name="{{$index}}_day[]" class="form-control days" required>
                                                                @foreach(daysList() as $day)
                                                                <option value="{{$day}}" @if($time['day'] == $day) selected @endif>{{$day}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <th>
                                                            <input type="time" name="{{$index}}_start_time[]" class="form-control start_time" value="{{$time['start_time']}}">
                                                        </th>
                                                        <th>
                                                            <input type="time" name="{{$index}}_end_time[]" class="form-control end_time" value="{{$time['end_time']}}">
                                                        </th>
                                                        <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                                                    class="fa fa-trash"></i></button></th>
                        
                                                    </tr>
                                                @endforeach
                                            @endif
                
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            @endif
                        @else
                        <div class="hospital_profile">
                            <div class="row">
                                <div class="col-md-8">
    
                                    <select name="hospital[]" class="select2 form-control">
                                        @foreach($hospitals as $hospital)
                                            <option value="{{$hospital->id}}">{{$hospital->name}} ({{$hospital->fullAddress()}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-sm btn-secondary add-more-time" data-index="0">Add More Time</button>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th></th>
                                </thead>
                                <tbody class="time-list">
                                    <tr>
                                        <td>
                                            <select name="0_day[]" class="form-control days" required>
                                                @foreach(daysList() as $day)
                                                <option value="{{$day}}">{{$day}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <th>
                                            <input type="time" name="0_start_time[]" class="form-control start_time">
                                        </th>
                                        <th>
                                            <input type="time" name="0_end_time[]" class="form-control end_time">
                                        </th>
                                        <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                                    class="fa fa-trash"></i></button></th>
        
                                    </tr>
        
                                </tbody>
                            </table>
                        </div>
                        @endif
                        
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary add-more-hospital">Add More Hospital</button>
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
           
            <div class="mt-5 text-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')
<script>
    var days_list = '<?php
        $list = "";
        foreach(daysList() as $day) {

            $list .= '<option value="'.$day.'">'.$day.'</option>';
        }
        echo $list;
        ?>';
$(document).on('click', '.remove-hospital', function(e){
    $(this).parents().eq(2).remove();
    let counter = 0
    $('.hospital_profile').each(function(){
        $(this).find('.add-more-time').attr('data-index', counter);
        $(this).find('.days').attr('name', counter+"_day[]");
        $(this).find('.start_time').attr('name', counter+"_start_time[]");
        $(this).find('.end_time').attr('name', counter+"_end_time[]");
        counter = counter+1;
    });
})
$(document).on('click', '.add-more-hospital', function(e){
    let hospital_list = '<?php
        $list = "";
        foreach($hospitals as $hospital) {

            $list .= '<option value="'.$hospital->id.'">'.$hospital->name.' ('.$hospital->fullAddress().')</option>';
        }
        echo $list;
        ?>';

        
        

        $('.doctor-hospital').append(`<div class="hospital_profile">

                            <div class="row">
                                <div class="col-md-8">
    
                                    <select name="hospital[]" class="select2 form-control">
                                        ${hospital_list}
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-sm btn-secondary add-more-time">Add More Time</button>
                                    <button type="button" class="btn btn-sm btn-danger remove-hospital" data-index="0">Remove Hospital</button>

                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th></th>
                                </thead>
                                <tbody class="time-list">
                                    <tr>
                                        <td>
                                            <select name="day[]" class="form-control days" required>
                                                    ${days_list}
                                            </select>
                                        </td>
                                        <th>
                                            <input type="time" name="start_time[]" class="form-control start_time">
                                        </th>
                                        <th>
                                            <input type="time" name="end_time[]" class="form-control end_time">
                                        </th>
                                        <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                                    class="fa fa-trash"></i></button></th>
        
                                    </tr>
        
                                </tbody>
                            </table>
                        </div>`);

    let counter = 0
    $('.hospital_profile').each(function(){
        $(this).find('.add-more-time').attr('data-index', counter);
        $(this).find('.days').attr('name', counter+"_day[]");
        $(this).find('.start_time').attr('name', counter+"_start_time[]");
        $(this).find('.end_time').attr('name', counter+"_end_time[]");
        counter = counter+1;
    });
});

$(document).on('click', '.add-more-contact', function(e) {
    $('#contact-list').append(`<tr>
                                <td>
                                    <input name="contact_person_name[]" class="form-control">
                                </td>
                                <th>
                                    <input type="textp" name="contact_no[]" class="form-control">
                                </th>

                                <th><button class="btn btn-sm btn-danger remove-time-item"><i
                                            class="fa fa-trash"></i></button></th>

                            </tr>`);
})
$(document).on('click', '.add-more-time', function(e) {
    let index = $(this).attr('data-index');
    $(this).parents().eq(2).find('.time-list').append(`<tr>
                                <td>
                                    <select name="${index}_day[]" class="form-control days">
                                        ${days_list}
                                    </select>
                                </td>
                                <th>
                                    <input type="time" name="${index}_start_time[]" class="form-control start_time">
                                </th>
                                <th>
                                    <input type="time" name="${index}_end_time[]" class="form-control end_time">
                                </th>
                                <th><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></th>
                            </tr>`);
})
$(document).on('click', '.remove-time-item', function() {
    $(this).parents().eq(1).remove();

})
</script>
@endpush