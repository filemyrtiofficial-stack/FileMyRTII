<?php

$service_categories = App\Models\ServiceCategory::list(false, ['ids' => json_decode($data['service_tabs_service_list'], true), 'status' => true]);
?>



<section class="rti_section @if(isset($data['description_enable']) && $data['description_enable'] == 'yes') rti_detail_section @endif {!! $data['class_name'] ?? '' !!}">
            <div class="container">
                @if(isset($data['title']) && !empty($data['title']))
                <div class="row">
                    <div class="col-12 col-sm-9">
                        <div class="section_heading">
                            <h2 class="fs-56 fw-700">{!! $data['title'] ?? '' !!}</h2>
                        </div>
                    </div>
                </div>
                @endif
               
                <div class="row">
                    <div class="col-12">
                        @if($data['service_tabs_service_count'] > 1)
                            <div class="rti_tab_wrapper">
                                <div class="rti_tabs">
                                    <ul class="rti_tab_list rti_tab_slider">
                                        @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                                            <?php
                                                $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->where('status', true)->values();
                                            ?>
                                            @if(count($item) > 0 )
                                        
                                            <li id="sevice_tab-{{$index}}"><a class="rti_tab_item {{ (!isset($data['service_tab']) && $index == 0) ||(isset($data['service_tab']) && $data['service_tab'] == $index) ? 'active': ''}} fs-28" href="javascript:void(0);" data-toggle="tab" data-id="rti_tab{{$index}}"><span>{{ $item[0]['name'] ?? ''}}</span></a></li>
                                            @endif
                                        @endfor
                                
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="rti_tab_details">
                            @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                                <div class="rti_tab {{ (!isset($data['service_tab']) && $index == 0) ||(isset($data['service_tab']) && $data['service_tab'] == $index) ? 'tab-active': ''}} " data-id="rti_tab{{$index}}" id="rti_tab{{$index}}">
                                    <div class="rti_wrapper">

                                        <?php
                                            $item = collect($service_categories)->where('id', $data['service_tabs_service_'.$index])->where('status', true)->values();
                                        ?>
                                        @if(count($item) > 0)

                                            @foreach($item[0]['services'] ?? [] as $key =>  $item)
                                                <?php $field_data =  json_decode($item->fields, true)?>
                                                 
                                                @if(!isset($item['create_new_page']) || (isset($item['create_new_page']) && $item['create_new_page']== 'yes') )
                                                    <div class="rti_block">
                                                    @if(isset($data['description_enable']) && $data['description_enable'] == 'yes')
                                                        <div class="rti_item">
                                                            <div class="rti_scroll">
                                                                <div class="rti_img">
                                                                    <img class="img-fluid"
                                                                        src="{{asset($item['icon'] ?? '')}}" alt="">
                                                                </div>
                                                                <div class="rti_content fs-28">{{$item['name'] ?? ''}}</div>
                                                                @if(isset($data['description_enable']) && $data['description_enable'] == 'yes')
                                                                    
                                                                    <div class="rti_content">
                                                                        {!! $item['description'] ?? '' !!}
                                                                    </div>
                                                                    <a href="{{route('frontend.service',[$item->category->slug->slug ?? '', $item->slug->slug ?? ''])}}" class="theme-btn-link">Know More</a>
                                                                    
                                                                @endif
                                                                <a href="{{route('frontend.service.form',[$item->category->slug->slug ?? '', $item->slug->slug ?? ''])}}" class="theme-btn-link">Apply Now</a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="{{route('frontend.service.form',[$item->category->slug->slug ?? '', $item->slug->slug ?? ''])}}" class="desktop-rti_item">
                                                            <div class="rti_item">
                                                                <div class="rti_scroll">
                                                                    <div class="rti_img">
                                                                        <img class="img-fluid"
                                                                            src="{{asset($item['icon'] ?? '')}}" alt="">
                                                                    </div>
                                                                    <div class="rti_content fs-28">{{$item['name'] ?? ''}}</div>
                                                                    
                                                                    <span class="theme-btn-link">Apply Now</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                           <div class="rti_item mobile-rti_item" style="display:none">
                                                                <div class="rti_scroll">
                                                                    <div class="rti_img">
                                                                        <img class="img-fluid"
                                                                            src="{{asset($item['icon'] ?? '')}}" alt="">
                                                                    </div>
                                                                    <div class="rti_content fs-28">{{$item['name'] ?? ''}}</div>
                                                                    
                                                                    <a href="{{route('frontend.service.form',[$item->category->slug->slug ?? '', $item->slug->slug ?? ''])}}"><span class="theme-btn-link">Apply Now</span></a>
                                                                </div>
                                                            </div>
                                                    @endif
                                                    
                                                    
                                                    </div>
                                                    @elseif(str_contains($item->slug->slug, $item->category->slug->slug."-custom-request"))
                                                     <div class="rti_block rti_block_ad">
                                                        <a href="{{route('frontend.service.form',[$item->category->slug->slug ?? '', 'custom-request'])}}">
                                                            
                                                            <div class="rti_item active">
                                                                <div class="rti_scroll">
                                                                    <div class="rti_img">
                                                                        <img class="img-fluid" src="{{asset('assets/rti/images/think-question.webp')}}" alt="">
                                                                    </div>
                                                                    <div class="rti_content fs-28">Can't find what you need?</div>
                                                                    <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <!--@if($item && $item->category)-->
                                            <!--<div class="rti_block rti_block_ad">-->
                                            <!--    <a href="{{route('frontend.service.form',[$item->category->slug->slug ?? '', 'custom-request'])}}">-->
                                                    
                                            <!--        <div class="rti_item active">-->
                                            <!--            <div class="rti_scroll">-->
                                            <!--                <div class="rti_img">-->
                                            <!--                    <img class="img-fluid" src="{{asset('assets/rti/images/think-question.webp')}}" alt="">-->
                                            <!--                </div>-->
                                            <!--                <div class="rti_content fs-28">Can't find what you need?</div>-->
                                            <!--                <div class="rti_content more_content fs-28">We're ready to help-just submit your request</div>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </a>-->
                                            <!--</div>-->
                                            <!--@endif-->
                                            @endif
                                    </div>
                                </div>
                            @endfor
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>