@extends('email.layout')
@section('content')
    <p>Dear Admin,</p>

    @if($type == 'first')

        @if($data->rtiApplication->appeal_no == 0)



            <p>The RTI application **(Application No: {{$data->rtiApplication->application_no}})** has been successfully drafted by **{{$data->rtiApplication->lawyer->first_name. " ".$data->rtiApplication->lawyer->last_name}}** and has been sent to the customer for review and approval.</p>

            <p>You can review the drafted RTI or download it using the button below:</p>

            <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Drafted RTI</a>
            </div>

            <p>No further action is required unless the customer requests modifications.</p>




        @elseif($data->rtiApplication->appeal_no == 1)

            <p>The lawyer has completed the draft for the First Appeal for RTI Application No: {{$data->rtiApplication->application_no}} and has sent it to the customer for review and approval.</p>
            
            <p><strong>Customer Details:</strong></p>
            <ul>
                <li><strong>Name:</strong> {{$data->rtiApplication->first_name}} {{$data->rtiApplication->last_name}}</li>
                <li><strong>Email:</strong> {{$data->rtiApplication->email}}</li>
                <li><strong>Phone:</strong> {{$data->rtiApplication->phone_number}}</li>
            </ul>
            
            <p><strong>Appeal Details:</strong></p>
            <ul>
                <li><strong>Application No.:</strong> {{$data->rtiApplication->application_no}}</li>
            </ul>
            <p>You can review the draft using the button below:</p>
            <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Draft</a>
            </div>
            <p>If you need to follow up, please contact the lawyer directly or take any necessary action.</p>

        @else

           
                <p>This is an FYI that the draft for the second appeal for RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong> has been sent to the customer for review and approval.</p>
                
                <p>If needed, you may review the drafted second appeal by clicking the button below.</p>
                
                <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Draft</a>
                </div>
                
                <p>Thank you for keeping track of this process.</p>



        @endif
    @else



        @if($data->rtiApplication->appeal_no == 0)



            <p>The revised RTI application **(Application No: {{$data->rtiApplication->application_no}})** has been updated by **{{$data->rtiApplication->lawyer->first_name}} {{$data->rtiApplication->lawyer->last_name}}** and has been sent to the customer for review and approval.</p>

            <p>You can review the revised draft or download it using the button below:</p>

            <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Revised RTI Draft</a>
            </div>

            <p>No further action is required unless the customer requests additional modifications.</p>


        @elseif($data->rtiApplication->appeal_no == 1)

           

            <p>The revised RTI application **(Application No: {{$data->rtiApplication->application_no}})** has been updated by **{{$data->rtiApplication->lawyer->first_name}} {{$data->rtiApplication->lawyer->last_name}}** and has been sent to the customer for review and approval.</p>

            <p>You can review the revised draft or download it using the button below:</p>

            <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Revised RTI Draft</a>
            </div>

            <p>No further action is required unless the customer requests additional modifications.</p>

        @else

            <p>This is an FYI that the updated second appeal draft for RTI Application No: <strong>{{$data->rtiApplication->application_no}}</strong>—which incorporates the customer's feedback—has been sent to the customer for review and approval.</p>
            <div class="btn-container">
                <a href="{{route('rtiapplication.view', $data->rtiApplication->id)}}?request={{$data->id}}" class="btn ">Review Updated Draft</a>
            </div>

            <p>Thank you for keeping track of this process.</p>
        @endif

    @endif
@endsection
