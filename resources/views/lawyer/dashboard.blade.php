@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer-overview.css')}}">
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">


@endpush
@section('content')

<section class="dashboard_section overview_table_section">
            <div class="container">

                <div class="section_heading">
                    <h2>Welcome {{auth()->guard('lawyers')->user()->fullName}}</h2>
                </div>


                <div class="col_box_main">
                    <div class="col_box_left">

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon1.png')}}" alt=""> </div>
                            <h2 class="title_part">  {{$total_rti['active']}} </h2>
                            <p> Active RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon2.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['pending']}} </h2>
                            <p> Pending RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon3.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['filed']}} </h2>
                            <p> Filed RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon4.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['total']}} </h2>
                            <p> Total RTIs </p>
                        </div>

                    </div>


                    <div class="col_box_right">
                        <div class="col_logo"> {{auth()->guard('lawyers')->user()->fullName[0]}} </div>
                        <div class="arrow_col"> 
                            <a href="javascript:void(0);" class="click_col"> 
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </a> 

                            <div class="col_dropdown">
                                <ul>
                                    <li> <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="personal_detail_modal" > <span> <img src="{{asset('assets/rti/images/dashboard-overview/user-new.png')}}" alt=""> </span> Profile Edit </a> </li>
                                    <li> <a href="javascript:void(0);"  class="change-password-modal"> <span> <img src="{{asset('assets/rti/iimages/dashboard-overview/password.png')}}" alt=""> </span> Change Password</a> </li>
                                    <li> <a href="javascript:void(0);"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span> <img src="{{asset('assets/rti/iimages/dashboard-overview/log-out.png')}}" alt=""> </span> Log Out </a> </li>



                                
                                <form role="form" method="post" action="{{ route('lawyer.logout') }}" id="logout-form">
                                    @csrf
                                    
                                </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                         
                </div>


                <div class="tab_overview">
              
                     <div class="tab_overview_up">
                        <ul>
                            <li><a href="{{route('lawyer.my-rti')}}?status=active" class="overview_click @if(!isset($_GET['status']) || (isset($_GET['status']) && strtolower($_GET['status']) == 'active'))active @endif" data-id="active_rti"> Active RTIs </a></li>
                            <li><a href="{{route('lawyer.my-rti')}}?status=pending" class="overview_click  @if(isset($_GET['status']) && strtolower($_GET['status']) == 'pending')active @endif" data-id="pending_rti"> Pending RTIs </a></li>
                            <li><a href="{{route('lawyer.my-rti')}}?status=filed" class="overview_click  @if(isset($_GET['status']) && strtolower($_GET['status']) == 'filed')active @endif" data-id="filed_rti"> Filed RTIs </a></li>
                            <li><a href="{{route('lawyer.my-rti')}}?status=all" class="overview_click  @if(isset($_GET['status']) && strtolower($_GET['status']) == 'all')active @endif" data-id="total_rti"> Total RTIs </a></li>
                        </ul>
                     </div>


                     <div class="tab_overview_bottom">

                        <div class="overview_data tab-active" data-id="active_rti"> 
                             <div class="tab_overview_data">
                                <table>
                                     <thead> 
                                        <th> Date</th>    
                                        <th> Application No </th>    
                                        <th> Name</th>    
                                        <th> Status </th>    
                                    </thead>

                                    <tbody>
                                        @foreach($list as $item)
                                        <tr>
                                                <td><a href="javascript:void(0);"> <div class="date_month_table"> <span class="date_table"> {{Carbon\Carbon::parse($item->created_at)->format('d')}} </span> <span class="month_table"> {{Carbon\Carbon::parse($item->created_at)->format('M y')}} </span> </div> </a> </td>
                                                <td><a href="javascript:void(0);"> {{$item->application_no}} </a></td>
                                                <td><a href="javascript:void(0);"> <div class="strong_data">{{$item->fullName}}</div></a> </td>
                                                <td><a href="{{route('lawyer.my-rti', $item->application_no)}}"><div class="status_btn"> {{lawyerApplicationStatus()[$item->status]['name'] ?? ''}} <span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83928 23.6492C6.32516 24.1169 7.11186 24.1169 7.5965 23.6492L17.8721 13.7329C18.8426 12.7964 18.8426 11.277 17.8721 10.3404L7.52209 0.350952C7.04119 -0.111943 6.26429 -0.117941 5.77717 0.338959C5.27886 0.805452 5.27409 1.57414 5.76369 2.04783L15.2365 11.1882C15.7224 11.6571 15.7224 12.4162 15.2365 12.8851L5.83928 21.9535C5.3534 22.4212 5.3534 23.1815 5.83928 23.6492Z" fill="#0384D4"/>
                                                    </svg> </span></a> </div>
                                                </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                                <div class="btn_view_more">
                                    <a href="javascript:void(0);" class="theme-btn"> <span> View More </span> </a>
                                </div>

                             </div>
                        </div>


                        <div class="overview_data" data-id="pending_rti"> 
                            <div class="tab_overview_data">
                               2
                            </div>
                        </div>


                         <div class="overview_data" data-id="filed_rti"> 
                            <div class="tab_overview_data">
                              3
                            </div>
                         </div>

                        <div class="overview_data" data-id="total_rti"> 
                            <div class="tab_overview_data">
                              4
                            </div>
                        </div>


                     </div>


                </div>


                
                
               
            </div>
        </section>


        
    @include('lawyer.auth.my-profile')
@endsection


