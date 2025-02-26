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
                                <li class="fs-24"><a href="{{route('lawyer.my-rti')}}">My RTI</a></li>

                                <li class="fs-24 active">{{$data->application_no ?? ''}}</li>
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
                        <li class="contact_faq_item @if($tab == 'application-status')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab1" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'case-details'])}}">Case Details</a>
                        </li>
                        @if($data->status != 3)

                        <li class="contact_faq_item @if($tab == 'pio-address')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab2" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'pio-address'])}}">PIO Address</a>
                        </li>
                        @endif
                        <li class="contact_faq_item @if($tab == 'draft-rti')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab3" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'draft-rti'])}}">Draft RTI</a>
                        </li>
                        @if($data->status < 2 )
                        <li class="contact_faq_item @if($tab == 'drafted-rti')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab4" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}">Drafted RTI</a>
                        </li>
                        @endif
                        <li class="contact_faq_item @if($tab == 'approved-rti')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab5" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'approved-rti'])}}">Approved RTI</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'upload-rti')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab6" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'upload-rti'])}}">Upload RTI</a>
                        </li>
                        <li class="contact_faq_item @if($tab == 'notification')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab7" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'notification'])}}">Notification</a>
                        </li>
                        @if($data->status >=2 )

                        <li class="contact_faq_item @if($tab == 'tracking-no')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab8" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'tracking-no'])}}">Enter Tracking No</a>
                        </li>
                        @endif
                        @if($data->firstAppeal && $data->firstAppeal->payment_status == 'paid')
                        <li class="contact_faq_item @if($tab == 'first-appeal')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab9" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'first-appeal'])}}">First Appeal</a>
                        </li>
                        @endif
                        @if($data->secondAppeal && $data->secondAppeal->payment_status == 'paid')

                        <li class="contact_faq_item @if($tab == 'second-appeal')active @endif">
                            <span class="shape"></span>
                            <a class="faq_list_item" href1="#tab10" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'second-appeal'])}}">Second Appeal</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="contact_wrapper db_tab_wrapper">
                    <div class="contact_faq">
                        <div class="contact_faq_tab_content lawyer_accordion">
                        <a class="accord_item" href1="#tab1" data-id="tab1" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'case-details'])}}">Case Details</a>

                            <div id="tab1" class="contact_faq_tab @if($tab == 'case-details')active @endif">
                                <div class="case_details">
                                    <div class="db_tab_heading">
                                        <h2>Case Details</h2>
                                    </div>
                                    <div class="lawyer_details_wrap">
                                        <div class="case_status">
                                            <ul class="case_list">
                                                <li>
                                                    <div class="list_item">Status<span>:</span></div>
                                                    <div class="list_value">{{lawyerApplicationStatus()[$data->status]['name'] ?? ''}} RTI</div>
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
                                                            <div class="list_value">{{$data['customer_pio_address'] ?? $data['pio_address']}}</div>
                                                        </li>
                                                        <!-- <li>
                                                            <div class="list_item">RTI Info<span>:</span></div>
                                                            <div class="list_value">Details Provided by Customer</div>
                                                        </li>
                                                        -->
                                                    </ul>
                                                    <div class="case_status hide more_info_status">
                                                        <ul class="case_list">
                                                            <li>
                                                                <div class="list_item">Status<span>:</span></div>
                                                                <div class="list_value"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="more_info hide">
                                                        <div class="more_info_header">More Info Provided by Client</div>
                                                        <div class="more_info_body">
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab_action">
                                                    <div class="tab_action_top">
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="attachment-popup"><span>View Attachment</span></a>
                                                    </div>
                                                    <div class="tab_action_bottom">
                                                    @if($data->status < 3 )
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="lawyer-request"><span>More Information Required</span></a>
                                                        @endif
                                                        @if($data->status < 2 )
                                                        <a class="theme-btn " href1="#tab4" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}"><span>Draft This Application</span></a>
                                                        @endif
                                                        @if($data->status < 3 )
                                                        <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="admin-request"><span>Send Back To Admin</span></a>
                                                        @endif
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
                                                  
                                                </div>
                                            </div>
                                            <div class="lawyer_req_info">
                                                <div class="req_info_wrap">
                                                    <div class="info_header">
                                                        <h4>Lawyer Requested Info</h4>
                                                    </div>
                                                    <div class="info_body v_scroll">
                                                        @foreach($data->rtiQueries as $item => $value)
                                                        <div class="info_msg_wrap">
                                                            <div class="info_requested" > <a href="{{route('lawyer.get-query',[$value->id])}}" data-reply="{{$value->reply}}" data-documents="{{json_encode($value->documents)}}">{{$value->message}}</a></div>
                                                            <!-- <div class="info_reminder">Reminder sent to customer on 01/01/2025</div> -->

                                                        </div>
                                                        @endforeach
                                                        <!-- <div class="info_msg_wrap">
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
                                                        </div> -->
                                                    </div>
                                                    @if($data->status < 3 )

                                                    <div class="info_footer">
                                                        <a href="javascript:void(0);" class="theme-btn"><span>Send Reminder</span></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('lawyer.auth.tab2')
                          
                            @include('lawyer.auth.tab3')

                                @include('lawyer.auth.tab4')
                          


                         
                            @include('lawyer.auth.tab5')
                                
                            
                            @include('lawyer.auth.tab6')

                            <a class="accord_item" href1="#tab7" data-id="tab7" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'notification'])}}">Notification</a>

                            <div id="tab7" class="contact_faq_tab @if($tab == 'notification')active @endif">
                                <div class="notification">
                                    <div class="lawyer_req_info">
                                        <div class="req_info_wrap">
                                            <div class="info_header">
                                                <h4>Lawyer Requested Info</h4>
                                            </div>
                                            <div class="info_body info_scroll">
                                                @foreach($data->lawyerNotifications as $item => $value)
                                                <div class="info_msg_wrap">
                                                    <div class="info_requested" > {{$value->message}}  <span >({{Carbon\Carbon::parse($value->created_at)->format('d M, Y h:i A')}})</span></div>
                                                    <!-- <div class="info_reminder">Reminder sent to customer on 01/01/2025</div> -->

                                                </div>
                                                @endforeach
                                            
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($data->status >=2 )
                                @include('lawyer.auth.tab8')
                            @endif
                            @if($data->firstAppeal &&  $data->firstAppeal->payment_status == 'paid' && $data->firstAppeal->appealDeatils)
                            <a class="accord_item" href1="#tab9" data-id="tab9" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'first-appeal'])}}">First Appeal</a>

                            <div id="tab9" class="contact_faq_tab @if($tab == 'first-appeal')active @endif">
                                <div class="rti_appeal">
                                    <div class="db_tab_heading">
                                        <h2>First Appeal</h2>
                                    </div>
                                           
                                            
                                        <div class="db_tab_form">
                                            <div class="db_item_wrap single">
                                                <div class="form_item">
                                                    <textarea class="form_field" type="text" name="reason" id="" placeholder="First Appeal Reason" disabled>{{$data->firstAppeal->appealDeatils->reason ?? ''}}</textarea>
                                                </div>
                                            </div>
                                            @if(!empty($data->firstAppeal->appealDeatils->document ))
                                            <a href="{{filePreview($data->firstAppeal->appealDeatils->document ?? '')}}" target="blank" class="theme-btn"><span>Documents</span></a>
                                            @endif
                                            @if($data->firstAppeal->lawyer_id == auth()->guard('lawyers')->id())
                                            <a href="{{route('lawyer.my-rti', $data->firstAppeal->application_no.'-'.$data->firstAppeal->id)}}" class="theme-btn"><span>View</span></a>
                                            @endif
                                        </div>

                                 
                                </div>
                            </div>
                            @endif
                            @if($data->secondAppeal &&  $data->secondAppeal->payment_status == 'paid' && $data->secondAppeal->appealDeatils)
                            <a class="accord_item" href1="#tab10" data-id="tab10" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'second-appeal'])}}">Second Appeal</a>

                            <div id="tab10" class="contact_faq_tab @if($tab == 'second-appeal')active @endif">
                                <div class="rti_appeal">
                                    <div class="db_tab_heading">
                                        <h2>Second Appeal</h2>
                                    </div>
                                           
                                            
                                        <div class="db_tab_form">
                                            <div class="db_item_wrap single">
                                                <div class="form_item">
                                                    <textarea class="form_field" type="text" name="reason" id="" placeholder="Second Appeal Reason" disabled>{{$data->secondAppeal->appealDeatils->reason ?? ''}}</textarea>
                                                </div>
                                            </div>
                                            @if(!empty($data->secondAppeal->appealDeatils->document ))
                                            <a href="{{filePreview($data->secondAppeal->appealDeatils->document ?? '')}}" target="blank" class="theme-btn">Documents</a>
                                            @endif
                                            @if($data->secondAppeal->lawyer_id == auth()->guard('lawyers')->id())
                                            <a href="{{route('lawyer.my-rti', $data->secondAppeal->application_no.'-'.$data->secondAppeal->id)}}" class="theme-btn"><span>View</span></a>
                                            @endif
                                        </div>

                                 
                                </div>
                            </div>
                            @endif
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

    $(document).on('click', '.info_requested a', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        $.ajax({
            url : href,
            dataType : 'json',
            type : "get",
            success : function(response) {
                let reply = response.data.reply;
                $('.more_info_body p').html(reply);
                if(response.data.marked_read == 1) {

                    $('.more_info').removeClass('hide');
                }
                else {
                    $('.more_info').addClass('hide');

                }
                $('.more_info_status').removeClass('hide').find('.list_value').html((response.data.marked_read == 0 ? "Not Replied" : "Customer Replied"))

            }
        });
      
    })

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
                console.log(value)

       
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

    $(document).on('change', '.upload-final-pdf', function(e) {
        const file = e.target.files[0];
        // if (file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            console.log(fileURL)
            $('#pdfPreview').attr('src', fileURL)
        // } else {
        //     alert("Please upload a valid PDF file.");
        // }
    })
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
    });
    $(document).on('keyup', '.search-pio-address', function(e){
        let _this = $(this);
        $('.pio-list').html(null).addClass('hide');
            

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            url: "{{route('search-pio-adress')}}",
            method: "POST",
            data: {address : _this.val()},
            dataType : 'json',
            success : function(response){
              console.log(response)
              $.each(response.data, function(index, value){
                $('.pio-list').removeClass('hide');
                  $('.pio-list').append(`<li><a class="pio-address" data-id="${value.id}">${value.address}</a></li>`);
              });

            },
            error : function(error) {}
         });
    });
    $(document).on('click', '.pio-address', function(e){
        e.preventDefault();
        $('.search-pio-address').val($(this).text());
        $('#pio_address').val($(this).text());
        $('.pio-list').html(null).addClass('hide');

    });
    $(document).on('change', '#manual-pio', function(e){
        $('#pio_address').val(null);
        $('.search-pio-address').val(null);
        if($(this).is(":checked")) {
            $('.search-pio-details').addClass('hide');
            $('.manual-pio-details').removeClass('hide');
           
        }
        else {
            $('.search-pio-details').removeClass('hide');
            $('.manual-pio-details').addClass('hide');

        }
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
        .attr('target', '_blank').show() // Open in new tab

        }
        else {
            previewLink.hide()

        }
        });
</script>
@endpush
