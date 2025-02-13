<p>Dear {{$data['first_name']}} {{$data['last_name']}}</p>
<p>
Thank you for choosing FileMyRTI! We are please to inform you that your RTI Application Number: {{$data['application_no']}} has been successfully received A payment of {{$data['charges']}} has been confirmed, and your invoice is attached to this email for your refrence.

</p>
<h4>What Happend Next?</h4>
<ol>
    <li><strong>review Process : </strong> Our experts will review your application and contact ypou if any additional information is needed.</li>
    <li><strong>Draft Preparation :</strong> Your RTI draft will be prepared and shared with you within <strong>24-48 hours</strong> for your review and approval. </li>
    <li><strong>Final Submission : </strong> Once approved, we'll notify you before filling your RTI application with th concerned authority.</li>
</ol>
<p><strong>Track Your RTI Anytime</strong></p>
<p>Your can track thr progress of your application at any time user link: <a href="{{route('my-rtis',[$data['application_no']])}}">Track My RTI</a>.</p>
<p>if you have any questions or need further assistance, please don't hesitate to reach out to us via our <a href="{{url('contact-us')}}">Contact Us </a> page. We are here to help every step of the way!</p>
<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>