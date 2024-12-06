@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Service</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('services.update', $data['id']) : route('services.store')}}"
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
                                    <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control enable-slug"
                                        type="text" placeholder="Name">
                                </div>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <label class="form-label">Slug</label>
                                <div class="input-group">
                                    <input id="slug" name="slug" value="{{$data->slug->slug ?? ''}}" class="form-control"
                                        type="text" placeholder="Slug">
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-6">
                           <div class="form-group">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $key => $item)
                                        <option value="{{$item->id}}" @if(isset($data['category_id']) && $data['category_id']==$item->id)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
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
                                <label class="form-label">Icon</label>
                                <div class="input-group">
                                    <input name="icon" type="file" class="form-control dropify" id="icon">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="description" rows="5">{{$data['description'] ?? ''}}</textarea>
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