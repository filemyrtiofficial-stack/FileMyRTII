@extends('email.layout')
@section('content')
    <?php

    $paymentdata = json_decode($data->success_response, true);
    ?>
    <p>Hi {{$data['first_name']}} {{$data['last_name']}},</p>
    @if($data->appeal_no == 0)

        <p>
            Thank you for your payment! Your RTI application is now being processed. Below are the next steps.
        </p>
        <p><strong>What Happens Next?</strong> <br>

        <strong>✔ If we need any additional details, we will reach out to you.</strong> <br>
        <strong>✔ Your RTI draft will be prepared within 3 business days.</strong> <br>
        <strong>✔ Once ready, we’ll send the draft for your review, approval, and signature.</strong>
        </p>
        <p>After approval, we will proceed with filing your RTI and provide tracking details.</p>
        <div class="btn-container"><a class="btn " href="{{route('my-rtis',[$data['application_no']])}}">Track My RTI</a> </div>
         @if($data->user_type == 'guest')
        <p><strong>Find Your Login Credentials</strong></p>
        <p>
            <ul>
                <li>Email : <strong>{{$data->email}}</strong></li>
                <li>Password : <strong>{{$data->phone_number}}</strong></li>
            </ul>
        <div class="btn-container"><a class="btn " href="{{route('home-page')}}?t=signin">Login</a> </div>

        </p>
        @endif
        
        <p>If you have any questions, our support team is available at {{config('app.support_mail')}} or reach us at:
        <strong>{{config('app.support_contact')}}</strong></p>

    @elseif($data->appeal_no == 1)

            
        <p>We have received your First Appeal for your RTI Application (Application No: {{$data['application_no']}}). Please find the attached invoice for processing your appeal.</p>
        <p>Our RTI experts will review your appeal and process it within the next 1-3 business days. Should we require any additional information, we will reach out to you.
        </p>
        <p>Thank you for choosing FileMyRTI – India’s Simplest Way to File My RTI.
        </p>



    @else

        <p>Thank you for filing your Second Appeal for RTI Application No: {{$data['application_no']}}.</p>
        <p>Invoice Number: </p>
        <p>Amount: ₹{{$data->charges}}</p>
        <p>Payment Mode: {{$paymentdata['method']}}</p>
        <p>Your appeal request is now in process. Our team will review your second appeal and process it within 3-5 business days. You will be notified as soon as any updates are available.</p>
        <p>Thank you for choosing FileMyRTI.</p>

    @endif
@endsection


