
<form action="{{route('send-change-request', $data->lastRevision->id ?? '')}}" class="authentication" method="post">
    @csrf
    


<div class="faq_item_wrap db_tab_form_wrap d-none1">
        
        <div class="db_item_wrap">
            
            <div class="form_item">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form_field" value="{{$revision_data['first_name'] ?? ($data->first_name ?? '')}}">
    
            </div>
            <div class="form_item">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form_field" value="{{$revision_data['last_name'] ?? ($data->last_name ?? '')}}">
            </div>
    
            <div class="form_item">
                <label for="">Email</label>
                <input type="email" name="email" class="form_field" value="{{$revision_data['email'] ?? ($data->email ?? '')}}">
            </div>
            <div class="form_item">
                <label for="">Phone Number</label>
                <input type="text" name="phone_number" class="form_field" value="{{$revision_data['phone_number'] ?? ($data->phone_number ?? '')}}">
            </div>
            <div class="form_item">
                <label for="">Address</label>
                <input type="text" name="address" class="form_field" value="{{$revision_data['address'] ?? ($data->address ?? '')}}">
            </div>
            <div class="form_item">
                <label for="">City</label>
                <input type="text" name="city" class="form_field" value="{{$revision_data['city'] ?? ($data->city ?? '')}}">
            </div>
            <div class="form_item">
                <label for="">State</label>
                <input type="text" name="state" class="form_field" value="{{$revision_data['state'] ?? ($data->state ?? '')}}">
            </div>
            <div class="form_item">
                <label for="">Pincode</label>
                <input type="text" name="pincode" class="form_field" value="{{$revision_data['pincode'] ?? ($data->pincode  ?? '')}}">
            </div>
    
        @foreach($service_fields['field_type'] ?? [] as $key => $value)
            @php
                $field_key =  getFieldName($service_fields['field_lable'][$key]);
            @endphp
            @if(!isset($service_fields['form_field_type'][$key]) || $service_fields['form_field_type'][$key] == 'customer')
            <div class="form_item">
                <label for="last_name">{{$service_fields['field_lable'][$key] ?? ''}}</label>
                @if($value == 'textarea') 
                    <textarea class="form_field" type="text" name="{{$field_key }}" id="{{$field_key }}" placeholder="" >{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}</textarea>
                @elseif($value == 'date') 
                <input class="form_field" type="date" name="{{$field_key }}" id="{{$field_key }}" value="{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}" placeholder="" @if(isset($service_fields['minimum_date'][$key]) && !empty($service_fields['minimum_date'][$key]))  min="{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}" @endif  @if(isset($service_fields['maximum_date'][$key]) && !empty($service_fields['maximum_date'][$key]))  max="{{$service_fields['maximum_date'][$key]}}" @endif>
                @elseif($value == 'file')

                <input type="hidden" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? '')}}">
                        <div class="custom_choose_file">
                        <input class="form_field form-image" type="file" name="{{$field_key}}_file" id="{{$field_key}}_file" placeholder="" @if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key]))  min="{{$fields['minimum_date'][$key]}}" @endif  @if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key]))  max="{{$fields['maximum_date'][$key]}}" @endif accept="image/*,.pdf"/>

                            <!-- <input class="form_field form-image" type="file" name="" id="" placeholder="" > -->
                                <a class="preview_icon form-image-preview" @if(empty($revision_data[$field_key])) style="display:none" @endif  href="{{ !empty($revision_data[$field_key]) ? filePreview($revision_data[$field_key]) : (!empty($service_field_data[$field_key]) ? filePreview($service_field_data[$field_key]) : '') }}" target="blank"><svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg></a>
                        </div>

                    <!-- <input type="hidden" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}">
                    <a href="{{filePreview($revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? ''))}}"  class="theme-btn" target="blank">Preview</a> -->
                      
                @elseif($value == 'select')
                    <select type="text" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $fields[$field_key] ?? '')}}">
                        {!! getOptions($service_fields['options'][$key], $revision_data[$field_key ] ?? ( $fields[$field_key] ?? '')) !!}    
                    </select>
                @else

                <input type="text" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}">
                @endif


    
            </div>
            @endif
        @endforeach
        </div>
    
    
        
        <div class="db_item_wrap">
            <div class="note">
                <p>Note: Please do only minor modification. We will generate your application and send it for approval.</p>
            </div>
        </div>
        <div class="form_action_wrap">
            <div class="form_action">
                <button type="submit" class="theme-btn"><span>Submit Edited Application</span></button>
            </div>
        </div>
    </div>
</form>

