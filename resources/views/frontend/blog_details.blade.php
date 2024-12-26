@extends('frontend.layout.layout')
@section('title')
{{$data->seo->meta_title ?? $data['title']}}
@endsection

@section('meta')
<meta name="description" value="{{$data->seo->meta_description ?? $data['title']}}">
@endsection
@section('content')

    <header class="breadcrumb_banner">
        <img class="img-fluid bg_img" src="{{asset($data['banner'] ?? '')}}" alt="{{asset($data['title'] ?? '')}}">
            <div class="container">
                <div class="row banner_row">
                    <div class="col-12 col-sm-12">
                        <div class="breadcrumb">
                            <ol>
                            <li class="fs-24"><a href="/">Home</a></li>
                            <li class="fs-24"><a href="/blogs">Blog</a></li>
                            <li class="fs-24 active">{{$data['title'] ?? ''}}</li>
                            </ol>
                        </div>
                        <div class="breadcrumb_heading">
                            <h1 class="title fs-72">{{$data['title'] ?? ''}}</h1>
                        </div>
                    </div>
                </div>
            </div>
    </header>

    <section class="blog_detail_section">
            <div class="container">
                <div class="row blog_row">
                    <div class="col-12 col-sm-8">
                        <div class="blog_post_wrap">
                            <ul class="blog_post_list">
                                <li class="blog_post_date"> {{Carbon\Carbon::parse($data['publish_date'])->format('jS \of M. Y')}}</li>
                                <li class="blog_post_admin">By - Lorem ipsum dolor</li>
                            </ul>
                            <div class="blog_post_content">
                            {!! $data['description'] ?? '' !!}
                            </div>

                            <div class="blog_post_share_wrap">
                                <div class="blog_post_share">
                                    <div class="blog_share_heading">Share :</div>
                                    <ul class="blog_share_list">
                                        <li><a href="javascript:void(0);"><img class="img-fluid" src="images/blog-detail/fb_icon.webp" alt=""></a></li>
                                        <li><a href="javascript:void(0);"><img class="img-fluid" src="images/blog-detail/twitterx_icon.webp" alt=""></a></li>
                                        <li><a href="javascript:void(0);"><img class="img-fluid" src="images/blog-detail/linkedin_icon.webp" alt=""></a></li>
                                        <li><a href="javascript:void(0);"><img class="img-fluid" src="images/blog-detail/email_link_icon.webp" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="blog_post_comment_wrap">
                                <div class="blog_post_wrap">
                                    <div class="blog_post_heading">
                                        <h5>Post a comment</h5>
                                    </div>
                                    <div class="comment_form_area">
                                        <div class="comment_form">
                                            <form action="{{route('blog-Comment')}}" class="contctus-form-submit" method="post">
                                            
                                                <input type="hidden" name="blog_id" id="contact_blog_id"   value="{!! $data['id'] ?? '' !!}">
                                                <div class="form_item col_2">
                                                    <div class="form_item">
                                                        <input class="form_field" type="text" name="first_name" id="contact_first_name" placeholder="First Name">
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="text" name="last_name" id="contact_last_name" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="form_item">
                                                    <input class="form_field" type="email" name="email" id="contact_email" placeholder="E-mail">
                                                </div>
                                                <div class="form_item">
                                                    <textarea class="form_field" rows="3" type="text" name="comment" id="contact_comment" placeholder="Comment"></textarea>
                                                </div>
                                                <button type="submit" class="theme-btn"><span>Submit</span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="topic_wrap">
                            <div class="topic_area">
                                <div class="topic_heading">
                                    <h5 class="heading">Topics</h5>
                                </div>
                                <div class="topic_list_wrap">
                                    <ul class="topic_list" id="topics-list">
                                     
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="related_blog_wrap">
                            <div class="related_blog_area">
                                <div class="related_blog_heading">
                                    <h5 class="heading">Other related blogs </h5>
                                </div>
                                <div class="related_blog_list_wrap">
                                    <ul class="related_blog_list">
                                        @foreach($relatedBlogs as $blog )
                                        <li class="related_blog_item active"><a href="{{$blog->slug}}">{{$blog->title}}</a></li>
                                      @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>



@endsection
@push('js')

<script>
        $(document).ready(function() {
           
            $('.blog_post_content h2').each(function() {
                var text = $(this).text();
                var trime_text = text.trim().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                $(this).attr('id', trime_text);
                $('#topics-list').append('<li class="topic_item"><a href="#'+trime_text+'">' +text + '</a></li>');
              
            });
            $('#topics-list li:first').addClass('active');

            $('.topic_item').click(function(e) {
                e.preventDefault(); 
                $(this).siblings().removeClass('active');       
                $(this).addClass('active');
                var targetId = $(this).find('a').attr('href'); 
                
            $('html, body').animate({
                scrollTop: $(targetId).offset().top-150 
            }, 1000); 
           });
        });
    </script>
@endpush

