@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">

@endpush
@section('content')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "FileMyRTI",
  "url": "https://filemyrti.com",
  "logo": "https://filemyrti.com/assets/images/logo.webp",
  "description": "{!! $seo->meta_description ?? 'File RTI online easily with India’s most trusted platform for fast, legal, and expert filing. Drafts, tracking, appeals & more in one place.' !!}",
  "sameAs": [
    "https://www.linkedin.com/company/filemyrti/",
    "https://www.facebook.com/profile.php?id=61572512135057&sk=about",
    "https://x.com/FileMyRTI",
    "https://www.instagram.com/filemyrtiofficial/",
    "https://www.youtube.com/@FileMyRTI"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91-9911100859",
    "contactType": "Customer Support",
    "areaServed": "IN",
    "availableLanguage": ["English", "Hindi", "Telugu"]
  }
}
</script>
@endsection

<style>
.hide {
  display: none;
}
</style>
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
                                <li class="fs-24"><a href="{{ url('/') }}">Home</a></li>
                                <li class="fs-24"><a href="{{ url('/service/'.$service_category->slug->slug ?? '') }}">{{$service_category->name ?? ''}}</a></li>
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

<!--checking start-->
            <section id="serviceform" style="padding:10px !important;" class="serviceform_section">
  <!-- content -->
</section>

<script>
  const section = document.getElementById('serviceform');
  if (window.innerWidth <= 768) {
    section.style.padding = "0px";
  }
