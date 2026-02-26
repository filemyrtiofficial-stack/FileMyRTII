@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('users.index')}}">User</a></li>
@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endif
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'Add'}} User</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('users.update', $data['id']) : route('users.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                 
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
                                    <div class="show-password-section mb-1-2">
                                        <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password" class="ml-2">Show Password</label>
                                    </div>
                            </div>
                        </div>
                        
                                
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control">
                                        @foreach(commonStatus() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <div class="input-group">
                                    <select name="role" id="role" class="form-control">
                                   
                                        @foreach($roles as $key => $item)
                                        <option value=" {{$item['name']}}" @if(isset($data)  && count($data->roles) > 0 && $data->roles[0]['name']==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
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