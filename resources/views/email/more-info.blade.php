@extends('email.layout')
    @section('content')
    <p>Hi {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}} </p>

    @if($data->rtiApplication->appeal_no == 0)
    <p>We need additional details to proceed with your RTI application (Application No: {{$data->rtiApplication['application_no'] ?? ''}})</p>
    <div class="btn-container"><a class="btn " href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'requested-info'])}}" ><span>Click Here to Provide Information</span></a></div>
    <p>Your prompt response wil help us move forward with your applications.</p>
    <p>Important :  Please do not reply to this email. This mailbox is not monitored.</p>
    <p>Thank you for choosing FileMyRTI.</p>

    @elseif($data->rtiApplication->appeal_no == 1)

    <p>To help us process your first appeal for RTI Application No: {{$data->rtiApplication['application_no']}}, we need some additional information.</p>
    <p>Please click the button below to provide the required details:</p>
    <div class="btn-container"><a class="btn " href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'requested-info'])}}">Provide More Information</a></div>
    <p>If you have any questions, feel free to reply to this email or contact our support team.</p>

    @else

    <p>To help us process your second appeal for RTI Application No: {{$data->rtiApplication['application_no']}}, we need some additional information.</p>
    <p>Please click the button below to provide the required details:</p>
    <div class="btn-container"><a class="btn " href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'requested-info'])}}">Provide More Information</a></div>
    <p>If you have any questions, feel free to reply to this email or contact our support team.</p>


    @endif

    <p>Warm regards,</p>
@endsection