</script>


            <!--checking end-->
            
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
                                <input type="hidden" id="old_service_slug" name="old_service_slug" value="{{$old_service_slug}}">




                                <div class="form_tab_wrapper">
                                    <div class="form_tabs">
                                        <ul class="form_tab_list">
                                            <li id="form_step_tab_1"><a class="form_tab_item1 form-tab active fs-28" href="javascript:void(0);" data-key="1" data-toggle1="tab" data-id="form_tab1"><span class="step">step 1</span><span class="title">Personal Details</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
                                            <li id="form_step_tab_2"><a class="form_tab_item1 form-tab fs-28" href="javascript:void(0);" data-key="2" data-toggle1="tab" data-id="form_tab2"><span class="step">step 2</span><span class="title">{{ stringLimit(($service->name ?? ''), 20) }}</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
                                            <li id="form_step_tab_3"><a class="form_tab_item1 form-tab fs-28" href="javascript:void(0);" ddata-key="3" ata-toggle1="tab" data-id="form_tab3"><span class="step">step 3</span><span class="title">Payment Details</span><span class="step_check" style="display:none;"><img class="img-fluid" src="{{asset('assets/rti/images/service-detail/step-check.svg')}}" alt="check-icon"></span></a></li>
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
                                                <label for="address">Address</label>
                                                <input class="form_field" type="text" name="address" id="address" placeholder="" >
                                            </div>
                                            <div class="form_item">
                                                <label for="address">City</label>
                                                <input class="form_field" type="text" name="city" id="city" placeholder="" >
                                            </div>

                                            <div class="form_item">
                                                <label for="address">State</label>
                                                <input class="form_field" type="text" name="state" id="state" placeholder="" >
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
                                                <div class="form_item single">
                                                    <label for="rt_query">RTI Query <span class="text-danger">*</span></label>
                                                    <textarea class="form_field" type="text" name="rti_query" id="rti_query" placeholder=""></textarea>
                                                </div>
                                                <div class="form_item single pio-address-yes-no">
                                                    <label for="pio_addr">Do you know the PIO Address? (Yes/No)</label>
                                                    <div class="radio_sec">
                                                        <div class="radio_btn"><label><input type="radio" id="yes" name="pio_addr" value="yes" class="pio_addr">Yes</label></div>
                                                        <div class="radio_btn"><label><input type="radio" id="no" name="pio_addr" value="no" class="pio_addr" checked>No</label></div>
                                                    </div>
                                                </div>
                                                <div class="form_item single" id="pio_address_section" style="display:none;">
                                                    <label for="pio_address">PIO Address</label>
                                                    <textarea class="form_field" type="text" name="pio_address" id="pio_address" placeholder=""></textarea>
                                                </div>
                                            @else
                                                @foreach($fields['field_type'] ?? [] as $key => $value)
                                                @if( !isset($fields['form_field_type'][$key]) || (isset($fields['form_field_type'][$key])  && strtolower($fields['form_field_type'][$key]) == "customer"))
                                                        <div class="form_item">

                                                            <label for="{{getFieldName($fields['field_lable'][$key])}}">{{$fields['field_lable'][$key] ?? ''}} @if(isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no')  @else <span class="text-danger">*</span> @endif</label>
                                                            @if($value == 'textarea')
                                                                <textarea class="form_field" type="text" name="{{getFieldName($fields['field_lable'][$key])}}" id="{{getFieldName($fields['field_lable'][$key])}}" placeholder="{{$fields['placeholder'][$key] ?? ''}}"></textarea>
                                                            @elseif($value == 'date')
                                                            <input class="form_field" type="date" value="{{Carbon\Carbon::now()}}" name="{{getFieldName($fields['field_lable'][$key])}}" id="{{getFieldName($fields['field_lable'][$key])}}" placeholder="" @if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key]))  min="{{$fields['minimum_date'][$key]}}" @endif  @if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key]))  max="{{$fields['maximum_date'][$key]}}" @endif>
                                                            @elseif($value == 'file')
                                                            <div class="custom_choose_file">
                                                                <input class="form_field form-image" type="file" name="{{getFieldName($fields['field_lable'][$key])}}_file" id="{{getFieldName($fields['field_lable'][$key])}}_file" placeholder="" @if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key]))  min="{{$fields['minimum_date'][$key]}}" @endif  @if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key]))  max="{{$fields['maximum_date'][$key]}}" @endif accept="image/*,.pdf"/>
                                                                <a class="preview_icon form-image-preview" href="javascript:void(0);" style="display:none"><svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg></a>
                                                            </div>
                                                               <!-- Image Preview -->
                                                             <img id="imagePreview" src="" alt="Image Preview" style="display: none;" width="50" height="50"/>
                                                            @elseif($value == 'select')
                                                            <select name="{{getFieldName($fields['field_lable'][$key])}}_file" id="{{getFieldName($fields['field_lable'][$key])}}_file"  class="form_field" >
                                                                {!! getOptions($fields['options'][$key]) !!}
                                                            </select>
                                                            @else
                                                            <input class="form_field" type="text" name="{{getFieldName($fields['field_lable'][$key])}}" id="{{getFieldName($fields['field_lable'][$key])}}" placeholder="{{$fields['placeholder'][$key] ?? ''}}" >

                                                            @endif
                                                        </div>
                                                    @endif
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
                                                    <input type="file" name="file[]" id="document-upload" multiple   accept="image/*,.pdf"/>
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
                                            <div style="border:none"; class="form_table_detail ">
                                            @if(isset($payment) && isset($payment['amount_type']))
                                                @foreach($payment['amount_type'] as $key =>  $value)
                                                <!--old Changes Start-->
                                            <!--        <ul class="charge_list">-->
                                            <!--            <li>{{$payment['amount_type'][$key] ?? ''}}</li>-->
                                            <!--            <li class="price-listing">₹ {{$payment['amount'][$key] ?? ''}}</li>-->
                                            <!--            <li>-->
                                            <!--                <span class="check_icon_wrapper">-->
                                            <!--                    @if($payment['basic'][$key] == 'yes')-->
                                            <!--                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">-->
                                            <!--                    @else-->
                                            <!--                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">-->
                                            <!--                    @endif-->
                                            <!--                </span>-->
                                            <!--            </li>-->
                                            <!--            <li>-->
                                            <!--                <span class="check_icon_wrapper">-->
                                            <!--                    @if($payment['advance'][$key] == 'yes')-->
                                            <!--                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/check-icon.svg')}}" alt="check icon">-->
                                            <!--                    @else-->
                                            <!--                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/cross-icon.svg')}}" alt="check icon">-->
                                            <!--                    @endif-->
                                            <!--                </span>-->
                                            <!--            </li>-->
                                            <!--        </ul>-->
                                            <!--    @endforeach-->
                                            <!--@endif-->
                                            <!--<ul class="charge_list option_list">-->
                                            <!--    <li>Price</li>-->
                                            <!--    <li><div class="charge_option custom_radio"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>-->
                                            <!--    <li><div class="charge_option custom_radio"><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>-->
                                            <!--</ul>-->

                                            <!--<ul class="charge_list option_list">-->
                                            <!--    <li>+GST ({{getGSTNo()}}%)</li>-->
                                            <!--    <li><div class="charge_option custom_radio"><label for="price-2">₹ {{getGST($payment['basic_total'])}}</label></div></li>-->
                                            <!--    <li><div class="charge_option custom_radio"><label for="price-3">₹ {{getGST($payment['advance_total'])}}</label></div></li>-->
                                            <!--</ul>-->
                                            
                                            <!--<ul class="charge_list option_list">-->
                                            <!--    <li>Choose An Option</li>-->
                                            <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']+getGST($payment['basic_total'])}}</label></div></li>-->
                                            <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']+getGST($payment['advance_total'])}}</label></div></li>-->
                                            <!--</ul>-->
                                            
                                            <!--old Changes end-->
                                            <!--Payment page update24.oct.20225 START-->
   
