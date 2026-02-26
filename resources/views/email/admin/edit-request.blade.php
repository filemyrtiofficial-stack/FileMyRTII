@extends('email.layout')
    @section('content')
    <p>Dear Admin,</p>
    @if($data->rtiApplication->appeal_no == 0)
    
        <p>The customer has responded to the first appeal draft by requesting a few modifications for RTI Application No: ({{$data->rtiApplication['application_no']}}).</p>
        <p>Customer Details:</p>
        <p>Name: {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}}</p>
        <p>Email: {{$data->rtiApplication['email']}}</p>
        <p>Phone: {{$data->rtiApplication['phone_number']}}</p>
        <div class="btn-container"><a class="btn " href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}">Change Request</a></div>
        <p>No action is required from you at this time. This is just for your reference.</p>
        <p>If you have any questions or need further details, please consult the system dashboard.</p>

    @elseif($data->rtiApplication->appeal_no == 1)
    
        <p>The customer has responded to the first appeal draft by requesting a few modifications for RTI Application No: <strong>{{$data->rtiApplication['application_no']}}</strong>.</p>
        <p><strong>Customer Details:</strong></p>
        <ul>
        <li><strong>Name:</strong> {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}}</li>
        <li><strong>Email:</strong> {{$data->rtiApplication['email']}}</li>
        <li><strong>Phone:</strong> {{$data->rtiApplication['phone_number']}}</li>
        </ul>
        
        <p>Please review the change request and coordinate with the lawyer if necessary.</p>
        <div class="btn-container">
        <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Change Request</a>
        </div>
        <p>If you have any questions or need further details, please consult the system dashboard.</p>
        

    @elseif($data->rtiApplication->appeal_no == 2)

        <p>The customer has responded to the first appeal draft by requesting a few modifications for RTI Application No: <strong>{{$data->rtiApplication['application_no']}}</strong>.</p>
        <p><strong>Customer Details:</strong></p>
        <ul>
        <li><strong>Name:</strong> {{$data->rtiApplication['first_name']}} {{$data->rtiApplication['last_name']}}</li>
        <li><strong>Email:</strong> {{$data->rtiApplication['email']}}</li>
        <li><strong>Phone:</strong> {{$data->rtiApplication['phone_number']}}</li>
        </ul>
        
        <p>Please review the change request and coordinate with the lawyer if necessary.</p>
        <div class="btn-container">
        <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Change Request</a>
        </div> 
        <p>If you have any questions or need further details, please consult the system dashboard.</p>
        
    @endif
   
@endsection