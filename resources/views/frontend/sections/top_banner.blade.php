
<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset($data['top_banner_desktop_image'] ?? '')}}" alt="{{asset($data['top_banner_desktop_image_alt'] ?? '')}}">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">{{$data['title'] ?? ''}}</h4>
                </div>
            </div>
        </div>
    </div>
</section>

@if($key == 0 && $slug == 'blogs')
@include('frontend.sections.blog_listing')

@endif