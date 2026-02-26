@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Lawyer Request</li>
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-3">
                <div class="card-body">
                      <form action="" id="search-form">
                                <div class="row">
                                        <div class="col-md-3">
                                                <input type="text" name="search" class="form-control" placeholder="Search By Application No." value="{{$_GET['search'] ?? ''}}">
                                        </div>
 <?php
                                    $lawyer_html = "";
                                    ?>

                                    <div class="col-md-3">
                                        <select  name="lawyer_id" class="form-control">
                                                <option value="">Select Lawyer</option>
                                                @foreach(App\Models\Lawyer::list(false) as $item)
                                                <?php
                                    $lawyer_html .= '<option value="'.$item->id.'">'.$item->first_name.' '.$item->last_name.' ('.$item->email.') </option>';
                                    ?>
                                                        <option value="{{$item->id ?? ''}}" {{isset($_GET['lawyer_id']) && $_GET['lawyer_id'] == $item->id ? 'selected' : ''}}>{{$item->first_name ?? ''}} {{$item->last_name ?? ''}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                        <div class="col-md-3">
                                            <select  name="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach(applicationCloseRequestsStatus() as $key =>  $value)
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
                <h4>RTI Applications</h4>
                {{-- <a href="{{route('testimonials.create')}}" class="btn btn-primary float-end">Add Testimonial</a> --}}
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Application No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lawyer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">message </th>
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
                                            <h6 class="mb-0 text-sm">
                                            <a href="{{route('rtiapplication.view', $item->rtiApplication->id ?? '')}}" target="_blank">{{$item->rtiApplication->application_no ?? ''}}</a></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('lawyers.edit',( $item->lawyer->id ?? ''))}}" target="blank">{{$item->lawyer->first_name ?? ""}} {{$item->lawyer->last_name ?? ""}}</a>
                                </td>

                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ stringLimit($item->message, 50) }}</h6>
                                        </div>
                                    </div>
                                </td>

                                  <td>
                                    <span class="{{applicationCloseRequestsStatus()[$item->status]['class'] ??''}}"><b>{{applicationCloseRequestsStatus()[$item->status]['name'] ??''}}</b></span>
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
         <div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="form-submition" action="{{route('approve.lawyer.request',( $item->id ?? ''))}}" method="post">
                                    <input type="hidden" name="application_id" value="{{$item->application_id ?? ''}}"  >
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message</label>
                                            <textarea class="form-control" id="message-text" name="message" disabled>{{$item->message}}</textarea>
                                        </div>
                                          <div class="form-group">

                                                @if(!empty($item->new_lawyer_id))
                                                                                            <label for="message-text" class="col-form-label">New Lawyer</label>
                                           
                                                    <textarea class="form-control" disabled="">{{$item->newLawyer->first_name ?? ""}} {{$item->newLawyer->last_name ?? ""}} ({{$item->newLawyer->email ?? ""}})</textarea>
                                                @else
                                                                                            <label for="message-text" class="col-form-label">Select Lawyer</label>
                                            <div>
                                                  <select name="lawyer" class="form-control lawyer" id="lawyer">
                                                <option value="">Select Lawyer</option>
                                                {!! $lawyer_html !!}
                                            </select>
                                            </div>
                                                @endif
                                          
                                            
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{-- @if(auth()->user()->can('Approve Request')  ) --}}
                                        @if($item->status == '0')
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                        @endif
                                    {{-- @endif --}}
                                    </div>
                                      </form>
                                    </div>
                                    </div>
                                    </div>
         @endforeach
</div>


@endsection
