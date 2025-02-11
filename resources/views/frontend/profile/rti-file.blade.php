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
                <div class="main_heading">Application No: 1234567890</div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">From</label>
                        <textarea class="form_field" name="" id="" disabled>{{$data->fullName}}&#10;&#10;{{$data->address}} {{$data->postal_code}} &#10;&#10;{{$data->phone_number}}  &#10;&#10;{{$data->email}} 
                        </textarea>
                    </div>
                    <div class="form_item">
                        <label for="last_name">To</label>
                        <textarea class="form_field" name="" id="" disabled>{{$data->pio_address}}</textarea>
                    </div>
                </div>
                <div class="heading">Personal Details</div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">First Name</label>
                        <input class="form_field" type="text" name="first_name" value="{{$revision_data['first_name'] ?? ($data->first_name ?? '')}}" placeholder="Name" required="">
                    </div>
                    <div class="form_item">
                        <label for="first_name">Last Name</label>
                        <input class="form_field" type="text" name="last_name" value="{{$revision_data['last_name'] ?? ($data->last_name ?? '')}}" placeholder="Name" required="">
                    </div>
                 
                </div>
                <div class="db_item_wrap">
                <div class="form_item">
                        <label for="last_name">Email</label>
                        <input class="form_field" type="text" name="email" value="{{$revision_data['email'] ?? ($data->email ?? '')}}" placeholder="Email" required="">
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
                    @endphp
                  
                    <div class="form_item  @if($value == 'textarea') single @endif">
                        <label for="{{$field_key}}">{{$service_fields['field_lable'][$key] ?? ''}}</label>
                        @if($value == 'textarea')
                        <textarea type="text" name="{{$field_key }}" class="form_field">{{$revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? '')}}</textarea>

                        @else
                        <input type="text" name="{{$field_key }}" class="form_field" value="{{$revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? '')}}">
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
                <div class="form_action">
                    <button class="theme-btn"><span>Save & Preview</span></button>
                </div>
            </div>
        </div>
      
    <!-- <button class="send-for-approval theme-btn">Send For Approval</button> -->
</form>

<div class="draft-rti-html">


</div>    


</div>
   

