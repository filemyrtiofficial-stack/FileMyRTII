@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer.css')}}">



@endpush
@section('content')

        
<header class="breadcrumb_banner bg_none">
                <div class="container">
                    <div class="row banner_row">
                        <div class="col-12 col-sm-12">
                            <div class="breadcrumb">
                               <ol>
                                <li class="fs-24"><a href="/">Home</a></li>
                                <li class="fs-24"><a href="{{route('my-rti')}}">My RTI</a></li>

                                <li class="fs-24 active">{{$data->application_no ?? ''}}</li>
                               </ol>
                            </div>
                          
                        </div>
                    </div>
                </div>
        </header>

        <!--<br><br>-->

<section class="contact_section dbtab_section lawyer_db_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                    <li class="contact_faq_item @if($tab == 'notification')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab9" href="{{route('my-rtis', [$data->application_no, 'notification'])}}">Notification</a>
                        </li>

                        <li class="contact_faq_item @if($tab == 'application-status')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab1" href="{{route('my-rtis', [$data->application_no, 'application-status'])}}">Application Status</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'rti-application')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab2" href="{{route('my-rtis', [$data->application_no, 'rti-application'])}}">RTI Application</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'your-profile')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab3" href="{{route('my-rtis', [$data->application_no, 'your-profile'])}}">Your Profile</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'download')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab4" href="{{route('my-rtis', [$data->application_no, 'download'])}}">Download</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'invoice')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab5" href="{{route('my-rtis', [$data->application_no, 'invoice'])}}">Payment Info & Invoice</a>
                        </li>   
                        @if((count($list) >= 1 && $data->status == 3) || ($data->firstAppeal && $data->firstAppeal->payment_status == 'paid'))
                        <li class="contact_faq_item @if($tab == 'first-appeal')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab6" href="{{route('my-rtis', [$data->application_no, 'first-appeal'])}}">First Appeal</a>
                        </li>
                        @endif
                        @if($data->filedTime && addDays(30, $data->filedTime->created_at) <= Carbon\Carbon::now() && addDays(60, $data->filedTime->created_at) > Carbon\Carbon::now())
                        @endif
                        @if((count($list) >= 2 && $data->status == 3 ) || ($data->secondAppeal && $data->secondAppeal->payment_status == 'paid'))
                        <li class="contact_faq_item @if($tab == 'second-appeal')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab7" href="{{route('my-rtis', [$data->application_no, 'second-appeal'])}}">Second Appeal</a>
                        </li>
                        @endif
                        @if($data->filedTime && addDays(60, $data->filedTime->created_at) <= Carbon\Carbon::now())
                        @endif
                        @if($data->lastRtiQuery && $data->lastRtiQuery->marked_read == 0)
                        <li class="contact_faq_item @if($tab == 'requested-info')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab8" href="{{route('my-rtis', [$data->application_no, 'requested-info'])}}">More Info Request</a>
                        </li>
                        @endif
                       
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                  
                    <h2>Application No: {{$data->application_no ?? ''}}

                    </h2>
                </div>
                <div class="contact_wrapper db_tab_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content lawyer_accordion">


                        <a class="accord_item" href1="#tab9" data-id="tab9" href="{{route('my-rtis', [$data->application_no, 'notification'])}}">Notification</a>
                            @if($tab == 'notification')
                            <div id="tab9" class="contact_faq_tab @if($tab == 'notification')active @endif">
                                <div class="notification">
                                    <div class="lawyer_req_info">
                                        <div class="req_info_wrap">
                                            <div class="info_header">
                                                <h4>Notifications</h4>
                                            </div>
                                            <div class="info_body info_scroll">
                                                @foreach(customerNotifictaionList(['linkable_id' => $data->id]) as $item => $value)
                                                <div class="info_msg_wrap">
                                                    <div class="info_requested" > {{$value->message}}  @if(in_array($value->type, ['assign-lawyer', 'draft-rti', 'filed-mail', 'more-info-requested', 'more-info-sended', 'edit-request', 'draft-rti-again', 'approve-rti', 'send-reply']))<a target="blank" class="mail-data"  data-target="mail-popup" href="{{route('customer.get-notification-mail', $value->id)}}"><img width="20" src="{{asset('assets/rti/images/view.png')}}" alt=""></a> @endif<span class="notification">({{Carbon\Carbon::parse($value->created_at)->format('d M, Y h:i A')}})</span></div>
                                                    <!-- <div class="info_reminder">Reminder sent to customer on 01/01/2025</div> -->

                                                </div>
                                                @endforeach
                                            
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif


                            <a class="accord_item" href1="#tab1" data-id="tab1" href="{{route('my-rtis', [$data->application_no, 'application-status'])}}">Application Status</a>
                            @if($tab == 'application-status')
                            <div id="tab1" class="contact_faq_tab @if($tab == 'application-status')active @endif">
                                <div class="application_status">
                                    <div class="db_tab_heading">
                                        <h2>Application Status</h2>
                                    </div>
                                    @foreach($list as $key =>  $item)
                                    <div class="db_tab_status">
                                        <div class="db_tab_heading">
                                            <div>
                                                @if($item->appeal_no > 0)
                                                {{$item->appeal_no == 1 ? "First" : "Second"}} Appeal Status
                                                @endif
                                            </div>
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
                                                   
                                                     @if(!empty($date)) 
                                                     {{$date}}
                                                     @else
                                                     -
                                                     @endif</li>
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
                                                <li>@if(!empty($item->pio_expected_date)) {{Carbon\Carbon::parse($item->pio_expected_date)->format('d/m/Y')}} @else - @endif</li>
                                                <li>
                                                    <span class="check_icon_wrapper">
                                                        @if(!empty($item->pio_expected_date)) 
                                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">
                                                        @else
                                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">

                                                        @endif
                                                    </span>
                                            </li>
                                            </ul>
                                        </div>

                

                                        <ul class="status_bar">
                                            <li @if($item->status >= 1) class="active done" @endif>
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
                                            <li @if($item->status >= 2) class="active done" @endif  >
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
                                            <li @if($item->status == 3) class="active done" @endif >
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
                                                    <div class="track_no">Postal Tracking No: <a href="{{$item->courierTracking->courier_tracking_number ?? ''}}" target="blank">{{$item->courierTracking->courier_tracking_number ?? ''}}</a></div>
                                                    <div class="track_note">
                                                        <p><strong>NOTE:</strong> As per the RTI Act, 2005, the information should reach you within 30 days of filing. In majority of the cases information reaches only after 40-50 days.</p>
                                                    </div>
                                                </div>
                                        @else

                                        @if(empty($item->signature_image) && $item->lastRevision && $item->lastRevision->send_client == 1 && empty($item->lastRevision->customer_change_request))
                                        <div class="status_bottom">

                                            <div class="note">
                                                <p>*Please approve your drafted RTI Application</p>
                                            </div>
                                            <div class="db_tab_status_action">
                                                <a class="theme-btn" href1="#tab2" href="{{route('my-rtis', [$item->application_no, 'rti-application'])}}"><span>Approve RTI</span></a>
                                            </div>
                                        </div>
                                        @elseif($item->lastRtiQuery && $item->lastRtiQuery->marked_read == 0)
                                           <div class="note">
                                            <div class=" more-info-card-message">
                                            <p>Note : We have requested more information, kindly review and provide the requested information to proceed further.</p>
                                            </div>
                                            </div>
                                     
                                        @elseif($item->status == 1)

                                        <div class="status_bottom">

                                            <div class="note">
                                               <p>
                                            @if($item->appeal_no == 0)
                                                Your RTI application is currently being processed and will be drafted and sent for your approval within 2-3 business days.
                                                @elseif($item->appeal_no == 1)
                                                Your First Appeal is currently being processed and will be drafted and sent for your approval within 2-3 business days.
                                                 @elseif($item->appeal_no == 2)
                                                   Your Second Appeal is currently being processed and will be drafted and sent for your approval within 2-3 business days.
                                                @endif
                                                </p>
                                            </div>
                                            </div>
                                          @elseif($item->status == 2)

                                        <div class="status_bottom">

                                            <div class="note">
                                                <p>Thankyou for approving the rti we will now file your rti and provide the tracking number shortly</p>
                                            </div>
                                            </div>
                                        @endif
                                          

                                        @endif
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            @endif

                            <a class="accord_item" href1="#tab2" data-id="tab2" href="{{route('my-rtis', [$data->application_no, 'rti-application'])}}">RTI Application</a>
                            @if($tab == 'rti-application')
                            <div id="tab2" class="contact_faq_tab @if($tab == 'rti-application')active @endif" data-t="{{$tab}}">
                                @if($data->lastRevision && $data->lastRevision->send_client == 1)
                                    <div class="review_application">
                                        <div class="db_tab_heading">
                                            <h2>
                                                @if($data->status ==2 )
                                                  Thank you for approving and here your Approved rti draft
                                                @elseif($data->status == 3 )
                                                    Your Final RTI
                                                @else
                                                Review Your Application: Check Your Drafted RTI
                                                @endif
                                                </h2>
                                        </div>
                                        <div class="db_tab_review">
                                            <div class="review_wrap">
                                                <div class="review">
                                                     @if(!empty($data->final_rti_document))
                                                     <embed type="text/html" src="{{asset($data->final_rti_document)}}" width="100%" height="100%">
                                                     @else
                                                         
                                                  
                                                        <embed type="text/html" src="{{url('download-my-rti/'.$data->id)}}" width="100%" height="100%">
                                                      
                                                     @endif
                                                     
                                                </div>
                                            </div>
                                            
                                            <div class="review_action">
                                                 @if( !empty($data->final_rti_document))
                                                 
                                                  <a href="{{filePreview($data->final_rti_document)}}" class="theme-btn @if(!$data->lastRevision ) disabled @endif" target="blank"><span>Download PDF</span></a>
                                                
                                                @else
                                                <a href="{{route('customer.download-rti', $data->id)}}" class="theme-btn @if(!$data->lastRevision ) disabled @endif" target="blank"><span>Download PDF</span></a>
                                                @endif
                                            </div>
                                            @if(empty($data->signature_image) && $data->lastRevision && $data->lastRevision->send_client == 1 && empty($data->lastRevision->customer_change_request))
                                            <ol class="review_option">
                                                <li class="option_no"><span>Edit if Needed - Click "<a class="tabings rti-popup" data-id="edit-request-modal" href="#" href1="#edit-request">Edit</a>" to Make Changes</span></li>
                                                <li class="option_no"><span>Proceed to Sign - If Satisfied, Click</span><a href="#signing-process" class="theme-btn tabings"><span>Proceed for Signing</span></a></li>
                                            </ol>
                                        
                                            @endif
                                        </div>
                                    
                                    
                                    </div>
                                @elseif($data->lastRtiQuery && $data->lastRtiQuery->marked_read == 0)
                                @include('frontend.profile.tab-section.query-request')

                                @else
                                

                                    <div class="approve_rti">
                                        <div class="db_tab_heading">
                                            <h2>DRAFTING IS IN PROCESS</h2>
                                        </div>
                                        <div class="approval_view">
                                        
                                            <div class="waiting_msg">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                                                <h4 class="heading">Please wait while your RTI application is being drafted.    </h4>
                                            </div>          
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endif
                          
                            <a class="accord_item" href1="#tab3" data-id="tab3" href="{{route('my-rtis', [$data->application_no, 'your-profile'])}}">Your Profile</a>
                            @if($tab == 'your-profile')
                            <div id="tab3" class="contact_faq_tab @if($tab == 'your-profile')active @endif">
                                <div class="contact_faq_heading text-center">
                                    <h2>Your Profile</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    @include('frontend.profile.tab-section.profile')
                                </div>
                            </div>
                            @endif
                            <a class="accord_item" href1="#tab4" data-id="tab4" href="{{route('my-rtis', [$data->application_no, 'download'])}}">Download</a>
                            @if($tab == 'download')
                            <div id="tab4" class="contact_faq_tab @if($tab == 'download')active @endif">
                                <div class="rti_download">
                                    <div class="db_tab_heading">
                                        <h2>Download RTI Application</h2>
                                    </div>
                                    <ul class="rti_documents_ul">
                                        @foreach($list as $key =>  $item)
                                    <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/download-application.webp')}}" alt="">
                                                <div class="doc_content">Your @if($item->appeal_no == 0) Intial @elseif($item->appeal_no == 1) First Appeal @elseif($item->appeal_no == 2) Second Appeal @endif RTI Application</div>
                                            </div>
                                            <div class="doc_action">
                                            @if(!empty($item->final_rti_document)) 
                                            <a class="theme-btn " href="{{filePreview($item->final_rti_document)}}" target="blank"><span>Download RTI</span></a>
                                            @else
                                            <a class="theme-btn @if(!$item->lastRevision) disabled @endif" href="{{route('customer.download-rti', $item->id)}}" target="blank"><span>Download RTI</span></a>

                                            @endif
                                            </div>
                                        </li>

                                    @endforeach
                                        <!--<li class="rti_document_list">-->
                                        <!--    <div class="doc_name">-->
                                        <!--        <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/download-application.webp')}}" alt="">-->
                                        <!--        <div class="doc_content">Your RTI Application</div>-->
                                        <!--    </div>-->
                                        <!--    <div class="doc_action">-->
                                        <!--    @if(!empty($data->final_rti_document)) -->
                                        <!--    <a class="theme-btn " href="{{filePreview($data->final_rti_document)}}" target="blank"><span>Download RTI</span></a>-->
                                        <!--    @else-->
                                        <!--    <a class="theme-btn @if(!$data->lastRevision) disabled @endif" href="{{route('customer.download-rti', $data->id)}}" target="blank"><span>Download RTI</span></a>-->

                                        <!--    @endif-->
                                        <!--    </div>-->
                                        <!--</li>-->
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/attachment-document.webp')}}" alt="">
                                                <div class="doc_content">Document(s) Attached to Application </div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(empty($data->documents) || count($data->documents) == 0) disabled @else rti-popup @endif" href="javascript:void(0);" data-id="attachment-popup"><span>@if(empty($data->documents) || count($data->documents) == 0) No @endif Document</span></a>
                                            </div>
                                        </li>
                                    </ul>
                                    @if($data->status < 3)
                                    <div class="track_wrap">
                                        <div class="track_note">
                                            <p><strong>NOTE:</strong> Your application goes through lot of changes during the filing process. Your downloaded file may change later.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <a class="accord_item" href1="#tab5" data-id="tab5" href="{{route('my-rtis', [$data->application_no, 'invoice'])}}">Payment Info & Invoice</a>
                            @if($tab == 'invoice')
                            <div id="tab5" class="contact_faq_tab @if($tab == 'invoice')active @endif">
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
                                        @if(count($list) > 1)
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/invoice-icon.webp')}}"  alt="">
                                                <div class="doc_content">RTI First Appeal Invoice</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(count($list) < 2) disabled @endif" href="{{invoicePreviewPath($data->application_no, 1)}}"  target="_blank"><span>Download Invoice</span></a>
                                            </div>
                                        </li>
                                        @endif
                                        @if(count($list) == 3)
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/invoice-icon.webp')}}" alt="">
                                                <div class="doc_content ">RTI Second Appeal Invoice</div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn @if(count($list) < 3) disabled @endif" href="{{invoicePreviewPath($data->application_no, 2)}}" target="_blank"><span>Download Invoice</span></a>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if((count($list) >= 1 && $data->status == 3) || ($data->firstAppeal && $data->firstAppeal->payment_status == 'paid'))

                                <a class="accord_item" href1="#tab6" data-id="tab6" href="{{route('my-rtis', [$data->application_no, 'first-appeal'])}}">First Appeal</a>
                                @if($tab == 'first-appeal')
                                @include('frontend.profile.tab-section.tab6')
                                <!--<div id="tab6" class="contact_faq_tab @if($tab == 'first-appeal')active @endif">-->
                                <!--    <div class="rti_appeal">-->
                                <!--        <div class="db_tab_heading">-->
                                <!--            <h2>First Appeal</h2>-->
                                <!--        </div>-->
                                <!--        @if($data->firstAppeal)-->
                                <!--         <div class="db_tab_form">-->
                                <!--            <div class="db_item_wrap single">-->
                                <!--                <div class="form_item">-->
                                <!--                    <textarea class="form_field" type="text" name="reason" id="" placeholder="First Appeal Reason" disabled>{{$data->firstAppeal->appealDeatils->reason ?? ''}}</textarea>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--            @if(!empty($data->firstAppeal->appealDeatils->document ))-->
                                <!--            <a href="{{filePreview($data->firstAppeal->appealDeatils->document ?? '')}}" target="blank" class="theme-btn"><span>Documents</span></a>-->
                                <!--            @endif-->
                                           
                                <!--        </div>-->
                                        
                                <!--        @else-->
                                <!--        <form action="{{route('rti-appeal', $data->id)}}" class="authentication first-appeal-form " method="post">-->
                                <!--            @csrf-->
                                <!--            <input type="hidden" name="appeal_no" value="1">-->
                                <!--            <div class="appeal_wrap">-->
                                <!--                <div class="appeal_info">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>What is First Appeal?</h4>-->
                                <!--                    </div>-->
                                <!--                    <div class="appeal_content">-->
                                <!--                        <p>According to the RTI Act, if a response is unsatisfactory or delayed beyond 30 days, you have the right to file a First Appeal. This ensures your application is reviewed by a higher authority within the same department.</p>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="appeal_info">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>Apply for First Appeal after {{Carbon\Carbon::parse($data->created_at)->addDays(30)->format('d/m/Y')}}</h4>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="appeal_info with_input">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>Did you receive response for your Initial Appeal?</h4>-->
                                <!--                    </div>-->
                                <!--                    <div class="custom_radio">-->
                                <!--                        <input type="radio" id="fappeal_yes" name="received_appeal" checked="" value="1">-->
                                <!--                        <label for="fappeal_yes">Yes</label>-->
                                <!--                    </div>-->
                                <!--                    <div class="custom_radio">-->
                                <!--                        <input type="radio" id="fappeal_no" name="received_appeal" value="0">-->
                                <!--                        <label for="fappeal_no">No</label>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="upload_area">-->
                                <!--                    <div class="upload_wrap">-->
                                <!--                        <div class="icon_wrap">-->
                                <!--                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">-->
                                <!--                        </div>-->
                                <!--                        <p>Drag and drop response received from PIO or <label>Choose File<input class="upload_inputfile document-upload" type="file" name="file"  data-form="first-appeal-form" data-preview="first-appeal-preview"    accept="image/*,.pdf"/></p>-->
                                <!--                        <div class="upload_img_wrap"></div>-->
                                                        
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <input type="hidden" name="document" class="image-input" />-->
                                <!--                <div class="preview" id="first-appeal-preview"></div>-->
                                <!--            </div>-->
                                <!--            <div class="db_tab_form">-->
                                <!--                <div class="db_item_wrap single">-->
                                <!--                    <div class="form_item">-->
                                <!--                        <input class="form_field" type="text" id="" placeholder="Type your reason here (request to provide in English)" name="reason">-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="db_tab_status_action">-->
                                <!--                    <button class="theme-btn"><span>Proceed Payment</span></button>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </form>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--</div>-->
                                @endif
                            @endif
                            @if($data->filedTime && addDays(30, $data->filedTime->created_at) <= Carbon\Carbon::now() && addDays(60, $data->filedTime->created_at) > Carbon\Carbon::now())
                            @endif
                            @if((count($list) >= 2 && $data->status == 3) ||($data->secondAppeal && $data->secondAppeal->payment_status == 'paid'))
                                <a class="accord_item" href1="#tab7" data-id="tab7" href="{{route('my-rtis', [$data->application_no, 'second-appeal'])}}">Second Appeal</a>
                                @if($tab == 'second-appeal')
                                @include('frontend.profile.tab-section.tab7')
                                <!--<div id="tab7" class="contact_faq_tab @if($tab == 'second-appeal')active @endif">-->
                                <!--    <div class="rti_appeal">-->
                                        
                                <!--        @if($data->secondAppeal)-->
                                <!--        <div class="db_tab_heading">-->
                                <!--            <h2>Second Appeal</h2>-->
                                <!--        </div>-->
                                <!--        <div class="db_tab_form">-->
                                <!--            <div class="db_item_wrap single">-->
                                <!--                <div class="form_item">-->
                                <!--                    <textarea class="form_field" type="text" name="reason" id="" placeholder="Second Appeal Reason" disabled>{{$data->secondAppeal->appealDeatils->reason ?? ''}}</textarea>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--            @if(!empty($data->secondAppeal->appealDeatils->document ))-->
                                <!--            <a href="{{filePreview($data->secondAppeal->appealDeatils->document ?? '')}}" target="blank" class="theme-btn"><span>Documents</span></a>-->
                                <!--            @endif-->
                                           
                                <!--        </div>-->
                                        
                                <!--        @else-->
                                <!--        <div class="db_tab_heading">-->
                                <!--            <h2>What is Second Appeal?</h2>-->
                                <!--        </div>-->
                                <!--        <form action="{{route('rti-appeal', $data->id)}}" class="authentication second-appeal-form " method="post">-->
                                <!--            @csrf-->
                                <!--            <input type="hidden" name="appeal_no" value="2">-->
                                <!--            <div class="appeal_wrap">-->
                                <!--                <div class="appeal_info">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>What is Second Appeal?</h4>-->
                                <!--                    </div>-->
                                <!--                    <div class="appeal_content">-->
                                <!--                        <p>If the First Appeal didn't yield a satisfactory outcome, the RTI Act empowers you to file a Second Appeal with the Central Information Commission (CIC) or State Information Commission (SIC). This is your final step to seek justice and transparency.</p>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="appeal_info">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>Apply for Second Appeal after {{Carbon\Carbon::parse($data->created_at)->addDays(60)->format('d/m/Y')}}</h4>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="appeal_info with_input">-->
                                <!--                    <div class="appeal_heading">-->
                                <!--                        <h4>Did you receive response for your First Appeal?</h4>-->
                                <!--                    </div>-->
                                <!--                    <div class="custom_radio">-->
                                <!--                        <input type="radio" id="sappeal_yes" name="received_appeal" checked="" value="1">-->
                                <!--                        <label for="sappeal_yes">Yes</label>-->
                                <!--                    </div>-->
                                <!--                    <div class="custom_radio">-->
                                <!--                        <input type="radio" id="sappeal_no" name="received_appeal" value="0">-->
                                <!--                        <label for="sappeal_no">No</label>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="upload_area">-->
                                <!--                    <div class="upload_wrap">-->
                                <!--                        <div class="icon_wrap">-->
                                <!--                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">-->
                                <!--                        </div>-->
                                <!--                        <p>Drag and drop response received from PIO or <label>Choose File<input class="upload_inputfile document-upload" type="file" name="file"  data-form="second-appeal-form" data-preview="second-appeal-preview"></p>-->
                                <!--                        <div class="upload_img_wrap"></div>-->
                                <!--                        <input type="hidden" name="document" class="image-input" />-->

                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="preview" id="second-appeal-preview"></div>-->
                                <!--            </div>-->
                                <!--            <div class="db_tab_form">-->
                                <!--                <div class="db_item_wrap single">-->
                                <!--                    <div class="form_item">-->
                                <!--                        <input class="form_field" type="text" name="reason" id="" placeholder="Type your reason here (request to provide in English)" required="">-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="db_tab_status_action">-->
                                <!--                    <button href="javascript:void(0);" class="theme-btn"><span>Proceed Payment</span></button>-->
                                <!--                </div>-->
                                <!--            </div>-->

                                <!--        </form>-->
                                <!--        @endif-->
                                    
                                <!--    </div>-->
                                <!--</div>-->
                                @endif
                            @endif
                            @if($data->filedTime && addDays(60, $data->filedTime->created_at) <= Carbon\Carbon::now())
                            @endif
                            @if($data->lastRtiQuery && $data->lastRtiQuery->marked_read == 0)

                                <a class="accord_item" href1="#tab8" data-id="tab8" href="{{route('my-rtis', [$data->application_no, 'requested-info'])}}">More Info Request</a>
                                @if($tab == 'requested-info')
                                <div id="tab8" class="contact_faq_tab @if($tab == 'requested-info')active @endif">
                                    <div class="rti_application">
                                        <div class="db_tab_heading">
                                            <h2>Lawyer Requested Info</h2>
                                        </div>
                                        <div>
                                            @include('frontend.profile.tab-section.query-request')
                                        </div>
                                    
                                    </div>
                                </div>
                                @endif
                            @endif

                            <div id="edit-request" class="contact_faq_tab @if($tab == 'edit-request')active @endif">
                                <div class="rti_application">
                                    <div class="db_tab_heading">
                                        <h2>RTI Application Details</h2>
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
                                        <h2>for approving your RTI Application No. {{$data->application_no}}</h2>
                                        <p>We will file your RTI and inform you shortly</p>
                                    </div>
                                </div>
                            </div>

                            <div id="thankyou-query-process" class="contact_faq_tab">
                                  
                                <div class="thankyou_msgs text-center">
                                    <div class="thankyou_img">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/thankyou-img.webp')}}" alt="">
                                    </div>
                                   
                                    <div class="thankyou_msg_detail">
                                    <h2>Thank you for submitting more information.</h2>
                                    <p>We will process and get back to you shortly.</p>
                                    </div>
                                </div>
                            </div>


                                <div id="signing-process" class="contact_faq_tab @if($tab == 'approve-rti')active @endif">
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
                                                          <input type="hidden" name="last_revision_id" value="{{$data->lastRevision->id ?? ''}}">
                                                            <div class="contact_option custom_radio">
                                                                <input type="radio" id="rti_yes" name="signature_type"  value="manual" checked>
                                                                <label for="rti_yes">Manual</label>
                                                                <div class="sign_area_wrap">
                                                                    <div class="sign_area">
                                                                        <input class="form-field" type="text" name="signature" id="signature" value="{{$data->fullName}}">
                                                                        <span class="signature-preview">{{$data->fullName}}</span> <br>
                                                                    
                                                                    </div>
                                                                    <!-- <button class="theme-btn"><span>Submit Signature</span></button> -->

                                                                </div>
                                                            </div>
                                                            <div class="contact_option custom_radio">
                                                                <input type="radio" id="rti_no" name="signature_type" value="upload">
                                                                <label for="rti_no">Upload Scanned Signature</label>
                                                                <div class="sign_area_wrap">
                                                                    <div class="upload_area drop-area" id="drop-area">
                                                                        <div class="upload_wrap">
                                                                            <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/upload-icon.webp')}}" alt="">
                                                                            <p>Drag and drop Signature or <label>Choose File</label>   (<span>Dimention :  max width : 200px and max Height : 50px</span>)</p>
                                                                            <div class="upload_img_wrap"></div>
                                                                        </div>
                                                                        <input id="document-upload" accept="image/*" class="upload_inputfile document-upload" data-type="signature" type="file" name="file" data-preview="signature-preview" data-form="signature-form" accept="image/*">
                                                                        <input type="hidden" name="signature_file" class="image-input"  id="signature_file"/>
                                                                      
 
                                                                    </div>
                                                                    <div class="preview" id="signature-preview"></div>
                                                                    <button class="theme-btn"><span>Submit Signature</span></button>
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
@include('frontend.profile.tab-section.edit-request-popup')

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>

