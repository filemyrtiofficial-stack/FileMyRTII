@extends('email.layout')
    @section('content')
        <p>Dear Admin,</p>
        @if($data['appeal_no'] == 0)

            <p>The RTI application **(Application No: {{$data['application_no']}})** has been successfully filed by **{{$data->lawyer->first_name. " ".$data->lawyer->last_name}}**.</p>

            <p><strong>Tracking Number:</strong> <a href="">{{$data->courierTracking->courier_tracking_number}}</a></p>

            <p><strong>What Happens Next?</strong></p>
            <ul>
                <li>The customer will receive an official response within **30-45 days** as per the RTI Act.</li>
                <li>If no response is received within this timeframe, the customer may choose to file a first appeal.</li>
            </ul>

            <p>No further action is required unless follow-up is needed.</p>



        @elseif($data['appeal_no'] == 1)
            <p>This is to inform you that the first appeal for RTI Application No: {{$data['application_no']}} has been filed by the lawyer.</p>
            <p>The tracking number has been updated in the system as: {{$data->courierTracking->courier_tracking_number}}</p>
            <p>This email is for your information only. You may review the filed appeal details at any time.</p>
                <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->id)}}">Review Appeal Details</a></div>

            <p>Thank you.</p>

        @elseif($data['appeal_no'] == 2)

            <p>This is an FYI that the lawyer has filed the second appeal for RTI Application No: <strong>{{$data['application_no']}}</strong>.</p>
            <p>The tracking number has been updated in the system as: {{$data->courierTracking->courier_tracking_number}}</p>
            <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->id)}}">Review Appeal Details</a></div>

            <p>Thank you for monitoring this process.</p>

        @endif

@endsection