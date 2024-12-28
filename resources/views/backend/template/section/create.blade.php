@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Section</h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('template-section.update', $data['id']) : route('template-section.store')}}"
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
                                    <input id="name" name="name" value="{{$data['section'] ?? ''}}" class="form-control enable-slug"
                                        type="text" placeholder="Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"> 
                                <label class="form-label">Slug</label>
                                <div class="input-group">
                                    <input id="slug" name="slug" value="{{$data->slugMaster->slug ?? ''}}" class="form-control"
                                        type="text" placeholder="Slug">
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-6">
                            <div class="form-group"> 
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="description">{{$data['description'] ?? ''}}</textarea>
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