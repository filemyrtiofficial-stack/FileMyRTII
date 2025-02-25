@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">PIO Master</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lawyer Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <form action="{{route('pio.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card mb-4">
            <div class="card-header list-header">

                <h4>PIO Import</h4>

            </div>
            <div class="card-body">
                <div class="d-flex">
                    <input type="file" name="file" class="form-control" class="col-12">
                    <button class="btn btn-primary float-end ms-2">Submit</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>



<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>PIO</h4>
                @if(auth()->user()->can('Create PIO'))
                <a href="{{route('pio.create')}}" class="btn btn-primary float-end">Add
                PIO</a>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">State</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">District</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pincode
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mandal</th> --}}
                                <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tahsildar</th> -->
                                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Department</th> --}}


                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                @if(auth()->user()->can('Edit PIO') || auth()->user()->can('Delete PIO') )
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>

                                <td class="align-middle text-sm">{{$item->address?? ''}} </td>
                                {{-- <td class="align-middle text-sm">{{$item->state?? ''}} </td>
                                <td class="align-middle text-sm">{{$item->city ?? ''}} </td>
                                <td class="align-middle text-sm">{{$item->pincode?? ''}} </td>
                                <td class="align-middle text-sm">{{$item->mandal?? ''}} </td> --}}
                                <!-- <td class="align-middle text-sm">{{$item->tahsildar?? ''}} </td> -->
                                {{-- <td class="align-middle text-sm">{{$item->department?? ''}} </td> --}}

                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit PIO') || auth()->user()->can('Delete PIO') )
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    @if(auth()->user()->can('Edit PIO'))
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('pio.edit', $item->id)}}">Edit</a>
                                     @endif
                                     @if(auth()->user()->can('Delete PIO'))
                                        <a href="{{route('pio.destroy', $item->id)}}"
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
