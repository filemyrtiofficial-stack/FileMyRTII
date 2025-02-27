@extends('frontend.layout.layout')

@section('content')




<section class="contact_section dashboard_section">
    <div class="container">
        <div class="section_heading">
            <h2>Empower yourself with RTI solutions.</h2>
        </div>
        <div class="section_sub_heading">
            <h4>All your RTI Applications are here</h4>
        </div>

        <div class="my_profile">
            <div class="my_info">
                <div class="profile">
                    <div class="profile_img">
                        <img class="img-fluid" src="{{asset('assets/rti/images/service-listing/profile-1.webp')}}" alt="">
                    </div>
                    <div class="profile_name">
                        <div class="p_name">{{auth()->guard('customers')->user()->fullName}}</div>
                        <div class="p_email">{{auth()->guard('customers')->user()->email}}</div>
                    </div>
                </div>
                <div class="profile_action">
                    <a class="profile_btn login-modal" href="javascript:void(0);">Change Password</a>
                    <!-- <a class="profile_btn" href="#">Logout</a> -->
                    <a href="{{ route('customer.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="profile_btn">
                        Logout
                    </a>

                </div>
            </div>
            <div class="my_application">
                @foreach($list as $key => $item)
                <div class="application_card_wrap">
                    <div class="application_card">
                        <div class="card_header"> RTI Application No: <span class="app_no">{{$item->application_no}}</span></div>
                        <div class="card_body">
                            <div class="application_detail">
                                <div class="row">
                                    <div class="col-12 col-sm-9">
                                        <div class="app_status">
                                            <ul class="app_date">
                                                <li class="heading">Application Date <span>:</span></li>
                                                <li>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</li>
                                            </ul>
                                            <ul class="app_date">
                                                <li class="heading">Status <span>:</span></li>
                                                <li>{{$item->payment_status == 'pending' ?  "Payment Pending" : "paid"}}</li> @if($item->payment_status == 'pending')<a class="theme-btn-link rti-popup" data-id="{{$item->application_no}}" href="javascript:void(0);">Delete</a>@endif
                                            </ul>
                                            <!-- to show and hide modal remove class active -->
                                            <div class="delete_modal" id="{{$item->application_no}}">
                                                <div class="delete_modal_wrap">
                                                    <div class="modal_body">
                                                        <div class="confirm_icon">
                                                            <img class="img-fluid" src="images/dashboard/problem.webp" alt="">
                                                        </div>
                                                        <h5 class="heading">Are You Sure!</h5>
                                                        <p>You won't be able to revert this RTI Application! Instead EDIT and SUBMIT</p>

                                                    </div>
                                                    <div class="modal_action">
                                                        @if($item->payment_status == 'paid')

                                                        <a href="{{ route('my-rti',$item->application_no) }}" class="theme-btn">Edit RTI</a>
                                                        @endif
                                                        <a href="javascript:void(0);" class="theme-btn" onclick="event.preventDefault(); document.getElementById('delete-rti-form').submit();">Yes, Delete</a>
                                                        <form role="form" method="post" action="{{ route('customer.rti.delete') }}" id="delete-rti-form">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                        </form>
                                                        <a href="javascript:void(0);" class="theme-btn close-rti-popup">No, Cancel</a>
                                                    </div>
                                                </div>
                                                <div class="modal_bg"></div>
                                            </div>
                                            <ul class="status_bar">
                                                <li @if($item->status >= 1)class="active" @endif>
                                                    <div class="bar_item">
                                                        <div class="number">
                                                            <div class="bar_icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                                    <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="bar_number">1</div>
                                                        </div>
                                                        <span>Started</span>
                                                    </div>
                                                </li>
                                                <li @if($item->status >= 2)class="active" @endif>
                                                    <div class="bar_item">
                                                        <div class="number">
                                                            <div class="bar_icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                                    <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="bar_number">2</div>
                                                        </div>
                                                        <span>Approval</span>
                                                    </div>
                                                </li>
                                                <li @if($item->status >= 3)class="active" @endif>
                                                    <div class="bar_item">
                                                        <div class="number">
                                                            <div class="bar_icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19" fill="none">
                                                                    <path d="M1.8 9.8001L9.2672 17.0001L24.2 2.6001" stroke="white" stroke-width="3.6" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="bar_number">3</div>
                                                        </div>
                                                        <span>Filed</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="app_action">
                                            @if($item->payment_status == 'pending')
                                            <!-- <a class="theme-btn pay-now-form" href="javascript:void(0);" data-id="{{$item->application_no}}"  >Pay Now</a> -->
                                            <a class="theme-btn" href="{{route('customer.payment-rti', encryptString($item->id))}}"  >Pay Now </a>
                                            @endif
                                            @if($item->payment_status == 'paid')

                                            <a class="theme-btn" href="{{route('my-rti', $item->application_no)}}">Details</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="application_card">
                            <div class="card_header">RTI Application No: <span class="app_no">{{$item->application_no}}</span></div>
                            <div class="card_body">
                                <div class="application_detail">
                                    <div class="row">
                                        <div class="col-12 col-sm-9">
                                            <div class="app_status">
                                                <ul class="app_date">
                                                    <li class="heading">Application Date <span>:</span></li>
                                                    <li>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</li>
                                                </ul>
                                                <ul class="app_date">
                                                    <li class="heading">Status <span>:</span></li>
                                                    <li> {{$item->payment_status == 'pending' ?  "Payment Pending" : "paid"}}</li> @if($item->payment_status == 'pending')<a class="theme-btn-link" href="javascript:void(0);">Delete</a>@endif
                                                </ul>
                                                <ul class="status_bar">
                                                    <li @if($item->status >= 1) class="active" @endif><a href="javascript:void(0);">1</a><span>Started</span></li>
                                                    <li @if($item->status >= 2) class="active" @endif><a href="javascript:void(0);">2</a><span>Approval</span></li>
                                                    <li @if($item->status == 3) class="active" @endif><a href="javascript:void(0);">3</a><span>Filed</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="app_action">
                                                @if($item->payment_status == 'pending')
                                                <a class="theme-btn" href="javascript:void(0);">Pay Now</a>
                                                @endif
                                                <a class="theme-btn" href="{{route('my-rti', $item->application_no)}}">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                @endforeach
            </div>
        </div>
    </div>

