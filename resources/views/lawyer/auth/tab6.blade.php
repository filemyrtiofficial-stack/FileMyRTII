<a class="accord_item" href="#tab6" data-id="tab6">Upload RTI</a>

<div id="tab6" class="contact_faq_tab">
    <div class="upload_rti_lawyer">
        <div class="db_tab_heading">
            <h2>Upload RTI</h2>
        </div>
        @if(empty($data->final_rti_document)) 
            <form action="{{route('lawyer.upload-final-rti', $data->id)}}" class="authentication" method="post">
            @csrf
            <div class="upload_rti_wrap">
                    <div class="upload_area drop-area" id="drop-area">
                        <div class="upload_wrap">
                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                            <p>Drag and drop Your Scanned RTI or <label>Choose File</label></p>
                            <div class="upload_img_wrap"></div>
                        </div>
                        <input id="document" name="document"  class="upload_inputfile upload-final-pdf" type="file" accept="application/pdf">
                    </div>
                    <iframe id="pdfPreview" width="100%" height="700" @if(!empty($data->final_rti_document)) src="{{asset($data->final_rti_document)}}" @endif></iframe>
                </div>
                <div class="form_action">
                    <button  class="theme-btn"><span>Submit Drafted RTI</span></button>
                </div>
            </form>
            @else
            <iframe id="pdfPreview" width="100%" height="700" @if(!empty($data->final_rti_document)) src="{{asset($data->final_rti_document)}}" @endif></iframe>

            @endif
    </div>
</div>