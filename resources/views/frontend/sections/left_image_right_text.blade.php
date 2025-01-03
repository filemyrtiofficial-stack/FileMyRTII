



@if(isset($data['partition']) && $data['partition'] == '5-6')

<section class="service_about_section">
            <div class="container">
                @if(isset($data['title']) && !empty($data['title']))
                    <div class="section_heading">
                        <h2>{{$data['title'] ?? ''}}</h2>
                    </div>
                @endif
                <div class="row service_about_row">
                    <div class="col-12 col-sm-5">
                        <div class="service_about_img">
                            <div class="about_lg">
                                <img class="img-fluid" src="{{asset($data['image_1'] ?? '')}}" alt="{{$data['image_1_alt'] ?? ''}}">
                                @if(isset($data['image_2']) && !empty($data['image_2']))
                                <div class="about_sm">
                                    <img class="img-fluid" src="{{asset($data['image_2'] ?? '')}}" alt="{{$data['image_2_alt'] ?? ''}}">
                                </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="service_about_area">
                            {!! $data['description'] ?? '' !!}
                            @if(isset($data['link_title']) && !empty($data['link_title']))
                            <a href="{{$data['link_url']}}" class="theme-btn"><span>{{$data['link_title'] ?? ''}}</span></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>



@else
<section class="about_section ">
            <div class="container">
                <div class="section_heading">
                    <h2>{{$data['title'] ?? ''}}</h2>
                </div>
                <div class="row about_row_top">
                    <div class="col-12   col-sm-6 ">
                        <div class="about_img">
                            <div class="about_lg">
                            <img class="img-fluid" src="{{asset($data['image_1'] ?? '')}}" alt="{{$data['image_1_alt'] ?? ''}}">
                                @if(isset($data['image_2']) && !empty($data['image_2']))
                                <div class="about_sm">
                                    <img class="img-fluid" src="{{asset($data['image_2'] ?? '')}}" alt="{{$data['image_2_alt'] ?? ''}}">
                                </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="about_area fs-24">
                             {!! $data['description'] ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endif
        
       