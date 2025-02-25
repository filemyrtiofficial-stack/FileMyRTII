
@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('roles.index')}}">Roles</a></li>
@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>

@endif


@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Role Management'])
<div class="row  mb-5">
    <div class="col-lg-12 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Role</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('roles.update', $data['id']) : route('roles.store')}}"
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
                                    <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            @foreach(permissionList(0) as $key =>  $parent)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <!-- <input type="checkbox"  id="parent_{{$parent->id}}" value="{{$parent->id}}" class="parents-permissions" data-target="child-{{$parent->id}}"> -->
                                            <label for="parent_{{$parent->id}}">{{$parent->name}}</label>
                                        </div>
                                        <div class="col-md-10 row">
                                            @foreach(permissionList($parent->id) as $key =>  $value)
                                                <div class="col-md-4">
                                                    <input type="checkbox" id="{{$value->id}}" value="{{$value->name}}" @if(isset($permissions) && in_array($value->name, $permissions)) checked @endif class="child-{{$parent->id}} childs" data-parent="parent_{{$parent->id}}" name="permissions[]">
                                                    <label for="{{$value->id}}">{{$value->name}}</label>
                                                </div>
                                            @endforeach
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
@push('js')
<script>
    $(document).on('change', '.parents-permissions', function(e){
        let target = $(this).attr('data-target');
        if(this.checked) {

            $('.'+target).attr('checked', 'checked');
        }
        else {
            $('.'+target).removeAttr('checked');

        }
    });
    $(document).on('change', '.childs', function(e){
        let target = $(this).attr('data-parent');
        if( !this.checked) {
        $('#'+target).removeAttr('checked');
        }

    })
</script>
@endpush