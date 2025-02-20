@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'PIO Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'Add'}} PIO</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('pio.update', $data['id']) : route('pio.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                 
                    <div class="row mt-5">
                    <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <textarea id="address" name="address" class="form-control" type="text" placeholder="Address" rows="12">{{ $data['address'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <div class="input-group">
                                    <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Contact Number</label>
                                <div class="input-group">
                                    <input id="phone_number" name="phone_number" value="{{$data['phone_number'] ?? ''}}" class="form-control"
                                        type="text" min="6" max="15" placeholder="Contact Number">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Email ID</label>
                                <div class="input-group">
                                    <input id="email" name="email" value="{{$data['email'] ?? ''}}" class="form-control"
                                        type="email" placeholder="Email ID">
                                </div>
                            </div>
                        </div> -->
                      
                      
                                
                        <!-- <div class="col-4">
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
                        </div> -->
                        <!-- <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <input name="address" class="form-control" id="address" rows="12" value="{{$data['address'] ?? ''}}">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">District</label>
                                <div class="input-group">
                                    <input name="city" class="form-control" id="city" rows="12" value="{{$data['city'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Mandal</label>
                                <div class="input-group">
                                    <input name="mandal" class="form-control" id="mandal" rows="12" value="{{$data['mandal'] ?? ''}}">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Tahsildar</label>
                                <div class="input-group">
                                    <input name="tahsildar" class="form-control" id="tahsildar" rows="12" value="{{$data['tahsildar'] ?? ''}}">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <div class="input-group">
                                    <input name="department" class="form-control" id="department" rows="12" value="{{$data['department'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <div class="input-group">
                                    <input name="state" class="form-control" id="state" rows="12" value="{{$data['state'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Pincode</label>
                                <div class="input-group">
                                    <input name="pincode" class="form-control" id="pincode" rows="12" value="{{$data['pincode'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Profile Image</label>
                                <div class="input-group">
                                    <input name="image" type="file" class="form-control dropify" id="image" @if(isset($data)) data-default-file="{{ asset($data->image) }}" @endif>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection