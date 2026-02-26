@extends('email.layout')
    @section('content')
<p>Dear Admin,</p>
@if($data->rtiApplication['appeal_no'] == 0)

    <p>The customer has provided additional details for **RTI Application No: {{$data->rtiApplication['application_no']}}**.</p>

    <p><strong>Updated Information:</strong></p>
    <p><strong>Query : </strong>{{$data->message}}</p>
    <p><strong>Reply : </strong>{{$data->reply}}</p>


    <p>No action is required from you at this time. This is just for your reference.</p>

@elseif($data->rtiApplication['appeal_no'] == 1)
<p>The customer has submitted modifications for their first appeal for RTI Application No: <strong>{{$data->rtiApplication['application_no']}}</strong>.</p>
    <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?query={{$data->id}}">View Appeal Details</a></div>
    <p>This is for your information. Please follow up if necessary.</p>

@elseif($data->rtiApplication['appeal_no'] == 2)
    
    <p>The customer has submitted modifications for their second appeal for RTI Application No: <strong>{{$data->rtiApplication['application_no']}}</strong>.</p>
    <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?query={{$data->id}}">View Appeal Details</a></div>
    <p>This is for your information. Please follow up if necessary.</p>

@endif
@endsection
