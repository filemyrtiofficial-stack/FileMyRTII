@extends('email.layout')
@section('content')
    <p>Dear {{$data->lawyer->first_name}} {{$data->lawyer->last_name}},</p>
    <p>The customer has approved their RTI draft **(Application No: {{$data['application_no']}})**. You may now proceed with filing the RTI with the concerned government authority.</p>
    <p>Please use the button below to file the RTI application:</p>
    <div class="btn-container"><a class="btn " href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'tracking-no'])}}">Proceed to File RTI</a></div>
@endsection



