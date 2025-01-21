Hi {{$customer['first_name']}} {{$customer['last_name']}}
<br>
<a href="{{route('customer.reset-password', [encryptString($customer['id']), encryptString(Carbon\Carbon::now())])}}">Reset password</a>