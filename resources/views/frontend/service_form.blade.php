@extends('frontend.layout.layout')

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
                                <li class="fs-24"><a href="javascript:void(0);">Home</a></li>
                                <li class="fs-24"><a href="javascript:void(0);">{{$service_category->name ?? ''}}</a></li>
                                <li class="fs-24 active">{{$service->name ?? ''}}</li>
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
                            <form action="{{route('frontend.service-form')}}" class="service-form" method="post">
                                @csrf
                                <input type="hidden" id="step_no" name="step_no" value="1">
                                <input type="hidden" id="service_key" name="service_key" value="{{$service->id}}">
                                <input type="hidden" id="application_no" name="application_no" value="">
                                <input type="hidden" id="category_id" name="category_id" value="{{$service_category->id}}">


                                <div class="form_tab_wrapper">
                                    <div class="form_tabs">
                                        <ul class="form_tab_list">
                                            <li id="form_step_tab_1"><a class="form_tab_item1 active fs-28" href="javascript:void(0);" data-toggle1="tab" data-id="form_tab1"><span class="step">step 1</span><span class="title">Personal Details</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
                                            <li id="form_step_tab_2"><a class="form_tab_item1 fs-28" href="javascript:void(0);" data-toggle1="tab" data-id="form_tab2"><span class="step">step 2</span><span class="title">{{$service->name ?? ''}}</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
                                            <li id="form_step_tab_3"><a class="form_tab_item1 fs-28" href="javascript:void(0);" data-toggle1="tab" data-id="form_tab3"><span class="step">step 3</span><span class="title">Payment Details</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div>

                                    <div class="form_row form_step_1">
                                        <div class="form_data">
                                            
                                            <div class="form_item">
                                                <label for="first_name">First Name</label>
                                                <input class="form_field" type="text" name="first_name" id="first_name" placeholder="" >
                                            </div>
                                        
                                        
                                            <div class="form_item">
                                                <label for="last_name">Last Name</label>
                                                <input class="form_field" type="text" name="last_name" id="last_name" placeholder="" >
                                            </div>
                                        
                                        
                                            <div class="form_item">
                                                <label for="email">Email Address</label>
                                                <input class="form_field" type="email" name="email" id="email" placeholder="" >
                                            </div>
                                        
                                        
                                            <div class="form_item">
                                                <label for="phone_number">Phone Number</label>
                                                <input class="form_field" type="tel" pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" name="phone_number" id="phone_number" placeholder="" >
                                            </div>
                                        
                                        
                                            <div class="form_item">
                                                <label for="address">Full Address</label>
                                                <input class="form_field" type="text" name="address" id="address" placeholder="" >
                                            </div>
                                        
                                        
                                            <div class="form_item">
                                                <label for="postal_code">Postal Code</label>
                                                <input class="form_field" type="text" pattern="^\d{6}$" name="postal_code" id="postal_code" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="form_action_wrap">
                                            <div class="form_action">
                                                <button type="submit" class="theme-btn"><span>Next</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row form_step_2 hide">
                                        <div class="form_data">
                                            
                                            @if($service->name == 'Custom Request')
                                                <div class="form_item">
                                                    <label for="rt_query">RTI Query</label>
                                                    <input class="form_field" type="text" name="rti_query" id="rti_query" placeholder="">
                                                </div>
                                                <div class="form_item">
                                                    <label for="pio_addr">Do you know the PIO Address? (Yes/No)</label>
                                                    <div class="radio_sec">
                                                        <div class="radio_btn"><label><input type="radio" id="yes" name="pio_addr" value="yes" class="pio_addr">Yes</label></div>
                                                        <div class="radio_btn"><label><input type="radio" id="no" name="pio_addr" value="no" class="pio_addr" checked>No</label></div>
                                                    </div>
                                                </div>
                                                <div class="form_item" id="pio_address_section" style="display:none;">
                                                    <label for="pio_address">PIO Address</label>
                                                    <input class="form_field" type="text" name="pio_address" id="pio_address" placeholder="">
                                                </div>
                                            @else
                                                @foreach($fields['field_type'] ?? [] as $key => $value)
                                                <div class="form_item">
                                                    
                                                
                                                    <label for="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}">{{$fields['field_lable'][$key] ?? ''}} {{isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no' ? '(Optional)' : ''}}</label>
                                                    @if($value == 'textarea') 
                                                        <textarea class="form_field" type="text" name="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" id="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" placeholder="" >
                                                        </textarea>
                                                    @elseif($value == 'date') 
                                                    <input class="form_field" type="date" name="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" id="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" placeholder="" @if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key]))  min="{{$fields['minimum_date'][$key]}}" @endif  @if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key]))  max="{{$fields['maximum_date'][$key]}}" @endif>

                                                    @else
                                                    <input class="form_field" type="text" name="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" id="{{Illuminate\Support\Str::slug($fields['field_lable'][$key])}}" placeholder="" >

                                                    @endif
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                        <div class="form_action_wrap">
                                        <div class="form_action">
                                            <button type="button" class="theme-btn back-btn" data-tab="form_step_1" data-index="2"><span>Previous</span></button>
                                            <button type="submit" class="theme-btn"><span>Next</span></button>
                                        </div>
                                    </div>
                                                
                                    </div>
                                    <div class="form_row form_step_3 hide">
                                        
                                        <div class="form_table">
                                            <div class="form_info">
                                                <div class="form_number">RTI Application No: <span id="application_number"></span></div>
                                                <div class="upload_file" id="upload_file-section">
                                                    <button class="upload-file-btn">Upload File <span>+</span></button>
                                                    <input type="file" name="file" id="document-upload" />
                                                    
                                                </div>
                                                <div class="upload_file hide" id="preview-section">
                                                    <a class="upload-file-btn" target="blank">Preview </a>
                                                    <span class="remove-file">X</span>
                                                    
                                                </div>

                                               
                                                <input type="hidden" name="document" class="image-input" />
                                            </div>
                                            <a href="" class="hide" id="preview-dodument" target="blank">Preview</a>
                                            <div class="form_table_detail">
                                            @if(isset($payment) && isset($payment['amount_type']))
                                                @foreach($payment['amount_type'] as $key =>  $value)
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
                                                    <li><div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>
                                                    <li><div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>
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
                                                    <button type="submit" class="theme-btn"><span>Pay Now</span></button>
                                                </div>
                                            </div>
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


     


        <form method="post" id="razorsubmission" action="{{route('update.payment.success')}}">
    @csrf
    <input type="hidden" class="" id="razor_order_number" name="application_no" value="">
    </form>


