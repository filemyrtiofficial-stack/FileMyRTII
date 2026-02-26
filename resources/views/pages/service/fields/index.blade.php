@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('services.index')}}">Service</a></li>
<li class="breadcrumb-item" aria-current="page">Fields</li>


@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<form method="POST" action="{{route('service-field.store', $data['id'])}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    <div class="row mt-4 mx-4 fields-row customer-field-list"  id="sortable_product">
        <?php $item_count = 0; ?>
        @if(isset($fields) && isset($fields['field_type']))
            @foreach($fields['field_type'] as $key => $field)

            <div class="col-md-3 draggable"  id="row{{  $key }}"  draggable="true" productID="{{ $key}}">
                <div class="card mt-3">
                    <div class="card-body">
                    <div class="form-group">
                            <label for="">Field For</label> <br>
                            <div class="input-group">
                                <select type="text" name="form_field_type[]" class="form-control" required>
                                    @foreach(formAdditionalFields() as $field_type_key  => $value)
                                    <option value="{{$field_type_key}}" @if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] == $field_type_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Field Type</label> <br>
                            <div class="input-group">
                                <select type="text" name="field_type[]" class="form-control field_type" required id="field_type_{{$item_count}}" data-key="{{$item_count}}">
                                    {!! fieldListOptions($fields['field_type'][$key]) !!}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Field Lable</label> <br>
                            <div class="input-group">
                                <input type="text" name="field_lable[]" class="form-control" required value="{{$fields['field_lable'][$key]}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Place Holder for Document</label> <br>
                            <div class="input-group">
                                <input type="text" name="document_placeholder[]" class="form-control" required value="{{$fields['document_placeholder'][$key] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Field Placeholder</label> <br>
                            <div class="input-group">
                                <input type="text" name="placeholder[]" class="form-control" value="{{$fields['placeholder'][$key] ?? ''}}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="">Is Required</label> <br>
                            <div class="input-group">
                                <select type="text" name="is_required[]" class="form-control" required>
                                        {!! booleanListOptions($fields['is_required'][$key] ?? '') !!}
                                </select>
                            </div>
                        </div>
                        <div class="options-other-validations"  @if($fields['field_type'][$key] != "select")style="display:none;" @endif>
                            <div class="form-group">
                                <label for="">Options</label> <br>
                                <div class="input-group">
                                <input type="text" name="options[]" class="form-control" value="{{$fields['options'][$key] ?? null}}">

                                </div>
                                <span class="text-danger">Note :  Options should be comma separated like options1,option2</span>
                            </div>
                        </div>
                        <div class="date-other-validation" @if($fields['field_type'][$key] != "date")style="display:none;" @endif>
                            <div class="form-group">
                                <label for="">Minimum Date</label> <br>
                                <div class="input-group">
                                <input type="date" name="minimum_date[]" class="form-control" value="{{$fields['minimum_date'][$key] ?? null}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Maximum Date</label> <br>
                                <div class="input-group">
                                <input type="date" name="maximum_date[]" class="form-control" value="{{$fields['maximum_date'][$key] ?? null}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Dependency Date Field</label> <br>
                                <div class="input-group">
                                <input type="" name="dependency_date_field[]" class="form-control" value="{{$fields['dependency_date_field'][$key] ?? ''}}">

                                </div>
                            </div>
                        </div>

                        <div class="numeric-other-validation">
                            <div class="form-group">
                                <label for="">Validations</label> <br>
                                <div class="input-group">
                                <input  name="validations[]" class="form-control" value="{{$fields['validations'][$key] ?? null}}">

                                </div>
                            </div>
                            <span class="text-danger">Note : digits:10|numeric </span>
                        </div>
                        <div class="numeric-other-validation">
                            <div class="form-group">
                                <label for="">Default Value</label> <br>
                                <div class="input-group default_values_section_{{$item_count}}">
                                    <textarea  name="default_values[]" class="form-control <?php if(!isset($fields['field_type'][$key]) || $fields['field_type'][$key] == 'richtext') {?> editor <?php } ?> default_values" id="default_values_{{$item_count}}">{{$fields['default_values'][$key] ?? null}}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                    </div>
                </div>

            </div>
                <?php $item_count++; ?>
            @endforeach
        @else
        @include('pages.service.customer-field')      

                    
        @endif

    
    </div>

    <div class="mt-5 text-right">
    <button type="button" class="btn btn-secondary add-more-lawyer-field"  >Add More Fields</button>
    <button type="submit" class="btn btn-primary"  >Submit</button>

    </div>
    <input type="text" id="update_array" name="update_array" hidden>

</form>
<div class="hide hidden-content"></div>
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more-lawyer-field', function(e){
        e.preventDefault();
        let html = `<?php echo view('pages.service.customer-field')->render();?>`
        $('.customer-field-list').append(html)
        let index = 0;
        $('.default_values').each(function(){
            $(this).attr('id', 'default_values_'+index);
            $(this).parents().eq(3).find('.field_type').attr('id', 'field_type_'+index).attr('data-key', index);
            index = index + 1;
        });
        
        if($("#field_type_"+($('.field_type_').length -1 )) == 'richtext') {
              
        $("#default_values_"+($('.default_values').length -1 )).each(function(_, ckeditor) {
            CKEDITOR.replace(ckeditor);
        });
        }
        
      
    });
    $(document).on('change', '.field_type', function(){
        $(this).parents().eq(2).find('.options-other-validations').hide();
        $(this).parents().eq(2).find('.date-other-validation').hide();
        if($(this).val() == 'date') {
            $(this).parents().eq(2).find('.date-other-validation').show();
        }
        else if($(this).val() == 'select') {
            $(this).parents().eq(2).find('.options-other-validations').show();
        }
        else {

            $(this).parents().eq(2).find('.date-other-validation').hide();
        }
        
        if($(this).val() == 'richtext') {
            $("#default_values_"+$(this).attr('data-key')).each(function(_, ckeditor) {
            CKEDITOR.replace(ckeditor);
        });
        }
        else {
            let key = $(this).attr('data-key');
            const editorId = ".default_values_section_"+$(this).attr('data-key'); // Replace with your actual ID
            let val = $(editorId).find('.default_values').val();
            $('.hidden-content').html(val);
            val = $('.hidden-content').text();
            // val = val.text();
            // val = val.replace(/< /?[br|li|ol|ul]+/?>/igm,'');

            $(editorId).html(`<textarea  name="default_values[]" class="form-control editor default_values" id="default_values_${key}">${val}</textarea>`)
            //     console.log(editorId)
            // if (CKEDITOR.instances[editorId]) {
            //     CKEDITOR.instances[editorId].remove();
            // }
          
        }
    });
  
    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(2).remove();
    })
</script>

@endpush