
<section class="process_section ">
    <div class="container">
        <div class="row process_head_row">
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h3 class="fs-56 fw-700">{!! $data['how_it_work_title'] ?? '' !!}</h3>
                </div>
            </div>
            <div class="col-12 col-sm-3 know-more">
                <a href="{!! $data['how_it_work_link_url'] ?? '' !!}" class="theme-btn"><span>{!! $data['how_it_work_link_title'] ?? '' !!}</span></a>
            </div>
        </div>
        <div class="row process_row">
            @for($index = 0; $index < $data['step_list_row_count'] ?? 1; $index++)
            <div class="col-12 col-sm-4">
                <div class="process_flow">
                    <div class="process_icon">
                        <img class="img-fluid" src="{{asset($data['step_image_'.$index] ?? '')}}" alt="{{$data['step_image_alt_'.$index] ?? ''}}">
                    </div>
                    <div class="process_title fs-36 fw-700">{{$data['step_title_'.$index] ?? ''}}</div>
                    <div class="fs-24">
                        <p>{{$data['step_description_'.$index] ?? ''}}</p>
                    </div>
                </div>
            </div>
            @endfor
          
        </div>
    </div>
</section>