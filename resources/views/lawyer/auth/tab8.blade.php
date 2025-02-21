<a class="accord_item" href1="#tab8" data-id="tab8" href="{{route('lawyer.my-rti', [$data->application_no, 'tracking-no'])}}">Enter Tracking No</a>

<div id="tab8" class="contact_faq_tab @if($tab == 'tracking-no')active @endif">
    <div class="tracking_app">
        <div class="db_tab_heading">
            <h2>Enter Tracking No</h2>
        </div>
        <div class="faq_item_wrap v_scroll">
            <div class="main_heading">Application No: {{$data->application_no ?? ''}}</div>
            <div class="tracking_form_view">
                <div class="tracking_item">
                    <div class="tracking_heading">From:</div>
                    <div class="content">
                        <p>{{$data->fullName}}</p>
                        <p>{{$data->address}}, {{$data->postal_code}}</p>
                        <p>Ph: {{$data->phone_number}}</p>
                        <p>Email: {{$data->email}}</p>
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="tracking_item">
                    <div class="tracking_heading">To:</div>
                    <div class="content">
                        <p>The Public Information Officer</p>
                        <p>{{$data->pio_address}}</p>
                        
                    </div>
                </div>
            </div>
            <form action="{{route('lawyer.assign-courier', $data->lastRevision->id ?? '')}}" method="post" class="authentication courier-tacking-form">
                @csrf
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Courier Name*</label>
                        <input class="form_field" type="text" name="courier_name" value="{{$data->courierTracking->courier_name ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                    </div>
                    <div class="form_item">
                        <label for="last_name">Courier Tracking Number*</label>
                        <input class="form_field"  name="courier_tracking_number" value="{{$data->courierTracking->courier_tracking_number ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Courier Date*</label>
                        <input class="form_field" type="date" name="courier_date" value="{{$data->courierTracking->courier_date ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                    </div>
                    <div class="form_item">
                        <label for="last_name">Courier Charges*</label>
                        <input class="form_field" type="" name="charges" value="{{$data->courierTracking->charges ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                    </div>
                </div>
                <div class="db_item_wrap single">
                    <div class="form_item">
                        <label for="first_name">Courier Delivered Details*</label>
                        <textarea class="form_field" name="details" id="" @if($data->courierTracking) disabled @endif>{{$data->courierTracking->address ?? ''}}</textarea>
                    </div>
                </div>
                @if($data->courierTracking)
                    <div class="preview" id="courier-images">
                        @foreach($data->courierTracking->documents ?? [] as $document)
                            <div class="preview-item">
                                <a href="{{route('preview-document',Crypt::encryptString($document))}}" target="blank">
                                    <embed src="{{asset($document)}}" width="50" height="50" />
                                  
                                </a>
                            </div>
                        @endforeach
                    </div>

                @else
                <div class="tracking_upload_wrap">
                    <div class="upload_area drop-area" id="drop-area">
                        <div class="upload_wrap">
                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                            <p>Drag and drop your courier acknowledgement or <label>Choose File</label></p>
                            <div class="upload_img_wrap"></div>
                        </div>
                        <input  accept="image/*,.pdf" class="upload_inputfile multiple-document-upload" type="file" name="file[]" multiple data-preview="courier-images" data-form="courier-tacking-form">

                    </div>
                    <div class="preview" id="courier-images"></div>
                </div>
                <div class="form_action">
                    <button class="theme-btn"><span>Save & Submit</span></button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>