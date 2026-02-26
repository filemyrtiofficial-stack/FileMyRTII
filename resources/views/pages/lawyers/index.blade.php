@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Lawyers</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lawyer Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                  <form action="" id="search-form">
                            <div class="row">
                                    <div class="col-md-3">
                                        <label>Search</label>
                                            <input type="text" name="search" class="form-control" placeholder="Search By Name" value="{{$_GET['search'] ?? ''}}">
                                    </div>
                                    <div class="col-md-3">
                                          <label>Status</label>
                                            <select  name="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach(commonStatus() as $key =>  $value)
                                                            <option value="{{$key}}" {{isset($_GET['status']) && $_GET['status'] == $key ? 'selected' : ''}}>{{$value['name'] ?? ''}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                         <div class="col-md-3">
                                               <label>RTI Date Range</label>
                                       <input type="text" name="daterange" id="" class="form-control daterange" value="{{$_GET['daterange'] ?? ''}}">
                                    </div>

                                    
                                    <div class="col-12">
                                            <button class="btn btn-sm btn-primary float-right">Filter</button>
                                            <a href="{{route('lawyers.export')}}?search={{$_GET['search'] ?? ''}}&status={{$_GET['status'] ?? ''}}&daterange={{$_GET['daterange'] ?? ''}}" class="btn btn-sm btn-secondary float-right">Export</a>

                                    </div>
                            </div>
                  </form>
            </div>
        </div>

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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Filed RTI</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Pending RTI</th>

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
                                  <td class="align-middle text-center"><a target="blank" href="{{route('rti.applications.list')}}?lawyer_id={{$item->id}}">{{$item['rti_applications_count'] ?? 0}}</a></td>
                                <td class="align-middle text-center"><a target="blank" href="{{route('rti.applications.list')}}?lawyer_id={{$item->id}}&status=3">{{$item['filed_rti_count'] ?? 0}}</a></td>
                                <td class="align-middle text-center">{{$item['pending_rti_count'] ?? 0}}</td>

            
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
                                            @if(count($item->rtiApplications) > 0)
                                             <a href="#"
                                            class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary ml-2 delete-lawyer" data-rti="{{$item['rti_applications_count'] ?? 0}}" data-href="{{route('rti.applications.list')}}?lawyer_id={{$item->id}}">Delete</a>
                                            @else
                                        <a href="{{route('lawyers.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
                                            @endif
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
