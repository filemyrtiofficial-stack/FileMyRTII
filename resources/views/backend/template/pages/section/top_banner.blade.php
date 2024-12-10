@extends('layouts.app')

@section('content')
<form action="{{route('update-page-section', $page_id)}}" method="post" class="form-submit">
@csrf
<input type="hidden" name="section_key" value="{{$section_key}}">
<input type="hidden" name="key" value="{{$id}}">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Hero Banner</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['top_banner_title'] ?? ''}}" name="top_banner_title" id="top_banner_title">
                                    </div>
                                </div>
                            </div>
                        

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Images </label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Mobile Banner @if(isset($data)) <a target="blank" href="{{ asset($data['top_banner_mobile_image'] ) }}"><img width="20" src="{{ asset($data['top_banner_mobile_image'] ) }}" alt=""></a> @endif</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="top_banner_mobile_image" @if(isset($data)) data-default-file="{{ asset($data['top_banner_mobile_image'] ?? '') }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['top_banner_mobile_image'] ?? ''}}"  class="form-control image-input" name="top_banner_mobile_image" data-lable="top_banner_mobile_image" id="top_banner_mobile_image">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['top_banner_mobile_image_alt'] ?? ''}}" id="top_banner_mobile_image_alt" name="top_banner_mobile_image_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Desktop Banner @if(isset($data)) <a target="blank" href="{{ asset($data['top_banner_desktop_image'] ) }}"><img width="20" src="{{ asset($data['top_banner_desktop_image'] ) }}" alt=""></a> @endif</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="top_banner_desktop_image_input" @if(isset($data)) data-default-file="{{ asset($data['top_banner_desktop_image'] ?? '') }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['top_banner_desktop_image'] ?? ''}}"  class="form-control image-input" name="top_banner_desktop_image" data-lable="top_banner_desktop_image" id="top_banner_desktop_image">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['top_banner_desktop_image_alt'] ?? ''}}" id="top_banner_desktop_image_alt" name="top_banner_desktop_image_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            



                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="mt-5 float-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
        </div>
    </div>
</form>
@endsection
