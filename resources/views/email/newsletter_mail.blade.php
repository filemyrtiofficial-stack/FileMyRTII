@extends('email.layout')
    @section('content')

<p>Thank you for subscribing to <a href="{{url('/')}}">FileMyRTI.com</a> – India’s most trusted RTI filing platform!</p>

<p>We’re excited to have you on board. Whether you're seeking clarity from a government department, tracking a delayed service, or just curious about your rights – you're in the right place. Our platform is designed to make filing RTIs simple, fast, and effective.
</p>
<!-- <p>
Here’s what you can do next:
</p>
<ul>
    <li>💼 File your first RTI in just a few clicks</li>
    <li>📄 Track your RTI status in real-time</li>
    <li>📚 Explore resources to better understand the RTI process</li>
    <li>🛠️ Get expert support whenever you need help</li>
</ul> -->

<p>If you have any questions or need assistance, we’re just an email away at {{config('app.support_mail')}}.</p>

<p>
Let’s make information work for you.</p>

<p>Warm regards,</p>
@endsection
