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
                        <h5>Footer Banner</h5>
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
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-label"><strong>Banner</strong></label>
                                        <div class="banner-list" @if(isset($data['custom_banner']) && $data['custom_banner'] == 'yes') style="display:none" @endif>

                                            <div class="d-flex "  id="row0"  draggable="true" productID="0">
                                                <div class="col-lg-9 mt-lg-0">
                                                    <div class="card-body">
                                                        <select name="banner" id="banner" class="form-control " >
                                                            <option value="">Select</option>    
                                                        {!!  sectionTemplateOptions('footer_banner')!!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-banner-list"
                                        @if(empty($id) || (isset($data['custom_banner']) && $data['custom_banner'] == 'no'))style="display:none" @endif
                                        >
                                        <!-- @if(!isset($data) || (isset($data['custom_banner']) && $data['custom_banner'] == 'no'))  style="display:none" @endif -->
                                            <div class="row">
                                                <!-- <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Title</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" value="{{$data['banner_title'] ?? ''}}" name="banner_title" id="banner_title">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <div class="input-group">
                                                                <textarea type="text" class="form-control"  name="description" id="description" rows="12">{{$data['description'] ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Banner</label>
                                                        <div class="input-group">
                                                            <input type="file" class=" upload-image dropify" id="banner_image_input">
                                                            <div class="image-collection mt-3" >
                                                                <input hidden type="text" value="{{$data['banner_image'] ?? ''}}"  class="form-control image-input" name="banner_image" data-lable="banner_image" id="banner_image">
                                                                <input placeholder="Alternative text" type="text" value="{{$data['banner_image_alt'] ?? ''}}" id="banner_image_alt" name="banner_image_alt" class="form-control w-100">
                                                            </div>
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
                                            </div>
                                        </div>


                                    </div>
                                    <label for="">Use Custom Footer Banner</label>
                                    <select name="custom_banner" id="custom_banner" class="form-control">
                                        @foreach(BooleanList() as $key =>  $value)
                                        <option value="{{$key}}" @if(isset($data['custom_banner']) && $data['custom_banner'] == $key)  selected @endif>{{$key}}</option>
                                        @endforeach
                                    </select>
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
    </div>
</form>
@endsection
@push('js')
<script>
    $(document).on('change', '#custom_banner', function(){
        if($(this).val() == 'yes') {
            $('.custom-banner-list').show();
            $('.banner-list').hide();
          
        }
        else {
            $('.custom-banner-list').hide();
            $('.banner-list').show();
        }
    })
</script>
@endpush