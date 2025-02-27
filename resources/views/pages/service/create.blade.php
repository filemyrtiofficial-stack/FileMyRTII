@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('services.index')}}">Services</a></li>
@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endif
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<style>
    .hide {
        display:none;
    }
</style>
<form method="POST" action="{{isset($data['id']) ? route('services.update', $data['id']) : route('services.store')}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="d-flex justify-content-center mb-5">
        <div class="row col-lg-12">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Service</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control {{!isset($data['id']) ? 'enable-slug' : ''}}"
                                        type="text" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            

                            
                          

                          
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Icon @if(isset($data) && isset($data['icon'])) <a target="blank" href="{{ asset($data['icon'] ) }}"><img width="50" src="{{ asset($data['icon'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="icon" type="file" class="form-control dropify" id="icon"  @if(isset($data)) data-default-file="{{ asset($data['icon'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control editor" id="description" rows="5">{{$data['description'] ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($data))
                <div class="card mt-4">
                    <div class="card-header">
                      <h5>Section List</h5>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sectionSelectionModalCenter">Select Section</button>
                    </div>
                    <div class="card-body pt-0">
                        <div class=" mt-5">
                        <div class="accordion" id="sortable_product">
                          @foreach($data->serviceData ?? [] as $key => $item)
                            <?php
                            $item_data = templateList()[$item->section_key] ?? [];
                            $details = json_decode($item->data, true);
                            ?>
                            <div class="card draggable"  id="row{{  $item->id }}"  draggable="true" productID="{{ $item->id}}">
                              <div class="card-header" id="headingOne" style="background: #e3e3e3;;">
                                <h2 class="mb-0">
                                      <strong>{{$item_data['section_name'] ?? ''}} </strong>
                                </h2>
                                  <h4>({!! $details['title'] ?? '' !!})</h4>
                                <div class="accordian-actions">
                                  <a href="{{route('get-services-section',[$data->id, $item->section_key, $item->id])}}" class="btn btn-sm btn-secondary">Edit</a>
                                  <button href="{{route('delete-services-section',[$item->id])}}" class="btn btn-sm btn-danger ml-3 delete-btn">Delete</button>

                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>

                        </div>
                    </div>
                </div>
                @endif
             
            </div>
            <div class="col-lg-4">
              <div class="card mt-4">
                    <div class="card-header">
                      <h5>SEO Details</h5>
                      
                    </div>
                  <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Slug</label>
                                    <div class="input-group">
                                        <input id="slug" name="slug" value="{{$data->slug->slug ?? ''}}" class="form-control"
                                            type="text" placeholder="slug">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <div class="input-group">
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $key => $item)
                                            <option value="{{$item->id}}" @if(isset($data['category_id']) && $data['category_id']==$item->id)
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                            @foreach(commonStatus() as $key => $item)
                                            <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Create New Page</label>
                                    <div class="input-group">
                                        <select name="create_new_page" id="create_new_page" class="form-control">
                                            @foreach(yesNoOption() as $key => $item)
                                            <option value="{{$item['id']}}" @if(isset($fields['create_new_page']) && $fields['create_new_page']==$item['id'])
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-3">
                            <h5 class="ml-2">Meta Details</h5>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <div class="input-group">
                                        <input id="meta_title" name="meta_title" value="{{$data->seo->meta_title ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <div class="input-group">
                                        <input id="meta_keywords" name="meta_keywords" value="{{$data->seo->meta_keywords ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_keywords">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <div class="input-group">
                                        <textarea id="meta_description" name="meta_description" class="form-control"
                                            type="text" placeholder="meta_description">{{$data->seo->meta_description ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-right">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#cutomer_field_popup" type="button">Add Form Fields</button>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                     
                  </div>
              </div>
              
              
          </div>
        </div>
        
    </div>  
    <input type="text" id="update_array" name="update_array" hidden>

   


    <div class="modal fade" id="cutomer_field_popup" tabindex="-1" role="dialog" aria-labelledby="lawyer_field_popup" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Field List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row customer-field-list">
                    @if(isset($fields) && isset($fields['field_type']))
                                @foreach($fields['field_type'] as $key => $field)

                                <div class="col-md-3">
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
                                                    <select type="text" name="field_type[]" class="form-control field_type" required>
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
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                                        </div>
                                    </div>
                        
                                </div>
                                @endforeach
                            @else
                    @include('pages.service.customer-field')      

                                
                            @endif

                </div>                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary add-more-lawyer-field"  >Add More Fields</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
</form>




<!-- Modal -->
 @if(isset($data))
<div class="modal fade" id="sectionSelectionModalCenter" tabindex="-1" role="dialog" aria-labelledby="sectionSelectionModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Section List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @foreach(templateList() as $key => $section)
          <div class="col-md-3 mb-3"  >

            <div class="card add-section1" data-key="{{$key}}" data-name="{{$section['section_name']}}">
              <div class="card-header p-0">
              <img src="{{asset('assets/section/'.$key.'.png')}}" class="w-100">

              </div>
              <div class="card-body">
                
              <a href="{{route('get-services-section', [$data->id, $key])}}">
              {{$section['section_name']}}
            </a>

              </div>
            </div>
          </div>
          @endforeach
        </div>
                                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more-lawyer-field', function(e){
        e.preventDefault();
        let html = `<?php echo view('pages.service.customer-field')->render();?>`
        $('.customer-field-list').append(html)
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
    });
  
    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(2).remove();
    })
</script>
<script>
    $(document).on('click', '.remove-faq-item', function() {
        $(this).parents().eq(1).remove();
    });
    $(document).on('click', '.add-more-faq', function(e) {
    
    $('#faq-list').append(`<tr>
                                <th><textarea name="question[]" class="form-control" id="" required></textarea></th>
                                    <th><textarea name="answer[]" class="form-control" id="" required></textarea></th>
                                    <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                    class="fa fa-trash"></i></button></th>
                            </tr>`);
})
    </script>
@endpush