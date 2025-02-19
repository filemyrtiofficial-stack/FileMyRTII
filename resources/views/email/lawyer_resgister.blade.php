<p>Dear {{$data['first_name']}} {{$data['last_name']}}</p>
<p>Welcome to <strong>FileMyRTI!</strong> We are excited to have you on board.</p>

<ul>
<li>Company email ID: {{$data['company_email']}}</li>
<li>Password : {{$data['password']}}</li>
<li>Employee ID :{{$data['employee_id']}}</li>
</ul>

<p>To access your account, please visit: <a href="{{url('/lawyer/login')}}">Your Login URL </a></p>

<h3>Next Steps:</h3>
<ol>
<li>Login using the credentials above.</li>
<li>Explore Our Platform: Check out our features and get started!</li>
</ol>

<p>if you have any questions or need further assistance, please don't hesitate to reach out to us via our <a href="{{url('contact-us')}}">Contact Us </a> page. We are here to help every step of the way!</p>
<p>
Looking forward to a great journey together!
</p>
<p>Warm regards,</p>
<p><strong>FileMyRTI Team</strong></p>
<p>India's Simplest Way to File My RTI</p>
<p>support@FileMyRTI.com</p>