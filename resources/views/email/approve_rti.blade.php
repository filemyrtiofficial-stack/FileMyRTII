<p>Dear {{$data['first_name']}} {{$data['last_name']}}</p>
<p>
@if($data['appeal_no'] == 0)

Thank you for reviewing and approving the draft of your RTI application ({{$data['application_no']}}). We're glad to have your confirmation and will proceed with filing your application.
@elseif($data['appeal_no'] == 1)
Thank you for reviewing and approving the draft of your First Appeal (RTI) application ({{$data['application_no']}}). We're glad to have your confirmation and will proceed with filing your application.
@else
Thank you for reviewing and approving the draft of your Second Appeal (RTI) application ({{$data['application_no']}}). We're glad to have your confirmation and will proceed with filing your application.
@endif
</p>
<h4>What Happend Next?</h4>
<ol>
    <li><strong>Filing Process : </strong>  Your RTI application will be filed with the appropriate government authority within the next 24-28 hours. </li>
    <li><strong>Tracking Details :</strong> One filled we'll share the tracking number with you via email, so you can monitor the progress of your application. </li>
</ol>

<p>We are committed to ensuring your RTI application is handled with the utmost care and efficiency.</p>
<p>If you have any questions or need assistance, feel free to contact us anytime via our <a href="{{url('contact-us')}}">Contact Us</a> page.</p>
<p>Thank you for choosing FileMyRTI.</p>
<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>