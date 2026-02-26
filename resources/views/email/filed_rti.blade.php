@extends('email.layout')
@section('content')
    <p>Dear {{$data['first_name']}} {{$data['last_name']}} </p>
    @if($data['appeal_no'] == 0)

        <p>We’re pleased to inform you that your RTI application **(Application No: {{$data['application_no']}})** has been successfully filed.</p>
        <p>A copy of your RTI application is attached to this email for your reference.</p>
        <p><strong>Your Registered Post Tracking Number:</strong> <a href={{$data->courierTracking->courier_tracking_number}}">{{$data->courierTracking->courier_tracking_number}}</a></p>
        <p>Please note that it may take **24-48 hours** for the tracking number to become active on the Registered Post website.</p>
        <p><strong>Progress Tracker:</strong></p>
        <p style="    text-align: center;">
        <img src="https://filemyrti.com/assets/images/filed.png" alt="" style="width: 19%;">
        </p>
        <p><strong>What Happens Next?</strong> <br>
        <strong>✔ Response Timeline:</strong> You will receive a response directly from the government authority within **30-45 days**, as per the RTI Act. <br>
        <strong>✔ Next Steps in Case of No Response:</strong> If you do not receive a response or find it unsatisfactory, you have the option to file a First Appeal.
        </p>
        <p>We are committed to empowering transparency and simplifying the RTI filing process for you. If you have any questions or need further assistance, don’t hesitate to reach out via our Contact Us page.</p>
        <p>Thank you for choosing FileMyRTI.</p>
        
    @elseif($data['appeal_no'] == 1)

        <p>We are pleased to inform you that your first appeal for RTI Application No: {{$data['application_no']}} has been successfully filed.</p>
        <p><strong>Your Registered Post Tracking Number:</strong> <a href="{{$data->courierTracking->courier_tracking_number}}">{{$data->courierTracking->courier_tracking_number}}</a></p>
        <p>A copy of your approved first appeal application is attached for your reference. The concerned appellate authority will respond within 45 days as per the RTI Act. If you do not receive a response or are not satisfied with the response within this timeframe, you may submit a second appeal.</p>
        <p>Thank you for choosing FileMyRTI – India’s Simplest Way to File My RTI.</p>
    

    @elseif($data['appeal_no'] == 2)


        <p>We are pleased to inform you that your second appeal for RTI Application No: {{$data['application_no']}} has been successfully filed.</p>
        <p><strong>Your Registered Post Tracking Number:</strong> <a href="{{$data->courierTracking->courier_tracking_number}}">{{$data->courierTracking->courier_tracking_number}}</a></p>
        <p>The concerned Information Commission is expected to respond to your appeal within <strong>45 days</strong> as per the RTI Act. If you do not receive any response within this timeframe, please get back to us for further assistance.</p>
        <p>Thank you for choosing FileMyRTI – India’s Simplest Way to File My RTI.</p>

    @endif


    <p>Warm regards,</p>
@endsection