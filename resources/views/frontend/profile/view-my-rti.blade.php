@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer.css')}}">





@endpush
@section('content')

        
<header class="breadcrumb_banner bg_none">
            <img class="img-fluid bg_img" src="images/contact/contact-banner.webp" alt="contact us banner">
                <div class="container">
                    <div class="row banner_row">
                        <div class="col-12 col-sm-12">
                            <div class="breadcrumb">
                               <ol>
                                <li class="fs-24"><a href="javascript:void(0);">Home</a></li>
                                <li class="fs-24 active">My RTI</li>
                               </ol>
                            </div>
                          
                        </div>
                    </div>
                </div>
        </header>


<section class="contact_section dbtab_section lawyer_db_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab1">Application Status</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab2">RTI Application</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab3">Your Profile</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab4">Download</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab5">Payment Info & Invoice</a>
                        </li>   
                        
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab6">First Appeal</a>
                        </li>
                        @if(addDays(30, $data->created_at) <= Carbon\Carbon::now() && addDays(60, $data->created_at) > Carbon\Carbon::now())
                        @endif
                        
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab7">Second Appeal</a>
                        </li>
                        @if(addDays(60, $data->created_at) <= Carbon\Carbon::now())
                        @endif
                        @if($data->lastRtiQuery && $data->lastRtiQuery->marked_read == 0)
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab8">More Info Request</a>
                        </li>
                        @endif
                       
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h2>Application No: {{$data->application_no ?? ''}}</h2>
                </div>
                <div class="contact_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content lawyer_accordion">
                            <a class="accord_item" href="#tab1" data-id="tab1">Application Status</a>

                            <div id="tab1" class="contact_faq_tab active">
                                <div class="application_status">
                                    <div class="db_tab_heading">
                                        <h2>Application Status</h2>
                                    </div>
                                    @foreach($list as $key =>  $item)
                                    <div class="db_tab_status">
                                        <div>
                                            @if($item->appeal_no > 0)
                                               {{$item->appeal_no == 1 ? "First" : "Second"}} Appeal Status
                                            @endif
                                        </div>
                                        <div class="form_table_detail">
                                            <ul class="charge_list">
                                                <li>Description</li>
                                                <li>Date</li>
                                                <li>Status</li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>RTI Application registered date</li>
                                                <li>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</li>
                                                <li><span class="check_icon_wrapper"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon"></span></li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>RTI Application filed date</li>
                                                <li>
                                                    @php $date = getRtiDate(['application_id' => $item->id, 'status' => "filed"]); @endphp
                                                    {{$date }}</li>
                                                <li><span class="check_icon_wrapper">
                                                    @if(!empty($date)) 
                                                    <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">
                                                    @else
                                                    <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">

                                                    @endif
                                                </span></li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>Expected reply from PIO</li>
                                                <li></li>
                                                <li><span class="check_icon_wrapper"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon"></span></li>
                                            </ul>
                                        </div>

                

                                        <ul class="status_bar">
                                            <li @if($item->status >= 1) class="active" @endif>
                                                <div class="bar_item">
                                                    <div class="number">
                                                        <div class="bar_icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                        <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        </div>
                                                        <div class="bar_number">1</div>
                                                    </div>
                                                    <span>Started</span>
                                                </div>
                                            </li>
                                            <li @if($item->status >= 2) class="active" @endif  >
                                                <div class="bar_item">
                                                    <div class="number">
                                                        <div class="bar_icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                        <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        </div>
                                                        <div class="bar_number">2</div>
                                                    </div>
                                                    <span>Approval</span>
                                                </div>
                                            </li>
                                            <li @if($item->status == 3) class="active" @endif >
                                                <div class="bar_item">
                                                    <div class="number">
                                                        <div class="bar_icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                        <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        </div>
                                                        <div class="bar_number">3</div>
                                                    </div>
                                                    <span>Filed</span>
                                                </div>
                                            </li>
                                        </ul>

                                        @if($item->courierTracking)
                                                <div class="track_wrap">
                                                    <div class="track_no">Postal Tracking No: <a href="javascript:void(0);">{{$item->courierTracking->courier_tracking_number ?? ''}}</a></div>
                                                    <div class="track_note">
                                                        <p><strong>NOTE:</strong> As per the RTI Act, 2005, the information should reach you within 30 days of filing. In majority of the cases information reaches only after 40-50 days.</p>
                                                    </div>
                                                </div>
                                        @else


                                            @if(count($list)-1 <= $key)
                                            <div class="status_bottom">

                                                <div class="note">
                                                    <p>*Please approve your drafted RTI Application</p>
                                                </div>
                                                <div class="db_tab_status_action">
                                                    <a class="theme-btn tabings" href="#tab2"><span>Approve RTI</span></a>
                                                </div>
                                            </div>
                                            @endif

                                        @endif
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <a class="accord_item" href="#tab2" data-id="tab2">RTI Application</a>

                            <div id="tab2" class="contact_faq_tab">
                                @if($data->lastRevision)
                                    <div class="review_application">
                                        <div class="db_tab_heading">
                                            <h2>Review Your Application: Check Your Drafted RTI</h2>
                                        </div>
                                        <div class="db_tab_review">
                                            <div class="review_wrap">
                                                <div class="review">
                                                    {!! $html !!}
                                                </div>
                                            </div>
                                            <div class="review_action">
                                                <a href="{{route('customer.download-rti', $data->application_no)}}" class="theme-btn @if(!$data->lastRevision ) disabled @endif" target="blank"><span>Download PDF</span></a>
                                            </div>
                                            @if(empty($data->signature_image) && $data->lastRevision && empty($data->lastRevision->customer_change_request))
                                            <ol class="review_option">
                                                <li class="option_no"><span>Edit if Needed - Click "<a class="tabings" href="#edit-request">Edit</a>" to Make Changes</span></li>
                                                <li class="option_no"><span>Proceed to Sign - If Satisfied, Click</span><a href="#signing-process" class="theme-btn tabings"><span>Proceed for Signing</span></a></li>
                                            </ol>
                                        
                                            @endif
                                        </div>
                                    
                                    
                                    </div>
                                @else
                                    <div class="approve_rti">
                                        <div class="db_tab_heading">
                                            <h2>Approved RTI</h2>
                                        </div>
                                        <div class="approval_view">
                                        
                                            <div class="waiting_msg">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                                                <h4 class="heading">Your RTI is not drafted. Please wait...</h4>
                                                <a class="theme-btn tabings" href="#tab1"><span>Back</span></a>
                                            </div>          
                                        </div>
                                    </div>
                                @endif
                            </div>
                          
                            <a class="accord_item" href="#tab3" data-id="tab3">Your Profile</a>
                            <div id="tab3" class="contact_faq_tab">
                                <div class="contact_faq_heading text-center">
                                    <h2>Your Profile</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    @include('frontend.profile.tab-section.profile')
                                </div>
                            </div>
                            <a class="accord_item" href="#tab4" data-id="tab4">Download</a>

                            <div id="tab4" class="contact_faq_tab">
                                <div class="rti_download">
                                    <div class="db_tab_heading">
                                        <h2>Download RTI Application</h2>
                                    </div>
                                    <ul class="rti_documents_ul">
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="images/dashboard/download-application.webp" alt="">
                                                <div class="doc_content">Your RTI Application</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(!$data->lastRevision) disabled @endif" href="{{route('customer.download-rti', $data->application_no)}}" target="blank"><span>Download RTI</span></a>
                                            </div>
                                        </li>
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="images/dashboard/attachment-document.webp" alt="">
                                                <div class="doc_content">Document(s) Attached to Application </div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(empty($data->documents) || count($data->documents) == 0) disabled @else rti-popup @endif" href="javascript:void(0);" data-id="attachment-popup"><span>@if(empty($data->documents) || count($data->documents) == 0) No @endif Document</span></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="track_wrap">
                                        <div class="track_note">
                                            <p><strong>NOTE:</strong> Your application goes through lot of changes during the filing process. Your downloaded file may change later.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="accord_item" href="#tab5" data-id="tab5">Payment Info & Invoice</a>

                            <div id="tab5" class="contact_faq_tab">
                                <div class="rti_invoice">
                                    <div class="db_tab_heading">
                                        <h2>Payment Info & Invoice</h2>
                                    </div>
                                    <ul class="rti_documents_ul">
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/invoice-icon.webp')}}" alt="">
                                                <div class="doc_content">RTI Application Invoice</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn" href="{{invoicePreviewPath($data->application_no, 0)}}"  target="_blank" ><span>Download Invoice</span></a>
                                            </div>
                                        </li>
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/invoice-icon.webp')}}"  alt="">
                                                <div class="doc_content">RTI First Appeal Invoice</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(count($list) < 2) disabled @endif" href="{{invoicePreviewPath($data->application_no, 1)}}"  target="_blank"><span>Download Invoice</span></a>
                                            </div>
                                        </li>
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/invoice-icon.webp')}}" alt="">
                                                <div class="doc_content ">RTI Second Appeal Invoice</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(count($list) < 3) disabled @endif" href="{{invoicePreviewPath($data->application_no, 2)}}" target="_blank"><span>Download Invoice</span></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a class="accord_item" href="#tab6" data-id="tab6">First Appeal</a>

                            <div id="tab6" class="contact_faq_tab">
                                <div class="rti_appeal">
                                    <div class="db_tab_heading">
                                        <h2>First Appeal</h2>
                                    </div>
                                    <form action="{{route('rti-appeal', $data->id)}}" class="authentication first-appeal-form " method="post">
                                        @csrf
                                        <input type="hidden" name="appeal_no" value="1">
                                        <div class="appeal_wrap">
                                            <div class="appeal_info">
                                                <div class="appeal_heading">
                                                    <h4>What is First Appeal?</h4>
                                                </div>
                                                <div class="appeal_content">
                                                    <p>According to the RTI Act, if a response is unsatisfactory or delayed beyond 30 days, you have the right to file a First Appeal. This ensures your application is reviewed by a higher authority within the same department.</p>
                                                </div>
                                            </div>
                                            <div class="appeal_info">
                                                <div class="appeal_heading">
                                                    <h4>Apply for First Appeal after {{Carbon\Carbon::parse($data->created_at)->addDays(30)->format('d/m/Y')}}</h4>
                                                </div>
                                            </div>
                                            <div class="appeal_info with_input">
                                                <div class="appeal_heading">
                                                    <h4>Did you receive response for your Initial Appeal?</h4>
                                                </div>
                                                <div class="custom_radio">
                                                    <input type="radio" id="fappeal_yes" name="received_appeal" checked="" value="1">
                                                    <label for="fappeal_yes">Yes</label>
                                                </div>
                                                <div class="custom_radio">
                                                    <input type="radio" id="fappeal_no" name="received_appeal" value="0">
                                                    <label for="fappeal_no">No</label>
                                                </div>
                                            </div>
                                            <div class="upload_area">
                                                <div class="upload_wrap">
                                                    <div class="icon_wrap">
                                                        <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                                                    </div>
                                                    <p>Drag and drop response received from PIO or <label>Choose File<input class="upload_inputfile document-upload" type="file" name="file"  data-form="first-appeal-form" data-preview="first-appeal-preview"></p>
                                                    <div class="upload_img_wrap"></div>
                                                    
                                                </div>
                                            </div>
                                            <input type="hidden" name="document" class="image-input" />
                                            <div class="preview" id="first-appeal-preview"></div>
                                        </div>
                                        <div class="db_tab_form">
                                            <div class="db_item_wrap single">
                                                <div class="form_item">
                                                    <input class="form_field" type="text" id="" placeholder="Type your reason here (request to provide in English)" name="reason">
                                                </div>
                                            </div>
                                            <div class="db_tab_status_action">
                                                <button class="theme-btn"><span>Proceed Payment</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <a class="accord_item" href="#tab7" data-id="tab7">Second Appeal</a>

                            <div id="tab7" class="contact_faq_tab">
                                <div class="rti_appeal">
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
                                 
                                </div>
                            </div>
                            <a class="accord_item" href="#tab8" data-id="tab8">More Info Request</a>

                            <div id="tab8" class="contact_faq_tab">
                                <div class="contact_form">
                                    <div class="contact_form_heading">
                                        Lawyer Requested Info
                                    </div>
                                    <div>
                                        @include('frontend.profile.tab-section.query-request')
                                    </div>
                                   
                                </div>
                            </div>

                            <div id="edit-request" class="contact_faq_tab">
                                <div class="contact_form">
                                    <div class="contact_form_heading">
                                        RTI Application Details
                                    </div>

                                    <div>

                                    
                                        @include('frontend.profile.tab-section.edit-request')
                                    </div>
                                   
                                </div>
                            </div>

                            <div id="thankyou-process" class="contact_faq_tab">
                                  
                                <div class="thankyou_msgs text-center">
                                    <div class="thankyou_img">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/thankyou-img.webp')}}" alt="">
                                    </div>
                                    <div class="thankyou_heading">
                                        <h2>Thank you...!</h2>
                                    </div>
                                    <div class="thankyou_msg_detail">
                                        <p>for approving your RTI Application No. {{$data->application_no}}</p>
                                        <p>We will file your RTI and inform you shortly</p>
                                    </div>
                                </div>
                            </div>
                            <div id="signing-process" class="contact_faq_tab">
                                <div class="contact_form">
                                  

                                    <div>
                                        <div class="signing_procedure">
                                            <div class="db_tab_heading">
                                                <h2>Review Your Application: Check Your Drafted RTI</h2>
                                            </div>
                                            <div class="db_tab_signing">
                                                <div class="signing_wrap">
                                                    <form action="{{route('approve-rti', $data->application_no)}}" class="form-submit signature-form" method="post">
                                                    @csrf
                                                    <input type="hidden" name="signature_type" value="manual">
                                                        <div class="contact_option custom_radio">
                                                            <input type="radio" id="rti_yes" name="rti_option" checked="">
                                                            <label for="rti_yes">Manual</label>
                                                            <input type="text" name="signature">
                                                            <div class="sign_area_wrap">
                                                                <div class="sign_area">
                                                                    <div class="sign_img">
                                                                        <!-- <img class="img-fluid" src="images/sign" alt=""> -->
                                                                    </div>
                                                                </div>
                                                                <button class="theme-btn">Submit Signature</button>

                                                            </div>
                                                        </div>
                                                    </form>

                                                    
                                                    <div class="contact_option custom_radio">


                                                    <form action="{{route('approve-rti', $data->application_no)}}" class="authentication signature-form-upload" method="post">
                                                            @csrf

                                                            <input type="hidden" name="signature_type" value="upload">

                                                        <input type="radio" id="rti_no" name="rti_option" >
                                                        <label for="rti_no">Upload Scanned Signature</label>
                                                        <div class="sign_area_wrap">
                                                            <div class="upload_area drop-area" id="drop-area">
                                                                <div class="upload_wrap">
                                                                    <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                                                                    <p>Drag and drop response received from PIO or <label>Choose File</label></p>
                                                                    <div class="upload_img_wrap"></div>
                                                                </div>
                                                                <input id="document-upload" accept="image/*" class="upload_inputfile document-upload" type="file" name="file" data-preview="signature-preview" data-form="signature-form-upload">
                                                                <input type="hidden" name="signature" class="image-input" />

                                                            </div>
                                                            <div class="preview" id="signature-preview"></div>
                                                            <button class="theme-btn">Submit</button>

                                                        </div>

                                                        </div>
                                                    </form>

                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.profile.tab-section.document-popup')

