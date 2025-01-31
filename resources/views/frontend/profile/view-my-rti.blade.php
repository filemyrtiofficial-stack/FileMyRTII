@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">

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


<section class="contact_section dbtab_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab1">Application Status</a>
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
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab7">Second Appeal</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-8">
            <div class="section_heading">
                            <h2>Application No: {{$data->application_no ?? ''}}</h2>
                        </div>
                <div class="contact_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content">
                            <div id="tab1" class="contact_faq_tab active">
                                <div class="application_status">
                                    <div class="db_tab_heading">
                                        <h2>Application Status</h2>
                                    </div>
                                    <div class="db_tab_status">
                                        <div class="form_table_detail">
                                            <ul class="charge_list">
                                                <li>Description</li>
                                                <li>Date</li>
                                                <li>Status</li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>RTI Application registered date</li>
                                                <li>{{Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</li>
                                                <li><span class="check_icon_wrapper"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon"></span></li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>RTI Application filed date</li>
                                                <li></li>
                                                <li><span class="check_icon_wrapper"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon"></span></li>
                                            </ul>
                                            <ul class="charge_list">
                                                <li>Expected reply from PIO</li>
                                                <li></li>
                                                <li><span class="check_icon_wrapper"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon"></span></li>
                                            </ul>
                                        </div>

                

                                        <ul class="status_bar">
                                            <li @if($data->status >= 1) class="active" @endif>
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
                                            <li @if($data->status >= 2) class="active" @endif  >
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
                                            <li @if($data->status == 3) class="active" @endif >
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

                                        @if($data->courierTracking)
                                                <div class="track_wrap">
                                                    <div class="track_no">Postal Tracking No: <a href="javascript:void(0);">{{$data->courierTracking->courier_tracking_number ?? ''}}</a></div>
                                                    <div class="track_note">
                                                        <p><strong>NOTE:</strong> As per the RTI Act, 2005, the information should reach you within 30 days of filing. In majority of the cases information reaches only after 40-50 days.</p>
                                                    </div>
                                                </div>
                                        @else 
                                        <div class="status_bottom">

                                            <div class="note">
                                                <p>*Please approve your drafted RTI Application</p>
                                            </div>
                                            <div class="db_tab_status_action">
                                                <a class="theme-btn tabings" href="#tab2"><span>Approve RTI</span></a>
                                            </div>
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div id="tab1old" class="contact_faq_tab">
                                <div class="contact_faq_heading text-center">
                                    <h2>Application Status</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>RTI Application registered date</td>
                                                <td>{{Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>RTI Application filed date</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Expected reply from PIO</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="status_bar">
                                        <li @if($data->status >= 1) class="active" @endif><a href="javascript:void(0);">1</a><span>Started</span></li>
                                        <li @if($data->status >= 2) class="active" @endif><a href="javascript:void(0);">2</a><span>Approval</span></li>
                                        <li @if($data->status == 3) class="active" @endif><a href="javascript:void(0);">3</a><span>Filed</span></li>
                                    </ul>

                                    @if($data->lastRevision && $data->lastRevision->status == 1)
                                    <button class="button tabings" href="#edit-request">Edit</button>
                                    <div class="signing-procedure">
                                       <form action="{{route('approve-rti', $data->application_no)}}" class="form-submit" method="post">
                                            @csrf
                                        <div>
                                                <input type="radio" name="signature_type" checked id="electronic-signature" value="elecronic">
                                                <label for="electronic-signature">Electronic Signature</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="signature_type" id="upload-scanned-signation" value="image">
                                                <label for="upload-scanned-signation">Upload Scanned Signation</label>
                                                <input type="file" name="file" id="document-upload" />
                                                <div class="upload_file hide" id="preview-section">
                                                    <img class="upload-file-img" target="blank">
                                                    
                                                    <input type="hidden" name="signature" class="image-input" />
                                                </div>

                                                
                                            </div>
                                            <button>Submit</button>
                                       </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="tab2" class="contact_faq_tab">
                                        
                                <div class="review_application">
                                    <div class="db_tab_heading">
                                        <h2>Review Your Application: Check Your Drafted RTI</h2>
                                    </div>
                                    @if($data->lastRevision)
                                    <div class="db_tab_review">
                                        <div class="review_wrap">
                                            <div class="review">
                                                {!! $html !!}
                                            </div>
                                        </div>
                                        <div class="review_action">
                                            <a href="{{route('customer.download-rti', $data->application_no)}}" class="theme-btn" target="blank"><span>Download PDF</span></a>
                                        </div>
                                        @if(empty($data->signature_image))
                                        <ol class="review_option">
                                            <li class="option_no"><span>Edit if Needed - Click "<a class="tabings" href="#edit-request">Edit</a>" to Make Changes</span></li>
                                            <li class="option_no"><span>Proceed to Sign - If Satisfied, Click</span><a href="#signing-process" class="theme-btn tabings"><span>Proceed for Signing</span></a></li>
                                        </ol>
                                      
                                        @endif
                                    </div>
                                    @else
                                     <div class="text-center">
                                        <h3>Your RTI is not drafted yet.</h3>
                                     </div>
                                    @endif
                                  
                                </div>
                             
                            </div>
                            <div id="tab2old" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="contact_faq_tab">
                                <div class="contact_faq_heading text-center">
                                    <h2>Your Profile</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    @include('frontend.profile.tab-section.profile')
                                </div>
                            </div>
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
                                                <a class="theme-btn" href="{{route('customer.download-rti', $data->application_no)}}" target="blank"><span>Download RTI</span></a>
                                            </div>
                                        </li>
                                        <li class="rti_document_list">
                                            <div class="doc_name">
                                                <img class="img-fluid" src="images/dashboard/attachment-document.webp" alt="">
                                                <div class="doc_content">Document(s) Attached to Application </div>
                                            </div>
                                            <div class="doc_action">
                                                <a class="theme-btn disabled" href="javascript:void(0);"><span>No Document</span></a>
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
                            <div id="tab5" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab6" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab7" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab8" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab9" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab10" class="contact_faq_tab">
                                <div class="contact_form">
                                    <div class="contact_form_heading">
                                        Lorem ipsum dolor sit ametcerat mi auctor
                                    </div>
                                    <div class="contact_option_list">
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_yes" name="rti_option" checked><label for="rti_yes">I have already applied RTI</label></div>
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_no" name="rti_option"><label for="rti_no">I Want to apply RTI</label></div>
                                    </div>
                                    <div class="contact_form_option">
                                        <div class="form_no">
                                            <button type="submit" class="theme-btn"><span>Apply Now</span></button>
                                        </div>
                                        <div class="form_yes">
                                            <div class="rti_form">
                                                <form action="">
                                                    <div class="form_item">
                                                        <select class="form_field custom_select" name="reason" id="">
                                                            <option value="selected">Please select a reason</option>
                                                            <option value="reason1">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason2">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason3">Lorem ipsum dolor sit amet.</option>
                                                        </select>
                                                    </div>
                                                    <div class="form_item col_2">
                                                        <div class="form_item">
                                                            <input class="form_field" type="text" name="study_year" id="" placeholder="Name">
                                                        </div>
                                                        <div class="form_item">
                                                            <input class="form_field" type="tel" name="study_year" id="" placeholder="Phone No">
                                                        </div>
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="email" name="email" id="" placeholder="E-mail">
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="text" name="study_year" id="" placeholder="Message">
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span>Submit</span></button>
                                                </form>
                                            </div>
                                        </div>
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

                            <div id="signing-process" class="contact_faq_tab">
                                <div class="contact_form">
                                    
                                    <div>
                                        <div class="signing_procedure">
                                            <div class="db_tab_heading">
                                                <h2>Review Your Application: Check Your Drafted RTI</h2>
                                            </div>
                                            <div class="db_tab_signing">
                                                <div class="signing_wrap">
                                                    <div class="contact_option custom_radio">
                                                        <input type="radio" id="rti_yes" name="signature_type" checked="">
                                                        <label for="rti_yes">Manual</label>
                                                        <div class="sign_area_wrap">
                                                            <div class="sign_area">
                                                                <div class="sign_img">
                                                                    <img class="img-fluid" src="images/sign" alt="">
                                                                </div>
                                                            </div>
                                                            <a href="javascript:void(0);" class="theme-btn"><span>Submit Signature</span></a>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="contact_option custom_radio">


                                                    <form action="{{route('approve-rti', $data->application_no)}}" class="form-submit signature-form" method="post">
                                                            @csrf


                                                        <input type="radio" id="rti_no" name="rti_option" checked="">
                                                        <label for="rti_no">Upload Scanned Signature</label>
                                                        <div class="sign_area_wrap">
                                                            <div class="upload_area drop-area" id="drop-area">
                                                                <div class="upload_wrap">
                                                                    <img class="img-fluid" src="images/dashboard/upload-icon.webp" alt="">
                                                                    <p>Drag and drop response received from PIO or <label>Choose File</label></p>
                                                                    <div class="upload_img_wrap"></div>
                                                                </div>
                                                                <input id="document-upload" accept="image/*" class="upload_inputfile" type="file" name="file">
                                                                <input type="hidden" name="signature" class="image-input" />

                                                            </div>
                                                            <div class="preview" id="preview"></div>
                                                            <!-- <a href="javascript:void(0);" class="theme-btn"><span>Submit</span></a> -->
                                                            <button class="theme-btn">Submit</button>

                                                        </div>


<!--                                                         

                                                        <div>
                                                            <input type="radio" name="signature_type" id="upload-scanned-signation" value="image">

                                                            <label for="upload-scanned-signation">Upload Scanned Signature</label>
                                                        </div>
                                                        <div class="sign_area_wrap">
                                                            <div class="upload_area">
                                                                <div class="upload_wrap">
                                                                    <input type="file" name="file" id="document-upload" />

                                                                    <div class="upload_file hide" id="preview-section">
                                                                        <img class="upload-file-img" target="blank">
                                                                        
                                                                        <input type="hidden1" name="signature" class="image-input" />
                                                                    </div>
                                                                    <img class="img-fluid" src="images/dashboard/upload-icon.webp" alt="">
                                                                    <p>Drag and drop your signature or <a href="javascript:void(0);">Choose File</a></p>
                                                                </div>
                                                            </div> -->

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

@endsection

@push('js')
<script>
    $(document).on('click', '.tabings', function(e){
        e.preventDefault();
        let id = $(this).attr('href');
        $(id).addClass('active').siblings().removeClass('active');

    })
    $(document).on('change', '#document-upload', function () {
        let _this = $(this);
        //  let uploadedFile = document.getElementById($(this).attr('id')).files[0];
        //  var form_data = new FormData();
        //  form_data.append("file", uploadedFile);
         
        var form_data = new FormData($('.signature-form')[0]);

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
                $('#preview').html(
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
</script>
@endpush
