
@extends('email.layout')
@section('content')
<?php

$paymentdata = json_decode($data->success_response, true);
$service_fields = [];
if($data->service && !empty($data->service->fields)) {
    $service_fields = json_decode($data->service->fields, true);
}
$service_field_data = [];
if(!empty($data->service_fields)) {
    $service_field_data = json_decode($data->service_fields, true);
}
?>


    <p>Dear Admin,</p>
    @if($data->appeal_no == 0)

        <p>
            A customer has successfully completed the payment for their RTI application. You need to take action.
        </p>
        <p><strong>Customer Details:</strong>
        </p>
        <ul>
            <li>📌 <strong>Customer Name:</strong> {{$data['first_name']}} {{$data['last_name']}}</li>
            <li>📌 <strong>Application Number:</strong> {{$data['application_no']}}</li>
            <li>📌 <strong>Email:</strong> {{$data['email']}}</li>
            <li>📌 <strong>Phone Number:</strong> {{$data['phone_number']}}</li>
            <li>📌 <strong>Selected Service:</strong> {{$data->service->name ?? 'Custom Request'}}</li>
        </ul>


        <p><strong>Payment Details:</strong></p>
        <ul>
            
            <li><strong>💳 Payment Amount:</strong> ₹{{$data['charges']}} </li>
            <li><strong>💳 Payment Mode:</strong> {{ $paymentdata['method']}} </li>
            <li><strong>💳 Transaction ID:</strong> {{ $paymentdata['id']}} </li>
            <li><strong>💳 Payment Status:</strong> Successful </li>
            <li><strong>📅 Date & Time:</strong> {{date("d-m-Y", $paymentdata['created_at'])}} </li>
        </ul>

    
        <p><strong>RTI Details Submitted by Customer:</strong>   </p>
        <ul>
                
            <li><strong>📜 Full Name:</strong> {{$data['first_name']}} {{$data['last_name']}} </li>
            <li><strong>📜 Address:</strong> {{$data['address']}} </li>
            <li><strong>📜 City:</strong> {{$data['city']}} </li>
            <li><strong>📜 State:</strong> {{$data['state']}} </li>
            <li><strong>📜 PIN Code:</strong> {{$data['postal_code']}} </li>

            @foreach($service_fields['field_type'] ?? [] as $key => $value)
            @if( !isset($service_fields['form_field_type'][$key]) || (isset($service_fields['form_field_type'][$key])  && strtolower($service_fields['form_field_type'][$key]) != "lawyer"))
                @php
                    $field_key =  getFieldName($service_fields['field_lable'][$key]);
                @endphp
                <li><strong>📜 {{$service_fields['field_lable'][$key] ?? ''}}  :</strong> {{$service_field_data[$field_key] ?? ''}} </li>
            @endif

            @endforeach
        </ul>
    
        <p><strong>Next Steps:</strong></p>
        <p>Please review the appeal details and take the necessary action:
        </p>
        <p>
        <div class="btn-container">
            <a href="{{route('rtiapplication.view', $data['id'])}}" class="btn ">Assign to Lawyer</a>
        </div>
        </p>
        <p>If no action is taken, an automated reminder will be sent in **24 hours.**</p>

    @elseif($data->appeal_no == 1)

        <p>
        A customer has filed a <strong>First Appeal</strong> for their RTI Application (Application No: {{$data['application_no']}}).

        </p>
        <p><strong>Customer Details:</strong>
        </p>
        <ul>
            <li>📌 <strong>Customer Name:</strong> {{$data['first_name']}} {{$data['last_name']}}</li>
            <li>📌 <strong>Application Number:</strong> {{$data['application_no']}}</li>
            <li>📌 <strong>Email:</strong> {{$data['email']}}</li>
            <li>📌 <strong>Phone Number:</strong> {{$data['phone_number']}}</li>
            <li>📌 <strong>Selected Service:</strong> {{$data->service->name ?? 'Custom Request'}}</li>
        </ul>


        <p><strong>Payment Details:</strong></p>
        <ul>
            
            <li><strong>💳 Payment Amount:</strong> ₹{{$data['charges']}} </li>
            <li><strong>💳 Payment Mode:</strong> {{ $paymentdata['method']}} </li>
            <li><strong>💳 Transaction ID:</strong> {{ $paymentdata['id']}} </li>
            <li><strong>💳 Payment Status:</strong> Successful </li>
            <li><strong>📅 Date & Time:</strong> {{date("d-m-Y", $paymentdata['created_at'])}} </li>
        </ul>
        <p><strong>Next Steps:</strong></p>
        <p>Please review the appeal details and take the necessary action:
        </p>
        <div class="btn-container">
            <a href="{{route('rtiapplication.view', $data['id'])}}" class="btn ">Assign to Lawyer</a>
        </div>
        <p>This email is for your information and further action if required.</p>

    @elseif($data->appeal_no == 2)

        <p>The customer has filed their <strong>Second Appeal</strong> for RTI Application No: <strong>{{$data['application_no']}}</strong>.</p>
        <p>Please take note of the new appeal. You can take further action if necessary.</p>
        <div class="btn-container">
            <a href="{{route('rtiapplication.view', $data['id'])}}" class="btn ">Assign to Lawyer</a>
        </div>
        <p>This email is for your information and further action if required.</p>

    @endif
   
@endsection