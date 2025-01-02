@extends('frontend.layout.layout')

@section('title')
Home
@endsection

@section('content')

@foreach($page_section as $section)
<?php
$data = json_decode($section->data, true);
?>
@include('frontend.sections.' . $section->section_key)
@endforeach
<header class="section_banner">
    <div class="header_bg_img" style="background-image: url({{asset('assets/rti/images/banner.webp')}});">
        <div class="container">
            <div class="row banner_row">
                <div class="col-12 col-sm-6">
                    <div class="header_text">
                        <h1 class="title">Fed Up with <br><span>Bribes</span> & <span>Delayed</span> Government
                            Services?</h1>
                        <p class="fs-24">Fast-Track Your Government Responses with FileMyRTI: Experience Speedy
                            and Transparent Services from the Comfort of Your Home.</p>
                        <a href="javascipt:void(0);" class="theme-btn"><span>File My RTI Now</span></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mobile_img">
                        <img class="img-fluid" src="{{asset('assets/rti/images/banner.webp')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row testimonial_row">
                <div class="col-auto">
                    <div class="slider_wrapper">
                        <div class="testimonial_slider">
                            <div class="item">
                                <div class="testimonial_slide">
                                    <div class="profile">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/user.webp')}}"
                                            alt="profile pic">
                                    </div>
                                    <div class="slide_content">
                                        <div class="fs-20">
                                            <p>Lorem ipsum dolor sit amet consectetur. Congue risus id nec sed.
                                                Nisl eget imperdiet habitant nibh </p>
                                        </div>
                                        <div class="fs-20">
                                            <div class="user-name fw-700">Client Name</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial_slide">
                                    <div class="profile">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/user.webp')}}"
                                            alt="profile pic">
                                    </div>
                                    <div class="slide_content">
                                        <div class="fs-20">
                                            <p>Lorem ipsum dolor sit amet consectetur. Congue risus id nec sed.
                                                Nisl eget imperdiet habitant nibh </p>
                                        </div>
                                        <div class="fs-20">
                                            <div class="user-name fw-700">Client Name</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial_slide">
                                    <div class="profile">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/user.webp')}}"
                                            alt="profile pic">
                                    </div>
                                    <div class="slide_content">
                                        <div class="fs-20">
                                            <p>Lorem ipsum dolor sit amet consectetur. Congue risus id nec sed.
                                                Nisl eget imperdiet habitant nibh </p>
                                        </div>
                                        <div class="fs-20">
                                            <div class="user-name fw-700">Client Name</div>
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
</header>

<section class="rti_section ">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h3 class="fs-56 fw-700">File My RTI For?</h3>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <div class="col-auto">
                <div class="rti_tab_wrapper">
                    <div class="rti_tabs">
                        <ul class="rti_tab_list">
                            <li><a class="rti_tab_item active fs-28" href="javascript:void(0);" data-toggle="tab"
                                    data-id="rti_tab1"><span>Personal RTI</span></a></li>
                            <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab"
                                    data-id="rti_tab2"><span>Property Related RTI</span></a></li>
                            <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab"
                                    data-id="rti_tab3"><span>Social RTI</span></a></li>
                            <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab"
                                    data-id="rti_tab4"><span>Other RTI</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="rti_tab_details">
                    <div class="rti_tab tab-active" data-id="rti_tab1">
                        <div class="rti_wrapper">
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/compliant-tracking.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Complaint Tracking</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/marksheet-verification.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Marksheet Verification</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/answer-copy.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">Answer<br> Copy</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/passport-delay.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Passport<br> Delay</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/income-tax-refund.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Income Tax Refund</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/fir-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">FIR<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/epf-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">EPF<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/pension-enquiry.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Pension<br> Inquiry</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/irctc-payment.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">IRCTC Payment & Refund Issues</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block rti_block_ad">
                                <div class="rti_item active">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/think-question.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Can't find what you need?</div>
                                        <div class="rti_content more_content fs-28">We're ready to help-just
                                            submit your request</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rti_tab" data-id="rti_tab2">
                        <div class="rti_wrapper">
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/compliant-tracking.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Complaint Tracking</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/marksheet-verification.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Marksheet Verification</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/answer-copy.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">Answer<br> Copy</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/passport-delay.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Passport<br> Delay</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/income-tax-refund.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Income Tax Refund</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/fir-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">FIR<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/epf-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">EPF<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/pension-enquiry.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Pension<br> Inquiry</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/irctc-payment.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">IRCTC Payment & Refund Issues</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block rti_block_ad">
                                <div class="rti_item active">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/think-question.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Can't find what you need?</div>
                                        <div class="rti_content more_content fs-28">We're ready to help-just
                                            submit your request</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rti_tab" data-id="rti_tab3">
                        <div class="rti_wrapper">
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/compliant-tracking.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Complaint Tracking</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/marksheet-verification.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Marksheet Verification</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/answer-copy.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">Answer<br> Copy</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/passport-delay.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Passport<br> Delay</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/income-tax-refund.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Income Tax Refund</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/fir-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">FIR<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/epf-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">EPF<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/pension-enquiry.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Pension<br> Inquiry</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/irctc-payment.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">IRCTC Payment & Refund Issues</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block rti_block_ad">
                                <div class="rti_item active">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/think-question.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Can't find what you need?</div>
                                        <div class="rti_content more_content fs-28">We're ready to help-just
                                            submit your request</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rti_tab" data-id="rti_tab4">
                        <div class="rti_wrapper">
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/compliant-tracking.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Complaint Tracking</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/marksheet-verification.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Marksheet Verification</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/answer-copy.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">Answer<br> Copy</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/passport-delay.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Passport<br> Delay</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/income-tax-refund.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Income Tax Refund</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/fir-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">FIR<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid" src="{{asset('assets/rti/images/epf-status.webp')}}"
                                                alt="">
                                        </div>
                                        <div class="rti_content fs-28">EPF<br> Status</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/pension-enquiry.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Pension<br> Inquiry</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block">
                                <div class="rti_item">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/irctc-payment.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">IRCTC Payment & Refund Issues</div>
                                        <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="rti_block rti_block_ad">
                                <div class="rti_item active">
                                    <div class="rti_scroll">
                                        <div class="rti_img">
                                            <img class="img-fluid"
                                                src="{{asset('assets/rti/images/think-question.webp')}}" alt="">
                                        </div>
                                        <div class="rti_content fs-28">Can't find what you need?</div>
                                        <div class="rti_content more_content fs-28">We're ready to help-just
                                            submit your request</div>
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

