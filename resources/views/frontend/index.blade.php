@extends('frontend.layout.layout')

@section('title')
Home
@endsection

@section('content')

@foreach($page_section as $section)
<?php
$data = json_decode($section->data, true);
?>
@include('frontend.sections.' . $section->section_key)
@endforeach






@endsection