<script>

$(document).ready(function() {
  $(".editor").each(function(_, ckeditor) {
    CKEDITOR.replace(ckeditor);
  });

});

$(document).on('keyup', '#signature', function(e){
    let value = $(this).val();
    $('.signature-preview').html(value);
}); 
//  $(document).on('change', '.form-image', function () {
//         let file = this.files[0]; // Get selected file
//         let files = this.files;
//         let previewLink = $(this).closest('.custom_choose_file').find('.form-image-preview'); // Find related anchor
//         let validation =   imagevaladition(files);
//                 if(validation == false){
//                     $(this).val(null)
//                      return;
//                 }
//         if (file) {
//         let fileURL = URL.createObjectURL(file); // Create a temporary file URL

//         // Set href attribute for the correct preview link
//         previewLink
//         .attr('href', fileURL)
//         .attr('target', '_blank').show() // Open in new tab

//         }
//         else {
//             previewLink.hide()
//         }
//         });

    $(document).on('change', '.document-upload', function () {
        let _this = $(this);
        let files = this.files;
        let accept = $(this).attr('accept');
        let validation =   imagevaladition(files, accept);
        
        if(validation == false){
        return;
        }

       let form = $(this).attr('data-form');
       let preview = $(this).attr('data-preview');

        var form_data = new FormData($('.'+form)[0]);
          if($(this).attr('data-type') != undefined) {
            form_data.append('field_type', $(this).attr('data-type'));
        }

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
                    `<div class="preview-item"><embed src="${response.data}" width="50" height="50"><button type="button" class="delete-icon"></button></div>`
                );
                _this.val(null)

            },
            error : function(error) {
                 $('.error_toast_msg').addClass('active').find('.error-message').html(error.responseJSON.errors.file[0] ?? '');
                    setTimeout(function() {
                    $('.error_toast_msg').fadeOut('slow', function() {
                    $(this).removeClass('active').show(); // Reset state after fading out
                    });
                    }, 3000);
            }
         });
      });
      $(document).on('click', '.delete-icon', function(){
        $(this).parents().eq(0).remove();
      });


$(document).on('change', '.multiple-document-upload', function () {
    let _this = $(this);
    let files = this.files;

    let validation =   imagevaladition(files);
    if(validation == false){
    return;
    }


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
                                                        <embed src="{{url('/')}}${value.file}" width="100" height="100" />
                                                        <input hidden value="${value.file}" name="documents[]">
                                                    </a>
                                                      <div class="preview-btn">
                    <a href="${value.path}" target="blank"> Preview
                                                        </a>
                                                        </div>
                                                    <button type="button" class="delete-icon"></button>
                                                </div>`);
            })

        },
        error : function(error) {}
        });
    });
    $(document).on('change', '.form-image', function () {
        let file = this.files[0]; // Get selected file
        let files = this.files;
        let previewLink = $(this).closest('.custom_choose_file').find('.form-image-preview'); // Find related anchor
        let validation =   imagevaladition(files);
                if(validation == false){
                    $(this).val(null)
                     return;
                }
        if (file) {
        let fileURL = URL.createObjectURL(file); // Create a temporary file URL

        // Set href attribute for the correct preview link
        previewLink
        .attr('href', fileURL)
        .attr('target', '_blank') // Open in new tab

        }
        });
</script>
@endpush