<section class="process_section ">
    <div class="container">
        <div class="row process_head_row">
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h3 class="fs-56 fw-700">How it Works</h3>
                </div>
            </div>
            <div class="col-12 col-sm-3 know-more">
                <a href="javascipt:void(0);" class="theme-btn"><span>Know more</span></a>
            </div>
        </div>
        <div class="row process_row">
            <div class="col-12 col-sm-4">
                <div class="process_flow">
                    <div class="process_icon">
                        <img class="img-fluid" src="{{asset('assets/rti/images/journey.webp')}}" alt="icon">
                    </div>
                    <div class="process_title fs-36 fw-700">The Journey</div>
                    <div class="fs-24">
                        <p>Lorem ipsum dolor sit amet constetur. Vulputate cras vulpate morbi velit metus
                            quisque tellus praesent. Amet nibh a amet.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="process_flow">
                    <div class="process_icon">
                        <img class="img-fluid" src="{{asset('assets/rti/images/challenge.webp')}}" alt="icon">
                    </div>
                    <div class="process_title fs-36 fw-700">The Challenge</div>
                    <div class="fs-24">
                        <p>Lorem ipsum dolor sit amet constetur. Vulputate cras vulpate morbi velit metus
                            quisque tellus praesent. Amet nibh a amet.</p>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-4">
                <div class="process_flow">
                    <div class="process_icon">
                        <img class="img-fluid" src="{{asset('assets/rti/images/commitment.webp')}}" alt="icon">
                    </div>
                    <div class="process_title fs-36 fw-700">Our Commitment</div>
                    <div class="fs-24">
                        <p>Lorem ipsum dolor sit amet constetur. Vulputate cras vulpate morbi velit metus
                            quisque tellus praesent. Amet nibh a amet.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="blog_section">
    <div class="container">
        <div class="section_heading">
            <h4 class="fs-56 fw-700">Our Blogs</h4>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="blog_item_wrapper">
                    <div class="blog_item">
                        <div class="blog_img">
                            <img class="img-fluid" src="{{asset('assets/rti/images/home/blog-1.webp')}}"
                                alt="Blog Image">
                        </div>
                        <div class="blog_area">
                            <div class="blog_date fs-20">Aug 20, 2024</div>
                            <div class="blog_text fs-28 fw-600">
                                <p>Lorem ipsum dolor sit amet consectetur. Commodo eget donec varius elementum.
                                </p>
                            </div>
                            <a href="javascript:void(0);" class="theme-btn-link fs-28">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="blog_item_wrapper">
                    <div class="blog_item">
                        <div class="blog_img">
                            <img class="img-fluid" src="{{asset('assets/rti/images/home/blog-2.webp')}}"
                                alt="Blog Image">
                        </div>
                        <div class="blog_area">
                            <div class="blog_date fs-20">Aug 20, 2024</div>
                            <div class="blog_text fs-28 fw-600">
                                <p>Lorem ipsum dolor sit amet consectetur. Commodo eget donec varius elementum.
                                </p>
                            </div>
                            <a href="javascript:void(0);" class="theme-btn-link fs-28">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="blog_item_wrapper">
                    <div class="blog_item">
                        <div class="blog_img">
                            <img class="img-fluid" src="{{asset('assets/rti/images/home/blog-3.webp')}}"
                                alt="Blog Image">
                        </div>
                        <div class="blog_area">
                            <div class="blog_date fs-20">Aug 20, 2024</div>
                            <div class="blog_text fs-28 fw-600">
                                <p>Lorem ipsum dolor sit amet consectetur. Commodo eget donec varius elementum.
                                </p>
                            </div>
                            <a href="javascript:void(0);" class="theme-btn-link fs-28">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog_cta">
            <a href="javascipt:void(0);" class="theme-btn"><span>View all blogs</span></a>
        </div>
    </div>
</section>

<!-- <section class="cta_section">

    <div class="container">
        <div class="cta_text">
            <div class="section_heading">
                <h4 class="fs-56 fw-700">Bringing transparency closer, one RTI at a time.</h4>
            </div>
            <a href="javascipt:void(0);" class="theme-btn"><span>File My RTI Now</span></a>
        </div>
    </div>
</section> -->


<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset('assets/rti/images/cta_bg.webp')}}" alt="cta bg">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">Bringing transparency closer, one RTI at a time.</h4>
                </div>
                <a href="javascipt:void(0);" class="theme-btn"><span>File My RTI Now</span></a>
            </div>
        </div>
    </div>
</section>

@endsection