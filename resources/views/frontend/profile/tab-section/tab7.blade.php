<div id="tab7" class="contact_faq_tab @if($tab == 'second-appeal')active @endif">
    <div class="rti_appeal">
        
        @if($data->secondAppeal)
        <div class="db_tab_heading">
            <h2>Second Appeal</h2>
        </div>

        <div class="draft_rti_wrap">
            <div class="draft_rti_left draft_rti_left-appeal-details">
                <div class="draft_rti_details v_scroll">
                     <div class="thankyou_img">
                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/thankyou-img.webp')}}" alt="">
                    </div>
                    <div class="heading text-center">
                        <h2>Thank you for filing your RTI application!</h2>
                    </div>
                    <br>
                    <div class="draft_rti_view">
                        <div class="heading">First Appeal Reason</div>
                        <div class="content">
                            <p class="name">{{$data->secondAppeal->appealDeatils->reason ?? ''}}</p>
                        </div>
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
                            <div><embed src="{{filePreview($data->secondAppeal->appealDeatils->document ?? '')}}" type="" width="100%" height="500"></div>
                            <!-- <img class="img-fluid view_form_img" src="images/dashboard/view_draft.webp" alt=""> -->
                        </div>
                    </div>
                       <div class="text-right mt-3">
                        <a href="{{filePreview($data->secondAppeal->appealDeatils->document ?? '')}}" target="blank" class="preview-button"><span>Preview</span></a>
                    </div>

                </div>
            </div>
        </div>

        
        
        
        @else
        <div class="db_tab_heading">
            <h2>What is Second Appeal?</h2>
        </div>
        <form action="{{route('rti-appeal', $data->id)}}" class="authentication second-appeal-form " method="post">
            @csrf
            <input type="hidden" name="appeal_no" value="2">
            <div class="appeal_wrap">
                <div class="appeal_info">
                    <div class="appeal_heading">
                        <h4>What is Second Appeal?</h4>
                    </div>
                    <div class="appeal_content">
                        <p>If the First Appeal didn't yield a satisfactory outcome, the RTI Act empowers you to file a Second Appeal with the Central Information Commission (CIC) or State Information Commission (SIC). This is your final step to seek justice and transparency.</p>
                    </div>
                </div>
                <div class="appeal_info">
                    <div class="appeal_heading">
                        <h4>Apply for Second Appeal after {{Carbon\Carbon::parse($data->created_at)->addDays(60)->format('d/m/Y')}}</h4>
                    </div>
                </div>
                <div class="appeal_info with_input">
                    <div class="appeal_heading">
                        <h4>Did you receive response for your First Appeal?</h4>
                    </div>
                    <div class="custom_radio">
                        <input type="radio" id="sappeal_yes" name="received_appeal" checked="" value="1">
                        <label for="sappeal_yes">Yes</label>
                    </div>
                    <div class="custom_radio">
                        <input type="radio" id="sappeal_no" name="received_appeal" value="0">
                        <label for="sappeal_no">No</label>
                    </div>
                </div>
                <div class="upload_area">
                    <div class="upload_wrap">
                        <div class="icon_wrap">
                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                        </div>
                        <p>Drag and drop response received from PIO or <label>Choose File<input class="upload_inputfile document-upload" type="file" name="file"  data-form="second-appeal-form" data-preview="second-appeal-preview"></p>
                        <div class="upload_img_wrap"></div>
                        <input type="hidden" name="document" class="image-input" />

                    </div>
                </div>
                <div class="preview" id="second-appeal-preview"></div>
            </div>
            <div class="db_tab_form">
                <div class="db_item_wrap single">
                    <div class="form_item">
                        <input class="form_field" type="text" name="reason" id="" placeholder="Type your reason here (request to provide in English)" required="">
                    </div>
                </div>
                <div class="db_tab_status_action">
                    <button href="javascript:void(0);" class="theme-btn"><span>Proceed Payment</span></button>
                </div>
            </div>

        </form>
        @endif
    
    </div>
</div>