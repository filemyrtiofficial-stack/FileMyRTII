@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Ambulance Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header pb-0 list-header">
                <h6>Ambulance</h6>
                <!-- <a href="/hospitals/create" class="btn bg-gradient-dark btn-sm float-end mb-0">Add Hospital</a> -->
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ambulance No.
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact person
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact No.
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Hospital
                                </th>
                               
                                <!-- <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th> -->
                                <!-- <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ambulances as $item)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-sm font-weight-bold mb-0">{{$item->ambulance_no}}</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$item->contact_person}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$item->contact_no}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$item->hospital->name ?? ''}} ({{$item->hospital->fullAddress()}})</p>
                                </td>
                               
                                <!-- <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a href="{{route('hospitals.show', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0">View</a>
                                        <a href="{{route('hospitals.edit', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2">Edit</a>
                                        <a href="{{route('hospitals.destroy', $item->id)}}"
                                        class="text-sm font-weight-bold mb-0 ps-2 delete-btn">Delete</a>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $ambulances->links('pagination::bootstrap-4') }}
        </div>
</div>
@endsection