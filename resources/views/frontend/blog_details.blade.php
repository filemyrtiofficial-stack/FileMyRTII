@extends('frontend.layout.layout')
@section('title')
{{$data->seo->meta_title ?? $data['title']}}
@endsection

@section('meta')
<meta name="description" value="{{$data->seo->meta_description ?? $data['title']}}">
@endsection
@section('content')
<style type="text/css">
        .copy-notification {
            color: #ffffff;
            background-color: #333333;
            padding: 20px;
            border-radius: 30px;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 150px;
            margin-top: -30px;
            margin-left: -85px;
            display: none;
            text-align:center;
        }
    </style>
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
                                <li class="blog_post_admin">By - {{$data['author'] ?? ''}}</li>
                            </ul>
                            <div class="blog_post_content">
                            {!! $data['description'] ?? '' !!}
                            </div>

                            <div class="blog_post_share_wrap">
                                <div class="blog_post_share">
                                    <div class="blog_share_heading">Share :</div>
                                    <ul class="blog_share_list">
                                    
                                        <li><a href="{{ shareUrl()['facebook'] }}" target="_blank"><img class="img-fluid" src="{{asset('assets/rti/images/blog-detail/fb_icon.webp')}}" alt=""></a></li>
                                        <li><a href="{{ shareUrl()['tweeter'] }}" target="_blank"><img class="img-fluid" src="{{asset('assets/rti/images/blog-detail/twitterx_icon.webp')}}" alt=""></a></li>
                                        <li><a href="{{ shareUrl()['linkedin'] }}" target="_blank"><img class="img-fluid" src="{{asset('assets/rti/images/blog-detail/linkedin_icon.webp')}}" alt=""></a></li>
                                        <li><a href="{{ shareUrl()['blogurl'] }}" id="copyButton"><img class="img-fluid" src="{{asset('assets/rti/images/blog-detail/email_link_icon.webp')}}" alt=""></a></li>
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

        
@if(!empty($footer_banner)) 
<section class="cta_section">
    <div class="cta_bg">
        <img class="cta_bg_img bg_img" src="{{asset($footer_banner['image'] ?? '')}}" alt="{{asset($footer_banner['image_alt'] ?? '')}}">
        <div class="container">
            <div class="cta_text">
                <div class="section_heading">
                    <h4 class="fs-56 fw-700">{{$footer_banner['description'] ?? ''}}</h4>
                </div>
                <a href="{{$footer_banner['link_url'] ?? ''}}" class="theme-btn"><span>{{$footer_banner['link_title'] ?? ''}}</span></a>
            </div>
        </div>
    </div>
</section>
@endif
        
  
@endsection
@push('js')

<script>
        $(document).ready(function() {
        var h2_count =   $('.blog_post_content h2').length;
        if(h2_count >0) {
       
            $('.blog_post_content h2').each(function() {
                var text = $(this).text();
                var trime_text = text.trim().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                $(this).attr('id', trime_text);
                $('.topic_wrap').show();
                $('#topics-list').append('<li class="topic_item"><a href="#'+trime_text+'">' +text + '</a></li>');
              
            });
        }else{
            $('.topic_wrap').hide();
        }
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

<script>
$(document).ready(function() {
    $('#copyButton').click(function(e) {
        e.preventDefault(); // Prevent the default anchor behavior (navigation)
        
        // Get the URL from the button's data attribute\
        var urlToCopy = $(this).attr('href');
        // var urlToCopy = $(this).data('url');
        // alert(urlToCopy);
        CopyToClipboard(urlToCopy, true, "Value copied");
    });

    function CopyToClipboard(value, showNotification, notificationText) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();

            if (typeof showNotification === 'undefined') {
                showNotification = true;
            }
            if (typeof notificationText === 'undefined') {
                notificationText = "Copied to clipboard";
            }

            var notificationTag = $("div.copy-notification");
            if (showNotification && notificationTag.length == 0) {
                notificationTag = $("<div/>", { "class": "copy-notification", text: notificationText });
                $("body").append(notificationTag);

                notificationTag.fadeIn("slow", function () {
                    setTimeout(function () {
                        notificationTag.fadeOut("slow", function () {
                            notificationTag.remove();
                        });
                    }, 1000);
                });
            }
        }
});
</script>


@endpush

