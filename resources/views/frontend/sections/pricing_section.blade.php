<section class="pricing_page_section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8">
                        <div class="pricing_page_wrapper">
                        <div class="section_heading">
                            <h2>{!! $data['title'] !!}</h2>
                        </div>
                        <div class="select_state">
                            <div class="form_item">
                                <label for="">Calculate RTI Filing Charges For</label>
                                <select class="form_field" class="country-list" name="" id="">
                                    <option selected="" value="">Select Center</option>
                                    @foreach(stateList() as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <?php
                            $payment = App\Models\Setting::getSettingData('payment');
                        ?>
                        <div class="pricing_plan">
                            <div class="form_table_detail">
                            @if(isset($payment) && isset($payment['amount_type']))
                                @foreach($payment['amount_type'] as $key =>  $value)
                                    <ul class="charge_list">
                                        <li>{{$payment['amount_type'][$key] ?? ''}}</li>
                                        <li class="price-listing">₹ {{$payment['amount'][$key] ?? ''}}</li>
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
                                    <li>Price</li>
                                    <li><div class="charge_option custom_radio"><label for="price-2">₹ {{$payment['basic_total']}}</label></div></li>
                                    <li><div class="charge_option custom_radio"><label for="price-3">₹ {{$payment['advance_total']}}</label></div></li>
                                </ul>

                                <ul class="charge_list option_list">
                                    <li>+GST ({{getGSTNo()}}%)</li>
                                    <li><div class="charge_option custom_radio"><label for="price-2">₹ {{getGST($payment['basic_total'])}}</label></div></li>
                                    <li><div class="charge_option custom_radio"><label for="price-3">₹ {{getGST($payment['advance_total'])}}</label></div></li>
                                </ul>
                                
                                <ul class="charge_list option_list">
                                    <li>Total</li>
                                    <li><label for="price-2">₹ {{$payment['basic_total']+getGST($payment['basic_total'])}}</label></li>
                                    <li><label for="price-3">₹ {{$payment['advance_total']+getGST($payment['advance_total'])}}</label></li>
                                </ul>
                                

                                <!--<ul class="charge_list option_list">-->
                                <!--    <li>Total</li>-->
                                <!--    <li><span>₹ {{$payment['basic_total']}}</span></li>-->
                                <!--    <li><span>₹ {{$payment['advance_total']}}</span></li>-->
                                <!--</ul>-->
                            </div>
                            <!--<div class="gst_add">+GST Tax (18%) & Others</div>-->
                        </div>

<div style="display: flex; flex-direction: column; align-items: flex-end;">
    <a href="https://mintcream-snake-956030.hostingersite.com/refund-policy" 
       style="color: 	#909090; text-decoration: none; margin-top: 0px; margin-right: 2px; font-weight: 10px; font-size:13px">
        *Refund Policy
    </a>
    <div class="pricing_action">
        <a class="theme-btn" href="/services">
            <span>Apply Now</span>
        </a>
    </div>
</div>



                    </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="what_we_do_wrap">
                            <div class="what_we_do_heading">
                                <h3>What We Do for You:</h3>
                            </div>
                            <?php
                                $list = App\Models\Section::list(false, ['ids' => json_decode($data['what_we_dolist'], true), 'status' => true]);
                            ?>
                            @for($index = 0; $index < count($list); $index++)
                                @if(isset($data['what_we_do_'.$index]))
                                    <?php
                                        $item = collect($list)->where('id', $data['what_we_do_'.$index])->values();
                                        $details = [];
                                        if(!empty($item) && isset($item[0])) {
                                            $details = json_decode($item[0]['data'], true);
                                        }

                                    ?>
                                    <div class="info_row">
                                        <div class="icon_wrap">
                                            <img class="img-fluid" src="{{asset($details['image'] ?? '')}}" alt="">
                                        </div>
                                        <div class="info_content">
                                            <p><span>{{$details['title'] ?? ''}}:</span> {{$details['description'] ?? ''}}</p>
                                        </div>
                                    </div>

                                @endif
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(isset($data['section_title']) && !empty($data['section_title']))
        <section class="custom_plan_section">
            <div class="container">
                <div class="custom_plan">
                    <div class="plan_left">
                        <div class="icon_wrap">
                            <img class="img-fluid" src="{{asset($data['image'] ?? '')}}" alt="">
                        </div>
                        <div class="plan_content">
                            <div class="heading">
                                <h4>{{$data['section_title']}}</h4>
                            </div>
                            <p>{{$data['section_description']}}</p>
                        </div>
                    </div>
                    <div class="plan_right">
                        @if(isset($data['link_title']) && !empty($data['link_title']))
                            <a class="theme-btn" href="{{$data['link_url']}}"><span>{{$data['link_title']}}</span></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
