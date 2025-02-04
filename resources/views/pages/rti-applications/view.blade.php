@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<div class="row mt-4 mx-4">
    <div class="col-6">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>RTI Applications</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive1 p-0">
                       
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
                                        <h5 class="card-title">Full Address</h5>
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
                                    <h5 class="card-title">{{ $data->serviceCategory->name ?? ''}}</h5>
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
                                    <h5 class="card-title {{paymentStatus()[$data->payment_status]['class'] ??''}}">{{ paymentStatus()[$data->payment_status]['name'] ??''}}</h5>
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-text pt-4"><h5 class="card-title"> {{$fields['field_lable'][$key] ?? ''}} {{isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no' ? '(Optional)' : ''}}</h5></div>
                                        </div>
                                        <div class="col-md-8 pt-4"> <div class="card-text"><h5 class="card-title">{{$field_data['field_data'][getFieldName($fields['field_lable'][$key])]['value'] ?? ''}}</h5></div></div>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif
                                   
                            
                                 
                               
                    </div>
                    
                </div>
            </div>
        </div>
    <div class="col-6">
        @if(empty($data->lawyer_id))
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
        @if(!empty($data->lawyer_id))
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
                            <tr>
                                <td>{{$data->lawyer->first_name}} {{$data->lawyer->last_name}}</td>
                                <td>{{$data->lawyer->email}}</td>
                                <td>{{$data->lawyer->phone}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
           
        </div>
        @endif
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
                                <a href="{{route('preview-document', encryptString($value))}}" target="blank">
                                    <embed src="{{asset($value)}}" width="100" />
                                </a>
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