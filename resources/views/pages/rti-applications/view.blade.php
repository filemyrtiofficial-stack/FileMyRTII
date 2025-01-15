@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'RTI Applications'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>RTI Applications</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-0">
                <div class="table-responsive p-0">
                    <div class="row mx-0">
                        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                            <div class="side-nav">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            Case Studies
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="col-md-9 ms-sm-auto col-lg-10 px-4 pt-4 pb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="heading">
                                        <h5 class="card-title">Date</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Application Number</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Name of Applicant</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Service Chosen</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Email Address</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Phone Number</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Full Address</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Postal Code</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Service Category</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Payment Status</h5>
                                    </div>
                                    <div class="heading pt-4">
                                        <h5 class="card-title">Status</h5>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-text"><h5 class="card-title">{{Carbon\Carbon::parse($data->created_at)->format('d M, Y')}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->application_no ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->first_name." ".$data->last_name }}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->service->name ?? ( $data->service_id == 0 ? "Custom Request" : '') }}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->email ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->phone_number ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->address ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->postal_code ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->serviceCategory->name ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ $data->payment_status ?? ''}}</h5></div>
                                    <div class="card-text pt-4"><h5 class="card-title">{{ commonStatus()[$data->status]['name'] ??''}}</h5></div>
                                </div>
                            </div>
                            @if ($data->service_id == '0')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">Pio Details</h5>
                                        </div>
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">RTI Query</h5>
                                        </div>
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">Do you know the PIO Address?</h5>
                                        </div>
                                        <div class="card-text pt-4">
                                            <h5 class="card-title">PIO Address</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-text pt-4"><h5 class="card-title">{{ $service_name['pio_address'] ?? ''}}</h5></div>
                                        <div class="card-text pt-4"><h5 class="card-title">{{ $service_name['rti_query'] ?? ''}}</h5></div>
                                        <div class="card-text pt-4"><h5 class="card-title">{{ $service_name['pio_addr'] ?? ''}}</h5></div>
                                        <div class="card-text pt-4"><h5 class="card-title">{{ $service_name['pio_address'] ?? ''}}</h5></div>
                                    </div>
                                </div>
                            @else
                                @foreach($fields['field_type'] ?? [] as $key => $value)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-text pt-4"><h5 class="card-title"> {{$fields['field_lable'][$key] ?? ''}} {{isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no' ? '(Optional)' : ''}}</h5></div>
                                        </div>
                                        <div class="col-md-8 pt-4"> <div class="card-text"><h5 class="card-title">{{$field_data['field_data'][Illuminate\Support\Str::slug($fields['field_lable'][$key])]['value'] ?? ''}}</h5></div></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- <table class="table align-items-center mb-0">
                        <thead>
                            
                        </thead>
                        <tbody> --}}
                            {{-- @php
                            echo '<pre>';
                                print_r($data);
                                echo '</pre>';
                            @endphp

                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
    <div>
        {{-- {{ $list->links('pagination::bootstrap-4') }} --}}
        </div>
</div>
@endsection