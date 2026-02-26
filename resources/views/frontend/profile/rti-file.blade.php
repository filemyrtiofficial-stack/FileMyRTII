<div>
 <style>
  
    .signature {
        position: absolute;
    right: 0px;
    }
    .title {
        text-align:center;
    }
  
.tab-form .form_item {
    width: 100%;
    padding: 0px 10px;
}
.tab-form .col-md-6 {
    width: 50%;
}
</style>

<form action="{{route('lawyer.send-for-approval', $data->id)}}" class="draft-form authentication">
    @csrf
<input type="hidden" name="template_id" value="{{$data->service->templates[0]['id'] ?? ''}}">

@csrf
<div class="drafted_rti_form">
            <div class="faq_item_wrap v_scroll">
                <div class="main_heading">Application No: {{$data->application_no}}</div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">From</label>
                        <textarea class="form_field" name="" id="" disabled>{{$revision_data['first_name'] ?? ($data->first_name ?? '')}}  {{$revision_data['last_name'] ?? ($data->last_name ?? '')}}&#10;&#10;{{$revision_data['address'] ?? ($data->address ?? '')}} {{$revision_data['city'] ?? ($data->city ?? '')}} {{$revision_data['state'] ?? ($data->state ?? '')}} {{$revision_data['pincode'] ?? ($data->postal_code ?? '')}} &#10;&#10;{{$revision_data['phone_number'] ??  ($data->phone_number ?? '')}}  &#10;&#10;{{$revision_data['email'] ?? ($data->email ?? '')}}
                        </textarea>
                    </div>
                    <div class="form_item">
                        <label for="last_name">To </label>
                        <textarea class="form_field" disabled name="to" id="to_address">{{$data->pio_address}}</textarea>
                        <a  type="button" class="rti-popup add-pio-address-btn" data-id="pio-popup">Update PIO</a>
                    </div>
                </div>
                <div class="heading">Personal Details</div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">First Name</label>
                        <input class="form_field" type="text" name="first_name" value="{{$revision_data['first_name'] ?? ($data->first_name ?? '')}}" placeholder="Name" >
                    </div>
                    <div class="form_item">
                        <label for="first_name">Last Name</label>
                        <input class="form_field" type="text" name="last_name" value="{{$revision_data['last_name'] ?? ($data->last_name ?? '')}}" placeholder="Name" >
                    </div>
                 
                </div>
                <div class="db_item_wrap">
                <div class="form_item">
                        <label for="last_name">Email</label>
                        <input class="form_field" type="text" name="email" value="{{$revision_data['email'] ?? ($data->email ?? '')}}" placeholder="Email" >
                    </div>
                    <div class="form_item">
                        <label for="first_name">Phone Number</label>
                        <input type="text" name="phone_number" class="form_field" value="{{$revision_data['phone_number'] ?? ($data->phone_number ?? '')}}">
                    </div>
                   
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="last_name">Address</label>
                        <input type="text" name="address" class="form_field" value="{{$revision_data['address'] ?? ($data->address ?? '')}}">
                    </div>
                    <div class="form_item">
                        <label for="last_name">City</label>
                        <input type="text" name="city" class="form_field" value="{{$revision_data['city'] ?? ($data->city ?? '')}}">
                    </div>
                    <div class="form_item">
                        <label for="last_name">State</label>
                        <input type="text" name="state" class="form_field" value="{{$revision_data['state'] ?? ($data->state ?? '')}}">
                    </div>
                    <div class="form_item">
                        <label for="last_name">Pincode</label>
                        <input type="text" name="pincode" class="form_field" value="{{$revision_data['pincode'] ?? ($data->postal_code ?? '')}}">
                    </div>
                </div>
                <div class="heading">Details of Information Required</div>
                <div class="db_item_wrap">
                @foreach($service_fields['field_type'] ?? [] as $key => $value)
                    @php
                        $field_key =  getFieldName($service_fields['field_lable'][$key]);
                        if(count($data->allDrafts) == 0) {
                         $key_data = getData($revision_data, $field_key, $service_field_data, $service_fields['default_values'] ?? []);
                        }
                        else {
                         $key_data = getData($revision_data, $field_key);
                        }
                        
                       

                    @endphp
                  
                    <div class="form_item  @if($value == 'textarea' || $value == 'richtext') single @endif">
                        <label for="{{$field_key}}">{{$service_fields['field_lable'][$key] ?? ''}} </label>

                        @if($value == 'textarea')

                        <textarea type="text" name="{{$field_key }}" class="form_field">{{$key_data}}</textarea>
                        @elseif($value == 'file')
                        <?php
                        $file =( $revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? "null"));
                        ?>
                     
                        <input type="hidden" name="{{$field_key }}" class="form_field" value="{{$key_data}}">
                        <div class="custom_choose_file">
                            <input class="form_field form-image" type="file"  name="{{$field_key}}_file" id="{{$field_key}}_file" placeholder="" >
                                <a class="preview_icon form-image-preview" @if(empty($file)) style="display:none;" @endif href="{{ !empty($revision_data[$field_key]) ? filePreview($revision_data[$field_key]) : (!empty($service_field_data[$field_key]) ? filePreview($service_field_data[$field_key]) : '') }}" target="blank"><svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg></a>
                        </div>
                            <!-- <a href="{{filePreview($revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? ''))}}"  class="theme-btn" target="blank">Preview</a> -->
                        @elseif($value == 'select')
                        
                        <select type="text" name="{{$field_key }}" class="form_field">
                            {!! getOptions($service_fields['options'][$key], $key_data) !!}    
                        </select>
                        @elseif($value == 'richtext')
                        <textarea type="text" name="{{$field_key }}" class="form_field editor">{{$key_data}}</textarea>

                        @else
                       <div class="test-data" style="display:none"> {{json_encode($revision_data)}}</div>
                        <input type="text" name="{{$field_key }}" class="form_field" value="{{$key_data}}">
                        @endif
                    </div>

                @endforeach


                  
                </div>
                
                <!-- <div class="db_item_wrap single">
                    <div class="form_item">
                        <label for="first_name">Additional Details</label>
                        <textarea class="form_field" name="" id=""></textarea>
                    </div>
                </div> -->
              
            </div>
              <div class="form_action">
                    <button class="theme-btn"><span>Save & Preview</span></button>
                </div>
        </div>
      
    <!-- <button class="send-for-approval theme-btn">Send For Approval</button> -->
</form>

<div class="draft-rti-html">


</div>    


</div>
   

