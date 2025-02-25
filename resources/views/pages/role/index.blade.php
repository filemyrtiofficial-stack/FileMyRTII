
@extends('layouts.app')

@section('breadcrumbs')

<li class="breadcrumb-item active" aria-current="page">Roles</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Role Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Role</h4>
                @if(auth()->user()->can('Create Role')  )
                <a href="{{route('roles.create')}}" class="btn btn-primary float-end">Add
                Role</a>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Permission
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                    @if(auth()->user()->can('Edit Role') || auth()->user()->can('Delete Role') )
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                                    @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="permission-list-section">
                                    @foreach($item['permissions'] as $key => $value)
                                        <span class="permission-list">{{$value['name'] ?? ''}}</span>
                                    @endforeach
                                    </div>
                                </td>

                                
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit Role') || auth()->user()->can('Delete Role') )
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                   
                                    @if(auth()->user()->can('Edit Role')  )
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('roles.edit', $item->id)}}">Edit</a>
                                    @endif
                                    @if(auth()->user()->can('Delete Role') )
                                        <a href="{{route('roles.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
                                    @endif
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>
@endsection