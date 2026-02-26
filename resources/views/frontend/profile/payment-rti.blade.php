
@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">


<style>
   @media (min-width: 767px) 
    {
        ul.charge_list.charge_list-first-appeal li, ul.charge_list.charge_list-second-appeal li{
            width: 33%;
        }
        ul.charge_list.option_list.option_list-first-appeal li:first-child, ul.charge_list.option_list.option_list-second-appeal li:first-child {
            width:  67% !important;
        }
    }
</style>
@endpush
@section('content')
<style>
    .hide {
        display:none;
    }
</style>
<?php
    $setting = App\Models\Setting::getSettingData('header-footer-setting');

?>
<header class="breadcrumb_banner bg_none">
            <img class="img-fluid bg_img" src="images/about-us/about-banner.webp" alt="about us banner">
                <div class="container">
                    <div class="row banner_row">
                        <div class="col-12 col-sm-12">
                            <div class="breadcrumb">
                               <ol>
                                <li class="fs-24"><a href="/">Home</a></li>
                                <li class="fs-24"><a href="{{ url('/service/'.$application->serviceCategory->slug->slug ?? '') }}">{{$application->serviceCategory->name ?? ''}}</a></li>
                                <li class="fs-24 active">{{$application->service->name ?? 'Custom Request'}}</li>
                               </ol>
                            </div>
                            <div class="breadcrumb_heading">
                                <h1 class="title fs-72">Service Detail</h1>
                            </div>
                        </div>
                    </div>
                </div>
        </header>

        <section class="serviceform_section">
            <div class="container">
                <div class="row service-form-row">
                    <div class="col-12 col-sm-9">
                        <div class="service_form">
                        <form action="{{route('customer.pay.form')}}" class="service-form" method="post">
                                @csrf
                           
                                    <input type="hidden" id="application_no" name="application_no" value="{{$application->application_no}}">
                                    <input type="hidden" id="appeal_no" name="appeal_no" value="{{$application->appeal_no}}">

                                <div>

                                    
                                    <div class="form_row form_step_3 ">
                                        
                                        <div class="form_table">
                                            <div class="form_info">
                                                <div class="form_number"> @if($application->appeal_no == 1)
                                           First Appeal Payment To 
                                            @elseif($application->appeal_no == 2)
                                           Second Appeal Payment To 
    
                                            @endif RTI Application No: <span id="application_number">{{$application->application_no}}</span></div>
                                                <div class="upload_file" id="upload_file-section">
                                                    <button class="upload-file-btn">Upload File <span>+</span></button>
                                                    <input type="file" name="file[]" id="document-upload"  accept="image/*,.pdf" multiple/>
                                                    
                                                </div>
                                                <div class="upload_file hide" id="preview-section">
                                                    <a class="upload-file-btn" target="blank">Preview </a>
                                                    <span class="remove-file">X</span>
                                                    
                                                </div>

                                               
                                                <input type="hidden" name="document" class="image-input" />
                                            </div>
                                            <div class="preview" id="preview">

                                            </div>
                                            <!-- <a href="" class="hide" id="preview-dodument" target="blank">Preview</a> -->
                                            <div class="form_table_detail">
                                            @if(isset($payment) && isset($payment['amount_type']))
                                                @foreach($payment['amount_type'] as $key =>  $value)
                                                    <ul class="charge_list @if($application->appeal_no == 1) charge_list-first-appeal @elseif($application->appeal_no == 2) charge_list-second-appeal @endif">
                                                        <li>{{$payment['amount_type'][$key] ?? ''}}</li>
                                                        <li class="price-listing">₹ {{$payment['amount'][$key] ?? ''}}</li>
                                                        @if($application->appeal_no == 0)
                                                        <li>
                                                            <span class="check_icon_wrapper">
                                                                @if($payment['basic'][$key] == 'yes')
                                                                    <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">
                                                                @else
                                                                    <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">
                                                                @endif
                                                            </span>
                                                        </li>
                                                        @endif
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
                                                 <ul class="charge_list option_list @if($application->appeal_no == 1) option_list-first-appeal @elseif($application->appeal_no == 2) option_list-second-appeal @endif">
                                                <li>Price</li>
                                                 @if($application->appeal_no == 0)
                                                <li><div class="charge_option custom_radio"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>
                                                @endif
                                                <li><div class="charge_option custom_radio"><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>
                                            </ul>

                                            <ul class="charge_list option_list @if($application->appeal_no == 1) option_list-first-appeal @elseif($application->appeal_no == 2) option_list-second-appeal @endif">
                                                <li>+GST (18%)</li>
                                                 @if($application->appeal_no == 0)
                                                <li><div class="charge_option custom_radio"><label for="price-2">₹ {{getGST($payment['basic_total'])}}</label></div></li>
                                                @endif
                                                <li><div class="charge_option custom_radio"><label for="price-3">₹ {{getGST($payment['advance_total'])}}</label></div></li>
                                            </ul>
                                            

                                                <ul class="charge_list option_list @if($application->appeal_no == 1) option_list-first-appeal @elseif($application->appeal_no == 2) option_list-second-appeal @endif">
                                                    <li>Choose An Option</li>
                                                    @if($application->appeal_no == 0)
                                                    <li><div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']+getGST($payment['basic_total'])}}</label></div></li>
                                                    @endif
                                                    <li><div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']+getGST($payment['advance_total'])}}</label></div></li>
                                                </ul>
                                                <!--<ul class="charge_list option_list @if($application->appeal_no == 1) option_list-first-appeal @elseif($application->appeal_no == 2) option_list-second-appeal @endif">-->
                                                <!--    <li>Choose An Option</li>-->
                                                <!--    @if($application->appeal_no == 0)-->
                                                <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>-->
                                                <!--    @endif-->
                                                <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>-->
                                                <!--</ul>-->
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
                                                    <button type="submit" class="theme-btn"><span>Pay Now</span></button>
                                                </div>
                                            </div>
                                            <div id="error"></div>
                                        </div>

                                </div>
                                    
                                </div>
                             
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="service_sidebar">
                            <div class="title">
                                <h3>Why Choose File My RTI?</h3>
                            </div>
                            <ul class="sidebar_list">
                                @foreach($why_choose as $item)
                                <?php
                                    
                                    $item_data = json_decode($item->data, true);
                                    ?>
                                <li>
                                    <span class="list_icon">
                                        <img class="img-fluid" src="{{asset($item_data['image'] ?? '')}}" alt="profile icon">
                                    </span>
                                    <span class="list_content"><strong>{{$item_data['title'] ?? ''}}</strong> - {{$item_data['description'] ?? ''}}</span>
                                </li>
                                @endforeach
                                
                            </ul>
                            <ul class="support_list">
                                <li>
                                    <span class="list_icon">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/call-support.png')}}" alt="call support icon">
                                    </span>
                                    <span class="list_content">Support Team:</span>
                                </li>
                                <li>
                                    <span class="list_icon">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/phone-icon.webp')}}" alt="phone icon">
                                    </span>
                                    <span class="list_content">Phone No: {{$setting['contact_no'] ?? ''}}</span>
                                </li>
                                <li>
                                    <span class="list_icon">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/mail-icon.webp')}}" alt="mail icon">
                                    </span>
                                    <span class="list_content">Email: {{$setting['email'] ?? ''}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


     


       

@if(!empty($footer_banner))
<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset($footer_banner['image'] ?? '')}}" alt="{{asset($footer_banner['image_alt'] ?? '')}}">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">{{$footer_banner['description'] ?? ''}}</h4>
                </div>
                <a href="{{$footer_banner['link_url'] ?? ''}}" class="theme-btn"><span>{{$footer_banner['link_title'] ?? ''}}</span></a>
            </div>
        </div>
    </div>
