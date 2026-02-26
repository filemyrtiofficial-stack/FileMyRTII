
@extends('email.layout')
@section('content')
<p>Dear {{$data->rtiApplication->lawyer['first_name']}} {{$data->rtiApplication->lawyer['last_name']}},</p>
@if($data->rtiApplication->appeal_no == 0)

    <p>The customer has requested modifications to their RTI draft **(Application No: {{$data->rtiApplication->application_no}})**. Please review the requested changes and update the RTI draft accordingly.</p>


    <div class="btn-container">
        <a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Review & Update RTI Draft</a>
    </div>


@elseif($data->rtiApplication->appeal_no == 1)

   
    <p>The customer has provided modifications for the first appeal draft for RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong>. Please review the provided details and proceed with updating your draft accordingly.</p>
    
    <div class="btn-container">
      <a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Review Modifications</a>
    </div>
    
    <p>If you need any clarification, please reach out to the admin for further details.</p>
    

@elseif($data->rtiApplication->appeal_no == 2)

    <p>The customer has provided modifications for the second appeal draft for RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong>. Please review the provided details and proceed with updating your draft accordingly.</p>
    
    <div class="btn-container">
      <a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Review Modifications</a>
    </div>
    
    <p>If you need any clarification, please reach out to the admin for further details.</p>
    

@endif

@endsection