@php
  $basicBase   = $payment['basic_total'] ?? 0;
  $advanceBase = $payment['advance_total'] ?? 0;
@endphp

<div id="pricing-matrix" class="pricing-matrix"
  style="position:relative;border:1px solid #e5e7eb;border-radius:0px;overflow:hidden;
         font-family:'Inter',sans-serif;max-width:100%;">

  <!-- Header -->
  <div class="pm-row pm-head"
    style="display:grid;grid-template-columns:1.2fr 0.6fr 1fr 1fr;background:#f9fafb;
           border-bottom:1px solid #e5e7eb;font-size:16px;font-weight:700;">
    <div class="col-title"
      style="grid-column:1 / span 2;padding:8px 10px;color:#0f172a;">Brief Plan Features</div>
    <div class="col-basic" style="padding:8px 10px;text-align:center;">Smart</div>
    <div class="col-adv" style="padding:8px 10px;text-align:center;">Pro</div>
  </div>

  <!-- Feature Rows -->
  @foreach($payment['amount_type'] as $key => $value)
    @php
      $label = trim($payment['amount_type'][$key] ?? '');
      $amountRaw = trim((string)($payment['amount'][$key] ?? ''));
      $amountNum = (int)preg_replace('/[^0-9]/', '', $amountRaw);
      $hideOnlyAmountOnSmall = in_array($amountNum, [149, 100, 150, 200], true);
    @endphp

    <div class="pm-row feature-row"
      style="display:grid;grid-template-columns:1.2fr 0.6fr 1fr 1fr;align-items:center;
             border-top:1px solid #eef2f7;position:relative;font-size:15px;">
      <div class="col-feature" style="padding:6px 10px;font-size:14px;font-family:'Poppins', sans-serif;">{{ $label }}</div>
      <div class="col-amount" style="padding:6px 10px;font-weight:300; font-size:10px;">
        <span class="{{ $hideOnlyAmountOnSmall ? 'amt-hide-sm' : '' }}">₹ {{ $amountRaw }}</span>
      </div>

      <div class="col-basic" style="padding:6px 10px;text-align:center;z-index:1;">
        @if(($payment['basic'][$key] ?? '') === 'yes')
          <img src="{{ asset('assets/rti/images/service-detail/check-icon.svg') }}"
               alt="yes" style="height:30px;">
        @else
          <img src="{{ asset('assets/rti/images/service-detail/cross-icon.svg') }}"
               alt="no" style="height:14px;">
        @endif
      </div>

      <div class="col-adv" style="padding:6px 10px;text-align:center;z-index:1;">
        @if(($payment['advance'][$key] ?? '') === 'yes')
          <img src="{{ asset('assets/rti/images/service-detail/check-icon.svg') }}"
               alt="yes" style="height:30px;">
        @else
          <img src="{{ asset('assets/rti/images/service-detail/cross-icon.svg') }}"
               alt="no" style="height:14px;">
        @endif
      </div>
    </div>
  @endforeach

  <!-- Choose Option -->
  <div class="pm-row choose-row"
    style="display:grid;grid-template-columns:1.2fr 0.6fr 1fr 1fr;align-items:center;
           border-top:2px solid #e5e7eb;background:#f9fafb;position:relative;font-size:15px;">
    <div class="col-title"
      style="grid-column:1 / span 2;padding:10px 12px;font-size:16px;font-weight:700;">Select</div>

    <div class="col-basic opt-cell"
      style="padding:10px;text-align:center;position:relative;z-index:1;">
      <label for="price-basic"
        style="display:inline-flex;gap:8px;align-items:center;cursor:pointer;
               <!--padding:8px 12px;border:0px solid #dbe6f2;border-radius:10px;-->
               <!--transition:0.2s ease;flex-wrap:wrap;">
        <input type="radio" id="price-basic" name="charges"
               value="{{ $basicBase }}" checked
               style="width:14px;height:14px;cursor:pointer;">
        <span style="font-weight:800;font-size:14px;color:#0f172a;">₹ {{ $basicBase }}</span>
      </label>
    </div>

    <div class="col-adv opt-cell"
      style="padding:10px;text-align:center;position:relative;z-index:1;">
      <label for="price-adv"
        style="display:inline-flex;gap:8px;align-items:center;cursor:pointer;
               <!--padding:0px 0px;border:px solid #dbe6f2;border-radius:10px;-->
               <!--transition:0.2s ease;flex-wrap:wrap;">
        <input type="radio" id="price-adv" name="charges"
               value="{{ $advanceBase }}"
               style="width:14px;height:14px;cursor:pointer;">
        <span style="font-weight:800;font-size:14px;color:#0f172a;">₹ {{ $advanceBase }}</span>
      </label>
    </div>
  </div>

  <!-- Highlight background strip -->
  <div id="highlight-strip" style="
      position:absolute;
      top:0;
      bottom:0;
      width:25%;
      background:rgba(2,108,182,0.08);
      border:3px solid #026CB6;
      border-right:3px solid #026CB6;
      border-radius:8px;
      box-shadow:0 0 8px rgba(2,108,182,0.25);
      opacity:0;
      transition:all 0.35s ease, opacity 0.4s ease;
      z-index:0;">
  </div>
