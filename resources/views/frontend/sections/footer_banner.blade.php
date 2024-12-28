
<?php
    $data = App\Models\Section::list(false, ['ids' => [$data['banner']], 'status' => true]);
    $detail = [];
    if(count($data) > 0) {
        $data = $data[0];
        $detail = json_decode($data->data, true);
    }
?>
@if(!empty($data)) 
<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset($detail['image'] ?? '')}}" alt="{{asset($detail['image_alt'] ?? '')}}">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">{{$detail['description'] ?? ''}}</h4>
                </div>
                <a href="{{$detail['link_url'] ?? ''}}" class="theme-btn"><span>{{$detail['link_title'] ?? ''}}</span></a>
            </div>
        </div>
    </div>
</section>
@endif