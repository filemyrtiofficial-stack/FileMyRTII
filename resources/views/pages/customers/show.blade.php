@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Customer Details'])
<div class="row">
    <div class="col-md-4">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Customer Details</h4>
            </div>
            <div class="card-body">
                       
                           
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <h5 class="card-title">Name</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">{{ $data->firstName}}</h5>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <h5 class="card-title">Email</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">{{ $data->email}}</h5>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="heading">
                            <h5 class="card-title">Phone No.</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title">{{ $data->phone_no}}</h5>
                    </div>
                </div>
                <hr>

            </div>
        </div>
 
 
</div>
@endsection