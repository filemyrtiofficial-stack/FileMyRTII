@extends('email.layout')
    @section('content')
    <p>Dear Admin,</p>
    @if($data->rtiApplication->appeal_no == 0)
        <p>The lawyer **{{$data->rtiApplication->lawyer->first_name. " ".$data->rtiApplication->lawyer->last_name}}** working on **RTI Application No: {{$data->rtiApplication['application_no']}}** has requested additional information from the customer.</p>

        <p><strong>Details of Missing Information:</strong> {{$data->message}}</p>

        <p>No action is required from you at this time. This is just for your reference.</p>


    @elseif($data->rtiApplication->appeal_no == 1)

        <p>The lawyer **{{$data->rtiApplication->lawyer->first_name. " ".$data->rtiApplication->lawyer->last_name}}** working on **RTI Application No: {{$data->rtiApplication['application_no']}}** has requested additional information from the customer.</p>

        <p><strong>Details of Missing Information:</strong> {{$data->message}}</p>

        <p>No action is required from you at this time. This is just for your reference.</p>

    @else

        <p>This is to inform you that we have requested additional information from the customer for their Second Appeal on RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong>.</p>
        
        <p><strong>Requested Details:</strong></p>
        <p>{{$data->message}}</p>
        
        <div class="btn-container">
        <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?query={{$data->id}}" class="btn ">View Requested Information</a>
        </div>
        
        <p>Please follow up with the customer if necessary.</p>


    @endif
@endsection