<?php

$service_categories = App\Models\ServiceCategory::list(false, ['ids' => json_decode($data['service_tabs_service_list'], true), 'status' => true]);
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
                    <div class="col-12">
                        <div class="rti_tab_wrapper">
                            <div class="rti_tabs">
                                <ul class="rti_tab_list rti_tab_slider">
                                    @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                                        <?php
                                            $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->where('status', true)->values();
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
                                            $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->where('status', true)->values();
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
                                                        <a href="{{route('frontend.service',[$item->slug->slug ?? ''])}}" class="theme-btn-link">Apply Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                       
                                        
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
                            @endfor
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>