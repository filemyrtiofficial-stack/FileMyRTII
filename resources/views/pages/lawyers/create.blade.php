@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lawyer Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'Add'}} Lawyer</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('lawyers.update', $data['id']) : route('lawyers.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                 
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="first_name" name="first_name" value="{{$data['first_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="First Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="last_name" name="last_name" value="{{$data['last_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">DOB</label>
                                <div class="input-group">
                                    <input id="dob" name="dob" value="{{$data['dob'] ?? ''}}" class="form-control"
                                        type="date" placeholder="DOB">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Contact Number</label>
                                <div class="input-group">
                                    <input id="phone" name="phone" value="{{$data['phone'] ?? ''}}" class="form-control"
                                        type="text" min="6" max="15" placeholder="Contact Number">
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
                                <label class="form-label">Qualification</label>
                                <div class="input-group">
                                    <input id="qualification" name="qualification" value="{{$data['qualification'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Qualification">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Experience</label>
                                <div class="input-group">
                                    <input id="experience" name="experience" value="{{$data['experience'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Experience">
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
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">About</label>
                                <div class="input-group">
                                    <textarea name="about" class="form-control" id="about" rows="12">{{$data['about'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <textarea name="address" class="form-control" id="address" rows="12">{{$data['address'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Profile Image</label>
                                <div class="input-group">
                                    <input name="image" type="file" class="form-control dropify" id="image" @if(isset($data)) data-default-file="{{ asset($data->image) }}" @endif>
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