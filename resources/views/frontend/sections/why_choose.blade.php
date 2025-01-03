<section class="why_choose_section">
            <div class="container">
                <div class="row reason_row">
                    <div class="col-12 col-sm-4">
                        <div class="reason_area">
                            <div class="reason_title">
                                <h4>{{$data['title'] ?? ''}}</h4>
                            </div>
                            <div class="reason_content">
                                <p>{{$data['description'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <div class="reason_list_wrap">
                            <div class="reason_list_area">
                            <?php
                                $list = App\Models\Section::list(false, ['ids' => json_decode($data['why_chooselist'], true), 'status' => true]);
                            ?>
                                <div class="reason_list_col">
                                    @for($index = 0; $index <= 1; $index++)
                                        @if(isset($data['why_choose_'.$index]))
                                            <?php
                                                $item = collect($list)->where('id', $data['why_choose_'.$index])->values();
                                                $details = [];
                                                if(!empty($item) && isset($item[0])) {
                                                    $details = json_decode($item[0]['data'], true);
                                                }
                                            
                                            ?>
                                            <div class="reason_item">
                                                <div class="reason_img_wrap">
                                                    <img class="img-fluid" src="{{asset($details['image_2'] ?? '')}}" alt="">
                                                </div>
                                                <div class="reason_content">
                                                    <p>{{$details['description'] ?? ''}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                   
                                </div>
                                <div class="reason_list_col">
                                    @for($index = 2; $index <= 2; $index++)
                                        @if(isset($data['why_choose_'.$index]))

                                        <?php
                                            $item = collect($list)->where('id', $data['why_choose_'.$index])->values();
                                            $details = [];
                                            if(!empty($item) && isset($item[0])) {
                                                $details = json_decode($item[0]['data'], true);
                                            }
                                        
                                        ?>
                                    
                                        <div class="reason_item">
                                            <div class="reason_img_wrap">
                                                <img class="img-fluid" src="{{asset($details['image_2'] ?? '')}}" alt="">
                                            </div>
                                            <div class="reason_content">
                                                <p>{{$details['description'] ?? ''}} </p>
                                            </div>
                                        </div>
                                        @endif
                                    @endfor

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>