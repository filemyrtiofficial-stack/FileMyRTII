<p>Dear {{$data['first_name']}} {{$data['last_name']}} </p>
@if($data['appeal_no'] == 0)
<p>
We are pleased to inform you that your RTI application has been successfully drafted by our expert team. To proceed further, we kindly request you to review, approve, and sign the drafted application.
</p>
@elseif($data['appeal_no'] == 1)
<p>
We are pleased to inform you that your First Appeal (RTI) application has been successfully drafted by our expert team. To proceed further, we kindly request you to review, approve, and sign the drafted application.
</p>
@else
<p>
We are pleased to inform you that your Second Appeal (RTI) application has been successfully drafted by our expert team. To proceed further, we kindly request you to review, approve, and sign the drafted application.
</p>
@endif

<h4>Next Steps :</h4>
<ol>
    <li><strong>Review the Draft : </strong>  Ensure all details are accurate and neet your expectations. </li>
    <li><strong>Approve and Sign :</strong> Provide your approval along with your signatue for submission. </li>
    <li><strong>Dispatch :</strong> Once approved, we will dispatch your application to the appropriate authority within 24 hours. </li>

</ol>
<a href="{{route('my-rtis', [$data['application_no'], 'rti-application'])}}">Click Here to View & Approved</a>

<p>If you have any questions or require assistance during this process, our support team is here to help.</p>
<p>Thank you for choosing FileMyRTI.</p>
<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>