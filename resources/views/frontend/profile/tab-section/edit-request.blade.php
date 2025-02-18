
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
                    <input type="hidden" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? '')}}">
                    <a href="{{filePreview($revision_data[$field_key ] ?? ( $fields[$field_key]['value'] ?? ''))}}"  class="theme-btn" target="blank">Preview</a>
                      
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

