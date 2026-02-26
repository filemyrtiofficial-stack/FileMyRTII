

<section class="about_section_2" @if(isset($data['style'] ) && !empty($data['style'])) style="{{$data['style']}}" @endif>
    <div class="container about_container">
    @if(isset($data['title'] ) && !empty($data['title']))
            <div class="section_heading">
                <h2 class="fs-56 fw-700">{{$data['title'] ?? ''}} </h2>
            </div>
        @endif

        <div class="row about_row_bottom">
            <div class="col-12 col-sm-5">
                <div class="about_mission">
                    <div class="fs-24">
                    {!! $data['description'] ?? '' !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7">
                <div class="about_mission_img text-right">
                    <img class="img-fluid" src="{{asset($data['image_1'] ?? '')}}" alt="{{$data['image_1_alt'] ?? ''}}">
                </div>
            </div>
        </div>
    </div>
</section>