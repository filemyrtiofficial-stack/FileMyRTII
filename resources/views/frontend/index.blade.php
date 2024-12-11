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
                $('.blog-listing').html(response.html)
            },
            error :  function(error) {

            }
        })
    }
</script>
@endpush