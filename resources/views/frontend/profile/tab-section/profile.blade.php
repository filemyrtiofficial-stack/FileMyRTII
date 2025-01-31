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
    </div>
    <div class="db_item_wrap">
        <div class="note">
            <p>Sorry! You can't change your details at this page</p>
        </div>
    </div>
</div>