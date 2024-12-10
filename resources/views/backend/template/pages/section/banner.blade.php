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
                                            <input type="text" class="form-control" value="{{$data['banner_title'] ?? ''}}" name="banner_title" id="banner_title">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">CTA Button</label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['banner_link_title'] ?? ''}}" name="banner_link_title" data-lable="banner_link_title" id="banner_link_title-0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['banner_link_url'] ?? ''}}" name="banner_link_url" data-lable="banner_link_url" id="banner_link_url-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Images </label>
                                    <div class="input-group">
                                    <div class="row">
                                      
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label class="form-label">Desktop Banner</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="banner_image_input">
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['banner_image'] ?? ''}}"  class="form-control image-input" name="banner_image" data-lable="banner_image" id="banner_image">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['banner_image_alt'] ?? ''}}" id="banner_image_alt" name="banner_image_alt" class="form-control w-100">
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
