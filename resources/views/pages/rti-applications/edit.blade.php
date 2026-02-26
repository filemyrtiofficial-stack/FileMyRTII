@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('rti.applications.list')}}">RTI Applications</a></li>
<li class="breadcrumb-item active" aria-current="page">{{$data->application_no}}</li>
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<form action="{{route('rtiapplication.update', $data->id)}}" method="post" class="form-submition">
    <div class="row mt-4 mx-md-4">
        <div class="col-12">

            <div class="card mb-4">
                <div class="card-header list-header">
                    <h4>Personal Details</h4>
                </div>
                <div class="card-body">
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First Name <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control first_name" name="first_name" value="{{$data->first_name ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control last_name" name="last_name" value="{{$data->last_name ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control email" name="email" value="{{$data->email ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone Number <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control phone_number" name="phone_number" value="{{$data->phone_number ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control address" name="address" value="{{$data->address ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">City <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control city" name="city" value="{{$data->city ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">State <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control state" name="state" value="{{$data->state ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Postal Code <span class="text-danger">*</span></label>
                                <div>
                                    <input type="text" class="form-control postal_code" name="postal_code" value="{{$data->postal_code ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div class="col-12">

            <div class="card mb-4">
                <div class="card-header list-header">
                    <h4>RTI Details</h4>
                </div>
                <div class="card-body">
                
                        <div class="row">
                        @foreach($service_fields['field_type'] ?? [] as $key => $value)
                            @if( !isset($service_fields['form_field_type'][$key]) ||  (isset($service_fields['form_field_type'][$key]) && strtolower($service_fields['form_field_type'][$key]) == "customer"))

                            @php
                                $field_key =  getFieldName($service_fields['field_lable'][$key]);
                               
                                
                            @endphp
                        
                            <div class="  @if($value == 'textarea' || $value == 'richtext') col-md-12 @else col-md-6 @endif">
                                <div class="form-group">

                                    <label for="{{$field_key}}">{{$service_fields['field_lable'][$key] ?? ''}} @if(isset($service_fields['is_required'][$key]) && $service_fields['is_required'][$key] == 'no')  @else <span class="text-danger">*</span> @endif</label>
                                    <div>

                                        @if($value == 'textarea')
        
                                        <textarea type="text" name="{{$field_key }}" class="form-control {{$field_key}}">{{( $service_field_data[$field_key] ?? '')}}</textarea>
                                        @elseif($value == 'file')
                                        <?php
                                        $file =( ( $service_field_data[$field_key] ?? "null"));
                                        ?>
                                    
                                        <input type="hidden" name="{{$field_key }}" class="form-control {{$field_key}}" value="{{( $service_field_data[$field_key] ?? ($service_fields['default_values'][$key] ?? ''))}}">
                                        <div class="custom_choose_file">
                                            <input class="form-control form-image" type="file"  name="{{$field_key}}_file" id="{{$field_key}}_file" placeholder="" >
                                                <a class="preview_icon form-image-preview" @if(empty($file)) style="display:none;" @endif href="{{ !empty($revision_data[$field_key]) ? filePreview($revision_data[$field_key]) : (!empty($service_field_data[$field_key]) ? filePreview($service_field_data[$field_key]) : '') }}" target="blank"><svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg></a>
                                        </div>
                                            <!-- <a href="{{filePreview(( $service_field_data[$field_key] ?? ''))}}"  class="theme-btn" target="blank">Preview</a> -->
                                        @elseif($value == 'select')
                                        
                                        <select type="text" name="{{$field_key }}" class="form-control {{$field_key}}" value="{{( $service_field_data[$field_key] ?? ($service_fields['default_values'][$key] ?? ''))}}">
                                            {!! getOptions($service_fields['options'][$key], ( $service_field_data[$field_key] ?? '')) !!}    
                                        </select>
                                        @elseif($value == 'richtext')
                                        <textarea type="text" name="{{$field_key }}" class="form-control editor {{$field_key}}">{{( $service_field_data[$field_key] ?? ($service_fields['default_values'][$key] ?? ''))}}</textarea>
        
                                        @else
                                        <input type="text" name="{{$field_key }}" class="form-control {{$field_key}}" value="{{( $service_field_data[$field_key] ??  ($service_fields['default_values'][$key] ?? ''))}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                        @endforeach
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    
</form>
@endsection
