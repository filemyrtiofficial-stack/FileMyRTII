
<section class="blog_section">
    <div class="container">
        <div class="section_heading">
            <h4 class="fs-56 fw-700">{!! $data['our_blogs_title'] ?? '' !!}</h4>
        </div>
        <div class="row">
            @if(is_array($data['our_blogs_blog_list']))
            <?php
                $blog_list = App\Models\Blog::list(false, ['ids' => $data['our_blogs_blog_list']]);
            ?>
            @else
            <?php
                $blog_list = App\Models\Blog::list(false, ['ids' => [$data['our_blogs_blog_list']]]);
            ?>
            @endif
            @foreach($blog_list as $value)
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
                                <a href="" class="theme-btn-link fs-28">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
          
           
         
        </div>
        <div class="blog_cta">
            <a href="javascipt:void(0);" class="theme-btn"><span>View all blogs</span></a>
        </div>
    </div>
</section>