

<?php

$list = App\Models\Section::list(false, ['ids' => json_decode($data['how_it_work_list'], true)]);
?>
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
            @for($index = 0; $index < $data['how_it_work_count']; $index++)
                <?php
                    $item = collect($list)->where('id', $data['how_it_work_'.$index])->values();
                    $details = [];
                    if(!empty($item)) {
                        $details = json_decode($item[0]['data'], true);
                    }
                ?>
                    <div class="col-12 col-sm-4">
                    <div class="process_flow">
                        <div class="process_icon">
                            <img class="img-fluid" src="{{asset($details['image'] ?? '')}}" alt="{{$details['image_alt'] ?? ''}}">
                        </div>
                        <div class="process_title fs-36 fw-700">{{$item['title'] ?? ''}}</div>
                        <div class="fs-24">
                            <p>{{$item['description'] ?? ''}}</p>
                        </div>
                    </div>
                </div>

            @endfor

            
          
        </div>
    </div>
</section>