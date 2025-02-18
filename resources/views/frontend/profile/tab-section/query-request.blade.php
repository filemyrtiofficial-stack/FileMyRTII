
<form action="{{route('customer.send-reply-request',[$data->lastRtiQuery->id ?? ''])}}" class="authentication query-request-form" method="post">
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
                <input type="text" name="pincode" class="form_field" value="{{$revision_data['pincode'] ?? ($data->postal_code  ?? '')}}">
            </div>
    
            <div class="form_item">
                <label for="">Lawyer Query</label>
                <textarea type="text"  class="form_field">{{($data->lastRtiQuery->message ?? '')}}</textarea>
            </div>
            <div class="form_item">
                <label for="">Enter Your Reply</label>
                <textarea type="text" name="reply" class="form_field"></textarea>
            </div>
        </div>
    

        <div class="upload_area">
            <div class="upload_wrap">
                <div class="icon_wrap">
                    <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                </div>
                <p>Drag and drop response received from PIO or <label>Choose File<input class="upload_inputfile multiple-document-upload" type="file" name="file[]"  data-form="query-request-form" data-preview="query-request-form-preview" multiple></p>
                <div class="upload_img_wrap"></div>
                <input type="hidden" name="document" class="image-input" />

            </div>
        </div>
        
        <div class="preview" id="query-request-form-preview"></div>

        
        <div class="form_action_wrap">
            <div class="form_action">
                <button type="submit" class="theme-btn"><span>Submit</span></button>
            </div>
        </div>
    </div>
</form>

