<section class="team_section">
    <div class="container">
        <div class="section_heading text-center">
            <h4>{!! $data['title'] ?? '' !!}</h4>
        </div>
        <div class="row team_row">
        <?php
                $list = App\Models\TeamMember::list(false, ['ids' => json_decode($data['team_list'], true), 'status' => true]);
            ?>
            @if(!empty($list))
            @for($index = 0; $index <  $data['team_count'] ?? 0; $index++)
                @if(isset($data['team_'.$index]))
                        <?php
                            $item = collect($list)->where('id', $data['team_'.$index])->values();
                        ?>
                        @if(!empty($item) && isset($item[0]))

                            <div class="col-4">
                                <div class="team_area">
                                    <div class="team_img">
                                        <img class="img-fluid" src="{{asset($item[0]['image'] ?? '')}}" alt="{{$item[0]['name'] ?? ''}}">
                                    </div>
                                    <div class="team_wrapper">
                                        <div class="team_post">
                                            <div class="team_post_name"><p>{{$item[0]['expertise'] ?? ''}}</p></div>
                                            <div class="team_shape"></div>
                                            <div class="team_name">{{$item[0]['name'] ?? ''}}</div>
                                            <div class="team_content fs-24">
                                                <p>{{$item[0]['about'] ?? ''}}</p>
                                            </div>
                                        </div>
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