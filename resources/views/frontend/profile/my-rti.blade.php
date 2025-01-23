@extends('frontend.layout.layout')

@section('content')

        


        <section class="contact_section dashboard_section">
            <div class="container">
                <div class="section_heading">
                    <h2>Empower yourself with RTI solutions.</h2>
                </div>
                <div class="section_sub_heading">
                    <h4>All your RTI Applications are here</h4>
                </div>

                <div class="my_profile">
                    <div class="my_info">
                        <div class="profile">
                            <div class="profile_img">
                                <img class="img-fluid" src="images/service-listing/profile-1.webp" alt="">
                            </div>
                            <div class="profile_name">
                                <div class="p_name">{{auth()->guard('customers')->user()->fullName}}</div>
                                <div class="p_email">{{auth()->guard('customers')->user()->email}}</div>
                            </div>
                        </div>
                        <div class="profile_action">
                            <a class="profile_btn login-modal" href="javascript:void(0);">Change Password</a>
                            <a class="profile_btn" href="#">Logout</a>
                        </div>
                    </div>
                    <div class="my_application">
                        @foreach($list as $key => $item)
                        <div class="application_card">
                            <div class="card_header">RTI Application No: <span class="app_no">{{$item->application_no}}</span></div>
                            <div class="card_body">
                                <div class="application_detail">
                                    <div class="row">
                                        <div class="col-12 col-sm-9">
                                            <div class="app_status">
                                                <ul class="app_date">
                                                    <li class="heading">Application Date <span>:</span></li>
                                                    <li>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</li>
                                                </ul>
                                                <ul class="app_date">
                                                    <li class="heading">Status <span>:</span></li>
                                                    <li> {{$item->payment_status == 'pending' ?  "Payment Pending" : "paid"}}</li> @if($item->payment_status == 'pending')<a class="theme-btn-link" href="javascript:void(0);">Delete</a>@endif
                                                </ul>
                                                <ul class="status_bar">
                                                    <li @if($item->status >= 1) class="active" @endif><a href="javascript:void(0);">1</a><span>Started</span></li>
                                                    <li @if($item->status >= 2) class="active" @endif><a href="javascript:void(0);">2</a><span>Approval</span></li>
                                                    <li @if($item->status == 3) class="active" @endif><a href="javascript:void(0);">3</a><span>Filed</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="app_action">
                                                @if($item->payment_status == 'pending')
                                                <a class="theme-btn" href="javascript:void(0);">Pay Now</a>
                                                @endif
                                                <a class="theme-btn" href="{{route('my-rti', $item->application_no)}}">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
         
        </section>
        
@endsection

