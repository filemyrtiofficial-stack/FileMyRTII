<?php

$testimonials = App\Models\Testimonial::list(false, ['ids' => json_decode($data['testimonial_list'], true), 'status' => true]);
?>

<section class="testimonials_section">
            <div class="container">
                <div class="row testimonial_head_row">
                    <div class="col-9 col-sm-9">
                        <div class="section_heading">
                            <h3>Testimonials</h3>
                        </div>
                    </div>
                    <div class="col-3 col-sm-3 testimonial_btns">
                        <ul class="testimonial_client_btn_wrap">
                            <li class="prev_btn"><img class="img-fluid" src="{{asset('assets/rti/images/service-listing/left_arrow.svg')}}" alt=""></li>
                            <li class="next_btn"><img class="img-fluid" src="{{asset('assets/rti/images/service-listing/right_arrow.svg')}}" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="row testimonial_row">
                    <div class="col-12 col-sm-12">
                        <div class="testimonial_slider_wrap">
                            <div class="testimonial_client_slider">
                                @for($index = 0; $index < $data['testimonial_count']; $index++)
                                    <?php
                                        $item = collect($testimonials)->where('id', $data['testimonial_'.$index])->where('status', true)->values();
                                    ?>
                                    @if(count($item) > 0)
                                    <div class="testimonial_item_wrap">
                                        <div class="testimonial_item">
                                            <div class="quote_left quote_left_img">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/service-listing/quote-left.webp')}}" alt="">
                                            </div>
                                            <div class="testimonial_img_wrap">
                                                <img class="img-fluid" src="{{asset($item[0]['image'] ?? '')}}" alt="">
                                            </div>
                                            <div class="testimonial_profile_name">
                                                <h5>{{$item[0]['client_name'] ?? ''}}</h5>
                                            </div>
                                            <div class="testimonial_content">
                                                <p>{!! $item[0]['comment'] ?? '' !!}</p>
                                            </div>
                                            <div class="quote_right quote_right_img">
                                                <img class="img-fluid" src="{{asset('assets/rti/images/service-listing/quote-right.webp')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endfor

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>