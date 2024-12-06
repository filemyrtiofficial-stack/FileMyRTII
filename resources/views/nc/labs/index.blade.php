@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Labs Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header pb-0 list-header">
                <h6>Labs</h6>
                <a href="{{route('labs.create')}}" class="btn bg-gradient-dark btn-sm float-end mb-0">Add Lab</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Address
                                </th>
                               
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div>
                                            <img src="{{asset(($item->hospitalPrimaryImage->image ?? ''))}}"
                                                class="avatar me-3" alt="image">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$item->fullAddress()}}</p>
                                </td>
                               
                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a href="{{route('labs.show', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0">View</a>
                                        <a href="{{route('labs.edit', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2">Edit</a>
                                        <a href="{{route('labs.destroy', $item->id)}}"
                                        class="text-sm font-weight-bold mb-0 ps-2 delete-btn">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
        {{ $list->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection