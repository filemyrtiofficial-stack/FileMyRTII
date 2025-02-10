@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer.css')}}">


@endpush
@section('content')

        


<section class="contact_section dbtab_section lawyer_db_section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab1">Case Details</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab2">PIO Address</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab3">Draft RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab4">Drafted RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab5">Approved RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab6">Upload RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab7">Notification</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab8">Enter Tracking No</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab9">First Appeal</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab10">Second Appeal</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="contact_wrapper db_tab_wrapper">
                    <div class="contact_faq">
                        <div class="contact_faq_tab_content">
                            <div id="tab1" class="contact_faq_tab active">
                                <div class="case_details">
                                    <div class="db_tab_heading">
                                        <h2>Case Details</h2>
                                    </div>
                                    <div class="lawyer_details_wrap">
                                        <div class="case_status">
                                            <ul class="case_list">
                                                <li>
                                                    <div class="list_item">Status<span>:</span></div>
                                                    <div class="list_value">Pending RTI</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="lawyer_details">
                                            <div class="lawyer_case_wrap">
                                                <div class="lawyer_case v_scroll">
                                                    <ul class="case_list">
                                                        <li>
                                                            <div class="list_item">Date<span>:</span></div>
                                                            <div class="list_value">{{Carbon\Carbon::parse($data->create_at)->format('d/m/Y')}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">Application Number<span>:</span></div>
                                                            <div class="list_value">{{$data->application_no}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">Name of the Applicant<span>:</span></div>
                                                            <div class="list_value">{{$data->fullName}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">Service Chosen<span>:</span></div>
                                                            <div class="list_value">{{ $data->service->name ?? ( $data->service_id == 0 ? "Custom Request" : '') }}</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">Pio Details<span>:</span></div>
                                                            <div class="list_value">Customer PIO Address</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">RTI Info<span>:</span></div>
                                                            <div class="list_value">Details Provided by Customer</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">Pio Details<span>:</span></div>
                                                            <div class="list_value">Customer PIO Address</div>
                                                        </li>
                                                        <li>
                                                            <div class="list_item">RTI Info<span>:</span></div>
                                                            <div class="list_value">Details Provided by Customer</div>
                                                        </li>
                                                    </ul>
                                                    <div class="more_info">
                                                        <div class="more_info_header">More Info Provided by Client</div>
                                                        <div class="more_info_body">
                                                            <p>Lorem ipsum dolor sit amet consectetur. Imperdiet iaculis pellentesque dictum dui. Tempus viverra lorem nunc convallis aliquam at. Amet cursus sed urna sem.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_action">
                                                    <div class="tab_action_top">
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="attachment-popup"><span>View Attachment</span></a>
                                                    </div>
                                                    <div class="tab_action_bottom">
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="lawyer-request"><span>More Information Required</span></a>
                                                        <a class="theme-btn tabings" href="#tab4"><span>Draft This Application</span></a>
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="admin-request"><span>Send Back To Admin</span></a>
                                                    </div>
                                                    <!-- for disabled modal remove class active -->
                                                    <div class="lawyer_req_info_modal active1">
                                                        <div class="lawyer_req_info_modal_wrap">
                                                            <div class="modal_header">
                                                                <h4 class="heading">Lawyer Requested Info</h4>
                                                                <button class="close">
                                                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                                                                        </svg>
                                                                </button>
                                                            </div>
                                                            <div class="modal_body">
                                                                <div class="db_tab_form">
                                                                    <div class="db_item_wrap single">
                                                                        <div class="form_item">
                                                                            <textarea class="form_field" name="" id=""></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal_action">
                                                                <a href="javascript:void(0);" class="theme-btn"><span>Send to Customer</span></a>
                                                            </div>
                                                        </div>
                                                        <div class="modal_bg"></div>
                                                    </div>

                                                    <!-- for disabled modal remove class active -->
                                                    <div class="upload_doc_modal active1">
                                                        <div class="upload_doc_modal_wrap">
                                                            <div class="modal_header">
                                                                <h4 class="heading">Attachments</h4>
                                                                <button class="close">
                                                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                                                                        </svg>
                                                                </button>
                                                            </div>
                                                            <div class="modal_body">
                                                                <div class="modal_area">
                                                                    <div class="modal_left">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal_right">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0);">
                                                                                    <span class="list_icon">
                                                                                        <img class="img-fluid" src="images/dashboard/attachment-file.webp" alt="">
                                                                                    </span>Document Name
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal_action">
                                                                <a href="javascript:void(0);" class="theme-btn">Preview</a>
                                                                <a href="javascript:void(0);" class="theme-btn"><span>Download</span></a>
                                                            </div>
                                                        </div>
                                                        <div class="modal_bg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="lawyer_req_info">
                                                <div class="req_info_wrap">
                                                    <div class="info_header">
                                                        <h4>Lawyer Requested Info</h4>
                                                    </div>
                                                    <div class="info_body info_scroll">
                                                        <div class="info_msg_wrap">
                                                            <div class="info_requested">Please furnish more details and any related attachment.</div>
                                                        </div>
                                                        <div class="info_msg_wrap">
                                                            <div class="info_requested">Requested above information from the customer on 17/01/2025</div>
                                                            <div class="info_reminder">Reminder sent to customer on 01/01/2025</div>
                                                        </div>
                                                        <div class="info_msg_wrap">
                                                            <div class="info_requested">Requested above information from the customer on 17/01/2025</div>
                                                            <div class="info_reminder">Reminder sent to customer on 01/01/2025</div>
                                                        </div>
                                                        <div class="info_msg_wrap">
                                                            <div class="info_requested">Requested above information from the customer on 17/01/2025</div>
                                                            <div class="info_reminder">Reminder sent to customer on 01/01/2025</div>
                                                        </div>
                                                    </div>
                                                    <div class="info_footer">
                                                        <a href="javascript:void(0);" class="theme-btn"><span>Send Reminder</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="contact_faq_tab">
                                <div class="pio_address">
                                    <div class="db_tab_heading">
                                        <h2>PIO Address</h2>
                                    </div>
                                    <div class="faq_item_wrap db_tab_form_wrap">
                                        <div class="db_item_wrap single">
                                            <div class="form_item">
                                                <label for="first_name">Customer Entered PIO Address</label>
                                                <input class="form_field" type="text" name="first_name" id="" placeholder="First Name" required="">
                                            </div>
                                        </div>
                                        <div class="db_item_wrap single">
                                            <div class="form_item">
                                                <label for="last_name">Search PIO Data Base</label>
                                                <input class="form_field" type="text" name="last_name" id="" placeholder="Last Name" required="">
                                            </div>
                                        </div>
                                        <div class="db_item_wrap single">
                                            <div class="form_item">
                                                <label for="first_name">Enter PIO Address Manually</label>
                                                <input class="form_field" type="email" name="" id="" placeholder="Enter Your Email" required="">
                                            </div>
                                        </div>
                                        <div class="form_action_wrap">
                                            <div class="form_action">
                                                <a href="javascript:void(0);" class="theme-btn"><span>Save PIO Address</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab4" class="contact_faq_tab">
                                
                            @if(($data->lastRevision && empty($data->lastRevision->customer_change_request)) || $data->status < 2)
                                    waiting or approval
                                    @else
                                    @include('frontend.profile.rti-file')
                                    @endif
                            </div>
                            <div id="tab5" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab6" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab7" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab7" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab9" class="contact_faq_tab">
                                
                            </div>
                            <div id="tab10" class="contact_faq_tab">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@include('lawyer.auth.lawyer-request')
@include('lawyer.auth.admin-request')

@include('lawyer.auth.document-popup')

@endsection

@push('js')
<script>
    $(document).on('change', '#document-upload', function () {
        let _this = $(this);
        var form_data = new FormData($(this).closest('form')[0]);

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
                $('.upload-file-img').attr('src', response.data);
              $('.image-input').val(response.data);


            },
            error : function(error) {}
         });
      });
</script>
<script>
    renderHtml()
    function renderHtml() {
        let data = $('.draft-form').serializeArray();

        let html = `<?php echo view('frontend.profile.rti-file1', ['template' => $data->service->templates[0] ?? []])->render();?>`;
        $.each(data, function(index, value){
            html = html.replaceAll("["+value['name']+"]", value['value']);
        });
        $('.draft-rti-html1').html(html)

    }
   
    $(document).on('keyup', '.change-value', function(){
        renderHtml()
    })
</script>
@endpush
