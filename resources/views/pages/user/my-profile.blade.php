@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item active" aria-current="page">My profile</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>My Profile</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{route('admin.update-profile')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                   
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <div class="input-group">
                                    <input id="name" name="name" value="{{$data['username'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Email ID</label>
                                <div class="input-group">
                                    <input id="email" name="email" value="{{$data['email'] ?? ''}}" class="form-control"
                                        type="email" placeholder="Email ID">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" value="" class="form-control password"
                                        type="password" >
                                </div>
                            </div>
                            <div class="show-password-section mb-1-2">
                                        <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password" class="ml-2">Show Password</label>
                                    </div>
                        </div>
                      

                        
                    </div>
                   
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection