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

<form action="{{route('lawyer.send-for-approval', $data->application_no)}}" class="draft-form authentication">
    @csrf
<input type="hidden" name="template_id" value="{{$data->service->templates[0]['id'] ?? ''}}">

@csrf
    <div class="row modal_body tab-form">
        <div class="col-md-6">
            <div class="form_item">
                <label for="">First Name</label>
                <div>
                    <input type="text" name="first_name" class="form_field" value="{{$revision_data['first_name'] ?? ($data->first_name ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">Last Name</label>
                <div>
                    <input type="text" name="last_name" class="form_field" value="{{$revision_data['last_name'] ?? ($data->last_name ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">Email</label>
                <div>
                    <input type="email" name="email" class="form_field" value="{{$revision_data['email'] ?? ($data->email ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">Phone Number</label>
                <div>
                    <input type="text" name="phone_number" class="form_field" value="{{$revision_data['phone_number'] ?? ($data->phone_number ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">Address</label>
                <div>
                    <input type="text" name="address" class="form_field" value="{{$revision_data['address'] ?? ($data->address ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">City</label>
                <div>
                    <input type="text" name="city" class="form_field" value="{{$revision_data['city'] ?? ($data->city ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">State</label>
                <div>
                    <input type="text" name="state" class="form_field" value="{{$revision_data['state'] ?? ($data->state ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form_item">
                <label for="">Pincode</label>
                <div>
                    <input type="text" name="pincode" class="form_field" value="{{$revision_data['pincode'] ?? ($data->pincode  ?? '')}}">
                </div>
            </div>
        </div>
    
        @foreach($service_fields['field_type'] ?? [] as $key => $value)
            @php
                $field_key =  Illuminate\Support\Str::slug($service_fields['field_lable'][$key]);
                $label_key = str_replace('-', '_',$field_key);
            @endphp
    
            <div class="col-md-6">
                <div class="form_item">
                    <label for="">{{$service_fields['field_lable'][$key] ?? ''}}</label>
                    <div>
                        <input type="text" name="{{$label_key }}" class="form_field" value="{{$revision_data[$label_key ] ?? ( $fields[$field_key]['value'] ?? '')}}">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="send-for-approval">Send For Approval</button>
</form>

<div class="draft-rti-html">


</div>    


</div>
   

