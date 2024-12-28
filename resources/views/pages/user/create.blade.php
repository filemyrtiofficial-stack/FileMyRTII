@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>New User</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="/users" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="firstname" name="firstname" class="form-control" type="text" placeholder="Firstname" value="" >
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="lastname" name="lastname" class="form-control" type="text" placeholder="Lastname" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