@endsection
@push('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $(document).on('click', '.remove-file', function(){
        $('#preview-section').addClass('hide').find('a').attr('href' , null);
        $('#upload_file-section').removeClass('hide')
        $('.image-input').val(null)

    });
 $(document).on('change', '#document-upload', function () {
        let _this = $(this);
         let uploadedFile = document.getElementById($(this).attr('id')).files[0];
         var form_data = new FormData();
         form_data.append("file", uploadedFile);
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
                console.log('upload-image', response)
                $('#upload_file-section').addClass('hide');
                // _this.parents().eq(0).find('.upload-file-btn').text('Uploaded');
              _this.parents().eq(1).find('.image-input').val(response.data);
              console.log(_this.parents().eq(1).find('.image-input').attr('class'));
                      $('#preview-section').removeClass('hide').find('a').attr('href' , response.preview_path);

            },
            error : function(error) {}
         });
      });
// $(document).on('change', "#document-upload", function (e) {
//                 file = this.files[0];
//                 if (file) {
//                     let reader = new FileReader();
//                     reader.onload = function (event) {
//                       console.log(event.target.result)
//                       $('#preview-dodument').attr('href' , event.target.result).removeClass('hide');
//                     };
//                     reader.readAsDataURL(file);
//                 }
//             });

    $(document).on('change', '.pio_addr', function(e) {
        if($(this).val() == 'yes') {
            $('#pio_address_section').show();
        }
        else {
            $('#pio_address_section').hide();

        }
    });
   
    $(document).on('click', '.back-btn', function(e){
        let target = $(this).attr('data-tab');
        let tab_index = parseInt($(this).attr('data-index'));

        $('.'+target).removeClass('hide').siblings().addClass('hide');
        $('#step_no').val(tab_index-1);
        for(let index = 1; index < tab_index; index++) {
            $('#form_step_tab_'+index).find('a').addClass('active');
            console.log(index < tab_index-1);
            if(index < tab_index-1) {
                $('#form_step_tab_'+index).find('.step_check').show();
            }
            else {
                $('#form_step_tab_'+index).find('.step_check').hide();

            }
            

        }
        $('#form_step_tab_'+tab_index).find('a').removeClass('active');
        $('#form_step_tab_'+tab_index).find('.step_check').hide();



    });
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