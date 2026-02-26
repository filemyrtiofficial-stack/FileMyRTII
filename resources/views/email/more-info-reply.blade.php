@extends('email.layout')
@section('content')
<p>Hi {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}} </p>

@if($data->rtiApplication->appeal_no == 0)
<p>
   This is to confirm that we have received the requested information for your RTI application (Application No: {{$data->rtiApplication['application_no'] ?? ''}})
</p>
<p>
   Our team will process It shortly and proceed with the next steps.
</p>

@elseif($data->rtiApplication->appeal_no == 1)

   <p>Thank you for providing the additional information for your first appeal regarding RTI Application No: {{$data->rtiApplication['application_no'] ?? ''}}. We have received your details and our team is reviewing them to proceed with your appeal.</p>
   <p>You will be updated shortly on the next steps. If you have any questions, please feel free to reply to this email.</p>

@else
   <p>Thank you for providing the additional information for your second appeal regarding RTI Application No: {{$data->rtiApplication['application_no'] ?? ''}}. We have received your details and our team is reviewing them to proceed with your appeal.</p>
   <p>You will be updated shortly on the next steps. If you have any questions, please feel free to reply to this email.</p>

@endif

<p>Thank you for choosing FileMyRTI.</p>

  <p>Warm regards,</p>
@endsection