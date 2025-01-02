@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Team Member Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Team Member</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('team-members.update', $data['id']) : route('team-members.store')}}"
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
                                    <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Expertise</label>
                                <div class="input-group">
                                    <input id="expertise" name="expertise" value="{{$data->expertise ?? ''}}" class="form-control"
                                        type="text" placeholder="Expertise">
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
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">About</label>
                                <div class="input-group">
                                    <textarea name="about" class="form-control" id="about" rows="12">{{$data['about'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Profile Image</label>
                                <div class="input-group">
                                    <input name="profile_image" type="file" class="form-control dropify" id="profile_image" @if(isset($data)) data-default-file="{{ asset($data->image) }}" @endif>
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