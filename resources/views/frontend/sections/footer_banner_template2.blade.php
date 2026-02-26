<section class="cta_section job_section">
            <div class="cta_bg">
                <img class="cta_bg_img bg_img" src="{{asset($data['banner_image'] ?? '')}}" alt="{{asset($data['banner_image_alt'] ?? '')}}">
                <div class="container">
                    <div class="cta_text">
                        <div class="section_heading">
                            <h4 class="fs-56 fw-700">{{$data['title'] ?? ''}}</h4>
                        </div>
                        @if(isset($data['banner_link_title']) && !empty($data['banner_link_title'])) 
                        <a href="{{$data['banner_link_url'] ?? ''}}" class="theme-btn"><span>{{$data['banner_link_title'] ?? ''}}</span></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>