</div>

<style>
  /* hide only the amount text on small devices */
  @media (max-width:480px){
    .amt-hide-sm{ display:none !important; }
    #pricing-matrix{ font-size:13px !important; }
    #pricing-matrix .col-feature,#pricing-matrix .col-amount,
    #pricing-matrix .col-basic,#pricing-matrix .col-adv{
      padding:5px 6px !important;
    }
  }
</style>

<script>
(function(){
  const matrix = document.getElementById('pricing-matrix');
  const highlight = document.getElementById('highlight-strip');

  function applyHighlight(){
    const selected = matrix.querySelector('input[name="charges"]:checked');
    if(!selected) return;

    const col = selected.id === 'price-basic' ? 'basic' : 'adv';
    const screenWidth = window.innerWidth;

    // align highlight accurately with columns
    if (screenWidth <= 768) {
      if (col === 'basic') {
        highlight.style.left = '46.5%';
        highlight.style.width = '26%';
      } else {
        highlight.style.left = '73.5%';
        highlight.style.width = '26%';
      }
    } else {
      if (col === 'basic') {
        highlight.style.left = '47.3%';
        highlight.style.width = '26.3%';
      } else {
        highlight.style.left = '73.6%';
        highlight.style.width = '26.3%';
      }
    }

    // make it visible with soft fade
    highlight.style.opacity = '1';

    // pop effect on label
    const label = matrix.querySelector(col === 'basic' ? '.col-basic label' : '.col-adv label');
    const otherLabel = matrix.querySelector(col === 'basic' ? '.col-adv label' : '.col-basic label');

    if(label){
      label.style.borderColor = '#026CB6';
      label.style.boxShadow = '0 0 6px rgba(2,108,182,0.35)';
      label.style.transform = 'scale(1.05)';
    }
    if(otherLabel){
      otherLabel.style.borderColor = '#dbe6f2';
      otherLabel.style.boxShadow = 'none';
      otherLabel.style.transform = 'scale(1)';
    }
  }

  matrix.addEventListener('change', e=>{
    if(e.target.name === 'charges') applyHighlight();
  });

  window.addEventListener('resize', applyHighlight);
  applyHighlight();
})();
</script>



                                            <!---->
                                            
                                            
                                            
                                            
                                            
                                            <!--<ul class="charge_list option_list">-->
                                            <!--    <li>Choose An Option</li>-->
                                            <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-2" name="charges" value="{{$payment['basic_total']}}"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>-->
                                            <!--    <li><div class="charge_option custom_radio"><input type="radio" id="price-3" name="charges" value="{{$payment['advance_total']}}" checked><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>-->
                                            <!--</ul>-->
                                        </div>
                                        <p id="error"></p>
                                        <!--<div class="gst_add" style="text-align: end">+GST (18%)</div>-->
                                            <div style="margin-top:-25px;display:flex;flex-direction:column;align-items:center;gap:12px;">

  <!-- Pay Button -->
