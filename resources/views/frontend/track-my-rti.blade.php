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
                                <li class="fs-24"><a href="/track-my-rti">Track My RTI</a></li>

                                <li class="fs-24 active">{{$data->application_no ?? ''}}</li>
                               </ol>
                            </div>
                          
                        </div>
                    </div>
                </div>
        </header>
        <br><br>

<section class="contact_section dbtab_section lawyer_db_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item @if($tab == 'application-status')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab1" href="{{route('track-my-rti', [encryptString($data->application_no), 'application-status'])}}">Application Status</a>
                        </li>
                       
                        <li class="contact_faq_item @if($tab == 'rti-application')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab2" href="{{route('track-my-rti', [encryptString($data->application_no), 'rti-application'])}}">RTI Application</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'your-profile')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab3" href="{{route('track-my-rti', [encryptString($data->application_no), 'your-profile'])}}">Your Profile</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'download')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab4" href="{{route('track-my-rti', [encryptString($data->application_no), 'download'])}}">Download</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'invoice')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab5" href="{{route('track-my-rti', [encryptString($data->application_no), 'invoice'])}}">Payment Info & Invoice</a>
                        </li>  
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
                @if(!auth()->guard('customers')->check())
                    <p class="track-my-rti-note"><strong>NOTE:</strong> Please Login your account for further process <a   class="login-modal" href="javascript:void(0);">Log In / Sign Up</a></p>
                    @endif
                <div class="contact_wrapper db_tab_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content lawyer_accordion">
                            <a class="accord_item" href1="#tab1" data-id="tab1" href="{{route('track-my-rti', [encryptString($data->application_no), 'application-status'])}}">Application Status</a>
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
                                                <li>@if(!empty($item->pio_expected_date)) {{Carbon\Carbon::parse($item->pio_expected_date)->format('d/m/Y')}}@endif</li>
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
                                                    <div class="track_no">Postal Tracking No: <a href="javascript:void(0);">{{$item->courierTracking->courier_tracking_number ?? ''}}</a></div>
                                                    <div class="track_note">
                                                        <p><strong>NOTE:</strong> As per the RTI Act, 2005, the information should reach you within 30 days of filing. In majority of the cases information reaches only after 40-50 days.</p>
                                                    </div>
                                                </div>
                                        @else

                                        @if(empty($item->signature_image) && $item->lastRevision && $item->lastRevision->send_client == 1 && empty($item->lastRevision->customer_change_request))
                                        <div class="status_bottom">

                                            <div class="note">
                                                <p>*Your RTI Ready for Approval</p>
                                            </div>
                                            @if(auth()->guard('customers')->check() && auth()->guard('customers')->user()->id = $item->user_id)
                                            <div class="db_tab_status_action">
                                                <a class="theme-btn" href1="#tab2" href="{{route('my-rtis', [$item->application_no, 'rti-application'])}}"><span>Approve RTI</span></a>
                                            </div>
                                            @endif
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
                                                       @if($item->appeal_no == 0)
                                                <p>Your RTI application is currently being processed and will be drafted and sent for your approval within 2-3 business days.</p>
                                                @elseif($item->appeal_no == 1)
                                                <p>Your First Appeal is currently being processed and will be drafted and sent for your approval within 2-3 business days.</p>
                                                 @elseif($item->appeal_no == 2)
                                                   <p>Your Second Appeal is currently being processed and will be drafted and sent for your approval within 2-3 business days.</p>
                                                @endif
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

                            <a class="accord_item" href1="#tab2" data-id="tab2" href="{{route('track-my-rti', [encryptString($data->application_no), 'rti-application'])}}">RTI Application</a>
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

                                        </div>
                                    
                                    
                                    </div>
                                @elseif($data->lastRtiQuery && $data->lastRtiQuery->send_client == 1 && $data->lastRtiQuery->marked_read == 0)

                                @else
                                

                                    <div class="approve_rti">
                                        <div class="db_tab_heading">
                                            <h2>DRAFTING IS IN PROCESS</h2>
                                        </div>
                                        <div class="approval_view">
                                        
                                            <div class="waiting_msg">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                                                <h4 class="heading">Please wait while your RTI application is being drafted. </h4>
                                                <a class="theme-btn" href1="#tab1" href="{{route('track-my-rti', [encryptString($data->application_no), 'application-status'])}}"><span>Back</span></a>
                                            </div>          
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endif
                            <a class="accord_item" href1="#tab3" data-id="tab3" href="{{route('track-my-rti', [encryptString($data->application_no), 'your-profile'])}}">Your Profile</a>
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

                            <a class="accord_item" href1="#tab4" data-id="tab4" href="{{route('track-my-rti', [encryptString($data->application_no), 'download'])}}">Download</a>
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
                                                <a class="theme-btn @if(!$item->lastRevision) disabled @endif" href="{{route('download-rti', $item->id)}}" target="blank"><span>Download RTI</span></a>

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
                                        <!--    <a class="theme-btn @if(!$data->lastRevision) disabled @endif" href="{{route('download-rti', $data->application_no)}}" target="blank"><span>Download RTI</span></a>-->

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
                            <a class="accord_item" href1="#tab5" data-id="tab5" href="{{route('track-my-rti', [encryptString($data->application_no), 'invoice'])}}">Payment Info & Invoice</a>
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
                                         @if(count($list) == 2)
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
                            
                            @if($data->lastRtiQuery && $data->lastRtiQuery->marked_read == 0)

                                <a class="accord_item" href1="#tab8" data-id="tab8" href="{{route('track-my-rti', [encryptString($data->application_no), 'requested-info'])}}">More Info Request</a>
                                @if($tab == 'requested-info')
                                <div id="tab8" class="contact_faq_tab @if($tab == 'requested-info')active @endif">
                                    <div class="rti_application">
                                        <div class="db_tab_heading">
                                            <h2>Lawyer Requested Info</h2>
                                        </div>
                                        <div>
                                            @include('frontend.profile.tab-section.query-request-section')
                                        </div>
                                    
                                    </div>
                                </div>
                                @endif
                            @endif
                          

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
