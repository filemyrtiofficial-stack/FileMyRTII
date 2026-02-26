@extends('email.layout')
@section('content')
    <p>Dear {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}},</p>
    @if($data->rtiApplication->appeal_no == 0)


    <p>We have revised your RTI draft **(Application No: {{$data->rtiApplication['application_no']}})** as per your requested modifications. Please review the updated draft and provide your approval.</p>
    <p>
        <strong>Next Steps:</strong> <br>
        <strong>✔ Review the Draft:</strong> Ensure all details are accurate and meet your expectations.<br>
        <strong>✔ Approve and Sign:</strong> Provide your approval along with your signature for submission. <br>
        <strong>✔ Dispatch:</strong> Once approved, we will dispatch your application to the appropriate authority within 24 hours. <br>
    </p>
    <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View & Approve</a>
        </div>
    <p>If you have any questions or require assistance during this process, our support team is here to help.</p>
    <p>Thank you for choosing FileMyRTI.</p>
    <p>We’re committed to making the RTI process seamless and hassle-free for you.</p>

    @elseif($data->rtiApplication->appeal_no == 1)

        <p>We have updated your first appeal draft by incorporating your valuable feedback for RTI Application No: {{$data->rtiApplication['application_no']}}. Please review the revised draft and let us know if it meets your approval.</p>
           <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View & Approve</a>
        </div>
        <p>If you have any further questions or need additional modifications, please feel free to reply to this email or contact our support team.</p>

    @else
        <p>We have updated your second appeal draft by incorporating your valuable feedback for RTI Application No: {{$data->rtiApplication['application_no']}}. Please review the revised draft and let us know if it meets your approval.</p>
           <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View & Approve</a>
        </div>
        <p>If you have any further questions or need additional modifications, please feel free to reply to this email or contact our support team.</p>

    @endif

    <p>Warm regards,</p>
@endsection