</section>
<div class="delete_modal pay-popup">
    <div class="delete_modal_wrap">
    <div class="modal_header">
                                                                        
        <button class="close">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                </svg>
        </button>
    </div>
        <div class="modal_body" style="margin-top: 50px;">
            <!-- <div class="confirm_icon">
                <img class="img-fluid" src="images/dashboard/problem.webp" alt="">
            </div> -->
            <!-- <h5 class="heading"> Are You Sure!</h5>
            <p>You won't be able to revert this RTI Application! Instead EDIT and SUBMIT</p> -->
            <form action="{{route('customer.pay.form')}}" class="service-form" method="post">
            <div class="form_table">
                <div class="form_info">
                   
                        @csrf
                        <input type="hidden" id="step_no" name="step_no" value="3">

                        <input type="hidden" id="application_no" name="application_no" value="">
                        <div class="form_number">RTI Application No: <span id="application_number"></span></div>
                        <div class="upload_file" id="upload_file-section">
                            <button class="upload-file-btn">Upload File <span>+</span></button>
                            <input type="file" name="file[]" id="document-upload" multiple />

                        </div>
                        <div class="upload_file hide" id="preview-section">
                            <a class="upload-file-btn" target="blank">Preview </a>
                            <span class="remove-file">X</span>

                        </div>

<!-- 
                        <input type="hidden" name="document" class="image-input" /> -->
                        </div>
                        <div class="preview" id="preview">

                        </div>
                <div class="form_table_detail">
                    @if(isset($payment) && isset($payment['amount_type']))
                    @foreach($payment['amount_type'] as $key => $value)
                    <ul class="charge_list">
                        <li>{{$payment['amount_type'][$key] ?? ''}}</li>
                        <li>₹ {{$payment['amount'][$key] ?? ''}}</li>
                        <li>
                            <span class="check_icon_wrapper">
                                @if($payment['basic'][$key] == 'yes')
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">
                                @else
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">
                                @endif
                            </span>
                        </li>
                        <li>
                            <span class="check_icon_wrapper">
                                @if($payment['advance'][$key] == 'yes')
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">
                                @else
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">
                                @endif
                            </span>
                        </li>
                    </ul>
                    @endforeach
                    @endif

                    <ul class="charge_list option_list">
                        <li>Choose An Option</li>
                        <li>
                            <div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']}}</label></div>
                        </li>
                        <li>
                            <div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']}}</label></div>
                        </li>
                    </ul>
                </div>
                <div class="form_action_wrap">
                    <div class="form_action">
                        <div class="payment_icon">
                            <div class="razorpay">
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/razorpay.webp')}}" alt="razorpay icon">
                            </div>
                            <div class="visa">
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/visa.webp')}}" alt="visa icon">
                            </div>
                            <div class="paytm">
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/paytm.webp')}}" alt="paytm icon">
                            </div>
                            <div class="mastercard">
                                <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/master-card.webp')}}" alt="mastercard icon">
                            </div>
                        </div>
                        <!-- <button type="submit" class="theme-btn"><span>Pay Now</span></button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal_action">
            <button type="submit" class="theme-btn">Pay Now</button>
        

        </div>
        </form>
    </div>
