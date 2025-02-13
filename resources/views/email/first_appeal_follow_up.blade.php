
<p>Dear {{$data['first_name']}} {{$data['last_name']}} </p>
<p>
@php $date = getRtiDate(['application_id' => $data->id, 'status' => "filed"]); @endphp

As per our records, your RTI application (Application Number {{$data['application_no'] ?? ''}}) was field on {{$date }}. It has now been over 30 days, and you should have received a response from the concerned govenment authorities.
</p>
<p>
    <strong>What If You Haven't Received a Response?</strong> <br>
    While the RTI Act,
</p>



<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>