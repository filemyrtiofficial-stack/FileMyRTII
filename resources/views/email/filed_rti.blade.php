<p>Dear {{$data['first_name']}} {{$data['last_name']}} </p>
<p>
@if($data['appeal_no'] == 0)
 
We're pleased to inform you that your RTI application (Application Number : {{$data['application_no']}}) has been successfully filed. A copy of your RTI application is attached to this email for your reference.
@if($data['appeal_no'] == 0)
We're pleased to inform you that your First Appeal (RTI) application (Application Number : {{$data['application_no']}}) has been successfully filed. A copy of your First Appeal (RTI) application is attached to this email for your reference.
@else
We're pleased to inform you that your Second Appeal (RTI) application (Application Number : {{$data['application_no']}}) has been successfully filed. A copy of your Second Appeal (RTI) application is attached to this email for your reference.
@endif
</p>

<p>Your Registered Post Tracking Number : {{$data->courierTracking->courier_tracking_number ?? ''}}</p>
<p>Please note that it may take 24-48 hours for the tracking number to become active on the Registered Post website.</p>

<div></div>

<h4>What Happens Next? :</h4>
<ol>
    <li><strong>Response Timeline: </strong>  You will receive a response directly from the government authority within 30-45 days, as per the RTI Act.</li>
    <li><strong>Next Steps in Case of No Response :</strong> If you do not receive a response of find it unsatisfactory you have the option to file a first appeal. </li>
</ol>
<p>Thank you for choosing FileMyRTI. We are committed to empowering transparency ans simplify the RTI filing process for you. If you have any questions of need further assistance, don't hesitate to reach out via our Contact Us page.</p>


<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>