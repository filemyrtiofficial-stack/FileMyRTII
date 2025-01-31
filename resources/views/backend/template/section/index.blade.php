@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Section</h4>
                @if(auth()->user()->can('Create Section Data'))
                <a href="{{route('template-section.create')}}" class="btn btn-primary float-end">Add
                Section1</a>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Slug
                                </th>
                                
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Description
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                @if(auth()->user()->can('Edit Section Data') || auth()->user()->can('Delete Section Data'))
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
                                            <h6 class="mb-0 text-sm">{{$item->section}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">{{$item->slugMaster->slug ?? ''}}</td>
                                <td class="align-middle text-sm">{{$item->description ?? ''}}</td>

                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit Section Data') || auth()->user()->can('Delete Section Data'))
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                   
                                    
                                        <a class="text-sm font-weight-bold mb-0 ps-2"
                                        href="{{route('template-section-fields.index', $item->id)}}">Manage Fields</a>
                                @if(auth()->user()->can('Edit Section Data'))

                                        <a class="text-sm font-weight-bold mb-0 ps-2"
                                            href="{{route('template-section.edit', $item->id)}}">Edit</a>
                                            @endif
                                @if(auth()->user()->can('Delete Section Data'))

                                        <a href="{{route('template-section.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn">Delete</a>
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