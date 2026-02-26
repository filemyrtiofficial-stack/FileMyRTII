@extends('email.layout')
@section('content')
    <p>Dear {{$data['first_name']}} {{$data['last_name']}}</p>
    <p>
    We're excited to inform you that processing for your RTI application number :  ({{$data['application_no']}}) has begun. <br> This automated email is to keep you updated on our progress.
    </p>
    <h4>Your application has undergone intial checks</h4>
    <ol>
        <li><strong>Spell Check: </strong> Ensured correctness and clarity.</li>
        <li><strong>Address Formatting :</strong> Verified and standardized. </li>
        <li><strong>Assignment: </strong> Your application is now assigned to one of our RTI experts for further processing.</li>
    </ol>
    <!--<p>Current Status</p>-->
    <div class="btn-container"><a class="btn " href="{{route('my-rtis',[$data['application_no']])}}">Track My RTI</a></div>

    <h4>What happen next?</h4>
    <ol>
        <li><strong>Draft Proparation: </strong> Our expert team will draft your RTI application following best practices and legal standards.</li>
        <li><strong>Verification :</strong> We'll locate the appropriate government office to file your application. </li>
        <li><strong>Your approval: </strong> This draft RTI application will be sent to you for review and approval before submission.</li>
    </ol>
    <p><strong>Thank You for Choosing FileMyRTI</strong></p>
    <p>We're committed to making the RTI filing process simple and hassle-free for you.</p>

    <p>Warm regards,</p>
@endsection