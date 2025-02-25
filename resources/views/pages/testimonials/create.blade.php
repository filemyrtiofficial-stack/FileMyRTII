@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('testimonials.index')}}">Testimonial</a></li>

@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endif
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Testimonial Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Testimonial</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('testimonials.update', $data['id']) : route('testimonials.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                   
                    <div class="row mt-5">
                        <div class="col-6">
                           <div class="form-group">
                            <label class="form-label">Name</label>
                                <div class="input-group">
                                    <input id="client_name" name="client_name" value="{{$data['client_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                </div>
                           </div>
                        </div>
                        

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control">
                                        @foreach(commonStatus() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Image  @if(isset($data)) <a target="blank" href="{{ asset($data->image) }}"><img width="20" src="{{ asset($data->image) }}" alt=""></a> @endif</label>
                                <div class="input-group">
                                    <input name="image" type="file" class="form-control dropify" id="image" @if(isset($data)) data-default-file="{{ asset($data->image) }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Comment</label>
                                <div class="input-group">
                                    <textarea name="comment" class="form-control" id="comment" rows="15">{{$data['comment'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection