
<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset($data['banner_image'] ?? '')}}" alt="{{asset($data['banner_image_alt'] ?? '')}}">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">{{$data['banner_title'] ?? ''}}</h4>
                </div>
                <a href="{{$data['banner_link_url'] ?? ''}}" class="theme-btn"><span>{{$data['banner_link_title'] ?? ''}}</span></a>
            </div>
        </div>
    </div>
</section>