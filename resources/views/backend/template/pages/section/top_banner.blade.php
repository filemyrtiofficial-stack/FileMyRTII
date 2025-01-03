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
                        <h5>Hero Banner</h5>
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
                                    <label class="form-label">Images </label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Mobile Banner @if(isset($data) && isset($data['top_banner_mobile_image'])) <a target="blank" href="{{ asset($data['top_banner_mobile_image'] ) }}"><img width="50" src="{{ asset($data['top_banner_mobile_image'] ) }}" alt=""></a> @endif</label>
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
                                                <label class="form-label">Desktop Banner @if(isset($data) && isset($data['top_banner_desktop_image'])) <a target="blank" href="{{ asset($data['top_banner_desktop_image'] ) }}"><img width="50" src="{{ asset($data['top_banner_desktop_image'] ) }}" alt=""></a> @endif</label>
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
                            
                            <hr>
                            <div class="col-12 table-responsive">
                                <label for="">Breakdrumbs</label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Lable</th>
                                            <th>Link</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add-more-breaddrum-list">
                                        @if($id != null && isset($data['breadcrum_label']))
                                            @foreach($data['breadcrum_label'] as $key => $value)
                                                <tr>
                                                    <td><input type="text" class="form-control" name="breadcrum_label[]" value="{{ $value}}"></td>
                                                    <td><input type="text" class="form-control" name="breadcrum_url[]" value="{{$data['breadcrum_url'][$key] ?? ''}}"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger remove-breadcrum"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td><input type="text" class="form-control" name="breadcrum_label[]"></td>
                                            <td><input type="text" class="form-control" name="breadcrum_url[]"></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-breadcrum"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endif
                                       
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-secondary add-more-breaddrum">Add More Breadcrum</button>
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

@push('js')
<script>
    $(document).on('click', '.add-more-breaddrum', function(e){
        $('#add-more-breaddrum-list').append(`  <tr>
                                            <td><input type="text" class="form-control" name="breadcrum_label[]"></td>
                                            <td><input type="text" class="form-control" name="breadcrum_url[]"></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-breadcrum"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>`);
    });
    $(document).on('click', '.remove-breadcrum', function(e){
        $(this).parents().eq(1).remove();
    });
</script>
@endpush