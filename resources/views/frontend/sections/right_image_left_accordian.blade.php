
<section class="vision_section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-5">
                <div class="section_heading vision_area">
                    <h3 class="fs-56 fw-700 title">
                    {!! $data['title'] ?? '' !!}</h3>
                </div>

                <div class="vision_accordion">
                    @foreach($data['accordian_title'] ?? [] as $key =>  $value)
                    <div class="accordion_item">
                                <div class="accordion_title @if($key == 0) active @endif"><h4>{!! $value !!}</h4></div>
                                <div class="accordion_content fs-24">
                                    <p>{{$data['accordian_description'][$key] ?? ''}}</p>
                                </div>
                            </div>

                       
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-sm-7">
                <div class="vision_img text-right">
                    <img class="img-fluid" src="{{asset($data['image_1'] ?? '')}}" alt="{{$data['image_1_alt'] ?? ''}}">
                </div>
            </div>
        </div>
    </div>
</section>