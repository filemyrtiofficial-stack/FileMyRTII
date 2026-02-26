@extends('email.layout')
@section('content')
    <p>Hi {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}} </p>

    @if($data->status == 'approve')

    <p>Thank you for your patience while we reviewed your refund request.</p>

    <p>After careful consideration, we’re pleased to inform you that your request has been approved by our admin team. This decision was made in accordance with our refund policy and based on the details you provided.</p>
    
    <p>The refund will be processed shortly, and you will receive a confirmation once it has been completed.</p>
    
    <p>If you have any further questions, feel free to reach out to our support team.</p>

       
       
    @elseif($data->status == 'reject')
   <p>Thank you for your patience while we reviewed your refund request.</p>

    <p>After careful consideration, we regret to inform you that your request has not been approved by our admin team. This decision was made in accordance with our refund policy and the specific details provided in your case.</p>
    
    <p>We understand this may be disappointing, and we’re here if you have any questions or need further clarification.</p>
    
    <p>Thank you for your understanding.</p>
    @endif
@endsection
