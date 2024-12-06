@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Speciality Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Speciality</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('specialities.update', $data['id']) : route('specialities.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control"
                                    type="text" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-6">
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
                        <div class="col-6">
                            <label class="form-label">Icon</label>
                            <div class="input-group">
                                <input name="icon" type="file" class="form-control" id="icon">
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