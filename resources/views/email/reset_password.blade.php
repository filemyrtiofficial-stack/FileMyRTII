@extends('email.layout')
    @section('content')

<p>Hello {{$customer['first_name']}} {{$customer['last_name']}},</p>

<p>You can reset your FileMyRTI password by clicking the link below or copying and pasting it into your browser.</p>

<div class="btn-container"><a class="btn " href="{{route('customer.reset-password', [encryptString($customer['id']), encryptString(Carbon\Carbon::now())])}}">Reset password</a></div>
@endsection