
<p>Dear {{$data['first_name']}} {{$data['last_name']}} </p>
<p>
@php $date = getRtiDate(['application_id' => $data->id, 'status' => "filed"]); @endphp

As per our records, your RTI application (Application Number {{$data['application_no'] ?? ''}}) was field on {{$date }}. It has now been over 30 days, and you should have received a response from the concerned govenment authorities.
</p>
<p>
    <strong>What If You Haven't Received a Response?</strong> <br>
    While the RTI Act, 2005 mandates that all applications must be answered within 30 days, some Public Information Officers (PIOs) may fail to respond within the timeframe or provide insufficient information. In such cases, you have the right to file a First Appeal.
</p>
<p>
    <strong>What Is a First Appeal?</strong> <br>
    A first Appeal is a formal complaint submitted to the Appel;ate Authority, a senior officer to the PIO, outlining the details of your original RTI application and the reasons for your dissatisfaction for lack of response.
</p>

<p>
    <strong>Need Help Filing a First Appeal?</strong> <br>
    At FileMyRTI, our team of experts s here to assist you. We can draft your First Appeal application and file it on your behalf of ensure your case moves forward smoothly.
</p>
<div class="btn-container"><a class="btn " href="{{route('my-rtis', [$data['application_no'], 'first-appeal'])}}">Click Here to File Your First Appeal</a></div>
<p>Once You complete the payment, we'll take care of the entire process for you.</p>
<p>Thank you for choosing FileMyRTI. We're committed to supporting you throughout your RTI journey. For any questions, feel free to <a href="{{url('contact-us')}}">Contact Us</a> via our COntact Us page.</p>


<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>