</div>
</div>
<!-- <div class="modal_bg"></div> -->
</div>
<form method="post" id="razorsubmission" action="{{route('update.payment.success')}}">
@csrf
<input type="hidden" class="" id="razor_order_number" name="application_no" value="">
</form>
@endsection
@push('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).on('click', '.rti-popup', function(e) {
        var rti_id = $(this).data('id');
        $('#' + rti_id).addClass("active");

    });

    $(".close-rti-popup").click(function() {

        $(this).closest(".delete_modal").removeClass("active");
    });
    $(document).on('click', '.pay-now-form', function(e) {
        var rti_id = $(this).data('id');
        $('.pay-popup').addClass("active");
        $('#application_no').val(rti_id);
        $('#application_number').html(rti_id);

    });
    $(document).on('click', '.close', function(e) {
    
        $('.pay-popup').removeClass("active");
  

    });
    $(document).on('click', '.delete-icon', function(){
        $(this).parents().eq(0).remove();
      });

    $(document).on('change', '#document-upload', function () {
        let _this = $(this);
        var data = new FormData($('.service-form')[0]);
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

                    $('#preview').append(`<div class="preview-item">
                                                       <a href="${value.path}" target="blank">
                                                            <embed src="{{url('/')}}${value.file}" width="50" height="50" />
                                                            <input type="hidden" value="${value.file}" name="documents[]">
                                                        </a>
                                                        <button type="button" class="delete-icon"></button>
                                                    </div>`);
                })
    
            },
            error : function(error) {}
         });
      });
      $(document).on('click', '.remove-document', function(e){
        e.preventDefault();
        $(this).parents().eq(1).remove();
      })
    $(document).on('submit', '.service-form', function(e){
        e.preventDefault();
        let action = $(this).attr('action');
        let type = $(this).attr('method');
        var data = new FormData($(this)[0]);
        $('.form-error-list').remove();
        $.ajax({
            url : action,
            type :  type,
            dataType : 'json',
            cache: false,
            contentType: false,
            processData: false,
            data :  data,
            success :  function(response) {
                console.log(response, "response=============")
                if(response.step) {
                    $('.form_step_'+response.step).removeClass('hide').siblings().addClass('hide');
                    for(let index = 1; index <= response.step; index++) {

                        $('#form_step_tab_'+index).find('a').addClass('active');
                        if(index < response.step) {

                            $('#form_step_tab_'+index).find('.step_check').show();
                        }

                    }
                    // $('#form_step_tab_'+response.step).siblings().find('a').removeClass('active')
                    $('#step_no').val(response.step);
                    if(response.step == 3) {
                        $('#application_no').val(response.rti.application_no);
                        $('#application_number').html(response.rti.application_no);
                    }
                    else if(response.step == 4) {
                        finalrayzorpayment(response.rti)

                    }
                }
            },
            error :  function(error) {
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    index = index.replaceAll('.', '_')
                    $('#' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });

    });

    function finalrayzorpayment(rti){
            $('#razor_order_number').val(rti.application_no);
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // rzp_live_ILgsfZCZoFIKMb
                "amount": (rti.charges*100), // 2000 paise = INR 20
                "name": "FileMyRti",
                "description": "Razor Payment",
                "prefill": {
                    "name": rti.first_name+" "+rti.last_name,
                    "email": rti.email
                },
                "currency": "INR",
                "image": "https://cdn.razorpay.com/logos/NSL3kbRT73axfn_medium.png",
                "notes":{'order_id':rti.application_no},
                "handler": function(reason_result){
                    console.log(reason_result, 'reason_result')
                    $('#razorsubmission').append('<input type="hidden" class="" name="razorpay_payment_id" value="'+reason_result.razorpay_payment_id+'"> <input type="hidden" class="" name="order_id" value="'+rti.application_no+'"> ');
                    $('#razorsubmission').submit();
                    $('.popup').css('display','block');
                
                },
                "modal": {
                    "ondismiss": function(){
                            $('.popup').css('display','none');
                            $('#proceed-to-payment').css("pointer-events", "visible");
                            $('#proceed-to-payment').css("opacity", "1");
                    }
                },

                "theme": {
                    "color": "#F9BF37"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                var razorpay_paymentfail_id = response.error.metadata.payment_id;
                var razorpay_paymentfail_order_id = response.error.metadata.order_id
                $.ajax({
                    url:  "{{route('update.payment.failed')}}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: razorpay_paymentfail_id ,order_id : razorpay_paymentfail_id,paymet_fail:response, application_no : rti.application_no
                    }, 
                    success: function (msg) {
                        // saveshipping(); 
                    // window.location.href = "{{url('checkout/order-success')}}";
                    }
                });
            });
            rzp1.open();
            // e.preventDefault();
        } 

</script>
@endpush