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
                        <h5>Blogs</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                @foreach($template['fields'] as $field)
                                    <?php
                                    $title = $template['key'].'_'.($field['name'] ?? '' );
                                    ?>
                                    <div class="form-group">
                                        <label class="form-label">{{$field['lable'] ??''}}</label>
                                        <div class="input-group">
                                            @if($field['type'] == 'input')
                                            <input type="text" class="form-control" value="{{$data[$title] ?? ''}}" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}">
                                            @elseif($field['type'] == 'select')
                                            <select class="form-control" @if(isset($field['check_multiple_type']) && isset($data[$field['check_multiple_type']]) && $data[$field['check_multiple_type']] == 'yes') multiple @endif   name="{{$template['key']}}_{{$field['name']}}@if(isset($field['check_multiple_type']) && isset($data[$field['check_multiple_type']]) && $data[$field['check_multiple_type']] == 'yes')[]@endif" @if(isset($field['target'])) data-target="{{$field['target']}}" @endif data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}">
                                                <option value="">{{$field['lable'] ??''}}</option>
                                                @foreach($field['options'] as $option)
                                                    <option value="{{$option['id'] ?? ''}}" @if(isset($data[$title]) && ((gettype($data[$title]) == 'string' && $data[$title] == $option['id'] ) || (gettype($data[$title]) == 'array' && in_array($option['id'] , $data[$title])))) selected @endif>{{$option['title'] ??( $option['name'] ?? '') }}</option>
                                                @endforeach
                                            </select>
                                           
                                            @elseif($field['type'] == 'link')
                                                <div class="row">
                                                    @foreach($field['fields'] as $sub_field)
                                                        <?php
                                                        $title = $template['key'].'_'.($sub_field['name'] ?? '' );
                                                        ?>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label">{{$sub_field['lable'] ??''}}</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" value="{{$data[$title] ?? ''}}" name="{{$template['key']}}_{{$sub_field['name']}}" data-lable="{{$template['key']}}_{{$sub_field['name']}}" id="{{$template['key']}}_{{$sub_field['name']}}-0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @elseif($field['type'] == 'image')
                                            <input type="file" class=" upload-image" id="{{$template['key']}}_{{$field['name']}}">
                                            <div class="image-collection" >
                                                <input hidden type="text" value="{{$data[$title] ?? ''}}"  class="form-control image-input" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}">
                                                <img src="{{asset($data[$title] ?? '')}}" class="img-preview" id="{{$template['key']}}_{{$field['name']}}" width="100" height="100">
                                                <input type="text" value="{{$data[$title.'_alt'] ?? ''}}" id="{{$template['key']}}_{{$field['name']}}" name="{{$template['key']}}_{{$field['name']}}_alt" class="form-control">
                                            </div>
                                            @elseif($field['type'] == 'textarea')
                                            <textarea class="form-control" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}">{{$data[$title] ?? ''}}</textarea>
                                            @elseif($field['type'] == 'section')

                                                @include('backend.template.pages.section.'.$field['key'],['template' => $field, 'prefix_key' => $template['key']])
                                            @endif
                                        </div>
                                    </div>
                                
                                @endforeach
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
       let target = $(this).attr('data-target');
       $(this).parents().eq(0).find('.add-new-section').append('<div class="col-12 row-item" >'+$(this).siblings().find('.row-item').html()+'</div>');
       $(this).parents().eq(0).find('#'+target+"_row_count").val($(this).siblings().find('.row-item').length);
        let key = $(this).attr('data-key');

       $( $('.home_banner_banner_review_slider_image')).each(function( index, value ) {
               

            $(this).attr('id', $(this).attr('data-key')+"_"+index)
        });

    })
    </script>
@endpush