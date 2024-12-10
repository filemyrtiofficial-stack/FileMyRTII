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
                                            <input type="text" class="form-control" value="{{$data['home_banner_title'] ?? ''}}" name="home_banner_title" id="home_banner_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['home_banner_description'] ?? ''}}" name="home_banner_description" id="home_banner_description">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">CTA Buttom</label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['home_banner_banner_link_title'] ?? ''}}" name="home_banner_banner_link_title" data-lable="home_banner_banner_link_title" id="home_banner_banner_link_title-0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['home_banner_banner_link_url'] ?? ''}}" name="home_banner_banner_link_url" data-lable="home_banner_banner_link_url" id="home_banner_banner_link_url-0">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Mobile Banner</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="home_banner_banner_mobile_image">
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['home_banner_banner_mobile_image'] ?? ''}}"  class="form-control image-input" name="home_banner_banner_mobile_image" data-lable="home_banner_banner_mobile_image" id="home_banner_banner_mobile_image">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['home_banner_banner_mobile_image_alt'] ?? ''}}" id="home_banner_banner_mobile_image_alt" name="home_banner_banner_mobile_image_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Desktop Banner</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="home_banner_banner_desktop_image_input">
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['home_banner_banner_desktop_image'] ?? ''}}"  class="form-control image-input" name="home_banner_banner_desktop_image" data-lable="home_banner_banner_desktop_image" id="home_banner_banner_desktop_image">
                                                        <input placeholder="Alternative text" type="text" value="{{$data['home_banner_banner_desktop_image_alt'] ?? ''}}" id="home_banner_banner_desktop_image_alt" name="home_banner_banner_desktop_image_alt" class="form-control w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Banner Slider</h5>
                            <div class="banner_slider_list row mb-3" id="sortable_product">
                            @if(isset($data['banner_slider_list_row_count'] ))
                                @for($index = 0; $index < $data['banner_slider_list_row_count'] ?? 1; $index++)
                                    <div class="col-lg-6 draggable mb-3"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                        <div class=" mt-lg-0 card">
                                            <div class="card-body">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Title</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control home_banner_banner_review_slider_title" value="{{$data['home_banner_banner_review_slider_title_'.$index] ?? ''}}" name="home_banner_banner_review_slider_title_{{$index}}" id="home_banner_banner_review_slider_title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control home_banner_banner_review_slider_description" value="{{$data['home_banner_banner_review_slider_description_'.$index] ?? ''}}"  name="home_banner_banner_review_slider_description_{{$index}}" id="home_banner_banner_review_slider_description">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <div class="input-group">
                                                            <input type="file" class=" upload-image dropify" id="upload-image_{{$index}}" >
                                                                <input hidden type="text"  class="form-control image-input home_banner_banner_review_slider_image image-input" value="{{$data['home_banner_banner_review_slider_image_'.$index] ?? ''}}" name="home_banner_banner_review_slider_image_{{$index}}" id="home_banner_banner_review_slider_image_{{$index}}">
                                                                <input placeholder="Alternative text" type="text"  id="home_banner_banner_review_slider_image_alt_{{$index}}" value="{{$data['home_banner_banner_review_slider_image_alt_'.$index] ?? ''}}" name="home_banner_banner_review_slider_image_alt_{{$index}}" class="form-control w-100 home_banner_banner_review_slider_image_alt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-danger mt-4 banner_slider_list_remove">Remove</button>

                                            </div>
                                        </div>
                                    
                                    </div>
                                @endfor
                            @endif
                               
                            </div>
                            <input type="hidden" name="banner_slider_list_row_count" id="banner_slider_list_row_count" value="{{$data['banner_slider_list_row_count'] ?? 1}}">

                            <button type="button" class="btn btn-primary btn-sm add-module-section"  data-key="0">Add More</button>




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
@push('js')
<script>
    $(document).on('click', '.add-module-section', function(e){
        e.preventDefault();
    
     renderHtml();

    });
    if('<?=$id?>'== '') {

        renderHtml()
    }
    
    function renderHtml(){
        $('.banner_slider_list').append(`<div class="col-lg-6 draggable mb-3"  id="row0"  draggable="true" productID="0">
                                    <div class=" mt-lg-0 card">
                                        <div class="card-body">

                                            <div class="col-12">
                                                <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control home_banner_banner_review_slider_title" name="home_banner_banner_review_slider_title_0" id="home_banner_banner_review_slider_title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control home_banner_banner_review_slider_description"  name="home_banner_banner_review_slider_description_0" id="home_banner_banner_review_slider_description">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <div class="input-group">
                                                        <input type="file" class=" upload-image dropify" >
                                                            <input hidden type="text"  class="form-control image-input home_banner_banner_review_slider_image" name="home_banner_banner_review_slider_image_0" id="home_banner_banner_review_slider_image_0">
                                                            <input placeholder="Alternative text" type="text"  id="home_banner_banner_review_slider_image_alt_0" name="home_banner_banner_review_slider_image_alt_0" class="form-control w-100 home_banner_banner_review_slider_image_alt">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-danger mt-4 banner_slider_list_remove">Remove</button>

                                        </div>
                                    </div>
                                 
                                </div>`);
     $('.dropify').dropify();
     restructureList();

    }
    function restructureList() {
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.upload-image').attr('id', 'upload-image'+index);
            $(this).find('.home_banner_banner_review_slider_title').attr('name', 'home_banner_banner_review_slider_title_'+index).attr('id', 'home_banner_banner_review_slider_title_'+index);
            $(this).find('.home_banner_banner_review_slider_description').attr('name', 'home_banner_banner_review_slider_description_'+index).attr('id', 'home_banner_banner_review_slider_description_'+index);
            $(this).find('.home_banner_banner_review_slider_image').attr('name', 'home_banner_banner_review_slider_image_'+index).attr('id', 'home_banner_banner_review_slider_image_'+index);
            $(this).find('.home_banner_banner_review_slider_image_alt').attr('name', 'home_banner_banner_review_slider_image_alt_'+index).attr('id', 'home_banner_banner_review_slider_image_alt_'+index);



        });
        $('#banner_slider_list_row_count').val($('.home_banner_banner_review_slider_title').length);
    }
    </script>
@endpush