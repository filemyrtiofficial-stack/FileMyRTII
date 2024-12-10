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
                        <h5>Right Image Left Text</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" id="title">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <div class="input-group">
                                            <textarea class="form-control editor" name="description" id="description">{{$data['description'] ?? ''}}</textarea>
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
                                                <label class="form-label">Image 1</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="image1">
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['image_1'] ?? ''}}"  class="form-control image-input" name="image_1" data-lable="image_1" id="image_1">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['image_1_alt'] ?? ''}}" id="image_1_alt" name="image_1_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Image 2</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="image2">
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['image_2'] ?? ''}}"  class="form-control image-input" name="image_2" data-lable="image_2" id="image_2">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['image_2_alt'] ?? ''}}" id="image_2_alt" name="image_2_alt" class="form-control w-100">
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