@endsection

@push('js')
<script>
 
    $(document).on('change', '.document-upload', function () {
        let _this = $(this);
       let form = $(this).attr('data-form');
       let preview = $(this).attr('data-preview');

        var form_data = new FormData($('.'+form)[0]);

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            url: "{{route('upload-images')}}",
            method: "POST",
            data: form_data,
            cache : false,
            processData: false,
            contentType: false,
            dataType : 'json',
            success : function(response){
                // $('.upload-file-img').attr('src', response.data);
              $('.image-input').val(response.data);
                $('#'+preview).html(
                    `<div class="preview-item"><img src="${response.data}"><button type="button" class="delete-icon"></button></div>`
                );
                _this.val(null)

            },
            error : function(error) {}
         });
      });
      $(document).on('click', '.delete-icon', function(){
        $(this).parents().eq(0).remove();
      });


$(document).on('change', '.multiple-document-upload', function () {
    let _this = $(this);
    let form = $(this).attr('data-form');
       let preview = $(this).attr('data-preview');
        var data = new FormData($('.'+form)[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url: "{{route('upload-multiple-files')}}",
        method: "POST",
        data: data,
        cache : false,
        processData: false,
        contentType: false,
        dataType : 'json',
        success : function(response){
            $.each(response.data, function(index, value){

               
                $('#'+preview).append(`<div class="preview-item">
                                                
                                                    <a href="${value.path}" target="blank">
                                                        <embed src="{{url('/')}}${value.file}" width="50" height="50" />
                                                        <input hidden value="${value.file}" name="documents[]">
                                                    </a>
                                                    <button type="button" class="delete-icon"></button>
                                                </div>`);
            })

        },
        error : function(error) {}
        });
    });
</script>
@endpush
