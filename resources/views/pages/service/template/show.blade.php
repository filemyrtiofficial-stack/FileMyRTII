@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])


<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Template</h4>
            </div>
            <div class="card-body pt-0">
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input id="name" name="name" value="{{$data['template_name'] ?? ''}}" class="form-control" disabled
                                type="text" placeholder="Name">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <div class="input-group">
                                <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control" disabled
                                type="text" placeholder="Title">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Sub Title</label>
                            <div class="input-group">
                                <input id="title" name="sub_title" value="{{$data['sub_title'] ?? ''}}" class="form-control" disabled
                                type="text" placeholder="Sub Title">
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-12">
                        
                            {!! $data['template'] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>  



@endsection
