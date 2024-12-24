@extends('frontend.layout.layout')

@section('content')


@foreach($page_section as $key => $section)
<?php
$data = json_decode($section->data, true);
?>

@include('frontend.sections.' . $section->section_key)
@endforeach

      

     




@endsection
@push('js')

@endpush