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


    <p>Dear {{$data->lawyer->first_name}} {{$data->lawyer->last_name}},</p>
    @if($data->appeal_no == 0)


        <p>An RTI application has been assigned to you for drafting. Below are the details:</p>

            <p><strong>Customer Details:</strong></p>
            <ul>
                <li>📌 **Customer Name:** {{$data['first_name']}} {{$data['last_name']}}</li>
                <li>📌 **Application Number:** {{$data['application_no']}} </li>
                <li>📌 **Email:** {{$data['email']}}</li>
                <li>📌 **Phone Number:** {{$data['phone_number']}}</li>
            </ul>

            <p><strong>RTI Query & Details:</strong></p>
            <ul>
                <li>📜 Full Name: {{$data['first_name']}} {{$data['last_name']}}</li>
                <li>📜 Address: {{$data['address']}}</li>
                <li>📜 City: {{$data['city']}} </li>
                <li>📜 State: {{$data['state']}} </li>
                <li>📜 PIN Code: {{$data['postal_code']}} </li>

            @foreach($service_fields['field_type'] ?? [] as $key => $value)
            @if( !isset($service_fields['form_field_type'][$key]) || (isset($service_fields['form_field_type'][$key])  && strtolower($service_fields['form_field_type'][$key]) != "lawyer"))
                @php
                    $field_key =  getFieldName($service_fields['field_lable'][$key]);
                @endphp
                <li>📜 {{$service_fields['field_lable'][$key] ?? ''}}  : {{$service_field_data[$field_key] ?? ''}} </li>
            @endif

            @endforeach
            </ul>

            <p><strong>Next Steps:</strong></p>

            <div class="btn-container">
                <a href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}" class="btn ">Start Drafting</a>
                <a href="{{route('lawyer.my-rti', $data->application_no.'-'.$data->id)}}" class="btn btn-danger">Assign Back to Admin</a>
            </div>

    
    @elseif($data->appeal_no == 1)

        <p>An RTI application has been assigned to you for drafting. Below are the details:</p>

        <p><strong>Customer Details:</strong></p>
        <ul>
            <li>📌 **Customer Name:** {{$data['first_name']}} {{$data['last_name']}}</li>
            <li>📌 **Email:** {{$data['email']}}</li>
            <li>📌 **Phone Number:** {{$data['phone_number']}}</li>
        </ul>
        <p><strong>Appeal Details</strong></p>
        <ul>
            <li><strong>Original RTI Application No. :</strong> {{$data['application_no']}} </li>
            <li><strong>Appeal Grounds / Additional Notes : </strong> {{$data->firstAppeal->appealDeatils->reason ?? ''}}</li>

        </ul>
       

        <p><strong>Next Steps:</strong></p>
        <p>Choose one of the following actions:
        </p>

        <div class="btn-container">
            <a href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}" class="btn ">Start Drafting</a>
            <a href="{{route('lawyer.my-rti', $data->application_no.'-'.$data->id)}}" class="btn btn-danger">Assign Back to Admin</a>
        </div>
        
        <p>If no action is taken, an automated reminder will be sent in <strong>24 hours.
        </strong></p>






    @elseif($data->appeal_no == 2)
    
        <p>The admin has assigned the Second Appeal for RTI Application No: <strong>{{$data->application_no}}</strong> to you. Please review the details and proceed to draft the appeal.</p>
        
        <div class="btn-container">
        <a href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}" class="btn ">Start Drafting Second Appeal</a>
        <a href="{{route('lawyer.my-rti', $data->application_no.'-'.$data->id)}}" class="btn ">Assign Back to Admin</a>
        </div>
        
        <p>If you have any questions or require further details, please reach out to the admin directly.</p>

    @endif
@endsection