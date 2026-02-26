<div id="tab9" class="contact_faq_tab @if($tab == 'first-appeal')active @endif">
    <div class="rti_application draft_rti">
        <div class="db_tab_heading">
            <h2>First Appeal Details</h2>
        </div>
        <div class="draft_rti_wrap">
            <div class="draft_rti_left draft_rti_left-appeal-details">
                <div class="draft_rti_details v_scroll">
                    <div class="draft_rti_view">
                        <div class="heading">First Appeal Reason</div>
                        <div class="content">
                            <p class="name">{{$data->firstAppeal->appealDeatils->reason ?? ''}}</p>
                        </div>
                        @if($data->firstAppeal->lawyer_id == auth()->guard('lawyers')->id())
                        <br>
                            <div class="tab_action_top text-right">
                                <a href="{{route('lawyer.my-rti', $data->firstAppeal->application_no.'-'.$data->firstAppeal->id)}}" class="theme-btn" ><span>View</span></a>
                            </div>
                        @endif
                    </div>
               
                   
                </div>
            </div>
            <div class="draft_rti_right">
                <div class="select_draft_wrap">
                  
                    <div class="view_draft">
                        <div class="view_draft_area">
                            <!-- <a href="javascript:void(0);" class="download-btn">
                                <span class="icon"><img class="img-fluid" src="images/dashboard/download-template.svg" alt=""></span>
                                Download Template
                            </a> -->
                            <div><embed src="{{filePreview($data->firstAppeal->appealDeatils->document ?? '')}}" type="" width="100%" height="500"></div>
                            <!-- <img class="img-fluid view_form_img" src="images/dashboard/view_draft.webp" alt=""> -->
                        </div>
                         <div class="text-right mt-3">
                        <a href="{{filePreview($data->firstAppeal->appealDeatils->document ?? '')}}" target="blank" class="preview-button"><span>Preview</span></a>
                    </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


 
</div>