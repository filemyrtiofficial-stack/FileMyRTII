@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('rti.applications.list')}}">RTI Applications</a></li>
<li class="breadcrumb-item active" aria-current="page">{{$data->application_no}}</li>
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<div class="row mt-4 mx-md-4">
    <div class="col-12 col-md-6">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>RTI Applications</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive1 p-0">
                    @if($data->firstAppeal &&  $data->firstAppeal->payment_status == 'paid' && $data->firstAppeal->appealDeatils)
                            <hr>
                            <h4>First Appeal Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Details :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{$data->firstAppeal->appealDeatils->reason ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Documents :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">
                                        @if(!empty($data->firstAppeal->appealDeatils->document))
                                        <a target="blank" href="{{filePreview($data->firstAppeal->appealDeatils->document ?? '')}}">View</a>
                                        @endif
                                        </h5>
                                </div>
                            </div>
                            <hr>

                            @endif

                            @if($data->secondAppeal &&  $data->secondAppeal->payment_status == 'paid' && $data->secondAppeal->appealDeatils)
                            <hr>
                            <h4>Second Appeal Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Details :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{$data->secondAppeal->appealDeatils->reason ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Documents :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">
                                         @if(!empty($data->secondAppeal->appealDeatils->document))
                                        <a target="blank" href="{{filePreview($data->secondAppeal->appealDeatils->document ?? '')}}">View</a>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <hr>

                            @endif
                             @if($data->payment_status != 'pending')
                              <hr>
                            <h4>Charges</h4>
                            <hr>
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Charges</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->charges ?? ''}}</h5>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">GST 18%</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->gst ?? ''}}</h5>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Final Charges</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->final_price ?? ''}}</h5>
                                </div>
                            </div>
                            @endif
                            <hr>
                            <h4>RTI Details</h4>
                            <hr>
                            
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Invoice :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                   <a href="{{invoicePreviewPath($data->application_no, $data->appeal_no)}}" target="blank"><strong>View</strong></a>
                                </div>
                            </div>
                               <hr>
                       
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Date :</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{Carbon\Carbon::parse($data->created_at)->format('d M, Y')}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Application Number</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->application_no ?? ''}}</h5>
                                </div>
                            </div>
                            @if(!empty($data->final_rti_document))
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Final RTI</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title"><a target="blank" href="{{filePreview($data->final_rti_document)}}">View</a></h5>
                                </div>
                            </div>
                             @elseif($data->status >= 2) 
                             <hr>
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Approved RTI</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title"><a target="blank" href="{{url('download-my-rti/'.$data->id)}}">View</a></h5>
                                </div>
                            </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Name of Applicant</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->first_name." ".$data->last_name }}</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Service Chosen</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->service->name ?? ( $data->service_id == 0 ? "Custom Request" : '') }}</h5>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Email Address</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->email ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Phone Number</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->phone_number ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Address</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->address ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">City</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->city ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">State</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->state ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="heading">
                                        <h5 class="card-title">Postal Code</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->postal_code ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="heading">
                                        <h5 class="card-title">Service Category</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $data->service->category->name ?? ''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="heading">
                                        <h5 class="card-title">Payment Status</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title {{paymentStatus()[trim($data->payment_status)]['class'] ??''}}">{{ paymentStatus()[trim($data->payment_status)]['name'] ??''}}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="heading">
                                        <h5 class="card-title">Status</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title {{applicationStatus()[$data->status]['class'] ??''}}">{{ applicationStatus()[$data->status]['name'] ??''}}</h5>
                                </div>
                            </div>
                            <hr>
                                
                            @if ($data->service_id == '0')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">RTI Query</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">{{ $service_name['rti_query'] ?? ''}}</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">Do you know the PIO Address?</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">{{ $service_name['pio_addr'] ?? ''}}</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">PIO Address</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">{{ $service_name['pio_address'] ?? ''}}</h5>
                                    </div>
                                </div>
                                <hr>
                                      
                                        
                                   
                                </div>
                            @else
                                @foreach($fields['field_type'] ?? [] as $key => $value)
                                    @if($fields['form_field_type'][$key] == 'customer')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-text pt-4"><h5 class="card-title"> {{$fields['field_lable'][$key] ?? ''}} {{isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no' ? '(Optional)' : ''}}</h5></div>
                                        </div>
                                        <div class="col-md-8 pt-4"> <div class="card-text"><h5 class="card-title">{{$field_data['field_data'][getFieldName($fields['field_lable'][$key])]['value'] ?? ''}}</h5></div></div>
                                    </div>
                                    <hr>
                                    @endif
                                @endforeach
                            @endif
                                   