<!--<div style="margin-top:-30px;">-->

  <!-- Razorpay + PayNow Row -->
 <!-- Razorpay + PayNow Row -->
<div style="
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:center;
    gap:16px;
    width:100%;
    max-width:650px;
    margin:auto;
  ">

    <!-- Razorpay Logo (hidden on small screens) -->
    <div class="razorpay-logo" style="flex:1 1 120px;display:flex;justify-content:flex-start;">
      <img src='{{ asset("assets/rti/images/service-detail/razorpayv1.webp") }}'
           alt="Razorpay"
           style="height:42px;width:auto;max-width:128%; margin-left:-27px;">
    </div>

    <!-- Pay Now Button -->
    <div class="paynow-container" style="position:relative;flex:0 0 auto;display:flex;flex-direction:column;align-items:center; margin-top:20px">
      <button type="submit" class="theme-btn"
        style="display:inline-block;width:373px;height:50px;border:none;border-radius:6px;cursor:pointer; left:30px">
        <span>Proceed To Pay</span>
      </button>
      
          
      
      <!-- Bottom Texts -->
      <div style="position:relative;width:100%;margin-top:4px;">
        <div style="position:relative;width:100%;margin-top:4px;">
  <!-- Secure & Refundable with green tick -->
  <span class="secure-text" style="position:absolute;left:36px;font-size:12px;color:#999; display:flex; align-items:center; margin-top:-6px;"> 
    <!-- Green tick slightly bigger -->
    <span style="color:#28a745; font-size:15px; font-weight:bold; margin-right:4px;">✔</span>
    Secure & Refundable if RTI not applicable
  </span> 

  <!-- GST -->
  <!--<span class="gst-text" style="position:absolute;right:-25px;font-size:12px;color:#999;">+Tax GST(18%)</span>-->
</div>

        <span class="gst-text" style="position:absolute;right:-25px;font-size:12px;color:#999; bottom:-14.5px;">+Tax GST(18%) </span>
      </div>
    </div>
</div>
<!-- Razorpay Logo (hidden on small screens) -->
    <div class="razorpay-logos" style="flex:1 1 120px;display:flex;justify-content:flex-start;">
      <img src='{{ asset("assets/rti/images/service-detail/razorpayv1.webp") }}'
           alt="Razorpay"
           style="height:42px;width:auto;max-width:100%; margin-left:-3px;display:none;">
    </div>

