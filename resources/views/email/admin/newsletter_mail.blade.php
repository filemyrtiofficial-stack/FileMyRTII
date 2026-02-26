@extends('email.layout')
    @section('content')
 <p>Dear Admin,</p>

<p>We have received a new subscription.</p>

<p>
   <strong> Details:</strong>
</p>
<ul>
    <li>
        <strong>Email:</strong> {{$newsletter->email}}
    </li>
    <li><strong>Subscription Date:</strong> {{Carbon\Carbon::parse($newsletter->created_at)->format('d M, Y g:i A')}}</li>
</ul>

<p>Warm regards,</p>
@endsection
