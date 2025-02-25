@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('template-section.index')}}">Sections</a></li>
@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endif
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>{{isset($data['id']) ? 'Edit' : 'New'}} @if(isset($_GET['type'])) {{sectionTypeList()[$_GET['type']]['title'] ?? ''}} @else {{sectionTypeList()[$data['type']]['title'] ?? ''}}  @endif Section</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('template-section.update', $data['id']) : route('template-section.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    @if(isset($_GET['type']))
                    <input hidden name="section_type" value="{{$_GET['type'] ?? ''}}">
                    @endif
                    <div class="row mt-5">
                        <!-- <div class="col-8">
                            <div class="form-group"> 
                                <label class="form-label">Title</label>
                                <div class="input-group">
                                    <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Title">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <div class="form-group"> 
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="description">{{$data['description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label class="form-label">Image @if(isset($details)) <a target="blank" href="{{ asset($details['image'] ?? '' ) }}"><img width="50" src="{{ asset($details['image'] ?? '' ) }}" alt=""></a> @endif</label>
                                <div class="input-group">
                                    <input type="file" class=" upload-image dropify" id="images" @if(isset($data)) data-default-file="{{asset($details['image'] ?? '')}}" @endif>
                                    <div class="image-collection mt-3" >
                                        <input hidden type="text" value="{{$details['image'] ?? ''}}"  class="form-control image-input" name="image" data-lable="image" id="image">
                                        <input placeholder="Alternative text" type="text" value="{{$details['image_alt'] ?? ''}}" id="image_alt" name="image_alt" class="form-control w-100">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <?php
                        $fields = [];
                        if(isset($_GET['type'])) {
                            $fields = sectionTypeList()[$_GET['type']]['fields'];
                        }
                        else {
                            $fields = sectionTypeList()[$data['type']]['fields'];

                        }
                        ?>
                        @if(isset($fields))
                        
                            @foreach($fields as $key =>  $fields)
                                @if($fields['type'] == 'link')
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">CTA Button</label>
                                        <div class="input-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label">Title</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$details['link_title'] ?? ''}}" name="link_title" data-lable="link_title" id="link_title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label">Url</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$details['link_url'] ?? ''}}" name="link_url" data-lable="link_url" id="link_url">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-6">
                                <div class="form-group"> 
                                    <label class="form-label">{{$fields['label'] ?? ''}}</label>
                                    <div class="input-group">
                                        @if($fields['type'] == 'input')
                                            <input id="{{$fields['name']}}" name="{{$fields['name']}}" value="{{$data[$fields['name']] ?? ''}}" class="form-control" type="text" placeholder="Title">
                                        @elseif($fields['type'] == 'numeric')
                                            <input id="{{$fields['name']}}" name="{{$fields['name']}}" value="{{$data[$fields['name']] ?? ''}}" class="form-control" type="number" placeholder="Title">
                                    
                                            @elseif($fields['type'] == 'image')
                                        <input type="file" class=" upload-image dropify" id="{{$fields['name']}}" @if(isset($data)) data-default-file="{{asset($details[$fields['name']] ?? '')}}" @endif>
                                        <div class="image-collection mt-3" >
                                            <input hidden type="text" value="{{$details[$fields['name']] ?? ''}}"  class="form-control image-input" name="{{$fields['name']}}" data-lable="{{$fields['name']}}" id="{{$fields['name']}}">
                                            <input placeholder="Alternative text" type="text" value="{{$details[$fields['name'].'_alt'] ?? ''}}" id="{{$fields['name']}}_alt" name="{{$fields['name']}}_alt" class="form-control w-100">
                                        </div>
                                        @elseif($fields['type'] == 'textarea')
                                        <textarea name="description" class="form-control" id="{{$fields['name']}}">{{$data[$fields['name']] ?? ''}}</textarea>
                                        @elseif($fields['type'] == 'select')
                                        <select name="status" id="status" class="form-control">
                                            @foreach($fields['options'] as $key => $item)
                                            <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        
                        @endif
                       
                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
</div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection