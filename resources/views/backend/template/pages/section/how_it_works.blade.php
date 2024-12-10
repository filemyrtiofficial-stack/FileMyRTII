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
                        <h5>How it works</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['how_it_work_title'] ?? ''}}" name="how_it_work_title" id="how_it_work_title">
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
                                                    <input type="text" class="form-control" value="{{$data['how_it_work_link_title'] ?? ''}}" name="how_it_work_link_title" data-lable="how_it_work_link_title" id="how_it_work_link_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['how_it_work_link_url'] ?? ''}}" name="how_it_work_link_url" data-lable="how_it_work_link_url" id="how_it_work_link_url">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                            <hr>
                            <h5>Steps</h5>
                            <div class="step_list row mb-3" id="sortable_product">
                            @if(isset($data['step_list_row_count'] ))
                                @for($index = 0; $index < $data['step_list_row_count'] ?? 1; $index++)
                                    <div class="col-lg-6 draggable mb-3"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                        <div class=" mt-lg-0 card">
                                            <div class="card-body">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Title</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control step_title" value="{{$data['step_title_'.$index] ?? ''}}" name="step_title_{{$index}}" id="step_title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control step_description" value="{{$data['step_description_'.$index] ?? ''}}"  name="step_description_{{$index}}" id="step_description">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <div class="input-group">
                                                            <input type="file" class=" upload-image dropify" id="upload-image_{{$index}}" >
                                                                <input hidden type="text"  class="form-control image-input step_image image-input" value="{{$data['step_image_'.$index] ?? ''}}" name="step_image_{{$index}}" id="step_image_{{$index}}">
                                                                <input placeholder="Alternative text" type="text"  id="step_image_alt_{{$index}}" value="{{$data['step_image_alt_'.$index] ?? ''}}" name="step_image_alt_{{$index}}" class="form-control w-100 step_image_alt">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-danger mt-4 step_list_remove">Remove</button>

                                            </div>
                                        </div>
                                    
                                    </div>
                                @endfor
                            @endif
                               
                            </div>
                            <input type="hidden" name="step_list_row_count" id="step_list_row_count" value="{{$data['step_list_row_count'] ?? 1}}">

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
        $('.step_list').append(`<div class="col-lg-6 draggable mb-3"  id="row0"  draggable="true" productID="0">
                                    <div class=" mt-lg-0 card">
                                        <div class="card-body">

                                            <div class="col-12">
                                                <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control step_title" name="step_title_0" id="step_title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control step_description"  name="step_description_0" id="step_description">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <div class="input-group">
                                                        <input type="file" class=" upload-image dropify" >
                                                            <input hidden type="text"  class="form-control image-input step_image" name="step_image_0" id="step_image_0">
                                                            <input placeholder="Alternative text" type="text"  id="step_image_alt_0" name="step_image_alt_0" class="form-control w-100 step_image_alt">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-danger mt-4 step_list_remove">Remove</button>

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
            $(this).find('.step_title').attr('name', 'step_title_'+index).attr('id', 'step_title_'+index);
            $(this).find('.step_description').attr('name', 'step_description_'+index).attr('id', 'step_description_'+index);
            $(this).find('.step_image').attr('name', 'step_image_'+index).attr('id', 'step_image_'+index);
            $(this).find('.step_image_alt').attr('name', 'step_image_alt_'+index).attr('id', 'step_image_alt_'+index);



        });
        $('#step_list_row_count').val($('.step_title').length);
    }
    </script>
@endpush