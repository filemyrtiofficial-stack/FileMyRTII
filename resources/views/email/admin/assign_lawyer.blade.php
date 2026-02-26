

@extends('email.layout')
@section('content')
<?php

function lawyerEntryTiming($application_id, $lawyer_id) {
    $item =  App\Models\RtiApplicationLawyer::where(['application_id' => $application_id, 'lawyer_id' => $lawyer_id])->orderBy('id', 'desc')->first();
    if($item) {
        return Carbon\Carbon::parse($item->created_at)->format('d-m-Y g:i A');
    }
    return "";
}
?>
<p>Dear Admin,</p>
<p>The RTI application **(Application No: {{$data->application_no}})** has been assigned to **{{$data->lawyer->first_name}} {{$data->lawyer->last_name}}** for drafting.</p>
<p>📅 **Assignment Date & Time:** {{lawyerEntryTiming($data->id, $data->lawyer_id)}}</p>
<p>No further action is required from you at this time.</p>
@endsection
