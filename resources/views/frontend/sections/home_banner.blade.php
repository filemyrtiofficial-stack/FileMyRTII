<header class="section_banner">
    <div class="header_bg_img" style="background-image: url({{asset($data['home_banner_banner_desktop_image'] ?? '')}});">
        <div class="container">
            <div class="row banner_row">
                <div class="col-12 col-sm-6">
                    <div class="header_text">
                        <h1 class="title">{!! $data['home_banner_banner_title'] ?? '' !!}</h1>
                        <p class="fs-24">{!! $data['home_banner_banner_description'] ?? '' !!}</p>
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
                            @foreach($data['home_banner_banner_review_slider_title'] ?? [] as $key => $value)
                            <div class="item">
                                <div class="testimonial_slide">
                                    <div class="profile">
                                        <img class="img-fluid" src="{{asset('assets/rti/images/user.webp')}}"
                                            alt="profile pic">
                                    </div>
                                    <div class="slide_content">
                                        <div class="fs-20">
                                            <p>{!! $data['home_banner_banner_review_slider_description'][$key] ?? '' !!} </p>
                                        </div>
                                        <div class="fs-20">
                                            <div class="user-name fw-700">{!! $data['home_banner_banner_review_slider_title'][$key] ?? '' !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>