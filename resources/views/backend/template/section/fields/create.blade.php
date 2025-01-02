@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Field Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Field</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('template-section-fields.update', $data['id']) : route('template-section-fields.store', $section_id)}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                  
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group"> 
                                <label class="form-label">Field Type</label>
                                <div class="input-group">
                                    <select class="form-control" name="field_type" id="field_type">
                                        <option value="">Select Field Type</option>
                                        @foreach(fieldTypeList() as $key => $field)
                                        <optgroup label="{{$key}}">
                                            @foreach($field as $field_item)
                                                <option value="{{$key}}#{{$field_item['field_key']}}" @if(isset($data) && $data['field_key'] ==  $key.'#'.$field_item['field_key']) selected @endif>{{$field_item['field_type']}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
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
                        <div class="col-6">
                            <div class="form-group"> 
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="slug" name="slug" value="{{$data->slugMaster->slug ?? ''}}" class="form-control"
                                        type="text" placeholder="Slug">
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection