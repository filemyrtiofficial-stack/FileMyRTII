@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Field Management'])
<form method="POST" action="{{route('template-section-fields.update', $data['id'])}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Field</h5>
                </div>
                <div class="card-body pt-0">
                
                    
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group"> 
                                    <label class="form-label">Field Type</label>
                                    <div class="input-group">
                                        <input class="form-control" name="field_type" id="field_type" value="{{getTypeDetails($data['field_key'])['field_type'] ?? ''}}" disabled>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group"> 
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="slug" name="slug" value="{{$data->slugMaster->slug ?? ''}}" class="form-control"
                                            type="text" placeholder="Slug" disabled>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-6">
                                <div class="form-group"> 
                                    <label class="form-label">Lable <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="name" name="name" value="{{$data['field_lable'] ?? ''}}" class="form-control enable-slug"
                                            type="text" placeholder="Lable">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group"> 
                                    <label class="form-label">Allowed number of values <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="number_of_value_type" name="number_of_value_type" value="{{$data['number_of_value_type'] ?? ''}}" class="form-control">
                                            @foreach(allNumberOfValueOptions() as $key => $value)
                                                <option value="{{$key}}" @if(isset($field_data['number_of_value_type']) && $field_data['number_of_value_type'] == $key) selected @endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 number_of_value_count-section" @if(isset($field_data['number_of_value_type']) && $field_data['number_of_value_type'] == 'unlimited') style="display:none" @endif>
                                <div class="form-group"> 
                                    <label class="form-label">Allowed number of values <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="number_of_value_count" name="number_of_value_count" value="{{$field_data['number_of_value_count']?? '1'}}" min="1" class="form-control"
                                            type="number" >
                                    </div>
                                </div>
                            </div>
                            
                        
                        </div>
                </div>
            </div>
            @if(isset(getTypeDetails($data['field_key'])['additional_fields'] ))
            <div class="card mt-4">
                <div class="card-header">
                    <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Field</h5>
                </div>
                <div class="card-body pt-0">
                
                    
                        <div class="row mt-5">
                            @foreach(getTypeDetails($data['field_key'])['additional_fields'] as $key => $field)
                            <div class="col-12">
                                <div class="form-group"> 
                                    <label class="form-label"><strong>{{$field['lable']}}  @if(isset($field['required']) && $field['required'] == true ) <span class="text-danger">*</span> @endif</strong></label>
                                    <div class="row">
                                        @foreach($field['fields'] as $field_item)
                                            <div class="col-md-4">
                                                @if(isset($field_item['lable']))
                                                    <label class="form-label">{{$field_item['lable']}} </label>
                                                @endif
                                                <div class="input-group">
                                                    @if($field_item['type'] == 'input')
                                                        <input class="form-control" name="{{$field_item['name']}}" id="{{$field_item['name']}}" value="{{$field_data[$field_item['name']]?? ($field_item['default'] ?? '')}}" >
                                                    @elseif($field_item['type'] == 'select')
                                                        <select class="form-control select-2" name="{{$field_item['name']}}[]" id="{{$field_item['name']}}" multiple>
                                                            @foreach($field_item['options'] as $option)
                                                                <option value="{{$option['id']}}" @if(isset($field_data[$field_item['name']]) && in_array($option['id'], $field_data[$field_item['name']])) selected @endif>{{$option['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                
                                </div>
                            </div>
                            @endforeach
                        
                        
                        </div>
                       
                </div>
            </div>
            @endif
            <div class="mt-5 text-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection
@push('js')
<script>
    $(document).on('change', '#number_of_value_type', function(e){
        if($(this).val() == 'unlimited') {
            $('.number_of_value_count-section').hide();
        }
        else {
            $('.number_of_value_count-section').show();

        }
    })
</script>
@endpush