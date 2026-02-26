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
                                <li class="fs-24"><a href="/">Home</a></li>
                                <li class="fs-24"><a href="{{ url('/service/'.$rti->serviceCategory->slug->slug ?? '') }}">{{$rti->serviceCategory->name ?? ''}}</a></li>
                                <li class="fs-24 active">{{$rti->service->name ?? 'Custom Request'}}</li>
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
                        <div class="thankyou_msg_wrap">
                            <div class="thankyou_msg">
                                    <div class="thankyou_img">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/service-detail/thankyou-img.webp')}}" alt="">
                                    </div>
                                    <div class="thankyou_heading">
                                        <h2>Thank you for filing your RTI application!</h2>
                                    </div>
                                    <div class="thankyou_app_msg"><span>Application No:</span> {{$rti->application_no ?? ''}}</div>
                                    <div class="thankyou_msg_detail">
                                        <p>We appreciate your initiative and encourage you to continue making 
                                            a positive impact through informed citizenship.</p>
                                    </div>

                                   
                                    @if(auth()->guard('customers')->check())
                                    <a class="theme-btn" href="{{route('my-rti', $rti->application_no)}}"><span>Go to the Dashboard</span></a>
                                    @else
                                    <a class="theme-btn" href="{{route('track-my-rti', encryptString($rti->application_no))}}"><span>Go to the Dashboard</span></a>

                                    @endif
                            </div>
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


@endsection
