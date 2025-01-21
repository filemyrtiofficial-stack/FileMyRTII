@extends('frontend.layout.layout')

@section('title')
{{$seo->meta_title}}
@endsection

@section('meta')
<meta name="description" value="{{$seo->meta_description}}">
@endsection
@section('content')

@foreach($page_section as $key => $section)
<?php
$data = json_decode($section->data, true);
?>

@include('frontend.sections.' . $section->section_key)
@endforeach

@endsection
@push('js')
<script>
    blogList()
    function blogList(data) {
        $('.blog_pagination').html('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : "{{route('search-blogs')}}",
            type : 'post',
            data : data,
            dataType : 'json',
            success : function(response) {
                $('.blog-listing').append(response.html)
                if(response.pages.current_page < response.pages.last_page) {
                    $('.blog_pagination').html(`<button class="load-more-blog theme-btn" data-page="${response.pages.next_page}"><span>Load More</span></button>`)
                }
               
            },
            error :  function(error) {

            }
        })
    }
    $(document).on('keyup', '.search-blog', function(e){
        $('.blog-listing').html('');
        blogList({search : $(this).val(), 'page'  : 1});
        
    });
    $(document).on('click', '.load-more-blog', function(e){
        let search = $('.search-blog').val();
        let page = $(this).attr('data-page');
        blogList({search : search, 'page'  : page});

    });
</script>
@endpush