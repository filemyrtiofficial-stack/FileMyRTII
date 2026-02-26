@extends('frontend.layout.layout')

@section('title')
{!! $seo->meta_title !!}
@endsection

@section('meta')
<meta name="description" content="{!! $seo->meta_description !!}">
@endsection
@section('content')

@if(count($page_section) > 0)
@foreach($page_section as $key => $section)
<?php
$data = json_decode($section->data, true);
?>

@include('frontend.sections.' . $section->section_key)
@endforeach
    
@else
<section class="why_work_section">
            <div class="container">
{!! $page->description !!}
</div>
</section>
@endif
@endsection
@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "FileMyRTI",
  "url": "https://filemyrti.com",
  "logo": "https://filemyrti.com/assets/images/logo.webp",
  "description": "{!! $seo->meta_description ?? 'File RTI online easily with India’s most trusted platform for filing, tracking, appeals & more.' !!}",
  "sameAs": [
    "https://www.linkedin.com/company/filemyrti/",
    "https://www.facebook.com/profile.php?id=61572512135057&sk=about",
    "https://x.com/FileMyRTI",
    "https://www.instagram.com/filemyrtiofficial/",
    "https://www.youtube.com/@FileMyRTI"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91-9911100589",
    "contactType": "Customer Support",
    "areaServed": "IN",
    "availableLanguage": ["English", "Hindi", "Telugu"]
  }
}
</script>
@endsection


@push('js')
<script>
     blogList()
    function getQueryParam(name) {
    const results = new RegExp('[?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results ? decodeURIComponent(results[1].replace(/\+/g, ' ')) : null;
}
    function blogList(data) {
        $('.blog_pagination').html('');
        const page = getQueryParam('page'); 
        const search = getQueryParam('search'); 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : "{{route('search-blogs')}}",
            type : 'post',
            data : {page:page, search:search},
            dataType : 'json',
            success : function(response) {
                $('.blog-listing').append(response.html)
                // if(response.pages.current_page < response.pages.last_page) {
                //     $('.blog_pagination').html(`<button class="load-more-blog theme-btn" data-page="${response.pages.next_page}"><span>Load More</span></button>`)
                // }

                $('.blog_pagination').html(response.pagination)
               
            },
            error :  function(error) {

            }
        })
    }
    $(document).on('submit', '.blog-search', function(e){
        $('.blog-listing').html('');
           let search = $('.search-blog').val();
        // let page = $(this).attr('data-page');
        window.location.href = "/blogs?page=1&search="+search;
        // blogList({search : $(this).val(), 'page'  : 1});
        
    });
    $(document).on('click', '.go-to-page', function(e){
        e.preventDefault();
            let search = $('.search-blog').val();
        let page = $(this).attr('data-page');
        window.location.href = "/blogs?page="+page+"&search="+search;
        // blogList({search : search, 'page'  : page});
    })
    // $(document).on('click', '.load-more-blog', function(e){
    //     let search = $('.search-blog').val();
    //     let page = $(this).attr('data-page');
    //     blogList({search : search, 'page'  : page});

    // });
</script>
@endpush