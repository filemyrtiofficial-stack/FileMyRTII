@extends('email.layout')
@section('content')
    <p>Dear {{$data['first_name']}} {{$data['last_name']}},</p>
    @if($data->appeal_no == 0)


        <p>Thank you for reviewing and approving the draft of your RTI application **(Application No: {{$data['application_no']}})**. We’re glad to have your confirmation and will proceed with filing your application.</p>
        <p>
            <strong>What Happens Next?</strong> <br>
            <strong>✔ Filing Process:</strong> Your RTI application will be filed with the appropriate government authority within the next 24-48 hours. <br>
            <strong>✔ Tracking Details:</strong> Once filed, we’ll share the tracking number via email, so you can monitor the progress of your application.
        </p>
        <p>We are committed to ensuring your RTI application is handled with the utmost care and efficiency.</p>
        <p>If you have any questions or need assistance, feel free to contact us anytime via our Contact Us page.</p>
        <p>Thank you for choosing FileMyRTI.</p>

    @elseif($data->appeal_no == 1)

        <p>Thank you for approving your First Appeal for RTI Application No: {{$data['application_no']}}.</p>
        <p>We will now proceed with the filing of your appeal within 1-2 business days. Once the filing is complete, we will provide you with the tracking number.</p>
        <p>We appreciate your prompt response and trust in FileMyRTI.</p>

    @elseif($data->appeal_no == 2)


        <p>Thank you for approving your second appeal for RTI Application No: {{$data['application_no']}}. We are now processing your appeal and will file it within the next 2–3 business days.</p>
        <p>You will receive further updates, including tracking details once the filing is complete.</p>


    @endif
    <p>Warm regards,</p>
@endsection


