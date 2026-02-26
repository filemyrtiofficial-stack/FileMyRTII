@extends('email.layout')
@section('content')
   <p>Dear {{$data->rtiApplication->lawyer->first_name}} {{$data->rtiApplication->lawyer->last_name}},</p>

   @if($data->rtiApplication->appeal_no == 0)
      <p>
      The customer has provided additional information for **RTI Application No: {{$data->rtiApplication['application_no'] ?? ''}}**. Below are the details:
      </p>
      <p>Newly Submitted Information: 
         <br>
         <strong>Query</strong> : {{$data['message'] ?? ''}} <br>
         <strong>Reply</strong> : {{$data['reply'] ?? ''}} <br>
      </p>
      <p>You may now proceed with drafting the RTI.</p>
      <div class="btn-container"><a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Continue Drafting</a></div>

   @elseif($data->rtiApplication->appeal_no == 1)
      <p>The customer has provided the additional information requested for their Second Appeal on RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong>.</p>
      
      <!-- <p>Please review the details by clicking the button below, and proceed with drafting the second appeal accordingly.</p> -->
      <p>Newly Submitted Information: 
         <br>
         <strong>Query</strong> : {{$data['message'] ?? ''}} <br>
         <strong>Reply</strong> : {{$data['reply'] ?? ''}} <br>
      </p>
      
      <div class="btn-container">
         <a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Continue Drafting</a>
      </div>
      
      <p>Once you have reviewed the information, please proceed with drafting the second appeal as soon as possible.</p>
      
      <p>If you have any questions, feel free to reach out to the admin.</p>

   @elseif($data->rtiApplication->appeal_no == 2)

      <p>The customer has provided modifications for the second appeal draft for RTI Application No: {{$data->rtiApplication->application_no}}. Please review the provided details and proceed with updating your draft accordingly.
      </p>
    
     
      <div class="btn-container">
         <a href="{{route('lawyer.my-rti', [$data->rtiApplication->application_no.'-'.$data->rtiApplication->id, 'drafted-rti'])}}" class="btn ">Review Modifications</a>
      </div>
      <p>If you need any clarification, please reach out to the admin for further details.
      </p>
   @endif
   
@endsection