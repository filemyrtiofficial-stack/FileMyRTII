<form action="{{route('lawyer.assign-courier', $data->lastRevision->id ?? '')}}" method="post" class="authentication">
    @csrf
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <p><strong>To : </strong></p>
        </div>
    </div>
    <div class="faq_item_wrap db_tab_form_wrap d-none1">
        <div class="db_item_wrap">
            <div class="form_item">
                <label for="courier_name">Courier Name</label>
                <input type="text" name="courier_name" class="form_field" value="">
            </div>
            <div class="form_item">
                <label for="courier_tracking_number">Courier Tacking Number</label>
                <input type="text" name="courier_tracking_number" class="form_field" value="">

            </div>
            <div class="form_item">
                <label for="courier_date">Courier Date</label>
                <input type="date" name="courier_date" class="form_field" value="">
            </div>
            <div class="form_item">
                <label for="courier_charges">Courier Charges</label>
                <input type="text" name="charges" class="form_field" value="">
            </div>
        </div>
        <div class="db_item_wrap single">
            <div class="form_item">
                <label for="courier_charges">Courier Delivered Address</label>
                <input type="text" name="address" class="form_field" value="">
            </div>
        </div>
        <div class="sign_area_wrap">
            <div class="upload_area">
                <div class="upload_wrap">
                    <input type="file" name="file" id="document-upload" />
                    <input type="hidden" name="documents" class="image-input">
                    <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                    <p>Drag and drop your courier acknowledgment or <a href="javascript:void(0);">Choose File</a></p>
                </div>
            </div>

        </div>
        <button>Submit</button>
    </div>  
</form>