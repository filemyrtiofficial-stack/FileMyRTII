@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Lawyers</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lawyer Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Lawyer</h4>
                @if(auth()->user()->can('Create Lawyer'))
                <a href="{{route('lawyers.create')}}" class="btn btn-primary float-end">Add
                Lawyer</a>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Number
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email ID
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Total Applications</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                @if(auth()->user()->can('Edit Lawyer') || auth()->user()->can('Delete Lawyer') )
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div>
                                            <img src="{{ asset($item->image) }}" class="avatar me-3"
                                                alt="image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ stringLimit($item->fullName, 20) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">{{$item->phone?? ''}}</td>
                                <td class="align-middle text-sm">{{$item->email?? ''}}</td>
                                <td class="align-middle text-center"><a target="blank" href="{{route('rti.applications.list')}}?lawyer_id={{$item->id}}">{{count($item->rtiApplications)}}</a></td>
                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit Lawyer') || auth()->user()->can('Delete Lawyer') )
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        @if(auth()->user()->can('Edit Lawyer'))
                                            <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('lawyers.edit', $item->id)}}">Edit</a>
                                        @endif
                                        @if(auth()->user()->can('Delete Lawyer'))
                                        <a href="{{route('lawyers.destroy', $item->id)}}"
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
        {{ $list->links('pagination::bootstrap-4') }}
        </div>
</div>
@endsection
