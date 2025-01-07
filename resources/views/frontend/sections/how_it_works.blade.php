<section class="process_section {!! $data['class_name'] ?? '' !!}">
    <div class="container">
        <div class="row process_head_row">
            <div class="col-12 col-sm-9">
                <div class="section_heading">
                    <h3 class="fs-56 fw-700">{!! $data['title'] ?? '' !!}</h3>
                </div>
            </div>
            @if(isset($data['how_it_work_link_title']) && !empty($data['how_it_work_link_title']))
            <div class="col-12 col-sm-3 know-more">
                <a href="{!! $data['how_it_work_link_url'] ?? '' !!}" class="theme-btn"><span>{!! $data['how_it_work_link_title'] ?? '' !!}</span></a>
            </div>
            @endif
        </div>
        <div class="row process_row">
            <?php
                $list = App\Models\Section::list(false, ['ids' => json_decode($data['how_it_work_list'], true), 'status' => true]);
            ?>
            @if(!empty($list))
                @for($index = 0; $index <  $data['how_it_work_count'] ?? 0; $index++)
                    @if(isset($data['how_it_work_'.$index]))
                    <?php
                            $item = collect($list)->where('id', $data['how_it_work_'.$index])->values();
                                $details = [];
                                if(!empty($item) && isset($item[0])) {
                                    $details = json_decode($item[0]['data'], true);
                                }
                        ?>
                        @if(!empty($item) && isset($item[0]))
                        <div class="col-12 col-sm-4">
                            <div class="process_flow">
                                <div class="process_icon">
                                    <img class="img-fluid" src="{{asset($details['image'] ?? '')}}" alt="{{$details['image_alt'] ?? ''}}">
                                </div>
                                <div class="process_title fs-36 fw-700">{{$details['title'] ?? ''}}</div>
                                <div class="fs-24">
                                    <p>{{$details['description'] ?? ''}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif

                @endfor
            @endif
            
          
        </div>
    </div>
</section>