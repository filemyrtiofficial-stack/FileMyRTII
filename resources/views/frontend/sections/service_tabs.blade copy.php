<?php

$service_categories = App\Models\ServiceCategory::list(false, ['ids' => json_decode($data['service_tabs_service_list'], true)]);
?>
<section class="rti_section ">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h3 class="fs-56 fw-700">{!! $data['title'] ?? '' !!}</h3>
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
                            @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                            <?php
                                $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->values();
                            ?>
                            <li><a class="rti_tab_item {{$index == 0 ? 'active': ''}} fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab{{$index}}"><span>{{ $item[0]['name'] ?? ''}}</span></a></li>
                            @endfor
                          
                        </ul>
                    </div>
                </div>
                <div class="rti_tab_details">
                    @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                        <div class="rti_tab {{$index == 0 ? 'tab-active': ''}}" data-id="rti_tab{{$index}}">
                            <div class="rti_wrapper">
                            <?php
                                $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->values();
                            ?>
                                @foreach($item[0]['services'] ?? [] as $key =>  $item)
                                    <div class="rti_block">
                                        <div class="rti_item">
                                            <div class="rti_scroll">
                                                <div class="rti_img">
                                                    <img class="img-fluid"
                                                        src="{{asset($item['icon'] ?? '')}}" alt="">
                                                </div>
                                                <div class="rti_content fs-28">{{$item['name'] ?? ''}}</div>
                                                @if(isset($item['description_enable']) && $item['description_enable'] == 'yes')
                                                    <div>
                                                        <p>{{$item['description'] ?? ''}}</p>
                                                    </div>
                                                @endif
                                                <a href="javascript:void(0);" class="theme-btn-link">Apply Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                               
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
                    @endfor
                   
                </div>
            </div>
        </div>
    </div>
</section>


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
                                <ul class="rti_tab_list rti_tab_slider">
                                    <li><a class="rti_tab_item active fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab1"><span>Personal RTI</span></a></li>
                                    <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab2"><span>Property Related RTI</span></a></li>
                                    <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab3"><span>Social RTI</span></a></li>
                                    <li><a class="rti_tab_item fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab4"><span>Other RTI</span></a></li>
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
                                                    <img class="img-fluid" src="images/compliant-tracking.webp" alt="">
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
                                                <img class="img-fluid" src="images/marksheet-verification.webp" alt="">
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
                                                <img class="img-fluid" src="images/answer-copy.webp" alt="">
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
                                                <img class="img-fluid" src="images/passport-delay.webp" alt="">
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
                                                <img class="img-fluid" src="images/income-tax-refund.webp" alt="">
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
                                                <img class="img-fluid" src="images/fir-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/epf-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/pension-enquiry.webp" alt="">
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
                                                <img class="img-fluid" src="images/irctc-payment.webp" alt="">
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
                                                    <img class="img-fluid" src="images/think-question.webp" alt="">
                                                </div>
                                                <div class="rti_content fs-28">Can't find what you need?</div>
                                                <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>
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
                                                    <img class="img-fluid" src="images/compliant-tracking.webp" alt="">
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
                                                <img class="img-fluid" src="images/marksheet-verification.webp" alt="">
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
                                                <img class="img-fluid" src="images/answer-copy.webp" alt="">
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
                                                <img class="img-fluid" src="images/passport-delay.webp" alt="">
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
                                                <img class="img-fluid" src="images/income-tax-refund.webp" alt="">
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
                                                <img class="img-fluid" src="images/fir-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/epf-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/pension-enquiry.webp" alt="">
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
                                                <img class="img-fluid" src="images/irctc-payment.webp" alt="">
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
                                                    <img class="img-fluid" src="images/think-question.webp" alt="">
                                                </div>
                                                <div class="rti_content fs-28">Can't find what you need?</div>
                                                <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>
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
                                                    <img class="img-fluid" src="images/compliant-tracking.webp" alt="">
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
                                                <img class="img-fluid" src="images/marksheet-verification.webp" alt="">
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
                                                <img class="img-fluid" src="images/answer-copy.webp" alt="">
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
                                                <img class="img-fluid" src="images/passport-delay.webp" alt="">
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
                                                <img class="img-fluid" src="images/income-tax-refund.webp" alt="">
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
                                                <img class="img-fluid" src="images/fir-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/epf-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/pension-enquiry.webp" alt="">
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
                                                <img class="img-fluid" src="images/irctc-payment.webp" alt="">
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
                                                    <img class="img-fluid" src="images/think-question.webp" alt="">
                                                </div>
                                                <div class="rti_content fs-28">Can't find what you need?</div>
                                                <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>
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
                                                    <img class="img-fluid" src="images/compliant-tracking.webp" alt="">
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
                                                <img class="img-fluid" src="images/marksheet-verification.webp" alt="">
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
                                                <img class="img-fluid" src="images/answer-copy.webp" alt="">
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
                                                <img class="img-fluid" src="images/passport-delay.webp" alt="">
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
                                                <img class="img-fluid" src="images/income-tax-refund.webp" alt="">
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
                                                <img class="img-fluid" src="images/fir-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/epf-status.webp" alt="">
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
                                                <img class="img-fluid" src="images/pension-enquiry.webp" alt="">
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
                                                <img class="img-fluid" src="images/irctc-payment.webp" alt="">
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
                                                    <img class="img-fluid" src="images/think-question.webp" alt="">
                                                </div>
                                                <div class="rti_content fs-28">Can't find what you need?</div>
                                                <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>
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