@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>{{isset($data['id']) ? 'Edit' : 'New'}} @if(isset($_GET['type'])) {{sectionTypeList()[$_GET['type']]['title'] ?? ''}} @else {{sectionTypeList()[$data['type']]['title'] ?? ''}}  @endif Section</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('template-section.update', $data['id']) : route('template-section.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    @if(isset($_GET['type']))
                    <input hidden name="section_type" value="{{$_GET['type'] ?? ''}}">
                    @endif
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="form-group"> 
                                <label class="form-label">Title</label>
                                <div class="input-group">
                                    <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"> 
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="description">{{$data['description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label class="form-label">Image</label>
                                <div class="input-group">
                                    <input type="file" class=" upload-image dropify" id="images" @if(isset($data)) data-default-file="{{asset($details['image'] ?? '')}}" @endif>
                                    <div class="image-collection mt-3" >
                                        <input hidden type="text" value="{{$details['image'] ?? ''}}"  class="form-control image-input" name="image" data-lable="image" id="image">
                                        <input placeholder="Alternative text" type="text" value="{{$details['image_alt'] ?? ''}}" id="image_alt" name="image_alt" class="form-control w-100">
                                    </div>
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