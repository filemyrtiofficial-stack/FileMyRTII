
<header class="section_banner">
    <div class="header_bg_img" style="background-image: url({{asset($data['home_banner_banner_desktop_image'] ?? '')}});">
        <div class="container">
            <div class="row banner_row">
                <div class="col-12 col-sm-6">
                    <div class="header_text">
                        <h1 class="title">{!! $data['title'] ?? '' !!}</h1>
                        <p class="fs-24">{!! $data['home_banner_description'] ?? '' !!}</p>
                        <a href="{!! $data['home_banner_banner_link_url'] ?? '' !!}" class="theme-btn"><span>{!! $data['home_banner_banner_link_title'] ?? '' !!}</span></a>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mobile_img">
                        <img class="img-fluid" src="{{asset($data['home_banner_banner_mobile_image'] ?? '')}}" alt="{{$data['home_banner_banner_mobile_image_alt'] ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="row testimonial_row">
                <div class="col-auto">
                    <div class="slider_wrapper">
                        <div class="testimonial_slider">
                            @for($index = 0; $index < $data['banner_slider_list_row_count'] ?? 1; $index++)
                                <div class="item">
                                    <div class="testimonial_slide">
                                        <div class="profile">
                                            <img class="img-fluid" src="{{asset($data['home_banner_banner_review_slider_image_'.$index] ?? '')}}"
                                                alt="{{$data['home_banner_banner_review_slider_image_alt_'.$index] ?? ''}}">
                                        </div>
                                        <div class="slide_content">
                                            <div class="fs-20">
                                                <p>{!! $data['home_banner_banner_review_slider_description_'.$index] ?? '' !!} </p>
                                            </div>
                                            <div class="fs-20">
                                                <div class="user-name fw-700">
                                                {!! $data['home_banner_banner_review_slider_title_'.$index] ?? '' !!}    
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
        </div>
    </div>
</header>