</section>
@endif

<form method="post" id="razorsubmission" action="{{route('update.payment.success')}}">
@csrf
<input type="hidden" class="" id="razor_order_number" name="application_no" value="{{$application->application_no}}">
<!-- <input type="hidden" class="" id="appliction_id" name="appliction_id" value="{{$application->id}}"> -->
<input type="hidden" class="" id="appeal_no" name="appeal_no" value="{{$application->appeal_no}}">
</form>
@endsection
@push('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).on('click', '.delete-icon', function(){
        $(this).parents().eq(0).remove();
      });

    $(document).on('change', '#document-upload', function () {
        let _this = $(this);

        let files = this.files;
         let validation =   imagevaladition(files);
         if(validation == false){
              return;
         }

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
                    <embed src="{{url('/')}}${value.file}" width="100" height="100" />
                    <input type="hidden" value="${value.file}" name="documents[]">
                    <div class="preview-btn">
                    <a href="${value.path}" target="blank"> Preview
                                                        </a>
                                                        </div>
                                                        <button type="button" class="delete-icon"></button>
                                                    </div>`);
                })
    
            },
            error : function(error) {
                console.log(value)
                    index = index.replaceAll('.', '_')
                    $('#' + index).html(
                        `<span class="text-danger form-error-list">${value}</span>`)
            }
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
                    $('#' + index).html(
                        `<span class="text-danger form-error-list">${value}</span>`)
                })
            }
        });

    });

    function finalrayzorpayment(rti){
        
            $('#razor_order_number').val(rti.application_no);
            // $('#appliction_id').val(rti.id);
            $('#appeal_no').val(rti.appeal_no);
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // rzp_live_ILgsfZCZoFIKMb
                "amount": (rti.final_price*100), // 2000 paise = INR 20
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