<section class="join_section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="team_img_wrap">
                            <img class="img-fluid" src="{{asset($data['image'] ?? '')}}" alt="{{$data['image_alt'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="team_content_wrap">
                            <div class="section_heading">
                                <h2>{!! $data['title'] ?? '' !!}</h2>
                            </div>
                            <div class="team_content">
                                {!! $data['description'] ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>