<!-- Payment Icons -->
<div style="
    display:none;
    flex-wrap:wrap;
    gap:14px;
    align-items:center;
    justify-content:center;
    margin-top:16px;
  
    @media (max-width:768px){
  /* Hide Razorpay logo */
  .razorpay-logo { 
    display:none !important;
  }
  ">
  <!--<img src='{{ asset("assets/rti/images/service-detail/razorpay.webp") }}' alt="Rozarpay" style="height:28px;width:auto;">-->
  <!--<img src='{{ asset("assets/rti/images/service-detail/visa.webp") }}' alt="VISA" style="height:28px;width:auto;">-->
   <!--!--<img src='{{ asset("assets/rti/images/service-detail/paytm.webp") }}' alt="Paytm" style="height:28px;width:auto;">-->-->
  <!--<img src='{{ asset("assets/rti/images/service-detail/master-card.webp") }}' alt="MasterCard" style="height:28px;width:auto;">-->
</div>

<!-- Responsive behavior -->
<style>
@media (max-width:768px){
  /* Hide Razorpay logo */
  .razorpay-logo { 
    display:none !important; 
  }
  .razorpay-logos img {
      display: flex !important;
  }

  /* Stack items vertically on small screens */
  div[style*="max-width:650px"] {
    flex-direction: column !important;
    align-items: center !important;
  }

  /* Make Pay Now button responsive on small devices */
  .paynow-container button {
    /*width: 90% !important;  */
    max-width: 320px !important;
    left: 0 !important;  
    /*margin-top:24.5px !important;*/
  }
  
  /* Align bottom texts properly on mobile */
  .paynow-container .gst-text {
    right: 0 !important;
    bottom: -14px;
    font-size:10.5px !important;

  }

  .paynow-container .secure-text {
    left: 0 !important;
    bottom: -18px;
    font-size:10.5px !important;
  }

  /* Reduce payment icons size for mobile */
  div[style*="margin-top:16px"] img {
    height: 24px !important;
  }
}
</style>
</div>
<!--Payment page update 24.oct.2025 END-->



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
            $(this).closest('.custom_choose_file').find('.form-image-preview').hide();

        }
        });

    $(document).on('click', '.remove-file', function(){
        $('#preview-section').addClass('hide').find('a').attr('href' , null);
        $('#upload_file-section').removeClass('hide')
        $('.image-input').val(null)

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
                    //     console.log('upload-image', response)
                    //     $('#upload_file-section').addClass('hide');
                    //     // _this.parents().eq(0).find('.upload-file-btn').text('Uploaded');
                    //   _this.parents().eq(1).find('.image-input').val(response.data);
                    //   console.log(_this.parents().eq(1).find('.image-input').attr('class'));
                    //           $('#preview-section').removeClass('hide').find('a').attr('href' , response.preview_path);

                    },
            error : function(error) {}
         });
      });
      $(document).on('click', '.remove-document', function(e){
        e.preventDefault();
        $(this).parents().eq(1).remove();
      })
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

        $('html,body').animate({ scrollTop: $('.banner_row').offset().top }, 500);



    });
    $(document).on('submit', '.service-form', function(e){
        e.preventDefault();
        let action = $(this).attr('action');
        let type = $(this).attr('method');
        var data = new FormData($(this)[0]);
        $('.form-error-list').remove();
        $('.loader').show();

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
                                        $('html,body').animate({ scrollTop: $('.banner_row').offset().top }, 500);

                    // $('#form_step_tab_'+response.step).siblings().find('a').removeClass('active')
                    $('#step_no').val(response.step);
                    if(response.step == 3) {
                        $('#application_no').val(response.rti.application_no);
                        $('#application_number').html(response.rti.application_no);
                    }
                    else if(response.step == 4) {
                        finalrayzorpayment(response.rti)

                    }
                    $('.loader').hide();

                }
            },
            error :  function(error) {
             
                $.each(error.responseJSON.errors, function(index, value) {
                    console.log(value)
                    index = index.replaceAll('.', '_')
                    $('#' + index).parents().eq(0).append(
                        `<span class="text-danger form-error-list">${value[0] ?? ''}</span>`)
                       
                });
                                $('html,body').animate({ scrollTop: $('.form-error-list').offset().top -200}, 500);

                $('.loader').hide();

            }
        });

    });

    function finalrayzorpayment(rti){
        $('.service-form').find('button').attr('disabled', true);
            $('#razor_order_number').val(rti.application_no);
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
                // "image": "https://cdn.razorpay.com/logos/NSL3kbRT73axfn_medium.png",
                "notes":{'order_id':rti.application_no},
                "handler": function(reason_result){
                    console.log(reason_result, 'reason_result')
                    $('#razorsubmission').append('<input type="hidden" class="" name="razorpay_payment_id" value="'+reason_result.razorpay_payment_id+'"> <input type="hidden" class="" name="order_id" value="'+rti.application_no+'"> ');
                    $('#razorsubmission').submit();
                    $('.popup').css('display','block');

                },
                "modal": {
                    "ondismiss": function(){
                        $('.service-form').find('button').attr('disabled', false);

                            $('.popup').css('display','none');
                            $('#proceed-to-payment').css("pointer-events", "visible");
                            $('#proceed-to-payment').css("opacity", "1");
                    }
                },

                // "theme": {
                //     "color": "#F9BF37"
                // }
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
                        $('.service-form').find('button').attr('disabled', false);
                    }
                });
            });
            rzp1.open();
            // e.preventDefault();
        }

    $(document).on('click', '.delete-icon', function(){
        $(this).parents().eq(0).remove();
      });


      $(document).on('click', '.form-tab', function(e){
        e.preventDefault();
        let step_no = parseInt($('#step_no').val());
        let key = parseInt($(this).attr('data-key'));
        let id = $(this).attr('data-id');

        if(step_no > key) {
            $('#step_no').val(key);
            $(".form_step_"+key).removeClass('hide').siblings().addClass('hide');
            $(this).addClass('active').parents().eq(0).nextAll().find('a').removeClass('active')
          
        }
        if(step_no >= key) {
           $(this).find('.step_check').hide();
            $(this).parents().eq(0).nextAll().find('.step_check').hide();
        }
      })
</script>
@endpush
