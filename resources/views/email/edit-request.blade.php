@extends('email.layout')
@section('content')
    <p>Hi {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}} </p>

    @if($data->appeal_no == 0)

 <p>We have received your request for modifications to your RTI draft **(Application No: {{$data->rtiApplication['application_no'] ?? ''}})**. Our team will review the requested changes and make the necessary updates.
        </p>
        <p>Once the modifications are completed, we will notify you to review and approve the updated RTI draft.
        </p>
       
       
       
    @elseif($data->appeal_no == 1)


        <p>We have received your request for modifications to the first appeal draft for your RTI Application (Application No: {{$data->rtiApplication['application_no'] ?? ''}}). Our team is reviewing your feedback and will send you a revised draft for your approval shortly.</p>
        <p>Thank you for your valuable feedback. If you have any further comments, please reply to this email or contact our support team.</p>
        

    @else
         <p>Thank you for your feedback on the second appeal draft. We have received your modification request and will review your comments promptly. We will update you with the revised draft as soon as possible.
        </p>
        <p>If you have any further questions or additional details to share, please feel free to reply to this email.</p>
        
    @endif
@endsection
