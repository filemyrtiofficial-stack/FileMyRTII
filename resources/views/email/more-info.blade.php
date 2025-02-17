
<p>Hi {{$data['first_name']}} {{$data['last_name']}} </p>

<p>
  We need additional details to proceed with your RTI application (Application No: {{$data['application_no'] ?? ''}})
</p>
<a href="{{route('my-rtis', [$data['application_no'], 'requested-info'])}}">Click Here to Provide Information</a>
<p>
  Your prompt response wil help us move forward with your applications.
</p>
<p>Inportant :  Please do not reply to this email. This mailbox is not monitored.</p>

<p>Thank your for choosing FileMyRTI.</p>

<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>