
<?php

$blogs = App\Models\Blog::list(false, ['ids' => json_decode($data['blog_list'], true), 'status' => 2]);
?>

<section class="blog_section">
    <div class="container">
        <div class="section_heading">
            <h4 class="fs-56 fw-700">{!! $data['title'] ?? '' !!}</h4>
        </div>
        <div class="row">
            
            @for($index = 0; $index < $data['blog_count']; $index++)
                <?php
                    $item = collect($blogs)->where('id', $data['blog_'.$index])->where('status', 2)->values();
                    $value = $item[0] ?? [];
                ?>
                @if(!empty($value))
                 <div class="col-12 col-sm-4">
                    <div class="blog_item_wrapper">
                        <div class="blog_item">
                            <div class="blog_img">
                                <img class="img-fluid" src="{{asset($value['thumbnail'] ?? '')}}"
                                    alt="Blog Image">
                            </div>
                            <div class="blog_area">
                                <div class="blog_date fs-20">{{isset($value['publish_date']) ? Carbon\Carbon::parse($value['publish_date'])->format('M d, Y') :  ''}}</div>
                                <div class="blog_text fs-28 fw-600">
                                    <p>{{$value['title'] ?? ''}}
                                    </p>
                                </div>
                                <a href="{{route('blog-details',[$value->slugMaster->slug ?? ''])}}" class="theme-btn-link fs-28">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endfor

          
          
           
         
        </div>
        <div class="blog_cta">
            <a href="javascipt:void(0);" class="theme-btn"><span>View all blogs</span></a>
        </div>
    </div>
</section>