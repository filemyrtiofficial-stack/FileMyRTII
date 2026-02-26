
@extends('email.layout')
@section('content')

    <p>Dear Admin,</p>
    @if($data->rtiApplication->appeal_no == 0)

        <p>The RTI application **(Application No: {{$data->rtiApplication->application_no}})** that was assigned to **{{$data->rtiApplication->lawyer->first_name." ".$data->rtiApplication->lawyer->last_name}}** has been reassigned back to you.</p>

        <p><strong>Reason Provided by Lawyer:</strong> {{!empty($data->message) ? $data->message : "Reason not Provided by lawyer"}} </p>

        <p>📅 **Reassignment Date & Time:** {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y g:i A')}}</p>

        <p>Action Required: Please review the RTI and assign it to another lawyer if necessary.</p>

    @elseif($data->rtiApplication->appeal_no == 1)

        <p>The  First Appeal RTI application **(Application No: {{$data->rtiApplication->application_no}})** that was assigned to **{{$data->rtiApplication->lawyer->first_name." ".$data->rtiApplication->lawyer->last_name}}** has been reassigned back to you.</p>

        <p><strong>Reason Provided by Lawyer:</strong> {{!empty($data->message) ? $data->message : "Reason not Provided by lawyer"}} </p>

        <p>📅 **Reassignment Date & Time:** {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y g:i A')}}</p>

        <p>Action Required: Please review the RTI and assign it to another lawyer if necessary.</p>

    @elseif($data->rtiApplication->appeal_no == 2)

        <p>The  Second Appeal RTI application **(Application No: {{$data->rtiApplication->application_no}})** that was assigned to **{{$data->rtiApplication->lawyer->first_name." ".$data->rtiApplication->lawyer->last_name}}** has been reassigned back to you.</p>
            
        <p><strong>Reason Provided by Lawyer:</strong> {{!empty($data->message) ? $data->message : "Reason not Provided by lawyer"}} </p>

        <p>📅 **Reassignment Date & Time:** {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y g:i A')}}</p>

        <p>Action Required: Please review the RTI and assign it to another lawyer if necessary.</p>

    @endif
   
@endsection