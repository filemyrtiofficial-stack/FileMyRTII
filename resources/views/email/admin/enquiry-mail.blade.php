@extends('email.layout')
    @section('content')
    <p>Dear Admin,</p>

    <p>You have received a new enquiry from the Contact Us page on your website. Here are the details:</p>

    <ul>
        <li> Name      : {{ $data->name }}</li>
        <li> Email      : {{ $data->email }}</li>
        <li> Phone      : {{ $data->phone_number }}</li>
        <li> Subject      : {{ $data->reason }}</li>
        <li>Message : {{$data->message}}</li>


    </ul>

   <p> Please respond to this enquiry at your earliest convenience.</p>
@endsection