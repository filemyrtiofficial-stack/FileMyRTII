<section class="why_work_section">
            <div class="container">
                <div class="section_heading">
                    <h2>{!! $data['title'] ?? '' !!}</h2>
                </div>
                <div class="work_item_wrap">
                <?php
                $list = App\Models\Section::list(false, ['ids' => json_decode($data['join_our_team_list'], true), 'status' => true]);
            ?>
            @if(!empty($list))
                @for($index = 0; $index <  $data['join_our_team_count'] ?? 0; $index++)
                    @if(isset($data['join_our_team_'.$index]))
                    <?php
                            $item = collect($list)->where('id', $data['join_our_team_'.$index])->values();
                                $details = [];
                                if(!empty($item) && isset($item[0])) {
                                    $details = json_decode($item[0]['data'], true);
                                }
                        ?>
                        @if(!empty($item) && isset($item[0]))
                    <div class="single_work_item">
                        <div class="work_item">
                            <div class="work_icon">
                                <img class="img-fluid" src="{{asset($details['image'] ?? '')}}" alt="{{$details['image_alt'] ?? ''}}">
                            </div>
                            <div class="work_content">
                                <h4 class="work_heading">{!! $details['title'] ?? '' !!}</h4>
                                <p>{!! $details['description'] ?? '' !!}</p>
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
