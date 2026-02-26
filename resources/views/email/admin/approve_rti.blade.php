

@extends('email.layout')
@section('content')
<p>Dear Admin,</p>
@if($data->appeal_no == 0)
    
    <p>The customer has approved their RTI draft **(Application No: {{$data['application_no']}})**. The lawyer will now proceed with filing the RTI with the concerned government authority.</p>
    <p>You can review the approved RTI draft using the button below:</p>
    <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->id)}}">Review Approved RTI Draft</a></div>
    <p>No further action is required unless you wish to intervene.</p>

@elseif($data->appeal_no == 1)

    <p>The customer has approved the First Appeal for RTI Application No: {{$data['application_no']}}.</p>
    <p>This email is for your information. You may review the First Appeal request at any time by clicking the button below.</p>
    <div class="btn-container">
      <a href="{{route('rtiapplication.view', $data->id)}}" class="btn ">Access First Appeal Request</a>
    </div>
    <p>Thank you for staying updated.</p>

@elseif($data->appeal_no == 2)

    <p>This is an FYI that the customer has approved the second appeal for RTI Application No: <strong>{{$data['application_no']}}</strong>. The appeal will now be filed within the next <strong>2–3 business days</strong>.</p>
    <div class="btn-container">
      <a href="{{route('rtiapplication.view', $data->id)}}" class="btn ">Review Appeal Details</a>
    </div>
    <p>Thank you for monitoring this process.</p>
@endif

@endsection
