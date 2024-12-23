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
    <div>
        <div>
            {!! $data['description'] ?? '' !!}
        </div>
        <div></div>
    </div>
@endsection
@push('js')

@endpush