</div>
                    
                </div>
            </div>
        </div>
    <div class="col-12 col-md-6">
        @if(($data->status) < 3 && $data->payment_status == 'paid' && empty($data->deleted_at))
            @if(auth()->user()->can('Assign Lawyer'))
            <div class="card mb-4">
                <div class="card-header list-header">
                    <h4>Assign Lawyer</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('rti.applications.assign.lawyer', $data->id)}}" class="form-submit" method="post">
                        @csrf
                        <div class="form-group">
                            <h4 class="form-label">Select lawyer</h4>
                            <div class="input-group">
                                <select id="lawyer" name="lawyer" class="form-control">
                                    <option value="">Select Lawyer</option>
                                    @foreach(App\Models\Lawyer::list(false, ['status' => true]) as $key => $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}} ({{$item->email}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-sm btn-primary">Assign</button>
                        </div>

                    </form>
                </div>
            
            </div>
            @endif
        @endif
        @if(!empty($data->lawyers))
        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Assigned Lawyer</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                           

                        </tr>
                    </thead>
                    <tbody>
                   
                        @foreach($data->lawyers as $index =>  $lawyer)
                            <tr>
                              <td>
                                  
                                    
                                    {{$lawyer->first_name}} {{$lawyer->last_name}}</td>
                                <td>{{$lawyer->email}}</td>
                                <td>{{$lawyer->phone}}</td>
                                <td>@if($index != 0) <span style="color: red;">Inactive</span> @else <span style="color: green;">Active</span> @endif</td>
                             
                             
                            </tr>
                        
                            @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
        @endif
          @if($data->courierTracking)
        <div class="card">
            <div class="card-header">
                    <h4>Tracking Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Courier Name </label>
                                <input class="form-control" type="text" name="courier_name" value="{{$data->courierTracking->courier_name ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Courier Tracking Number</label>
                                <input class="form-control"  name="courier_tracking_number" value="{{$data->courierTracking->courier_tracking_number ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Courier Date </label>
                                <input class="form-control" type="date" name="courier_date" max="{{date('Y-m-d')}}" value="{{$data->courierTracking->courier_date ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Courier Charges </label>
                                <input class="form-control" type="" name="charges" value="{{$data->courierTracking->charges ?? ''}}" placeholder=""  @if($data->courierTracking) disabled @endif>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first_name">Courier Delivered Details</label>
                                <textarea class="form-control" name="details" id="" @if($data->courierTracking) disabled @endif>{{$data->courierTracking->address ?? ''}}</textarea>
                            </div>
                        </div>
                         @foreach($data->courierTracking->documents ?? [] as $document)
                         <div class="col-12">

                             <div class="card">
                                <div class="card-body">
                                    <embed src="{{asset($document)}}" width="100" />
                                    <br>
                                    <a href="{{route('preview-document',Crypt::encryptString($document))}}"  class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary ml-2" target="blank">
                                    View</a>

                                  

                                </div>
                            </div>
                        </div>

                        @endforeach

                        
                    </div>
                </div>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>All Drafts</h4>
            </div>
            <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Draft By</th>
                                <th>Draft Date</th>
                                <th>Modification Date</th>
                                <th></th>

                            </tr>
                        </thead>
                        <thead>
                            @foreach($data->allDrafts ?? [] as $key => $value)
                                    <tr @if(isset($_GET['request']) && !empty($_GET['request']) && $_GET['request'] == $value->id) class="bg-warning"  @endif>
                                        <td>{{$value->lawyer->fullName ?? ''}} ({{$value->lawyer->email ?? ''}})</td>
                                        <td>{{Carbon\Carbon::parse($value->created_at)->format('d M, Y g:i A')}}</td>
                                        <td>@if(!empty($value->customer_change_request)){{Carbon\Carbon::parse($value->updated_at)->format('d M, Y g:i A')}} @endif</td>
                                        <td>
                                      
                                            <a  data-toggle="modal" id="change_request_{{$value->id}}-btn"  data-target="#change_request_{{$value->id}}" data-whatever="@mdo"
                                            href="javascript:void(0)" >View</a>
                                            
                                            <div class="modal fade" id="change_request_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="change_requestLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="change_requestLabel">Modifications</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">

                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Fields</th>
                                                                                <th>Existing (Previous)</th>
                                                                                <th>Revised By Customer</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $revision_data = json_decode($value->details, true);
                                                                            $change_request = json_decode($value->customer_change_request, true);


                                                                            ?>

                                                                            @foreach(rtiPersonalDetailFields() as $key => $value)

                                                                            <tr>
                                                                                <td><strong>{{ $value['label']}}</strong></td>
                                                                                <td>{{$revision_data[$key ] ?? ''}} </td>
                                                                                <td>{{$change_request[$key] ?? ''}}</td>
                                                                            </tr>
                                                                            @endforeach

                                                                            @if($data->lastRevision)
                                                                                @foreach($fields['field_type'] ?? [] as $key => $value)
                                                                                    @if((!isset($fields['form_field_type'][$key]) || $fields['form_field_type'][$key] != 'lawyer' ))

                                                                                        @php
                                                                                            $field_key =  getFieldName($fields['field_lable'][$key]);
                                                                                        @endphp
                                                                                
                                                                                        <tr @if(isset($change_request[$field_key])) <?php if( (strip_tags($revision_data[$field_key ]) != strip_tags($change_request[$field_key] ?? ""))) {?> class="text-danger-light" <?php }?> @endif>
                                                                                            <td><strong>{{$fields['field_lable'][$key] ?? ''}}</strong></td>
                                                                                            @if($value == 'file')
                                                                                            <td>
                                                                                                @if(isset($revision_data[$field_key ]) && !empty($revision_data[$field_key ]))
                                                                                                <a target="blank" href="{{filePreview(($revision_data[$field_key ] ?? ''))}}">
                                                                                                <svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg>
                                                                                                </a> 
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if(isset($change_request[$field_key ]) && !empty($change_request[$field_key ]))
                                                                                                    <a target="blank" href="{{filePreview(($change_request[$field_key ] ?? ''))}}">
                                                                                                    <svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg>
                                                                                                    </a> 
                                                                                                @endif
                                                                                            </td>
                                                                                            @else
                                                                                            <td>{!! $revision_data[$field_key ] ?? '' !!} </td>
                                                                                            <td>{!! $change_request[$field_key] ?? '' !!}</td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    @endif

                                                                                @endforeach

                                                                            @endif
                                                                        
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </td>
                                    </tr>
                            @endforeach

                        </thead>

                    </table>
                </div>
            </div>
           
        </div>


        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>More Information Query</h4>
            </div>
            <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Lawyer</th>
                                <th>Query</th>
                                <th>Date</th>

                                <th></th>

                            </tr>
                        </thead>
                        <thead>
                            @foreach($data->rtiQueries ?? [] as $key => $value)
                                    <tr @if(isset($_GET['query']) && !empty($_GET['query']) && $_GET['query'] == $value->id) class="bg-warning"  @endif>
                                        <td>{{$value->lawyer->fullName ?? ''}} ({{$value->lawyer->email ?? ''}})</td>
                                        <td>{{ stringLimit(($value->message?? ''), 50) }}</td>

                                        <td>{{Carbon\Carbon::parse($value->created_at)->format('d M, Y g:i A')}}</td>
                                        <td>
                                            <a  data-toggle="modal" data-target="#more_query_{{$value->id}}" id="#more_query_{{$value->id}}-btn" data-whatever="@mdo"
                                            href="javascript:void(0)">View</a>
                                            <div class="modal fade" id="more_query_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="more_queryLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="more_queryLabel">Query</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">

                                                                <div >
                                                                   
                                                                   
                                                                   <div class="row">
                                                                        <div class="col-md-12">
                                                                        <textarea class="form-control" disabled>Query : {{$value->message}} </textarea>
                                                                        <textarea class="form-control mt-2" disabled>Reply : {{$value->reply}}</textarea>
                                                                        </div>
                                                                        @foreach($value->documents ?? [] as $key => $doc)
                                                                            <div class="col-md-4">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <embed src="{{route('preview-document', encryptString($doc))}}" width="100" />
                                                                                        <br>
                                                                                        <a target="blank" href="{{route('preview-document', encryptString($doc))}}" target="blank">
                                                                                        View</a>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                   </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </td>
                                    </tr>
                            @endforeach

                        </thead>

                    </table>
                </div>
            </div>
           
        </div>


        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Documents</h4>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    @foreach($data->documents ?? [] as $key => $value)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <embed src="{{asset($value)}}" width="100" />
                                <br>
                                 <a href="{{route('preview-document', encryptString($value))}}"  class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary ml-2" target="blank">
                                View</a>

                                <a href="{{route('rtiapplication.document.delete', [$data->id, $key])}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn  btn btn-sm btn-danger ml-2">Delete</a>


                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
           
        </div>
    </div>
 
</div>
@endsection
@push('js')

@if(isset($_GET['request']) && !empty($_GET['request'])) 
<script>
    $("#change_request_{{$_GET['request']}}-btn").click();
</script>

@endif


@if(isset($_GET['query']) && !empty($_GET['query'])) 
<script>
    $("#more_query_{{$_GET['query']}}-btn").click();
</script>

@endif

@endpush