@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Refund Request</li>
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Refund Request'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
                <div class="card-body">
                      <form action="">
                                <div class="row">
                                        <div class="col-md-3">
                                                <input type="text" name="search" class="form-control" placeholder="Search By Application No." value="{{$_GET['search'] ?? ''}}">
                                        </div>
                                        
                                   
                                        <div class="col-md-3">
                                            <select  name="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach(refundRequestStatus() as $key =>  $value)
                                                            <option value="{{$key}}" {{isset($_GET['status']) && $_GET['status'] == $key ? 'selected' : ''}}>{{$value['name'] ?? ''}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                        <div class="col-12">
                                                <button class="btn btn-sm btn-primary float-right">Filter</button>
                                        </div>
                                </div>
                      </form>
                </div>
        </div>
        <div class="card mb-4">
            <div class="card-header  list-header">
                <h4>Refund Requests</h4>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Application No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Appeal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reason</th>
                                 <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Create Date</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                           <a href="{{route('rtiapplication.view', $item->id)}}" > <h6 class="mb-0 text-sm">{{$item->rtiApplication->application_no ?? ''}}</h6></a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{appealDetails()[$item->rtiApplication->appeal_no] ?? ''}}</td>
                                <td>{{ stringLimit($item->reason, 50) }}</td>

                               
                                <td>
                                    <span class="{{paymentStatus()[$item->payment_status]['class'] ??''}}"><b>{{refundRequestStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>
                                
                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>
                                <td class="align-middle text-end">
                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModal_{{$item->id}}" data-whatever="@mdo"
                                            href="javascript:void(0)">View</a>
                                    </div>
                                </td>
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


        @foreach($list as $item)
            @include('pages.rti-applications.refund.popup')
         @endforeach
</div>
@endsection
