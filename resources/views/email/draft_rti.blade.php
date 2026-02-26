@extends('email.layout')
@section('content')
    <p>Dear {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}},</p>
    @if($data->rtiApplication->appeal_no == 0)

        <p>We are pleased to inform you that your RTI application has been successfully drafted by our expert team. To proceed further, we kindly request you to review, approve, and sign the drafted application.</p>
        <p>
            <strong>Next Steps:</strong> <br>
            <strong>✔ Review the Draft:</strong> Ensure all details are accurate and meet your expectations.<br>
            <strong>✔ Approve and Sign:</strong> Provide your approval along with your signature for submission. <br>
            <strong>✔ Dispatch:</strong> Once approved, we will dispatch your application to the appropriate authority within 24 hours. <br>
        </p>
        <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View, Edit & Approve</a>
        </div>
        <p>If you have any questions or require assistance during this process, our support team is here to help.</p>
        <p>Thank you for choosing FileMyRTI.</p>
        <p>We’re committed to making the RTI process seamless and hassle-free for you.</p>

    @elseif($data->rtiApplication->appeal_no == 1)

        <p>Your first appeal request has been drafted and is ready for your review and approvals. Kindly review the draft by clicking the button below.</p>
        <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View, Edit & Approve</a>
        </div>
        <p>If you have any questions or need further clarification, feel free to reply to this email or contact our support team.</p>
        <p>Thank you for choosing FileMyRTI – India’s Simplest Way to File My RTI.</p>

    @else

        <p>Your second appeal draft for RTI Application No: {{$data->rtiApplication['application_no']}} has been prepared and is now ready for your review and approval.
        Please click the button below to review the draft. Once approved, we will proceed with the next steps.</p>
        <div class="btn-container">
            <a href="{{route('my-rtis', [$data->rtiApplication['application_no'], 'rti-application'])}}" class="btn ">Click Here to View, Edit & Approve</a>
        </div>
        <p>If you have any questions or need further clarification, feel free to reply to this email or contact our support team.</p>
        <p>Thank you for choosing FileMyRTI – India’s Simplest Way to File My RTI.</p>

    @endif

    <p>Warm regards,</p>
@endsection
