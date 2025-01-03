@extends('layouts.app')

@section('content')
<form action="{{route('update-page-section', $page_id)}}" method="post" class="form-submit">
@csrf
<input type="hidden" name="section_key" value="{{$section_key}}">
<input type="hidden" name="key" value="{{$id}}">
<input type="hidden" name="page_type" value="{{$page_type}}">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Left Image Right Text</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" id="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                        <label class="form-label">Partition</label>
                                        <div class="input-group">
                                            <select type="text" class="form-control" value="{{$data['partition'] ?? ''}}" name="partition" id="partition">
                                                @foreach(partition() as $key => $value)
                                                    <option value="{{$key}}">{{$key}}</option>
                                                @endforeach    
                                            </select>
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
                                    <label class="form-label">CTA Button</label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['link_title'] ?? ''}}" name="link_title" data-lable="link_title" id="link_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['link_url'] ?? ''}}" name="link_url" data-lable="link_url" id="link_url">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Image 1 @if(isset($data) && isset($data['image_1'])) <a href="{{ asset($data['image_1']) }}" target="blank"><img src="{{ asset($data['image_1']) }}" alt="" width="50"></a>@endif</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="image1" @if(isset($data) && isset($data['image_1'])) data-default-file="{{ asset($data['image_1']) }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['image_1'] ?? ''}}"  class="form-control image-input" name="image_1" data-lable="image_1" id="image_1">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['image_1_alt'] ?? ''}}" id="image_1_alt" name="image_1_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Image 2 @if(isset($data) && isset($data['image_2'])) <a href="{{ asset($data['image_2']) }}" target="blank"><img src="{{ asset($data['image_2']) }}" alt="" width="50"></a>@endif</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="image2" @if(isset($data) && isset($data['image_2'])) data-default-file="{{ asset($data['image_2']) }}" @endif>
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
